<?php

namespace user\fund\entity;
/**
 * table
 */
class ChargeRecord {

    public  function __construct() {
    }

    /**
     * @var integer
     */
    protected $accountId;

    /**
     * @var integer
     */
    protected $amount;

    /**
     * @var string
     */
    protected $desc;

    /**
     * @var DateTime
     */
    protected $createTime;

}