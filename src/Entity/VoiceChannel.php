<?php

namespace Rozeo\Discord\Entity;

class VoiceChannel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $parentId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $bitrate;


    public static function fromArray(array $arr)
    {
        $self = new self();

        $self->id = $arr['id'];
        $self->parentId = $arr['id'] ?? 0;
        $self->name = $arr['name'];
        $self->bitrate = $arr['name'];

        return $self;
    }

    public function getId()
    {
        return $this->id;
    }
}
