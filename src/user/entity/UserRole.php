<?php

namespace user\entity;
/**
 * entity
 * table
 */
class UserRole {

    public  function __construct() {
    }

    /**
     * @GeneratedValue
     * @var integer
     * @Id
     * 
     * @Column(type="integer",options={"comment":""})
     */
    protected $id;

    /**
     * @length:32
     * @var string
     * @Column(type="string",length=32,options={"comment":""})
     */
    protected $name;

    /**
     * @length:256
     * @var string
     * @Column(type="string",length=256,options={"comment":""})
     */
    protected $desc;

    /**
     * @var integer
     * @var integer
     * @Column(type="integer",options={"comment":"
     * "})
     */
    protected $creatorId;

    /**
     * @var User
     *  @var User
     *  @var User
     *  @var User
     *  @var User
     *  @var User
     *  @var User
     * @var User
     */
    protected $creator;

}