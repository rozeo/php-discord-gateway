<?php

namespace Rozeo\Discord\Entity;

class Role implements EntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $permissions;
    
    /**
     * @var int
     */
    private $position;

    /**
     * @var bool
     */
    private $mentionable;

    /**
     * @var array?
     */
    private $hoist;

    /**
     * @var string
     */
    private $color;

    public static function fromArray(array $arr)
    {
        $self = new self();
        
        $self->id = $arr['id'];
        $self->name = $arr['name'] ?? '';
        $self->permissions = $arr['permissions'];
        $self->position = $arr['position'];
        $self->mentionable = $arr['mentionable'];
        $self->hoist = $arr['hoist'];
        $self->color = dechex($arr['color']);

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

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getMentionable()
    {
        return $this->mentionable;
    }

    public function getHoist()
    {
        return $this->hoist;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'permissions' => $this->permissions,
            'position' => $this->position,
            'mentionable' => $this->mentionable,
            'hoist' => $this->hoist,
            'color' => $this->color,
        ];
    }
}
