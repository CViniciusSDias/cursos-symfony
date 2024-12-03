.PHONY: init start up stop build bash consume m_stats

init: start
	docker compose exec app php bin/console doctrine:fixtures:load --no-interaction

start: up
	docker compose exec app composer install
	docker compose exec app php bin/console doctrine:migrations:migrate --no-interaction

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

m_stats:
	docker compose exec app php bin/console messenger:stats