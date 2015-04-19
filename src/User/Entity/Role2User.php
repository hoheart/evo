<?php

namespace user\entity;
/**
 * table
 */
class Role2User {

    public  function __construct() {
    }

    /**
     * @var integer
     * @var integer
     * @Id
     */
    public $userId;

    /**
     * @var integer
     * @var integer
     * @Id
     */
    public $groupId;

}