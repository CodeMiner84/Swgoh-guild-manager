<?php

namespace App\Command;

use App\Entity\Guild;
use App\Entity\User;
use App\Utils\CharacterCrawler;
use App\Utils\UserCharacterCrawler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AllCharactersCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CharacterCrawler
     */
    private $characterCrawler;

    /**
     * @var string
     */
    protected static $defaultName = 'swgoh:fetch:characters';

    /**
     * UserCharacterCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param CharacterCrawler $characterCrawler
     */
    public function __construct(EntityManagerInterface $entityManager, CharacterCrawler $characterCrawler)
    {
        $this->entityManager = $entityManager;
        $this->characterCrawler = $characterCrawler;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Fetch all characters');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $this->characterCrawler->crawl();

        $io->success('ALL CHARACTERS ARE FETCHED');
    }
}
