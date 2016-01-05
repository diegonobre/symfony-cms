Symfony CMS
===========
This is a sample project used to test some Symfony Bundles and feautures.

[![Build Status](https://travis-ci.org/diegonobre/symfony-cms.svg?branch=master)](https://travis-ci.org/diegonobre/symfony-cms) 
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/diegonobre/symfony-cms/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/diegonobre/symfony-cms/?branch=master)
[![Coverage Status](https://coveralls.io/repos/diegonobre/symfony-cms/badge.svg?branch=master&service=github)](https://coveralls.io/github/diegonobre/symfony-cms?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/566856b2fdeb51003700007d/badge.svg?style=flat)](https://www.versioneye.com/user/projects/566856b2fdeb51003700007d)

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

### Install or update GULP
```shell
npm install
gulp
```
### Set file permissions
```shell
chmod a-x '.gitignore' \
    'LICENSE' \
    'README.md' \
    'app/.htaccess' \
    'app/AppCache.php' \
    'app/AppKernel.php' \
    'app/Resources/views/base.html.twig' \
    'app/Resources/views/default/index.html.twig' \
    'app/autoload.php' \
    'app/config/config.yml' \
    'app/config/config_dev.yml' \
    'app/config/config_prod.yml' \
    'app/config/config_test.yml' \
    'app/config/parameters.yml.dist' \
    'app/config/routing.yml' \
    'app/config/routing_dev.yml' \
    'app/config/security.yml' \
    'app/config/services.yml' \
    'app/phpunit.xml.dist' \
    'composer.json' \
    'composer.lock' \
    'src/.htaccess' \
    'src/AppBundle/AppBundle.php' \
    'src/AppBundle/Controller/AdminController.php' \
    'src/AppBundle/Controller/CustomUserController.php' \
    'src/AppBundle/Controller/DefaultController.php' \
    'src/AppBundle/Controller/SecurityController.php' \
    'src/AppBundle/Entity/CustomUser.php' \
    'src/AppBundle/Form/CustomUserType.php' \
    'src/AppBundle/Resources/views/CustomUser/edit.html.twig' \
    'src/AppBundle/Resources/views/CustomUser/index.html.twig' \
    'src/AppBundle/Resources/views/CustomUser/new.html.twig' \
    'src/AppBundle/Resources/views/CustomUser/show.html.twig' \
    'src/AppBundle/Resources/views/Security/login.html.twig' \
    'src/AppBundle/Resources/views/admin/index.html.twig' \
    'web/.htaccess' \
    'web/app.php'
  ```

### Running security check
```shell
php app/console security:check
```
