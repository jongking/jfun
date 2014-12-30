<?php
/**
 * Created by PhpStorm.
 * User: jongking
 * Date: 2014/12/30
 * Time: 22:20
 */

class model {
    private $jdb;

    public function __construct(){
        $jdb = Db_factory::create();
    }
}