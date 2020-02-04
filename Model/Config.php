<?php

namespace Wss\FreshSales\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isActive() : bool
    {
        return $this->scopeConfig->isSetFlag('freshsales/general/active');
    }

    /**
     * @return mixed
     */
    public function getApiDomain()
    {
        return $this->scopeConfig->getValue('freshsales/general/api_domain');
    }

    /**
     * @return mixed
     */
    public function getApiAuthKey()
    {
        return $this->scopeConfig->getValue('freshsales/general/api_auth_key');
    }
}
