<?php

namespace Wss\FreshSales\Block\Adminhtml\Customer\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Customer\Block\Adminhtml\Edit\GenericButton;

class FreshSalesButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData() : array
    {
        return [
            'label' => __('Customer view in FreshSales'),
            'on_click' => sprintf("window.open('%s', '_blank');", $this->getBackUrl()),
            'sort_order' => 12
        ];
    }

    /**
     * @return string
     */
    public function getBackUrl() : string
    {
        return $this->getUrl('freshsales/redirect', ['customer_id' => $this->getCustomerId()]);
    }
}
