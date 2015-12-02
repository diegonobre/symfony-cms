Symfony CMS
===========

## Create Symfony Project
```shell
# create your Symfony Standard Project
symfony new cms
cd cms/
# download necessary libraries
composer install
```

## Create database using Doctrine
```shell
php app/console doctrine:database:create
```

## Create CustomUserEntity
```shell
php app/console doctrine:generate:entity
php app/console doctrine:schema:update --force
# create complete CRUD using doctrine
php app/console generate:doctrine:crud
```

## Running security check
```shell
php app/console security:check
```

## GULP
```shell
npm install
gulp watch
```
