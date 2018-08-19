<?php

namespace App\Utils;

use App\Entity\Setting;
use App\Repository\RepositoryInterface;
use App\Utils\API\ApiConnector;
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
     * @var ApiConnector
     */
    protected $apiConnector;

    /**
     * BaseCrawler constructor.
     * @param ApiConnector $apiConnector
     * @param Client $curlClient
     * @param Setting $setting
     * @param EntityManagerInterface $em
     * @param RepositoryInterface $repository
     */
    public function __construct(
        ApiConnector $apiConnector,
        Client $curlClient,
        Setting $setting,
        EntityManagerInterface $em,
        RepositoryInterface $repository
    )
    {
        $this->apiConnector = $apiConnector;
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
