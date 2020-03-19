<?php

namespace Rozeo\Discord\Entity;

use DateTime;
use Rozeo\Discord\Repository\Roles;

class Member
{
    private $id;
    private $name;
    private $discriminator;
    private $avatorUrl;
    private $roles;
    private $muted;
    private $joinedAt;
    private $hoistedRole;
    private $deaf;

    const AVATOR_BASE_URL = "https://cdn.discordapp.com/avatars/";

    public static function fromArray(array $arr, Roles $roles)
    {
        $self = new self();

        $self->id = $arr['id'];
        $self->name = $arr['name'];
        $self->discriminator = $arr['discriminator'];
        $self->avatorUrl =
            self::AVATOR_BASE_URL . $self->id . "/" .
            $arr['avator'] . ".png";

        $self->roles = [];
        foreach ($arr['roles'] as $role) {
            $self->roles[] = $roles->findById($role);
        }

        $self->muted = $arr['muted'];
        $self->joinedAt = new DateTime($arr['joined_at']);
        $self->hoistedRole = $arr['hoisted_role'];
        $self->deaf = $arr['deaf'];

        return $self;
    }

    public function getId()
    {
        return $this->id;
    }
}
