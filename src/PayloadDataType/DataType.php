<?php

namespace Rozeo\Discord\PayloadDataType;

use Rozeo\Discord\Payload;
use JsonSerializable;

interface DataType extends JsonSerializable
{
    public static function fromPayload(Payload $payload);
    public function toJson();
}
