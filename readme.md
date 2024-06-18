# tuto Symfony 17/06/2024

Un site internet présentant des peintures

## Features

## Lancer l'environnement de développement
``` bash
composer install
symfony serve
```

## Créer des tests
``` bash
symfony console make:unit-test <nom-du-test>
```

## Lancer des tests
``` bash
php bin/phpunit --testdox
```

## Installation webpack
``` bash
composer require symfony/webpack-encore-bundle
npm install
```