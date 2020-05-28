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

    public function save(array $threads)
    {
        foreach ($threads as $thread) {
            $this->entityManager->persist($thread);
        }
        $this->entityManager->flush();
    }

    /**
     * @return Thread[]
     */
    public function getActive(): ?array
    {
        return $this->entityManager->getRepository(Thread::class)->findBy(['isArchived' => false, 'isChecked' => false]);
    }

    /**
     * @return Thread[]
     */
    public function getArchived(): ?array
    {
        return $this->entityManager->getRepository(Thread::class)->findBy(['isArchived' => true, 'isChecked' => false]);
    }

    public function getByThreadId(string $threadId): ?Thread
    {
        return $this->entityManager->getRepository(Thread::class)->findOneBy(['threadId' => $threadId]);
    }
}
