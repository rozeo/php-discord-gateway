<?php

namespace Rozeo\Discord;

use Closure;
use Swoole;
use Co;
use Rozeo\Discord\Entity\Guild;

class DiscordGateway
{
    private $ws;
    private $token;

    const OPCODE_EVENT_MAP = [
        'READY' => 'ready',
    ];

    private $handlers = [];

    private $heartBeatInterval;

    private $heartBeatTimer;
    private $lastSeqNumber;

    private $killed;

    private $channel;

    /**
     * @var Closure
     */
    private $callback;

    public function __construct(string $token)
    {
        $this->token = $token;
        $this->heartBeatTimer = null;
        $this->lastSeqNumber = 0;
        $this->killed = false;

        $this->ws = new WebSocket("gateway.discord.gg", "/?v=6&encoding=json", 443);

        $this->handlers['ready'] = function ($payload) {
        };
    }

    public function setCallback(Closure $closure)
    {
        $this->callback = $closure;
    }

    public function bindEvent(string $eventName, Closure $handler)
    {
        $handlers[$eventName] = $handler;
        return $this;
    }

    public function start()
    {
        $this->ws->connect();
        $self = $this;

        go(function () use ($self) {
            while (!$self->killed) {
                $ret = $self->ws->recv(0.001);

                if (!$ret) {
                    continue;
                }

                $payload = Payload::fromJsonString($ret->data);
                $self->lastSeqNumber = $payload->getSequence();

                go(function () use ($self, $payload) {
                    $self->eventDispatch($payload);
                });
            }
        });

        /*
         *
        echo "Input [Enter] stop discord bot.";
        fgets(STDIN);
        $this->killed = true;
        */
        Swoole\Event::wait();
        Swoole\Timer::clearAll();
    }

    private function eventDispatch(Payload $payload)
    {
        if ($payload->getOpCode() === OpCode::HELLO) {
            $this->registerIndentity(PayloadDataType\Hello::fromPayload($payload));
            return;
        }

        if ($payload->getOpCode() === OpCode::DISPATCH) {
            ($this->callback)($payload);
        }
    }

    private function registerIndentity(PayloadDataType\Hello $payload)
    {
        $self = $this;
        Swoole\Timer::tick($payload->getHeartBeatInterval() * 0.8, function () use ($self) {
            $self->sendHeartBeat();
        });

        $identify = new PayloadDataType\Identify($this->token);
        $retPayload = new Payload(OpCode::IDENTIFY, $identify);

        $this->ws->send(json_encode($retPayload));
    }

    private function sendHeartBeat()
    {
        $payload = new Payload(OpCode::HEARTBEAT, [], $this->lastSeqNumber);
        $this->ws->send(json_encode($payload));
    }
}
