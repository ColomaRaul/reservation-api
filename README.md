# Inicialización del proyecto

## Lanzar un make up para instalar los contenedores
Para instalar toda la infrastructura y los requisitos mínimos para poder probar el desarrollo, lanzar el comando siguiente

```bash
make init
```

Este lo que hace es crear las imágenes de docker, luego lanzar un composer install para instalar los vendors necesarios, luego lanza una migración para crear las tablas necesarias y por último precarga los datos necesarios.

En el fichero de _MAKEFILE_ se encuentran todos los comandos disponibles para lanzar.

Está el _make up_, el _make stop_ (levantar y parar los contenedores), _make bash_ para poder entrar en la consola de PHP dentro del contenedor, _make unit_, para lanzar los test unitarios.

## Estructura del proyecto

El proyecto ha sido montado con PHP 8.1 con una base de Symfony 6.4, dónde he usado Doctrine para la gestión de base de datos el motor de base de datos PostgresSQL, para el servidor una imagen de Nginx para poder atacar a los endpoints

La organización del proyecto se divide en las carpetas dentro de _src_

Dónde tenemos:

- Console (los comandos de consola para poder ejecutar el import de datos inicial)
- Health (un endpoint básico dónde se comprueba que funciona el servicio de Nginx)
- Hotel (todo lo relacionado a un hotel, guardar sus datos y relaciones)
- Reservation (todo lo relacion a una reserva, desde el guardado hasta el endpoint donde se muestra)
- Shared (la carpeta que comparte entre los distintos dominions del proyecto)

### Console
Tan solo tenemos dos comandos para la importación de datos iniciales. Solo usamos 1, el otro que se importa todas las reservas existentes no es necesario lanzarlo al inicio.

### Health
Un endpoint _api/v1/health_ dónde solo se comprueba que el servicio de Nginx funcione. En un futuro se puede usar este endpoint como health check para las subidas a producción. Este endpoint se puede expandir también a que compruebe por ejemplo que hay conexión a la base de datos o a los distintos servicios que dependen de ello.

El endpoint se encuentra definido en la carpeta de _infrastructure_

### Hotel
Solo tiene relación con el hotel. Dónde hay dos tablas, 

- hotel (información básica del hotel, id y nombre)
- hotel_provider_relation (relaciónd de hotel-proveedor, con los identificadores en uuid del hotel y proveedor, como el código de proveedor)

En esta parte solo se guarda información del hotel, y luego posteriormente se consulta para gestionar las reservas

### Reservation
Un endpoint donde se consulta información de la reserva _api/v1/reservation/{hotelId}/{roomNumber}_ dado un UUID de hotel y un número de habitación.

Esta información consulta si existe en la base de datos. Sino existe, la consulta al servicio externo, que posteriormente este lanza un evento para actualizar las reservas que no se hayan insertado todavía.

La tabla que hace uso: _reservation_ tiene los siguientes campos

- id (UUID identificador de la reserva)
- hotel_id (UUID identificador del hotel)
- locator (string del localizador de la reserva)
- room_number (string del número de la habitación)
- check_in (fecha de la hora de la entrada)
- check_out (fecha de la hora de salida)
- created (fecha de la creación de la reserva)
- guests (un array de json que contiene todas las personas que se hospedan en esa habitación)

El endpoint se encuentra definido en la carpeta de _infrastructure_

### Shared
Contiene todo lo que se puede usar en varios dominios, como un tipado genérico para las UUIDs o la colección

También hay un endpoint de home _/_ que tan solo lo hice para que no se mostrara la escafandra de Symfony. Este endpoint no sirve de nada.

Se define también las interfaces de las queries
