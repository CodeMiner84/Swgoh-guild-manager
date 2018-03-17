<?php

namespace App\Utils;

use App\Entity\Setting;
use App\Repository\RepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;

/**
 * Class BaseCrawler.
 */
class BaseCrawler
{
    /**
     * @var Client
     */
    protected $curlClient;

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
    public function __construct(Client $curlClient, Setting $setting, EntityManagerInterface $em, RepositoryInterface $repository)
    {
        $this->curlClient = $curlClient;
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
        return $this->curlClient->get($url, ['allow_redirects' => false])->getBody()->getContents();
    }
}
