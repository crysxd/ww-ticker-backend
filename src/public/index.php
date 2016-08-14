<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\Firebase;

require '../vendor/autoload.php';
require 'team.php';

// Extend max run time to 5 min
ini_set('max_execution_time', 300);

$app = new \Slim\App;
$app->get('/database/update', function (Request $request, Response $response) {
    $team = new Team();
    $team->fetch();
	$fb = Firebase::initialize("https://ww-ticker-3ccb6.firebaseio.com/", "HTQOqDOQzDLmPEj1myUrz4b3PthRhLQbI0zpddO6");
	$fb->set('/team', $team->players);
    $response->getBody()->write('{"success":true}');

    return $response;

});
$app->run();