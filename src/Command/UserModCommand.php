<?php

namespace App\Command;

use App\Entity\Guild;
use App\Entity\User;
use App\Utils\ModCrawler;
use App\Utils\UserCrawler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class UserModCommand.
 */
class UserModCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserCrawler
     */
    private $modCrawler;

    /**
     * @var string
     */
    protected static $defaultName = 'swgoh:mods:user';

    /**
     * UserCharacterCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param ModCrawler             $modCrawler
     */
    public function __construct(EntityManagerInterface $entityManager, ModCrawler $modCrawler)
    {
        $this->entityManager = $entityManager;

        $this->modCrawler = $modCrawler;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Fetch user mods')
            ->addArgument('code', InputArgument::REQUIRED, 'User code')
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
        $code = $input->getArgument('code');

        $user = $this->entityManager->getRepository(User::class)->findOneByUuid($code);

        $progress = new ProgressBar($output);
        $this->modCrawler->setUser($user)->crawl();
        $progress->setMessage('Importing...');
        $progress->finish();

        $io->success('IMPORT SUCCESSFULL');
    }
}
