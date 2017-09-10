<?php

require_once __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../app'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {

}

$app = new \Core\Application();


$app->registerRoutes(function ($router) {
    require __DIR__ . '/../app/Routes/api_routes.php';
});

$app->start();
