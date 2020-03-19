<?php

namespace Rozeo\Discord\Entity;

use DateTime;
use Rozeo\Discord\Repository\Roles;

class Member implements EntityInterface
{
    private $id;
    private $name;
    private $discriminator;
    private $avatarUrl;
    private $roleIds;
    private $muted;
    private $joinedAt;
    private $hoistedRole;
    private $deaf;

    const AVATAR_BASE_URL = "https://cdn.discordapp.com/avatars/";

    public static function fromArray(array $arr)
    {
        $self = new self();

        $self->id = $arr['user']['id'];
        $self->name = $arr['user']['username'];
        $self->discriminator = $arr['user']['discriminator'];
        $self->avatarUrl =
            self::AVATAR_BASE_URL . $self->id . "/" .
            $arr['user']['avatar'] . ".png";

        $self->roleIds = $arr['roles'];

        $self->muted = $arr['mute'];
        $self->joinedAt = new DateTime($arr['joined_at']);
        $self->hoistedRole = $arr['hoisted_role'];
        $self->deaf = $arr['deaf'];

        return $self;
    }

    public function getId()
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'discriminator' => $this->discriminator,
            'avatar_url' => $this->avatarUrl,
            'role_ids' => $this->roleIds,
            'muted' => $this->muted,
            'joined_at' => $this->joinedAt->format('U'),
            'hoisted_role' => $this->hoistedRole,
            'deaf' => $this->deaf,
        ];
    }
}
