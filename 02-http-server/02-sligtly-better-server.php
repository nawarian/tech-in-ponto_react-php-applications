<?php

require_once 'vendor/autoload.php';

use React\EventLoop\Factory as EventLoop;
use React\Http\Server;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;

$loop = EventLoop::create();

$server = new Server(function (ServerRequestInterface $request) {
    return new Response(
        200,
        ['Content-Type' => 'text/html'],
        '<h1>Hello World!</h1>'
    );
});

$socket = new React\Socket\Server(8080, $loop);
$server->listen($socket);

$loop->run();