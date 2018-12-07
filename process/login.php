<?php

require_once __DIR__."/../vendor/autoload.php";
$config = require_once __DIR__.'/../includes/config.php';

use \Curl\Curl;
$curl = new Curl();
$curl->setHeader('Accept','application/json');

$params = [
	'username' => $_POST['username'],
	'password' => $_POST['password']
];

$response = $curl->post($config['API_ENDPOINT'].'/auth/login',$params);

if ($response->status) {

	$_SESSION['user'] = [
		'token' => $response->data->token,
		'name' => $_POST['username']
	];
}

header('Content-Type: application/json');
echo json_encode($response);