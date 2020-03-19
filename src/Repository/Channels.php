<?php

namespace Rozeo\Discord\Repository;

use Rozeo\Discord\Entity\TextChannel;
use Rozeo\Discord\Entity\VoiceChannel;
use Rozeo\Discord\Entity\CategoryChannel;

class Channels
{
    private $textChannels;
    private $voiceChannels;
    private $categories;

    public function __construct(array $tc = [], array $vc = [], array $categories = [])
    {
        $this->textChannels = $tc;
        $this->voiceChannels = $vc;
        $this->categories = $categories;
    }

    public function add($channel)
    {
        if ($channel instanceof TextChannel) {
            $this->textChannels[$channel->getId()] = $channel;
        }

        if ($channel instanceof VoiceChannel) {
            $this->voiceChannels[$channel->getId()] = $channel;
        }

        if ($channel instanceof CategoryChannel) {
            $this->categories[$channel->getId()] = $channel;
        }
    }

    public function findTextChannelById(int $id)
    {
        $this->textChannels[$id] ?? null;
    }
}
