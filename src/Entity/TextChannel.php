<?php

namespace Rozeo\Discord\Entity;

class TextChannel
{
    private $id;
    private $parentId;
    private $name;
    private $topic;

    public static function fromArray(array $arr)
    {
        $self = new self();

        $self->id = $arr['id'];
        $self->parentId = $arr['parent_id'] ?? 0;
        $self->name = $arr['name'];
        $self->topic = $arr['topic'];

        return $self;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getParentId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTopic()
    {
        return $this->topic;
    }
}
