<?php

/**
 * Created by PhpStorm.
 * User: lukstankovic
 * Date: 04.10.16
 * Time: 19:25
 */
class teplota{

    private function getAll(){
        $result = dibi::query('SELECT * FROM teplota ORDER BY datum DESC');
        return($result->fetchAll());
    }

    public function dateFormat($date){
        return date("j. n. Y H:i",strtotime($date));
    }
}