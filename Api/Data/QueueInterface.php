<?php

namespace Wss\FreshSales\Api\Data;

use Exception;

/**
 * @api
 */
interface QueueInterface
{
    /*
     * Entity ID.
     */
    const ENTITY_ID = 'entity_id';

    /*
     * Customer ID.
     */
    const CUSTOMER_ID = 'customer_id';

    /*
     * Action.
     */
    const ACTION = 'action';

    /*
     * Status.
     */
    const STATUS = 'status';

    /*
     * Created At.
     */
    const CREATED_AT = 'created_at';

    /*
     * Updated At.
     */
    const UPDATED_AT = 'updated_at';

    /**
     * Gets ID
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Sets entity ID.
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId);

    /**
     * Sets customer id
     *
     * @param integer $customerId
     *
     * @return $this
     */
    public function setCustomerId($customerId);

    /**
     * Gets customer id
     *
     * @return int
     */
    public function getCustomerId();

    /**
     * Sets action
     *
     * @param string $action
     *
     * @return $this
     */
    public function setAction($action);

    /**
     * Gets action
     *
     * @return string
     */
    public function getAction();

    /**
     * Sets status
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status);

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Sets created at
     *
     * @param string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Gets created at
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Sets updated at
     *
     * @param string $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Gets updated at
     *
     * @return $this
     */
    public function getUpdatedAt();

    /**
     * Save queue
     *
     * @return $this
     * @throws Exception
     */
    public function save();

    /**
     * Load queue data
     *
     * @param integer $modelId
     * @param null|string $field
     * @return $this
     */
    public function load($modelId, $field = null);
}
