<?php

require_once 'vendor/autoload.php';

use React\EventLoop\Factory as EventLoop;
use React\Socket\ConnectionInterface as Connection;

$loop = EventLoop::create();

$socket = new React\Socket\Server('0.0.0.0:8080', $loop);

$socket->on('connection', function (Connection $connection) {
    $httpResponse = <<<HTTP
HTTP/1.1 200 OK
Server: MyReactPHPServer
Content-Type: text/html
Connection: Closed

<h1>Hello World!</h1>
HTTP;

    $connection->end($httpResponse);
});

$loop->run();