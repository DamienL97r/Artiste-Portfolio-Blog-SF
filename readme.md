# tuto Symfony 17/06/2024

Un site internet présentant des peintures

## Features

## Lancer l'environnement de développement
``` bash
composer install
npm install
npm run build
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

## Mise en places des fixtures avec FakerPHP
``` bash
composer require --dev orm-fixtures
composer require fakerphp/faker
```

## Charger les fixtures
``` bash
symfony console doctrine:fixtures:load
```

## Recevoir les mail sur mailtrap
``` bash
php bin/console messenger:consume async --env=dev
```
