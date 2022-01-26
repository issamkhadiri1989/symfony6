install: composer-install npm-install run-dev load-fixtures

run-dev:
	npm run dev

npm-install:
	npm install

composer-install:
	composer install

load-fixtures:
	php bin/console doctrine:fixtures:load


