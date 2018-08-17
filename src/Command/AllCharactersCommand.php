<?php

namespace App\Command;

use App\Entity\Guild;
use App\Utils\UserCrawler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class UserCharacterCommand.
 */
class AllCharactersCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserCrawler
     */
    private $userCrawler;

    /**
     * @var string
     */
    protected static $defaultName = 'swgoh:all:user:characters';

    /**
     * UserCharacterCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param UserCrawler            $userCrawler
     */
    public function __construct(EntityManagerInterface $entityManager, UserCrawler $userCrawler)
    {
        $this->entityManager = $entityManager;

        $this->userCrawler = $userCrawler;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Fetch all in game user characters')
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $guilds = $this->entityManager->getRepository(Guild::class)->findAll();

        $progress = new ProgressBar($output, count($guilds));
        $progress->setFormatDefinition('custom', ' %current%/%max% -- %message% (%guild%)');
        $progress->setFormat('custom');
        foreach ($guilds as $key => $guild) {
            $this->userCrawler->setGuild($guild)->crawl();
            $progress->setMessage('Importing...');
            $progress->setMessage($guild->getName(), 'guild');
            $progress->advance();
            $this->entityManager->clear();
        }
        $progress->finish();

        $io->success('IMPORT SUCCESSFULL');
    }
}
