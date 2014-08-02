<?php

include_once(__DIR__ . '/../vendor/autoload.php');

define('APP_ROOT', dirname(__DIR__));

$app = new Jtl\Shop4\Application();
return $app;
