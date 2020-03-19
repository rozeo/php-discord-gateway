<?php

namespace Rozeo\Discord;

use JsonSerializable;

class Payload implements JsonSerializable
{
    private $op;
    private $d;
    private $t;
    private $s;

    public static function fromJsonString(string $jsonString)
    {
        $json = json_decode($jsonString, true);

        return new self(
            $json['op'],
            $json['d'],
            $json['s'] ?? 0,
            $json['t'] ?? ""
        );
    }

    public function __construct(int $op, $d, int $s = 0, string $t = "")
    {
        $this->op = $op;
        $this->d = $d;
        $this->s = $s;
        $this->t = $t;
    }

    public function getOpCode()
    {
        return $this->op;
    }

    public function getData()
    {
        return $this->d;
    }

    public function getEventName()
    {
        return $this->t;
    }

    public function getSequence()
    {
        return $this->s;
    }

    public function jsonSerialize()
    {
        return $this->toJson();
    }

    public function toJson()
    {
        $arr = [
            'op' => $this->op,
            'd' => $this->d ?? [],
        ];

        if ($this->s > 0) {
            $arr['s'] = $this->s;
        }

        if (!empty($this->t)) {
            $arr['t'] = $this->t;
        }

        var_dump($arr);

        return $arr;
    }
}
