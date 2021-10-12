MAKEFLAGS += --warn-undefined-variables --no-builtin-rules
SHELL := bash
.SHELLFLAGS := -eu -o pipefail -c

dc-run := docker-compose run --rm --no-deps
dc-run-user := $(dc-run) --user "$$(id -u):$$(id -g)"

php := $(dc-run-user) --workdir="/app" php

USER := $(shell whoami)

install: .env $(wildcard .env.local) vendor database

vendor: composer.lock
	$(php) composer install --prefer-dist --no-suggest
	@touch vendor

database: database-empty database-migration

database-empty: vendor
	$(php) bin/console doctrine:database:drop --force --if-exists
	$(php) bin/console doctrine:database:create

database-migration: vendor
	$(php) bin/console doctrine:migration:migrate --no-interaction