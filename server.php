<?php

    require __DIR__ . '/vendor/autoload.php';

    $server   = new \TusPhp\Tus\Server('redis'); // Leave empty for file based cache
    $response = $server->serve();

    $response->send();

    exit(0);

?>