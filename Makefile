.PHONY: start up stop build bash consume

start: up
	docker compose exec app composer update
	docker compose exec app php bin/console doctrine:migrations:migrate --no-interaction
	docker compose exec app php bin/console doctrine:fixtures:load

up:
	docker compose up -d

stop:
	docker compose down

build:
	docker compose build

bash:
	docker compose exec app bash

consume:
	docker compose exec app php bin/console messenger:consume async -vv