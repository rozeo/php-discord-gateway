<?php

require __DIR__ . "/vendor/autoload.php";

$token = '****';
$d = new Rozeo\Discord\DiscordGateway($token);

$d->start();
