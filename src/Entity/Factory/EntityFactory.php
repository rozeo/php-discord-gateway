<?php

namespace Rozeo\Discord\Entity\Factory;

use Rozeo\Discord\Payload;
use Rozeo\Discord\Event;
use Rozeo\Discord\Entity as Entity;

class EntityFactory
{
    /**
     * @return Entity\EntityInterface|Payload
     */
    public static function make(Payload $payload)
    {
        switch ($payload->getEventName())
        {
            case Event::MESSAGE_CREATE:
            case Event::MESSAGE_UPDATE:
                return new Entity\Message($payload->getData());
        }        
        return $payload;
    }
}
