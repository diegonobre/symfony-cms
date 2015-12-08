Symfony CMS
===========
This is a sample project used to test some Symfony Bundles and feautures.

## How to Install

### Create Symfony Project
```shell
# create your Symfony Standard Project
symfony new cms
cd cms/
# download necessary libraries
composer install
```

### Create database using Doctrine
```shell
php app/console doctrine:database:create
```

## Running security check
```shell
php app/console security:check
```

## Install or update GULP
```shell
npm install
gulp
```
