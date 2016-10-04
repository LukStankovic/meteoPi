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

    public function timeFormat($date){
        return date("H:i",strtotime($date));
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

    public function averageTotalTemperature(){
        $result = dibi::query('SELECT avg(teplota) as countrows FROM teplota');
        return $result->fetchSingle();
    }

    public function averageDayTemperature(){

        $total = 0;

        for($i = 0; $i < $this->countRows(); $i++) {

            $total += $this->getTemperature($i);

            if ($this->newDay($i))
                break;
        }

        return $total/$i;
    }

    public function maxDayTemperature(){
        $max["temperature"] = -1000;
        for($i = 0; $i < $this->countRows(); $i++) {

            if($this->getTemperature($i) > $max["temperature"]) {
                $max["temperature"] = $this->getTemperature($i);
                $max["date"] = $this->timeFormat($this->getDate($i));
            }

            if ($this->newDay($i))
                break;
        }

        return $max;
    }

    public function minDayTemperature(){
        $min["temperature"] = 1000;
        for($i = 0; $i < $this->countRows(); $i++) {

            if($this->getTemperature($i) < $min["temperature"]) {
                $min["temperature"] = $this->getTemperature($i);
                $min["date"] = $this->timeFormat($this->getDate($i));
            }

            if ($this->newDay($i))
                break;
        }

        return $min;
    }

    public function maxTotalTemperature(){
        $result = dibi::query('SELECT teplota as temperature, datum as date FROM teplota WHERE teplota = (SELECT max(teplota) FROM teplota ) ');

        return $result->fetchAll()[0];

    }

    public function minTotalTemperature(){
        $result = dibi::query('SELECT teplota as temperature, datum as date FROM teplota WHERE teplota = (SELECT min(teplota) FROM teplota ) ');

        return $result->fetchAll()[0];
    }
}