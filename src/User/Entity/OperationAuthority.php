<?php

namespace user\entity;
/**
 * table
 */
class OperationAuthority {

    public  function __construct() {
    }

    /**
     * @var integer
     * @var integer
     * @Id
     */
    protected $id;

    /**
     * @var integer
     * @var integer
     */
    protected $userId;

    /**
     * @length:64
     * @var string
     */
    protected $route;

    /**
     * @var DateTime
     *  @var DateTime
     *  @var DateTime
     *  @var DateTime
     *  @var DateTime
     *  @var DateTime
     *  @var DateTime
     * @var DateTime
     */
    protected $startTime;

    /**
     * @var DateTime
     * @var DateTime
     */
    protected $endTime;

}