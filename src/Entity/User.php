<?php

namespace Rozeo\Discord\Entity;

use DateTime;

class User implements EntityInterface
{
    /**
     * user's id
     * @var string
     */
    private $id;

    /**
     * the user's username
     * @var string
     */
    private $username;

    /**
     * 4 digits discord-tag
     * @var string
     */
    private $discriminator;

    /**
     * avatar hash
     * @var string
     */
    private $avatar;

    /**
     * @var bool
     */
    private $bot;

    /**
     * @var bool
     */
    private $system;

    /**
     * @var bool
     */
    private $mfaEnabled;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var bool
     */
    private $verified;

    /**
     * @var string
     */
    private $email;

    /**
     * @var int
     */
    private $flags;

    /**
     * @var int
     */
    private $premiumType;

    /**
     * @var int
     */
    private $publicFlags;

    public function __construct(array $payloads = [])
    {
        $this->id = $payloads['id'] ?? 0;
        $this->username = $payloads['username'] ?? '';
        $this->discriminator = $payloads['discriminator'] ?? '';
        $this->avatar = $payloads['avatar'] ?? '';
        $this->bot = $payloads['bot'] ?? false;
        $this->system = $payloads['system'] ?? false;
        $this->mfaEnabled = $payloads['mfa_enabled'] ?? false;
        $this->locale = $payloads['locale'] ?? '';
        $this->verified = $payloads['verified'] ?? false;
        $this->email = $payloads['email'] ?? '';
        $this->flags = $payloads['flags'] ?? 0;
        $this->premiumType = $payloads['premium_type'] ?? 0;
        $this->publicFlags = $payloads['public_flags'] ?? 0;
    }

    /**
     * @var snowflake(stringed int)
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getDiscriminator(): string
    {
        return $this->discriminator;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function isBot(): bool
    {
        return $this->bot;
    }

    public function isSystem(): bool
    {
        return $this->system;
    }

    public function isMfaEnabled(): bool
    {
        return $this->mfaEnabled;
    }

    public function getLocale(): string
    {
        return $this->locale;
    } 

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFlags(): int
    {
        return $this->flags;
    }

    public function getPremiumType(): int
    {
        return $this->premiumType;
    }

    public function getPublicFlags(): int
    {
        return $this->publicFlags;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'discriminator' => $this->discriminator,
            'avatar' => $this->avatar,
            'bot' => $this->bot,
            'system' => $this->system,
            'mfa_enabled' => $this->mfaEnabled,
            'locale' => $this->locale,
            'verified' => $this->verified,
            'email' => $this->email,
            'flags' => $this->flags,
            'premium_type' => $this->premiumType,
            'public_flags' => $this->publicFlags,
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}
