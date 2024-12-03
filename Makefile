.PHONY: init start up stop build bash consume m_stats init_tests test

init: start
	docker compose exec app php bin/console doctrine:fixtures:load --no-interaction
	docker run --rm -itv $(CURDIR):/app -w /app node:22 npm install
	docker run --rm -itv $(CURDIR):/app -w /app node:22 npm run build

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

init_tests:
	docker compose exec app php bin/console doctrine:migrations:migrate --no-interaction --env=test
	docker compose exec app php bin/console doctrine:fixtures:load --no-interaction --env=test

test:
	docker compose exec app php bin/phpunit
