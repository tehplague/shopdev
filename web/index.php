<?php

if (!defined('WEB_ROOT')) {
    define('WEB_ROOT', __DIR__);
}

$app = require_once(__DIR__ . '/../app/bootstrap.php');
$app->run();