<?php

require __DIR__ . "/vendor/autoload.php";

$token = '****';
$d = new Rozeo\Discord\DiscordGateway($token);

$d->bindEvent(Rozeo\Discord\Event::READY, function () {
    echo "Discord bot is ready!\n\n";
});

$d->bindEvent(Rozeo\Discord\Event::MESSAGE_CREATE, function (Rozeo\Discord\Entity\Message $message) {
    echo sprintf("Name: %s %s\n  text: %s\n",
        $message->getAuthor()->getUsername(),
        $message->getTimestamp()->format('Y/m/d H:i:s'),
        $message->getContent()
    );
});

$d->start();
