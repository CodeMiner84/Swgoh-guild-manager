<?php

namespace App\Utils;

use App\Entity\Guild;
use App\Entity\Setting;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class AbstractCrawler
 * @package App\Utils
 */
abstract class AbstractCrawler
{
    private const SWGOH_API = 'swgoh';

    /**
     * @var EntityManagerInterface
     */
    public $em;

    /**
     * @var
     */
    public $settings;

    /**
     * @var Crawler
     */
    public $crawler;

    /**
     * AbstractCrawler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->crawler = new Crawler();

        $this->initApiSettings();
    }

    public function initApiSettings(): void
    {
        $this->settings = $this->em->getRepository(Setting::class)->getOneByCode(self::SWGOH_API);
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
