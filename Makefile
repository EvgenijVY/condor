#!make
.SILENT:
.DEFAULT_GOAL:= help

COLOR_DEFAULT=\033[0m
COLOR_RED=\033[31m
COLOR_GREEN=\033[32m
COLOR_YELLOW=\033[33m

.PHONY: help
help: ## Shows the help
help:
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//' | awk 'BEGIN {FS = ":"}; {printf "$(COLOR_YELLOW)%s:$(COLOR_DEFAULT)%s\n\n", $$1, $$2}'

.PHONY: up
up: ##Start
up:
	docker-compose up -d --force-recreate --build $(args)

.PHONY: down
down: ##Stop
down:
	docker-compose down --remove-orphans

.PHONY: join
join: ##Join
join:
	docker-compose exec php bash