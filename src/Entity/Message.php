<?php

namespace Rozeo\Discord\Entity;

use DateTime;

class Message implements EntityInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $channelId;

    /**
     * @var string|null
     */
    private $guildId;

    /**
     * @var User|null
     */
    private $author;

    /**
     * @var GuildMember|null
     */
    private $member;

    /**
     * @var string
     */
    private $content;

    /**
     * @var DateTime
     */
    private $timestamp;
    
    /**
     * @var DateTime
     */
    private $editedTimestamp;

    /**
     * @var bool
     */
    private $tts;

    /**
     * @var bool
     */
    private $mentionEveryone;

    /**
     * @var array<User>
     */
    private $mentions;

    /**
     * @var array<int>
     */
    private $mentionRoles;
    
    public function __construct(array $payloads = [])
    {
        $this->id = $paylods['id'] ?? 0;
        $this->channelId = $payloads['channel_id'] ?? 0;
        $this->guildId = $payloads['guild_id'] ?? null;

        $this->author = array_key_exists('author', $payloads)
            ? new User($payloads['author'])
            : null;

        $this->member = array_key_exists('member', $payloads)
            ? new GuildMember($payloads['member'])
            : null;

        $this->content = $payloads['content'] ?? '';

        $this->timestamp = array_key_exists('timestamp', $payloads)
            ? new DateTime($payloads['timestamp'])
            : new DateTime;

        $this->editedTimestamp = array_key_exists('edited_timestamp', $payloads)
            ? new DateTime($payloads['edited_timestamp'])
            : new DateTime();

        $this->tts = $payloads['tts'] ?? false;
        $this->mentionEveryone = $payloads['mention_everyone'] ?? false;
        $this->mentions = array_map(fn($arr) => new User($arr), $payloads['mentions'] ?? []);
        $this->mentionRoles = array_map('intval', $payloads['mention_roles'] ?? []);       

        // channel mention object 
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getChannelId(): string
    {
        return $this->channelId;
    }

    public function getGuildId(): string 
    {
        return $this->guildId;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getMember(): GuildMember
    {
        return $this->member;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

    public function getEditedTimestamp(): DateTime
    {
        return $this->editedTimestamp;
    }

    public function isTTS(): bool
    {
        return $this->tts;
    }

    public function isMentionEveryone(): bool
    {
        return $this->mentionEveryone;
    }

    public function getMentions(): array
    {
        return $this->mentions;    
    }

    public function getMentionRoles(): array
    {
        return $this->mentionRoles;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'channel_id' => $this->channelId,
            'guild_id' => $this->guildId,
            'author' => $this->author->toArray(),
            'member' => $this->member
                ? $this->member->toArray()
                : null,
            'content' => $this->content,
            'timestamp' => $this->timestamp->format('U'),
            'edited_timestamp' => $this->editedTimestamp->format('U'),
            'tts' => $this->tts,
            'mention_everyone' => $this->mentionEveryone,
            'memtions' => array_map(fn($u) => $u->toArray(), $this->mentions),
            'mention_roles' => $this->mentionRoles,
        ];
    }

    public function toString(): string 
    {
        return json_encode($this->toArray());
    }
}
