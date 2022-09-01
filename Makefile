migrate:
	docker-compose exec backend php artisan migrate
migrate-fresh:
	docker-compose exec backend php artisan migrate:fresh
test:
	docker-compose exec backend php artisan test
key-generate:
	docker-compose exec backend php artisan key:generate