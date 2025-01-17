start-project:
	docker-compose up -d

restart-project:
	docker-compose restart

reset-project:
	docker-compose down -v db project scheduler
	docker-compose up -d
	make deploy-project-local

# resets db and runs application deployment
reset-api-local:
	docker-compose down -v db project scheduler
	docker-compose up -d
	make deploy-project-local

fetch-pull:
	git fetch --all --prune --jobs=10
	git pull

fetch-checkout-tag:
	git fetch --all --prune --jobs=10
	git checkout $(TAG)

deploy-project-local:
	docker-compose exec -T project sh -c ' \
		cd /var/www/project && \
		composer clear-cache && \
		composer install --optimize-autoloader --no-interaction --prefer-dist && \
		php artisan migrate --force && \
		php artisan cache:clear && \
		php artisan route:cache && \
		php artisan config:cache && \
		php artisan view:cache && \
		composer dump-autoload --optimize
