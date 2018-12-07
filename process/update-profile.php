<?php

require_once __DIR__."/../vendor/autoload.php";
$config = require_once __DIR__.'/../includes/config.php';

use \Curl\Curl;
$curl = new Curl();
$curl->setHeader('Accept','application/json');
$curl->setHeader('X-SECURE-TOKEN',$_SESSION['user']['token']);

$params = [
	'username' => $_POST['username'],
	'password' => $_POST['password'],
	'password_confirmation' => $_POST['password_confirmation'],
];

$response = $curl->put($config['API_ENDPOINT'].'/me',$params);

if ($response->status) {

	$_SESSION['user'] = [
		'name' => $_POST['username']
	];
}

header('Content-Type: application/json');
echo json_encode($response);