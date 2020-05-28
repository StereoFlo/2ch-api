<?php

namespace App\Command;

use App\Entity\Thread;
use App\Repository\ThreadRepository;
use Exception;
use Phpach\Phpach;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportThreadCommand extends Command
{
    protected static $defaultName = 'thread:import';

    /**
     * @var ThreadRepository
     */
    private $threadRepos;

    /**
     * @var Phpach
     */
    private $phpach;

    public function __construct(ThreadRepository $threadRepos, Phpach $phpach)
    {
        parent::__construct();
        $this->threadRepos = $threadRepos;
        $this->phpach = $phpach;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $boards = $this->phpach->getAllBoards();

        foreach ($boards as $board) {
            foreach ($board->getBoards() as $b) {
                $board = $this->phpach->getAllThreadsInBoard($b->getId());
                if (empty($board)) {
                    continue;
                }

                $toSave = [];
                $count = 0;
                foreach ($board->getThreads() as $thread) {
                    if ($this->threadRepos->getByThreadId($thread->getNum())) {
                        continue;
                    }

                    $threadDb = new Thread($b->getId(), $thread->getNum(), $thread->getTimestamp());

                    try {
                        $tmpThread = $this->phpach->getThread($b->getId(), $thread->getNum());
                    } catch (Exception $exception) {
                        $threadDb->setArchived();
                        $toSave[] = $threadDb;
                        continue;
                    }

                    foreach ($tmpThread->getThreads() as $item1) {
                        foreach ($item1->getPosts() as $item2) {
                            $post = new Thread\Post($threadDb, $item2);
                            $threadDb->addPost($post);
                        }
                    }
                    $toSave[] = $threadDb;
                    $count++;
                    if ($count === 10) {
                        $count = 0;
                        $toSave = [];
                        $this->threadRepos->save($toSave);
                        print "OK\n";
                    }
                }
            }
        }

        return 0;
    }
}
