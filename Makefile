include .env
export

DC := docker-compose exec php-fpm
DCT := docker-compose exec -T php-fpm
DOCKER := docker
OS := $(shell uname)

start:
	@docker-compose up -d

stop:
	@docker-compose stop

build-container:
	@docker-compose build php-fpm

ssh:
	@$(DC) bash

console:
	@$(DC) bin/console

workspace-connect:
	ssh -i ${CERT_PATH} -l ubuntu ${LIVE_HOST}

workspace-clear:
	ssh -i ${CERT_PATH} -l ubuntu ${LIVE_HOST} 'cd ~/deployserver && docker ps && rm -rf ~/deployserver/* && ls'

workspace-unpack:
	ssh -i ${CERT_PATH} -l ubuntu ${LIVE_HOST} 'cd ~/deployserver && tar -zxvf workspace.tar.gz'

workspace-start:
	ssh -i ${CERT_PATH} -l ubuntu ${LIVE_HOST} 'cd ~/deployserver && make stop && make start && make cache-clear'

workspace-upload:
	scp -i ${CERT_PATH} ./workspace.tar.gz ubuntu@${LIVE_HOST}:${DEPLOY_PATH}

pack:
	tar -czf workspace.tar.gz --exclude=workspace.tar.gz .

deploy: pack workspace-clear workspace-upload workspace-unpack workspace-start

cache-clear:
	@$(DCT) bin/console cache:clear