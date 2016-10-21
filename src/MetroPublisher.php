<?php
namespace MetroPublisher;

use MetroPublisher\Http\Client;
use MetroPublisher\Http\ConnectionException;
use MetroPublisher\Http\HttpClientInterface;
use MetroPublisher\Http\Steps\HttpResponseExceptionThrower;

/**
 * Class MetroPublisher
 * @package MetroPublisher
 */
class MetroPublisher
{
    /** @var  string */
    private $apiKey;

    /** @var  string */
    private $secretKey;

    /** @var  string */
    private $bearer;

    /** @var  int */
    private $accountId;

    /** @var HttpClientInterface */
    public $client;

    const API_BASE = "https://api.metropublisher.com";

    const O_AUTH_BASE = "https://go.metropublisher.com";

    public function __construct($key, $secret, array $clientOptions = [])
    {
        $this->apiKey = $key;
        $this->secretKey = $secret;

        $clientOptions["verify"]       = false;
        $clientOptions["content-type"] = "application/json; charset=UTF-8";
        $clientOptions['base_uri']     = MetroPublisher::API_BASE;

        $this->client = new Client($clientOptions, [
            new HttpResponseExceptionThrower()
        ]);

        $this->connect();
    }

    /**
     * @return string
     */
    public function getBearer()
    {
        return $this->bearer;
    }

    /**
     * @param string $bearer
     *
     * @return $this
     */
    public function setBearer($bearer)
    {
        $this->bearer = $bearer;

        return $this;
    }

    /**
     * Fetches OAuth token from MetroPublisher.
     *
     * @link https://api.metropublisher.com/narr/design.html#authentication
     *
     * @throws ConnectionException
     */
    private function connect() {
        try {
            $response = $this->client->post('oauth/token', [
                    "grant_type" => "client_credentials",
                    "api_key"    => $this->apiKey,
                    "api_secret" => $this->secretKey
                ],
                ['base_uri' => MetroPublisher::O_AUTH_BASE]
            );

            $this->accountId = $response['items'][0]['id'];
            $this->bearer    = $response['access_token'];
            $this->client->setDefaultOptions([
                "headers" => ["Authorization" => "Bearer {$this->bearer}"]
            ]);
        } catch(\Exception $e) {
            throw new ConnectionException("Failed to fetch bearer. Please check API credentials.", $e->getCode(), $e);
        }
    }

    public function getClient() {
        return $this->client;
    }

    /**
     * @return int
     */
    public function getAccountId()
    {
        return $this->accountId;
    }
}