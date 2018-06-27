<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {
    return "Geo Gaming API";
});

$app->get('/locations', function (Request $request, Response $response, $args) {

	$resource = $this->db->table('locations')->get();

    $res = $response->withJson($resource, 200);
    return $res;

});

$app->put('/locations/{id}', function (Request $request, Response $response, $args) {

	$resource_id = (int)$args['id'];

    $body = $request->getParsedBody();
    $res = $response->withJson($body, 200);

    $this->db->table('locations')->where('id', $resource_id)->update([
        "latitude" 	=> $body['latitude'],
        "longitude" 	=> $body['longitude'],
        "icon" 	=> $body['icon'],
        "active" => $body['active']
    ]);

    $resource = $this->db->table('locations')->where('id', $resource_id)->first();

    $res = $response->withJson($resource, 200);
    return $res;

});