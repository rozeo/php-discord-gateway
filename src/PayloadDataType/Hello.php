<?php

namespace Rozeo\Discord\PayloadDataType;

use Rozeo\Discord\Payload;

class Hello implements DataType
{
    private $heartBeatInterval;

    public static function fromPayload(Payload $payload)
    {
        return new self($payload->getData()["heartbeat_interval"]);
    }

    public function __construct(int $hbInterval)
    {
        $this->heartBeatInterval = $hbInterval;
    }

    public function getHeartBeatInterval()
    {
        return $this->heartBeatInterval;
    }

    public function jsonSerialize()
    {
        return $this->toJson();
    }

    public function toJson()
    {
        return [];
    }
}
