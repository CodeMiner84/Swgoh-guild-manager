<?php

namespace App\Command;

use App\Entity\Guild;
use App\Utils\UserCharacterCrawler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GuildUsersCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserCharacterCrawler
     */
    private $userCrawler;

    /**
     * @var string
     */
    protected static $defaultName = 'swgoh:guild:users';

    /**
     * UserCharacterCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param UserCharacterCrawler   $userCrawler
     */
    public function __construct(EntityManagerInterface $entityManager, UserCharacterCrawler $userCrawler)
    {
        $this->entityManager = $entityManager;

        $this->userCrawler = $userCrawler;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Fetch all guild users squad')
            ->addArgument('guild', InputArgument::REQUIRED, 'Guild code')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $guildCode = $input->getArgument('guild');

        if (!$guildCode) {
            $io->success('IMPORT FINISHED');
        }

        $guild = $this->entityManager->getRepository(Guild::class)->findOneByCode($guildCode);
        if (!$guild instanceof Guild) {
            throw new \Exception('NO GUILD FOUND !');
        }

        $progress = new ProgressBar($output);

        $this->userCrawler->setGuild($guild)->crawlGuild();
        $io->success('IMPORT SUCCESSFULL');
    }
}
