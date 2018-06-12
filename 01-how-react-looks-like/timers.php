<?php

require 'vendor/autoload.php';

use React\EventLoop\Factory as EventLoop;

$loop = EventLoop::create();

$loop->addTimer(1, function () {
    echo 'First hello!'.PHP_EOL;
});

$secondTimer = $loop->addTimer(2, function () {
    echo 'Second hello!'.PHP_EOL;
});

$loop->addPeriodicTimer(1.2, function () {
    echo '[INFINITE] hello...'.PHP_EOL;
});

$loop->run();
