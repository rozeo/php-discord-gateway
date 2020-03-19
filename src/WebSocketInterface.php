<?php

namespace Rozeo\Discord;

use Closure;

interface WebSocketInterface
{
    /**
     * @expect Exception\WebSocketConnectException
     */
    public function connect();

    public function recv(): string;

    public function send(string $data);

    public function close();
}
