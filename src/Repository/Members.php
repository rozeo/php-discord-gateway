<?php

namespace Rozeo\Discord\Repository;

use Rozeo\Discord\Entity\Member;

class Members
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
}
