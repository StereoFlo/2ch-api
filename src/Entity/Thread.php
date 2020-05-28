<?php

namespace App\Entity;

use App\Entity\Thread\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="threads")
 */
class Thread
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $threadName;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $threadId;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $isArchived;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $isChecked;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $timestamp;

    /**
     * @var Collection<Post>
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Thread\Post", mappedBy="thread", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $posts;

    public function __construct(string $threadName, string $threadId, int $timestamp)
    {
        $this->posts      = new ArrayCollection();
        $this->threadId   = $threadId;
        $this->threadName = $threadName;
        $this->isArchived = false;
        $this->isChecked  = false;
        $this->timestamp  = $timestamp;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function addPost(Post $post): void
    {
        $this->posts->add($post);
    }

    /**
     * @return Collection<Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    /**
     * @return string
     */
    public function getThreadName(): string
    {
        return $this->threadName;
    }

    /**
     * @return string
     */
    public function getThreadId(): string
    {
        return $this->threadId;
    }

    public function setArchived(): void
    {
        $this->isArchived = true;
    }

    /**
     * @return bool
     */
    public function getIsArchived(): bool
    {
        return $this->isArchived;
    }

    public function setChecked(): void
    {
        $this->isChecked = true;
    }

    /**
     * @return bool
     */
    public function getIsChecked(): bool
    {
        return $this->isChecked;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }
}
