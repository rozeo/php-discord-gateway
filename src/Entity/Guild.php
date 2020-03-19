<?php

namespace Rozeo\Discord\Entity;

use Rozeo\Discord\Repository\Roles;

use Rozeo\Discord\Repository\Emojis;
use Rozeo\Discord\Repository\Members;
use Rozeo\Discord\Repository\Channels;

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
     * @var string server region string
     */
    private $region;

    /**
     * @var Roles roles repository
     */
    private $roles;

    /**
     * @var Channels channels repository
     */
    private $channels;

    /**
     * @var Members members repository
     */
    private $members;

    /**
     * @var Emojis emojis repository
     */
    private $emojis;

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
        $self->region = $arr['region'];

        $self->roles = new Roles();
        foreach ($arr['roles'] as $role) {
            $self->roles->add(Role::fromArray($role));
        }

        $self->channels = new Channels();
        foreach ($arr['channels'] as $channel) {
            $self->channels->add(Factory\ChannelFactory::make($channel));
        }

        $self->members = new Members();
        foreach ($arr['members'] as $member) {
            $self->members->add(Member::fromArray($member));
        }

        $self->emojis = new Emojis();
        foreach ($arr['emojis'] as $emoji) {
            $self->emojis->add(Emoji::fromArray($emoji));
        }

        return $self;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function members()
    {
        return $this->members;
    }

    public function roles()
    {
        return $this->roles;
    }

    public function emojis()
    {
        return $this->emojis;
    }

    public function channels()
    {
        return $this->channels;
    }
}
