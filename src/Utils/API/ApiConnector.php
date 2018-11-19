<?php

namespace App\Utils\API;

use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class   ApiConnector
{
    private const API_URL = 'https://apiv2.swgoh.help/auth/signin';

    private const API_USERNAME = 'ziul';
    private const API_PASSWORD = 'qFBdtLwQQ4CygRc';
    private const API_GRANT_TYPE = 'password';
    private const API_CLIENT_ID = 'abc';
    private const API_CLIENT_SECRET = '123';

    private const SESSION_KEY = 'api_access_token';
    /**
     * @var Response
     */
    protected $client;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var TokenStorageInterface
     */
    protected $token;

    public function  __construct(TokenStorageInterface $token, EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->token = $token;
        $this->session = $session;
        $this->connect();
        $this->em = $entityManager;
        $this->token = $token;
    }

    public function connect()
    {
        try {
            if (!$this->getAccessToken()) {
                $this->getClient();
            } else {

            }
        } catch (\Exception $exception) {
            //var_dump($exception->getMessage());die;
            return false;
        }
    }//92a28fa6061d7f11d240761ae81e13d91984690e

    /**
     * @return null|string
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken = $this->session->get(self::SESSION_KEY);
    }
    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getClient(): void
    {
        if ($this->session->get(self::SESSION_KEY)) {
            $this->accessToken = $this->session->get(self::SESSION_KEY);
        } else {
            $client = new Client();
            $this->client = $client->request('POST', self::API_URL, [
                'form_params' => [
                    'username' => self::API_USERNAME,
                    'password' => self::API_PASSWORD,
                    'grant_type' => self::API_GRANT_TYPE,
                    'client_id' => self::API_CLIENT_ID,
                    'client_secret' => self::API_CLIENT_SECRET
                ]
            ]);

            if ($this->client instanceof Response) {
                try {
                    $this->accessToken = json_decode($this->client->getBody()->getContents())->access_token;
                    $this->session->set(self::SESSION_KEY, $this->accessToken);
                } catch (\Exception $e) {

                }
            }
        }
    }

    /**
     * @param string $apiUrl
     * @param array $params
     * @param bool $withAuthorization
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getResource(string $apiUrl, array $params, bool $withAuthorization = true)
    {
        try {
            $client = new Client();

            $client = $client->request('POST', $apiUrl, [
                'headers' => $this->getHeaders($withAuthorization),
                'form_params' => $params
            ]);

            return json_decode($client->getBody()->getContents());
        } catch (\Exception $e) {
            echo [
                'message' => $e->getMessage()
            ];die;
        }
    }

    /**
     * @param bool $withAuthorization
     * @return array
     */
    private function getHeaders(bool $withAuthorization): array
    {
        $headers = [];
        if ($withAuthorization) {
            $headers = [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
            ];
        }

        return $headers;
    }
}
