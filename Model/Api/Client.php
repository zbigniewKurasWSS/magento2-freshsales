<?php

namespace Wss\FreshSales\Model\Api;

use Wss\FreshSales\Model\Config;

class Client
{
    /**
     * @var Config
     */
    protected $config;

    /**
    * @var \GuzzleHttp\Client
    */
    protected $client;

    /**
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->config->getApiDomain()
        ]);
    }

    /**
     * @param string $method
     * @param array $data
     * @param string $type
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function call(string $method, array $data, $type = 'GET')
    {
        $options = [
            'headers' => [
                'Authorization' => 'Token token=' . $this->config->getApiAuthKey(),
            ],
            'json' => $data
        ];
        $url = $this->config->getApiDomain() . '/' . $method;
        return $this->client->request($type, $url, $options);
    }
}
