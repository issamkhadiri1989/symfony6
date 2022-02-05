composer-install:
	composer install

assets:
	php bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json

npm:
	npm run dev

install: composer-install assets npm

