<?php

namespace App\Entity;

use App\Entity\Thread\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="boards")
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
     * @ORM\Column(type="string", length=3)
     */
    private $threadId;

    /**
     * @var Collection<Post>
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Thread\Post", mappedBy="thread", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $posts;

    public function __construct(string $threadId)
    {
        $this->posts = new ArrayCollection();
        $this->threadId = $threadId;
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

}
