.PHONY: up stop down bash
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
