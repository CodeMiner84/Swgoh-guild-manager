<?php

namespace App\Command;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Utils\SingleUserCrawler;
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
     * @var SingleUserCrawler
     */
    private $singleUserCrawler;

    /**
     * @var string
     */
    protected static $defaultName = 'swgoh:user:characters';

    /**
     * UserCharactersCommand constructor.
     *
     * @param EntityManagerInterface $em
     * @param UserCharacterCrawler $userCrawler
     */
    public function __construct(EntityManagerInterface $em, UserCharacterCrawler $userCrawler, SingleUserCrawler $singleUserCrawler)
    {
        $this->em = $em;

        $this->userCrawler = $userCrawler;
        $this->singleUserCrawler = $singleUserCrawler;

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

        $user = $this->em->getRepository(User::class)->findOneByUuid($code);
        if (!$user) {
            $user = $this->fetchUser($code);
        }

        if (!$user instanceof User) {

        }

        $progress = new ProgressBar($output);
        $this->userCrawler->crawlGuildUser($user);
        $progress->setMessage('Import complete');
        $progress->advance();
        $progress->finish();

        $io->success('IMPORT SUCCESSFULL');
    }

    public function fetchUser(string $code)
    {
        $user = UserFactory::create([
            'uuid' => $code,
            'name' => trim($code),
            'guild' => null,
        ]);
        $this->em->persist($user);

        return $user;
    }
}
