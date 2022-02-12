<?php
require './vendor/autoload.php';
use Chat\ChatServer;

$app = new Ratchet\App('localhost',8090);

$app->route('/chat', new ChatServer,['*']);
$app->run();
