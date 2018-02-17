<?php

namespace App\Utils;

use App\Entity\Setting;
use App\Repository\RepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class BaseCrawler.
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
     * @param Setting                $setting
     * @param EntityManagerInterface $em
     * @param RepositoryInterface    $repository
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
