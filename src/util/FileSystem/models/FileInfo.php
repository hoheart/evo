<?php

namespace util\FileSystem\models;
/**
 * entity
 * table
 */
class FileInfo {

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
     * 
     * @var string
     * @Column(type="string",length=32,options={"comment":""})
     */
    protected $name;

    /**
     * @length:128
     * @var string
     * @Column(type="string",length=128,options={"comment":""})
     */
    protected $path;

    /**
     * @var integer
     * @var integer
     * @Column(type="integer",options={"comment":"
     * "})
     */
    protected $size;

    /**
     * 参见：RFC 2045，RFC 2046，RFC 2047，RFC 2048，RFC 2049等
     * @var string
     * @Column(type="string",options={"comment":"参见：RFC 2045，RFC 2046，RFC 2047，RFC 2048，RFC 2049等"})
     */
    protected $mime;

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
    protected $createTime;

}