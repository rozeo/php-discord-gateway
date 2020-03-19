<?php

namespace Rozeo\Discord\Repository;

use Rozeo\Discord\Entity\Member;
use JsonSerializable;

class Members implements JsonSerializable
{
    private $members;

    public function __construct(array $members = [])
    {
        $this->members = $members;
    }
    

    public function add(Member $member)
    {
        $this->members[$member->getId()] = $member;
    }

    public function findById(int $id)
    {
        return $this->members[$id] ?? null;
    }

    public function jsonSerialize()
    {
        return array_map(function ($member) {
            return $member->toArray();
        }, $this->members);
    }
}
