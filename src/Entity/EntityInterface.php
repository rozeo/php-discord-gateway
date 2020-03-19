<?php

namespace Rozeo\Discord\Entity;

interface EntityInterface
{
    public static function fromArray(array $arr);

    public function toArray(): array;
}
