<?php

namespace App\Repository;

use App\Entity\Thread;
use Doctrine\ORM\EntityManagerInterface;

class ThreadRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Thread $thread)
    {
        $this->entityManager->persist($thread);
        $this->entityManager->flush();
    }

    public function getByThreadId(string $threadId): ?Thread
    {
        return $this->entityManager->getRepository(Thread::class)->findOneBy(['threadId' => $threadId]);
    }
}
