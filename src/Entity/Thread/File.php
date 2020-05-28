<?php

namespace App\Entity\Thread;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="thread_post_files")
 */
class File
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
     * @var Post
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Thread\Post", inversedBy="files", cascade={"persist"})
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $displayName;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $height;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $width;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private $path;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private $thumbnail;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $type;

    public function __construct(Post $post, array $file)
    {
        $this->post = $post;

        $this->displayName = (string) $file['displayname'] ?? null;
        $this->height      = (int) $file['height'] ?? null;
        $this->width       = (int) $file['width'] ?? null;
        $this->size        = (int) $file['size'] ?? null;
        $this->path        = (string) $file['path'] ?? null;
        $this->thumbnail   = (string) $file['thumbnail'] ?? null;
        $this->type        = (int) $file['type'] ?? null;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @return string|null
     */
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
