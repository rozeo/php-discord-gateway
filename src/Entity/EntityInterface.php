<?php

namespace Rozeo\Discord\Entity;

interface EntityInterface
{
    public function __construct(array $payloads);

    public function toArray(): array;

    public function toString(): string;
}
