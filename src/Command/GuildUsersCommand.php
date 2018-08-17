<?php

namespace App\Command;

use App\Entity\Guild;
use App\Entity\User;
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
            ->addArgument('code', InputArgument::REQUIRED, 'Guild code')
            ->addArgument('uuid', InputArgument::REQUIRED, 'Guild uuid')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $guildUuid = $input->getArgument('uuid');
        $guildCode = $input->getArgument('code');

        $guild = $this->entityManager->getRepository(Guild::class)->findOneBy([
            'code' => $guildCode,
            'uuid' => $guildUuid,
        ]);

        if (!$guild instanceof Guild) {
            throw new \Exception('NO GUILD FOUND !');
        }
        $users = $this->entityManager->getRepository(User::class)->findByGuild($guild);

        $progress = new ProgressBar($output, count($users));
        $progress->setFormatDefinition('custom', ' %current%/%max% -- %message% (%user%)');
        $progress->setFormat('custom');

        $crawler = $this->userCrawler->setGuild($guild);
        foreach ($users as $user) {
            $progress->setMessage('Importing...');
            $progress->setMessage($user->getName(), 'user');
            $crawler->crawlGuildUser($user);
            $progress->advance();
        }

        $io->success('IMPORT SUCCESSFULL');
    }
}
