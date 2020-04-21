<?php

require __DIR__ . "/vendor/autoload.php";

$token = '';
$d = new Rozeo\Discord\DiscordGateway($token);

$d->setCallback(function (Rozeo\Discord\Payload $payload) {
    if ($payload->getEventName() === 'MESSAGE_CREATE') {
        $data = $payload->getData();

        echo sprintf("user: %s, message: %s\n", $data["author"]["username"], $data['content']);  
    }
});

$d->start();
