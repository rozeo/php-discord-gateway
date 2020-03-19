<?php

namespace Rozeo\Discord;

use Closure;
use Swoole\Coroutine\Http\Client as SwooleHttpClient;
use Swoole;

class WebSocket
{
    private $ws;

    private $host;

    private $uri;

    private $port;

    private $events;

    /**
     * @var \Exception |null
     */
    private $error;

    public function __construct(string $host, string $uri, int $port)
    {
        $this->host = $host;
        $this->uri = $uri;
        $this->port = $port;
        $this->error = null;

        $ip = gethostbyname($this->host);
        if ($ip === $host) {
            throw new Exception\WebSocketConnectException("Invalid host.");
        }

        $this->ws = new SwooleHttpClient($ip, $port, true);

        // for websocket upgrade headers
        $this->ws->setHeaders([
            "Host" => $this->host,
            "Connection" => "Upgrade",
            "User-Agent" => 'Chrome/80.0.3987.132',
            "Upgrade" => "websocket",
            "Sec-WebSocket-Key" => base64_encode(openssl_random_pseudo_bytes(64)),
            "Sec-WebSocket-Version" => 13,
        ]);
    }

    public function connect()
    {
        $self = $this;

        \Co\run(function () use ($self) {
            $self->ws->get($self->uri);
            
            if ($self->ws->getStatusCode() !== 101) {
                $self->error = new Exception\WebSocketConnectException(
                    "Cannot switching websocket protocol"
                );
                return;
            }

            // upgrade to websocket
            $self->ws->upgrade($self->uri);
        });

        if ($this->error) {
            throw $this->error;
        }
    }

    public function recv(float $timeout = -1.0)
    {
        return $this->ws->recv($timeout);
    }

    public function send(string $data): self
    {
        $this->ws->push($data);
        return $this;
    }

    public function close()
    {
        $this->ws->close();
    }
}
