<?php

namespace Wss\FreshSales\Model\Api;

use GuzzleHttp\Exception\ClientException;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Setup\Exception;
use Wss\FreshSales\Model\Api\Client;
use Wss\FreshSales\Model\Config;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Psr\Log\LoggerInterface;

class Contacts
{
    const METHOD = 'contacts';

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Json
     */
    private $serializer;

    /**
     * @param Config $config
     */
    public function __construct(
        Config $config,
        Client $client,
        CustomerRepositoryInterface $customerRepository,
        LoggerInterface $logger,
        Json $serializer
    ) {
        $this->config = $config;
        $this->client = $client;
        $this->customerRepository = $customerRepository;
        $this->logger = $logger;
        $this->serializer = $serializer;
    }

    /**
     * @param int $customerId
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function insert(int $customerId)
    {
        try {
            $customer = $this->customerRepository->getById($customerId);
            $data = $this->prepareData($customer);
            $response = $this->client->call(self::METHOD, $data, 'POST');
            if ($response->getStatusCode() === 200) {
                $response = $this->serializer->unserialize($response->getBody());
                if (isset($response['contact']) && isset($response['contact']['id'])) {
                    $customer->setCustomAttribute('freshsales_id', $response['contact']['id']);
                    $this->customerRepository->save($customer);
                }
            }
        } catch (NoSuchEntityException $e) {
            $this->logger->error($e->getMessage());
            return;
        } catch (ClientException $e) {
            $this->logger->error($e->getMessage());
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
        return true;
    }

    /**
     * @param CustomerInterface $customer
     * @return array
     */
    protected function prepareData(CustomerInterface $customer) : array
    {
        $data = [
            'contact' => [
                'first_name' => $customer->getFirstname(),
                'last_name' => $customer->getLastname(),
                'email' => $customer->getEmail()
            ]
        ];
        return $data;
    }
}
