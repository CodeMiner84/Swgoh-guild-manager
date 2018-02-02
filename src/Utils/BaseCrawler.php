<?php

namespace App\Utils;

use App\Entity\Guild;
use App\Entity\Setting;
use App\Repository\GuildRepository;
use App\Repository\RepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class BaseCrawler
 */
class BaseCrawler
{
    /**
     * @var array
     */
    public $buffer = [];

    /**
     * @var int
     */
    public $iter = 0;

    /**
     * @var RepositoryInterface
     */
    public $repository;

    /**
     * @var Setting
     */
    public $settings;

    /**
     * @var EntityManagerInterface
     */
    public $em;

    /**
     * BaseCrawler constructor.
     *
     * @param Setting $setting
     * @param EntityManagerInterface $em
     * @param RepositoryInterface $repository
     */
    public function __construct(Setting $setting, EntityManagerInterface $em, RepositoryInterface $repository)
    {
        $this->settings = $setting;
        $this->em = $em;
        $this->repository = $repository;
    }
    /**
     * @param string $url
     *
     * @return bool|string
     */
    public function getSiteHtml(string $url): string
    {
        return file_get_contents($url);
    }
}
