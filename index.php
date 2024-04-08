<?php

session_start(); // Startet die Session

require 'core/bootstrap.php';

$routes = [
    '/'                => 'GameController@welcome',
    'game/start'      => 'GameController@startGame',
    'game'            => 'GameController@playGame',
    'game/abort'      => 'GameController@abort',
    'game/tip'        => 'GameController@processTip',  
    'game/answer'     => 'GameController@showAnswer',
];


$db = [
    'name'     => 'm307',
    'username' => 'TEST',
    'password' => '123',
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');
