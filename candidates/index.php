<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/scripts/config.php";

$http = require_once __DIR__ . "/src/infra/http/http.php";

use Slim\App;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__)->load();

$app = new App();

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->get("/", function ($req, $res) {
    return $res->withJson(["msg" => "welcome to candidates service"]);
});

$http($app);

$app->run();
