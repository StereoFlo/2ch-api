<?php

namespace App\Entity\Thread;

use App\Entity\Thread;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="thread_posts")
 */
class Post
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
     * @var Thread
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Thread", inversedBy="posts", cascade={"persist"})
     * @ORM\JoinColumn(name="thread_id", referencedColumnName="id")
     */
    private $thread;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $lasthit;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $banned;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $closed;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private $date;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $num;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $parent;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $sticky;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text")
     */
    private $subject;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $tags;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $timestamp;

    /**
     * @var string|null
     *
     * @ORM\Column(type="integer")
     */
    private $trip;

    /**
     * @var File[]|null
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Thread\File", mappedBy="post", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $files;

    public function __construct(Thread $thread, array $post)
    {
        $this->thread = $thread;
        $this->name = $post['name'] ?? null;
        $this->banned = $post['banned'] ?? null;
        $this->closed = $post['closed'] ?? null;
        $this->comment = $post['comment'] ?? null;
        $this->date = $post['date'] ?? null;
        $this->lasthit = $post['lasthit'] ?? null;
        $this->num = $post['num'] ?? null;
        $this->number = $post['number'] ?? null;
        $this->op = $post['op'] ?? null;
        $this->parent = $post['parent'] ?? null;
        $this->sticky = $post['sticky'] ?? null;
        $this->subject = $post['subject'] ?? null;
        $this->tags = $post['tags'] ?? null;
        $this->timestamp = $post['timestamp'] ?? null;
        $this->trip = $post['trip'] ?? null;
        $this->setFiles($post['files'] ?? null);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Thread
     */
    public function getThread(): Thread
    {
        return $this->thread;
    }

    /**
     * @return int|null
     */
    public function getLasthit(): ?int
    {
        return $this->lasthit;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getBanned(): ?int
    {
        return $this->banned;
    }

    /**
     * @return int|null
     */
    public function getClosed(): ?int
    {
        return $this->closed;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @return int|null
     */
    public function getNum(): ?int
    {
        return $this->num;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @return int|null
     */
    public function getParent(): ?int
    {
        return $this->parent;
    }

    /**
     * @return int|null
     */
    public function getSticky(): ?int
    {
        return $this->sticky;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @return int|null
     */
    public function getTags(): ?int
    {
        return $this->tags;
    }

    /**
     * @return int|null
     */
    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    /**
     * @return string|null
     */
    public function getTrip(): ?string
    {
        return $this->trip;
    }

    /**
     * @return File[]|null
     */
    public function getFiles(): ?array
    {
        return $this->files;
    }

    private function setFiles(?array $files): void
    {
        if ($files) {
            foreach ($files as $file) {
                $this->files[] = new File($this, $file);
            }
        }
    }
}

