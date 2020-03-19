<?php

namespace Rozeo\Discord\Entity;

use Rozeo\Discord\Repository\Roles;

// use Rozeo\Discord\Repository\Emojis;
use Rozeo\Discord\Repository\Members;

// use Rozeo\Discord\Repository\Channels;

class Guild
{
    /**
     * @var int Guild id
     */
    private $id;

    /**
     * @var string Guild name
     */
    private $name;

    /**
     * @var Roles roles repository
     */
    private $roles;

    /**
     * @var Members members repository
     */
    private $members;

    /**
     * build guild informations from Payload array
     * @param array $arr payload array
     *
     * @return Guild
     */
    public static function fromArray(array $arr)
    {
        $self = new self();

        $self->id = $arr['id'];
        $self->name = $arr['name'];

        $self->roles = new Roles();
        foreach ($arr['roles'] as $role) {
            $self->roles->add(Role::fromArray($role));
        }

        $self->members = new Members();
        foreach ($arr['members'] as $member) {
            $self->members->add(Member::fromArray($member, $self->roles));
        }

        return $self;
    }
}
