<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'team.php';

ini_set('max_execution_time', 300);

$app = new \Slim\App;
$app->get('/database/update', function (Request $request, Response $response) {
    $team = new Team();
    $team->fetch();
    $response->getBody()->write(json_encode($team->players));

    return $response;

});
$app->run();