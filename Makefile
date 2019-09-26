up:
	docker-compose up -d

down:
	docker-compose down

build:
	sudo docker-compose up --build -d

perm:
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache

test:
	docker-compose exec php-cli vendor/bin/phpunit

fresh:
	docker-compose exec php-cli php artisan migrate:fresh
