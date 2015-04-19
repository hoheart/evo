<?php

namespace user\entity;
/**
 * table
 */
class DataAuthority {

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
    protected $className;

    /**
     * @length:16
     * @var string
     */
    protected $propertyName;

    /**
     * @length:64
     * @var string
     */
    protected $value;

}