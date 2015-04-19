<?php

namespace user\entity;
/**
 * entity
 * table
 */
class UserExtetion {

    public  function __construct() {
    }

    /**
     * @var integer
     * @var integer
     * @Id
     * 
     * @Column(type="integer",options={"comment":"
     * "})
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
     * @length:16
     * @var string
     * @Column(type="string",length=16,options={"comment":""})
     */
    protected $property;

    /**
     * @length:64
     * 
     * @var string
     * @Column(type="string",length=64,options={"comment":""})
     */
    protected $type;

    /**
     * @length:256
     * @var string
     * @Column(type="string",length=256,options={"comment":""})
     */
    protected $desc;

}