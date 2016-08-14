<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'team.php';

$app = new \Slim\App;
$app->get('/database/update', function (Request $request, Response $response) {
    $team = new Team();
    $team->fetch();
    $response->getBody()->write($team->players[0]);

    return $response;

});
$app->run();