<?php

namespace Rozeo\Discord\Repository;

use Rozeo\Discord\Entity\Role;

class Roles
{
    private $roles;

    public function __construct(array $roles = [])
    {
        $this->roles = $roles;
    }

    public function add(Role $role)
    {
        $this->roles[$role->getId()] = $role;
    }

    public function findById(int $id)
    {
        return $this->roles[$id] ?? null;
    }
}
