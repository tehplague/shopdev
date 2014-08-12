<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
$app = require_once(__DIR__ . '/../app/bootstrap.php');

// replace with mechanism to retrieve EntityManager in your app
$entityManager = $app['orm.em'];

// map MySQL enum to PHP string
$platform = $entityManager->getConnection()->getDatabasePlatform();
$platform->registerDoctrineTypeMapping('enum', 'string');

return ConsoleRunner::createHelperSet($entityManager);
