<?php

namespace Rozeo\Discord\Entity;

class Emoji implements EntityInterface
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
     * @var bool
     */
    private $requireColons;

    /**
     * @var bool
     */
    private $managed;

    /**
     * @var bool
     */
    private $available;

    /**
     * @var bool
     */
    private $animated;

    public static function fromArray(array $arr)
    {
        $self = new self();

        $self->id = $arr['id'];
        $self->name = $arr['name'];
        $self->requireColons = $arr['require_colons'];
        $self->managed = $arr['managed'];
        $self->available = $arr['available'];
        $self->animated = $arr['animated'];

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
            'require_colons' => $this->requireColons,
            'managed' => $this->managed,
            'available' => $this->available,
            'animated' => $this->animated,
        ];
    }
}
