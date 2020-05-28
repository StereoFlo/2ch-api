<?php

namespace App\Command;

use App\Repository\ThreadRepository;
use Phpach\Phpach;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $activeList = $this->threadRepos->getActive();

        if (empty($activeList)) {
            return 0;
        }

        foreach ($activeList as $threadDb) {
            try {
                $threadTmp = $this->phpach->getThread($threadDb->getThreadName(), $threadDb->getThreadId());
            } catch (\Exception $exception) {
                continue;
            }
        }

        return 0;
    }
}
