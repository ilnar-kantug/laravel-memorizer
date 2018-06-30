up-docker:
	docker-compose up -d

down-docker:
	docker-compose down

build-docker:
	docker-compose up --build -d

test:
	docker-compose exec php-cli vendor/bin/phpunit

install-assets:
	docker-compose exec node yarn install

rebuild-assets:
	docker-compose exec node npm rebuild node-sass --force

dev-assets:
	docker-compose exec node yarn run dev

prod-assets:
	docker-compose exec node yarn run prod

watch-assets:
	docker-compose exec node yarn run watch

perm:
	sudo chmod -R 777 vendor
	sudo chmod -R 777 storage
	sudo chmod -R 777 bootstrap/cache
	if [ -d "node_modules" ]; then sudo chmod -R 777 node_modules; fi
	if [ -d "public/build" ]; then sudo chmod -R 777 public/build; fi

migrate:
	docker-compose exec php-cli php artisan migrate

migrate-seed:
	docker-compose exec php-cli php artisan migrate:refresh --seed

seed:
	docker-compose exec php-cli php artisan db:seed