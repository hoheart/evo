<?php

namespace user\entity;
/**
 * entity
 * table
 */
class UserExtetionValue {

    public  function __construct() {
    }

    /**
     * @var integer
     * @Id
     * 
     * @Column(type="integer",options={"comment":""})
     */
    protected $id;

    /**
     * @var integer
     * @var integer
     * @Column(type="integer",options={"comment":"
     * "})
     */
    protected $userId;

    /**
     * @var integer
     * @var integer
     * @Column(type="integer",options={"comment":"
     * "})
     */
    protected $extId;

    /**
     * @var string
     * @Column(type="string",options={"comment":""})
     */
    protected $value;

}