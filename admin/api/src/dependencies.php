<?php
// DIC configuration
$container = $app->getContainer();
$container['logger'] = function ($c) {
	$settings = $c->get('settings')['logger'];
	$logger = new Monolog\Logger($settings['name']);
	$logger->pushProcessor(new Monolog\Processor\UidProcessor());
	//$logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
	foreach ($settings['type'] as $elTipo) {
		$logger->pushHandler(new Monolog\Handler\StreamHandler($elTipo['path'], $elTipo['level']));
	}
	return $logger;
};
$container['saludador'] = function ($c) {
	$saludador = new App\Saludador($c['logger']);
	return $saludador;
};
//SESSION WRITE CLOSE!!!!
$container['sessionador'] = function ($c) {
	$session = new App\Session($c['logger']);
	return $session;
};
$container['logueador'] = function ($c) {
	$loguea = new App\Login($c['logger']);
	return $loguea;
};
$container['usuario'] = function ($c) {
	$user = new App\User($c['logger']);
	return $user;
};
$container['usuarios'] = function ($c) {
	$users = new App\UserMapper($c['logger']);
	return $users;
};
$container['producto'] = function ($c) {
	$product = new App\Product($c['logger']);
	return $product;
};
$container['productos'] = function ($c) {
	$products = new App\ProductMapper($c['logger']);
	return $products;
};
$container['institucional'] = function ($c) {
	$institucional = new App\InstitucionalMapper($c['logger']);
	return $institucional;
};