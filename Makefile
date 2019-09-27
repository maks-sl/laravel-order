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

migrate-fresh:
	docker-compose exec php-cli php artisan migrate:fresh

composer-install:
	docker-compose exec php-cli composer install

composer-dump-o:
	docker-compose exec php-cli composer dump-autoload -o

yarn-install:
	docker-compose exec node yarn install

yarn-dev:
	docker-compose exec node yarn run dev

yarn-watch:
	docker-compose exec node yarn run watch
