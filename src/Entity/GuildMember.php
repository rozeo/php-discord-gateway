<?php

namespace Rozeo\Discord\Entity;

use DateTime;
use Rozeo\Discord\Repository\Roles;

class GuildMember implements EntityInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var array<int>
     */
    private $roles;

    /**
     * @var string
     */
    private $nick;

    /**
     * @var DateTime
     */
    private $joinedAt;

    /**
     * @var DateTime|null
     */
    private $premiumSince;

    /**
     * @var bool
     */
    private $deaf;

    /**
     * @var bool
     */
    private $mute;

    const AVATAR_BASE_URL = "https://cdn.discordapp.com/avatars/";

    public function __construct(array $payloads)
    {
        $this->user = new User($payloads['user'] ?? []);

        $this->nick = $payloads['nick'] ?? '';
        $this->roles = $payloads['roles'] ?? [];
        
        $this->joinedAt = new DateTime();
        if (isset($payloads['joined_at'])) {
            $this->joinedAt = new DateTime($payloads['joined_at']);
        }

        $this->premiumSince = null;
        if (isset($payloads['premium_since'])) {
            $this->premiumSince = new DateTime($payloads['premium_since']);
        }

        $this->deaf = $payloads['deaf'] ?? false;
        $this->mute = $payloads['mute'] ?? false; 
    }

    public function getUser()
    {
        return $this->user;
    }

    public function toArray(): array
    {
        return [
            'user' => $this->user->toArray(),
            'nick' => $this->nick,
            'roles' => $this->roles,
            'joined_at' => $this->joinedAt->format('U'),
            'premium_since' => $this->premiumSince 
                ? $this->premiumSince->format('U')
                : null,

            'deaf' => $this->deaf,
            'mute' => $this->mute,
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}
