<?php

namespace Rozeo\Discord\Repository;

use Rozeo\Discord\Entity\Emoji;

class Emojis
{

    /**
     * @var Emoji[]
     */
    private $emojis;
    
    public function __construct(array $emojis = [])
    {
        $this->emojis = $emojis;
    }

    public function add(Emoji $emoji)
    {
        $this->emojis[$emoji->getId()] = $emoji;
        return $this;
    }

    public function findById(int $id)
    {
        return $this->emojis[$id] ?? null;
    }
}
