<?php

namespace App\Command;

use App\Entity\Guild;
use App\Entity\User;
use App\Utils\CharacterCrawler;
use App\Utils\GuildCrawler;
use App\Utils\UserCharacterCrawler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AllGuildsCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var GuildCrawler
     */
    private $guildCrawler;

    /**
     * @var string
     */
    protected static $defaultName = 'swgoh:all:guild';

    /**
     * UserCharacterCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param GuildCrawler $guildCrawler
     */
    public function __construct(EntityManagerInterface $entityManager, GuildCrawler $guildCrawler)
    {
        $this->entityManager = $entityManager;
        $this->guildCrawler = $guildCrawler;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Fetch all guilds');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $this->guildCrawler->crawl();

        $io->success('ALL GUILDS ARE FETCHED');
    }
}
