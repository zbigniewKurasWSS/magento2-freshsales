<?php

namespace Wss\FreshSales\Model;

use Wss\FreshSales\Api\Data\QueueInterface;
use Wss\FreshSales\Model\ResourceModel\Queue as QueueResourceModel;
use Magento\Framework\Model\AbstractModel;

class Queue extends AbstractModel implements QueueInterface
{
    const STATUS_PENDING = 0;

    const STATUS_SENT = 1;

    protected function _construct()
    {
        $this->_init(QueueResourceModel::class);
    }

    /**
     * {@inheritDoc}
     */
    public function setEntityId($entityId)
    {
        return $this->setData(QueueInterface::ENTITY_ID, $entityId);
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityId()
    {
        return $this->getData(QueueInterface::ENTITY_ID);
    }

    /**
     * {@inheritDoc}
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(QueueInterface::CUSTOMER_ID, $customerId);
    }

    /**
     * {@inheritDoc}
     */
    public function getCustomerId()
    {
        return $this->getData(QueueInterface::CUSTOMER_ID);
    }

    /**
     * {@inheritDoc}
     */
    public function setAction($action)
    {
        return $this->setData(QueueInterface::ACTION, $action);
    }

    /**
     * {@inheritDoc}
     */
    public function getAction()
    {
        return $this->getData(QueueInterface::ACTION);
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus($status)
    {
        return $this->setData(QueueInterface::STATUS, $status);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus()
    {
        return $this->getData(QueueInterface::STATUS);
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(QueueInterface::CREATED_AT, $createdAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {
        return $this->getData(QueueInterface::CREATED_AT);
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt($action)
    {
        return $this->setData(QueueInterface::UPDATED_AT, $action);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {
        return $this->getData(QueueInterface::UPDATED_AT);
    }
}
