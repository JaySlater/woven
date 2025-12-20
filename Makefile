include .env
export

.PHONY: help build

CONTAINER=${APP_ENV}-${APP_NAME}
CONTAINER_PHP=${CONTAINER}-fpm

help: ## Print help.
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

ps: ## Show containers.
	@docker compose ps

start: ## Start all containers
	@docker compose -f docker-compose.yml up --force-recreate -d
	@docker ps
build: 	## Build all containers
	@docker compose build
stop: ## Stop all containers
	@docker compose stop

migrate: ## Run migration files
	docker exec ${CONTAINER_PHP} php artisan migrate

migrate-rollback: ## Rollback migration files
	docker exec ${CONTAINER_PHP} php artisan migrate:rollback --step=1
