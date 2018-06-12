<?php

require_once 'vendor/autoload.php';

use React\EventLoop\Factory as EventLoop;
use Psr\Http\Message\ServerRequestInterface as Request;
use React\Http\Response;
use React\Promise as P;

$loop = EventLoop::create();

$server = new \React\Http\Server([
    function (Request $req, callable $next) {
        echo "[{$req->getServerParams()['REQUEST_TIME']}] Got request!\n";

        return $next($req);
    },
    function () use ($loop) {
        return new P\Promise(function ($resolve) use ($loop) {
            $loop->addTimer(3, function () use ($resolve) {
                $response = new Response(200);
                $response->getBody()->write('Hello world!');

                return $resolve($response);
            });
        });
    },
]);

$socket = new React\Socket\Server(8080, $loop);
$server->listen($socket);

$loop->run();
