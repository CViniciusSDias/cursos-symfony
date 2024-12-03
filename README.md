# Curso de programação assíncrona com PHP

## Pré-requisitos

- Docker e docker-compose instalados

## Executar o projeto

Caso esteja em ambiente Linux (WSL serve) e tenha `make` instalado, basta executar o comando `make`.

```bash
make
```

Caso contrário, execute os comandos a seguir:

```bash
docker compose up -d
docker compose exec app composer update
docker compose exec app php bin/console doctrine:migrations:migrate --no-interaction
docker compose exec app php bin/console doctrine:fixtures:load
# Caso tenha NPM localmente, pode omitir a parte do Docker
docker run --rm -itv $(pwd):/app -w /app node:23 npm install
docker run --rm -itv $(pwd):/app -w /app node:23 npm run build
```

Com isso, acesse http://localhost:8000/pt_BR/series para acessar a aplicação e http://localhost:8025 para acessar o _Mailpit_.

## Login

Ao executar os passos anteriores, um usuário será criado com os seguintes dados:

- **E-mail**: email@example.com
- **Senha**: 123456
