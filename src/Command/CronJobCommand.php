<?php

namespace App\Command;

use App\Entity\Guild;
use App\Entity\Queue;
use App\Entity\User;
use App\Utils\UserCharacterCrawler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CronJobCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var string
     */
    protected static $defaultName = 'swgoh:cron';

    /**
     * CronJobCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Fetch all guild users squad');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $commands = $this->entityManager->getRepository(Queue::class)->findBy([
            'finished' => 0
        ]);

        if (count($commands) === 0) {
            throw new \Exception('NO COMMANDS FOUND !');
        }

        $progress = new ProgressBar($output, count($commands));
        $progress->setFormatDefinition('custom', ' %current%/%max% -- %command% %params%');
        $progress->setFormat('custom');

        foreach ($commands as $command) {
            try {
                $progress->setMessage('Executing');
                $progress->setMessage($command->getCommand(), 'command');
                $progress->setMessage(implode(',', $command->getParams()), 'params');

                $cmd = $this->getApplication()->find($command->getCommand());
                $cmd->run(new ArrayInput($command->getParams()), $output);
                $progress->advance();

                $command->setFinished(1);
            } catch (\Exception $e) {

            }
        }

        $this->entityManager->flush();
        $io->success('CRON FINISH');
    }
}
