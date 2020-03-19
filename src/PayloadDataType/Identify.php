<?php

namespace Rozeo\Discord\PayloadDataType;

use Rozeo\Discord\Payload;

class Identify implements DataType
{
    private $token;

    private $os;

    private $browser;

    private $device;

    public static function fromPayload(Payload $payload)
    {
    }

    public function __construct(
        string $token,
        string $osName = "Linux",
        string $browserName = "dummy",
        string $deviceName = "dummy"
    ) {
        $this->token = $token;
        $this->os = $osName;
        $this->browser = $browserName;
        $this->device = $deviceName;
    }

    public function jsonSerialize()
    {
        return $this->toJson();
    }

    public function toJson()
    {
        return [
            'token' => $this->token,
            'properties' => [
                '$os' => $this->os,
                '$browser' => $this->browser,
                '$device' => $this->device,
            ],
            /*
            'large_threshold' => 30,
            'compress' => false,
            'shard' => [0, 1],
            'presence' => [
                'game' => null,
                'status' => 'online',
                'since' => null,
                'afk' => false,
            ],
            'guild_subscriptions' => true,
            'intents' => false,
             */
        ];
    }
}
