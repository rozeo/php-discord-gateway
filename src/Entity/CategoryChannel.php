<?php

namespace Rozeo\Discord\Entity;

class CategoryChannel
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
    private $bitrate;
    
    public function fromArray(array $arr)
    {
        $self = new self();

        $self->id = $arr['id'];
        $self->name = $arr['name'];
        $self->bitrate = $arr['bitrate'];

        return $self;
    }

    public function getId()
    {
        return $this->id;
    }
}
