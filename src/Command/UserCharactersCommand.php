<?php

namespace App\Command;

use App\Entity\User;
use App\Utils\UserCharacterCrawler;
use App\Utils\UserCrawler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class UserCharactersCommand.
 */
class UserCharactersCommand extends Command
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
    protected static $defaultName = 'swgoh:user:characters';

    /**
     * UserCharacterCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param UserCrawler            $userCrawler
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
            ->setDescription('Fetch user characters')
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
        $this->userCrawler->crawlGuildUser($user);
        $progress->setMessage('Import complete');
        $progress->advance();
        $progress->finish();

        $io->success('IMPORT SUCCESSFULL');
    }
}
