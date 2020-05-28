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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lasthit;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $banned;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $closed;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $date;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $num;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $parent;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sticky;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $subject;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tags;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $timestamp;

    /**
     * @var string|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $trip;

    /**
     * @var File[]|null
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Thread\File", mappedBy="post", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $files;

    public function __construct(Thread $thread, \Phpach\Thread\Post $post)
    {
        $this->thread = $thread;
        $this->name = $post->getName();
        $this->banned = $post->getBanned();
        $this->closed = $post->getClosed();
        $this->comment = $post->getComment();
        $this->date = $post->getDate();
        $this->lasthit = $post->getLasthit();
        $this->num = $post->getNum();
        $this->number = $post->getNumber();
        $this->parent = $post->getParent();
        $this->sticky = $post->getSticky();
        $this->subject = $post->getSubject();
        //$this->tags = $post->getTags();
        $this->timestamp = $post->getTimestamp();
        $this->trip = $post->getTrip();
        $this->setFiles($post->getFiles());
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

    /**
     * @param \Phpach\Thread\File[]|null $files
     */
    private function setFiles(?array $files): void
    {
        if ($files) {
            foreach ($files as $file) {
                $this->files[] = new File($this, $file);
            }
        }
    }
}

