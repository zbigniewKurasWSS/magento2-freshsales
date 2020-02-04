# Wss_FreshSales Module

Module allows create contacts in SalesFresh CRM automatically after customer registration

# Installation

```
composer require wss/freshsales
php bin/magento module:enable Wss_FreshSales
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
```

# Configuration
After installation has completed go to Stores > Settings > Configuration > Customers > FreshSales > General Settings
