<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/congressperson', function () use ($app) {

    $app->get('', function (Request $request, Response $response, array $args) {
        $response->getBody()->write("Hello");
        return $response;
    });
});
