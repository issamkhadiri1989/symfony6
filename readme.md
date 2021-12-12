# What is it?
This project is for demonstration purposes. The goal is to show how to work with Voters in a Symfony based application.


# Content
## Dependencies

This projet is based on :
### webpack encore bundle
```
composer require symfony/webpack-encore-bundle
npm install
npm run dev (To compile all assets)
```
### Doctrine fixtures feature
```
composer require --dev orm-fixtures
php bin/console doctrine:fixtures:load (to load all fixtures)
```
### StofDoctrineExtensionsBundle
```
composer require stof/doctrine-extensions-bundle
```

# How to install ?

After cloning the project, you need to run the following commands :

```
composer install
npm install
npm run dev
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
```
