.PHONY: up stop down bash composer init build migrate load-hotel-data

init: build up composer migrate load-hotel-data

build:
	cd .docker && docker-compose build
up:
	cd .docker && docker-compose up

stop:
	cd .docker && docker-compose stop

down:
	cd .docker && docker-compose down

bash:
	cd .docker && docker-compose exec php sh

unit:
	cd .docker && docker-compose exec php vendor/phpunit/phpunit/phpunit -c phpunit.xml.dist

composer:
	cd .docker && docker-compose exec php composer install

migrate:
	cd .docker && docker-compose exec php php bin/console doctrine:migrations:migrate -n

load-hotel-data:
	cd .docker && docker-compose exec php php bin/console app:load-hotel-data
