<?php

namespace user\entity;
/**
 * entity
 * table
 */
class LoginLog {

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
     * @var integer
     * @var integer
     * @Column(type="integer",options={"comment":"
     * "})
     */
    protected $userId;

    /**
     * @var DateTime
     *  @var DateTime
     *  @var DateTime
     *  @var DateTime
     *  @var DateTime
     *  @var DateTime
     *  @var DateTime
     * @var DateTime
     * @Column(type="datetime",options={"comment":"
     *  
     *  
     *  
     *  
     *  
     *  
     *  "})
     */
    protected $time;

    /**
     * @var string
     * @Column(type="string",options={"comment":""})
     */
    protected $ip;

    /**
     * 如果用了代理，就是代理服务器的IP，否则为空。
     * @var string
     * @Column(type="string",options={"comment":"如果用了代理，就是代理服务器的IP，否则为空。"})
     */
    protected $sourceIp;

}