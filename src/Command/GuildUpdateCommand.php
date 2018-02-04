<?php

namespace App\Command;

use App\Entity\Guild;
use App\Utils\UserCrawler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GuildUpdateCommand extends Command
{
    private $entityManager;

    private $userCrawler;

    protected static $defaultName = 'swgoh:guilds:users';

    public function __construct(EntityManagerInterface $entityManager, UserCrawler $userCrawler)
    {
        $this->entityManager = $entityManager;

        $this->userCrawler = $userCrawler;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $argument = $input->getArgument('arg1');

        if ($input->getOption('option1')) {
            // ...
        }

        $guilds = $this->entityManager->getRepository(Guild::class)->findAll();

        $progress = new ProgressBar($output, count($guilds));
        $progress->setFormatDefinition('custom', ' %current%/%max% -- %message% (%guild%)');
        $progress->setFormat('custom');
        foreach ($guilds as $key => $guild) {
            if ($key >= 793) {
                $this->userCrawler->setGuild($guild)->crawl();
                $progress->setMessage('Importing...');
                $progress->setMessage($guild->getName(), 'guild');
                $progress->advance();
                $this->entityManager->clear();
            }
        }
        $progress->finish();

        $io->success('IMPORT SUCCESSFULL');
    }
}
