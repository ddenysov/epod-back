include .env
export

DC := docker-compose exec php
DOCKER := docker
OS := $(shell uname)

start:
	@docker-compose up -d

stop:
	@docker-compose stop

build-container:
	@docker-compose build php

ssh:
	@$(DC) sh

console:
	@$(DC) bin/console
