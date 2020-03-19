<?php

namespace Rozeo\Discord\Entity\Factory;

use Rozeo\Discord\Entity\CategoryChannel;
use Rozeo\Discord\Entity\VoiceChannel;
use Rozeo\Discord\Entity\TextChannel;

class ChannelFactory
{
    public static function make(array $arr)
    {
        switch ($arr['type']) {
        case 0:
            return TextChannel::fromArray($arr);

        case 2:
            return VoiceChannel::fromArray($arr);

        case 4:
            return CategoryChannel::fromArray($arr);
        }
    }
}
