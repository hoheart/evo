<?php

namespace util\FileSystem\models;
/**
 * table
 */
class FileManager {

    public  function __construct() {
    }

    /**
     * @param file 
     * @param modulePath 
     * @return
     */
    public  function addFile( $file,  $modulePath) {
        // TODO implement here
        return null;
    }

    /**
     * @param id
     */
    public  function httpDownload( $id) {
        // TODO implement here
    }

    /**
     * @param id
     */
    public  function del( $id) {
        // TODO implement here
    }

    /**
     * @param id 
     * @param modulePath 
     * @param file
     */
    public  function modifyFile( $id,  $modulePath,  $file) {
        // TODO implement here
    }

    /**
     * @param id 
     * @return
     */
    public  function getUrl( $id) {
        // TODO implement here
        return null;
    }

    /**
     * @param id 
     * @return
     */
    public  function getFileInfo( $id) {
        // TODO implement here
        return null;
    }

    /**
     * @param id 
     * @param name
     */
    public  function rename( $id,  $name) {
        // TODO implement here
    }

}