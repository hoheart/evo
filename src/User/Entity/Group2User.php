<?php

namespace user\entity;
/**
 * entity
 * table
 */
class Group2User {

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
    public $userId;

    /**
     * @var integer
     * @var integer
     * @Id
     * 
     * @Column(type="integer",options={"comment":"
     * "})
     */
    public $groupId;

}