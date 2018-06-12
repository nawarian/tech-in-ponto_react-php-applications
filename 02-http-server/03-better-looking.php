<?php

require_once 'vendor/autoload.php';

use React\EventLoop\Factory as EventLoop;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use React\Http\Server;
use React\Http\Response;

class Application
{
    public function __invoke(ServerRequestInterface $request)
    {
        $response = new Response(200, ['content-type' => 'text/html']);

        return $this->handleRequest($request, $response);
    }

    private function handleRequest(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write('<h1>Hallo Welt!</h1>');

        return $response;
    }
}

$app = new Application();

$server = new Server($app);

$loop = EventLoop::create();
$socket = new React\Socket\Server(8080, $loop);
$server->listen($socket);

$loop->run();