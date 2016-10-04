<?php

class temperature{

    private $all;
    private $temperatures = array();
    private $dates = array();

    public function __construct(){
        $result = dibi::query('SELECT * FROM teplota ORDER BY datum DESC');

        $this->all = $result->fetchAll();

        foreach ($this->all as $i => $row){
            $this->temperatures[$i] = $row["teplota"];
            $this->dates[$i] = $row["datum"];
        }

    }

    public function getAll(){
        return $this->all;
    }

    public function getTemperatures(){
        return $this->temperatures;
    }

    public function getDates(){
        return $this->dates;
    }

    public function getTemperature($i){
        return $this->temperatures[$i];
    }

    public function getDate($i){
        return $this->dates[$i];
    }

    public function countRows(){
        $result = dibi::query('SELECT count(teplota) as countrows FROM teplota');
        return $result->fetchSingle();
    }

    public function dateFormat($date){
        return date("j. n. Y H:i",strtotime($date));
    }

    public function dayFormat($date){
        return date("j",strtotime($date));
    }

    public function newDay($i){
        if($this->dayFormat($this->getDate($i)) != $this->dayFormat($this->getDate($i+1)))
            return true;
        else
            return false;
    }

}