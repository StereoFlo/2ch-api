<?php

namespace App\Command;

use App\Entity\Thread\Post;
use App\Repository\ThreadRepository;
use Exception;
use Phpach\Phpach;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use function date;

class SyncThreadCommand extends Command
{
    protected static $defaultName = 'thread:sync';

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
        $this->phpach      = $phpach;
    }

    protected function configure(): void
    {
        $this->addArgument('type',InputOption::VALUE_REQUIRED, 'active or archived');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $type = $input->getArgument('type');

        if ($type === 'active') {
            $threads = $this->threadRepos->getActive();
        }

        if ($type === 'archived') {
            $threads = $this->threadRepos->getArchived();
        }


        if (empty($threads)) {
            return 0;
        }

        $count = 0;
        $toSave = [];
        foreach ($threads as $thread) {
            $threadsTmp = null;
            try {
                $threadsTmp = $this->phpach->getThread($thread->getThreadName(), $thread->getThreadId());
            } catch (Exception $exception) {
                try {
                    $threadsTmp = $this->phpach->getArchivedThread($thread->getThreadName(), date('Y-m-d', $thread->getTimestamp()), $thread->getThreadId());
                    $thread->setArchived();
                    $thread->setChecked();
                } catch (Exception $exception) {
                    $thread->setArchived();
                    $thread->setChecked();
                    $toSave[] = $thread;
                    continue;
                }
            }

            foreach ($threadsTmp->getThreads() as $threadTmp) {
                foreach ($threadTmp->getPosts() as $postTmp) {
                    $postNum = $postTmp->getNum();
                    $exists  = $thread->getPosts()->exists(function (int $key, Post $post) use ($postNum) {
                        return $post->getNum() === $postNum;
                    });

                    if ($exists) {
                        continue;
                    }

                    $post = new Post($thread, $postTmp);
                    $thread->addPost($post);
                }
            }
            $toSave[] = $thread;
            $count++;
            if ($count === 100) {
                $count = 0;
                $this->threadRepos->save($toSave);
                $toSave = [];
                $output->writeln('saves 100');
            }
        }

        return 0;
    }
}
