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

key:
	docker-compose exec php-cli php artisan key:generate

seed:
	docker-compose exec php-cli php artisan db:seed

config-default:
	cp .env.example .env

composer-install:
	docker-compose exec php-cli composer install

composer-dump-o:
	docker-compose exec php-cli composer dump-autoload -o

yarn-install:
	docker-compose exec node yarn install

yarn-dev:
	docker-compose exec node yarn run dev

yarn-prod:
	docker-compose exec node yarn run prod

yarn-watch:
	docker-compose exec node yarn run watch

redis-flush:
	docker-compose exec redis redis-cli flushall
