<?php

class temperature{

    private $all;
    private $data = array();

    // CONSTRUCTOR
    // -----------
    // - getting data from database
    // - save them to private var $data
    //          - two dimensional array
    //          - first dimension is int
    //              - temperature -> show temperature in °C
    //              - date -> show date time in human like format
    //              - unix_timestamp -> show datetime in seconds since  1. 1. 1970

    public function __construct(){
        $result = dibi::query('SELECT * FROM teplota ORDER BY datum DESC');

        $this->all = $result->fetchAll();

        foreach ($this->all as $i => $row){
            $this->data[$i]["temperature"] = $row["teplota"];
            $this->data[$i]["date"] = $this->dateTimeFormat($row["datum"]);
            $this->data[$i]["unix_timestamp"] = strtotime($row["datum"]);
        }

    }

    // DATE AND TIME FORMATS
    // =====================

        // DATE AND TIME FORMAT
        // --------------------
        // - format: 02. 12. 2017 18:25

        public function dateTimeFormat($date){
            if(is_int($date))
                return date("j. n. Y H:i",$date);
            else
                return date("j. n. Y H:i",strtotime($date));
        }

        // DATE FORMAT
        // -----------
        // - format: 02. 12. 2017

        public function dateFormat($date){
            if(is_int($date))
                return date("j. n. Y",$date);
            else
                return date("j. n. Y",strtotime($date));
        }

        // TIME FORMAT
        // --------------------
        // - format: 18:25

        public function timeFormat($date){
            if(is_int($date))
                return date("H:i",strtotime($date));
            else
                return date("H:i",strtotime($date));
        }

        // TIME FORMAT
        // --------------------
        // - format: 30

        public function dayFormat($date){
            if(is_int($date))
                return date("j",$date);
            else
                return date("j",strtotime($date));
        }


    // GET TEMPERATURE AND DATE
    // ========================

        // GET ALL DATA
        // ------------
        // - returns array of all temperatures with date

        public function getAll(){
            return $this->data;
        }

        // GET ONE TEMPERATURE WITH DATE TIME
        // ----------------------------------
        // - returns array of all temperatures with date

        public function getOne($i){
            return $this->data[$i];
        }

        // GET LATEST (actual) TEMPERATURE WITH DATETIME
        // ---------------------------------------------
        // - return array of latest temp

        public function actualTemperature(){
            return $this->data[0];
        }



    // AVERAGES
    // ========
    // - returns averages of rows

        // AVERAGE TEMPERATURE - TOTAL
        // ---------------------------
        // - return float

        public function averageTotalTemperature(){
            $result = dibi::query('SELECT avg(teplota) as countrows FROM teplota');
            return $result->fetchSingle();
        }

        // AVERAGE TEMPERATURE - TODAY
        // -------------------------
        // - return float

        public function averageTodayTemperature(){

            $total = 0;

            for($i = 1; $i < $this->countAll(); $i++) {

                $total += $this->getOne($i)["temperature"];

                if ($this->newDay($i))
                    break;
            }

            return $total/$i;
        }

        // AVERAGE TEMPERATURE - DAY
        // -------------------
        // - returns avg temperature of day



    // MAXIMUM AND MINIMUM
    // ===================
    // - returns maximum and minimum


        // MAX TODAY TEMPERATURE
        // ---------------------

        public function maxTodayTemperature(){
            $max["temperature"] = -1000;

            foreach ($this->getAll() as $i => $item){

                if($item["temperature"] > $max["temperature"]) {
                    $max["temperature"] = $item["temperature"];
                    $max["date"] = $item["date"];
                    $max["unix_timestamp"] = $item["unix_timestamp"];
                }

                if ($this->newDay($i))
                    break;

            }

            return $max;
        }

        // MIN TODAY TEMPERATURE
        // ---------------------

        public function minTodayTemperature(){
            $min["temperature"] = 1000;
            foreach ($this->getAll() as $key => $item){

                if($item["temperature"] < $min["temperature"]) {
                    $min["temperature"] = $item["temperature"];
                    $min["date"] = $item["date"];
                    $min["unix_timestamp"] = $item["unix_timestamp"];
                }

                if ($this->newDay($key))
                    break;

            }

            return $min;
        }

        // MAX DAY TEMPERATURE
        // -------------------
        // - returns max temperature of day

        /* NOTHING TO SEE HERE... */

        // MIN DAY TEMPERATURE
        // -------------------
        // - returns min temperature of day

        /* NOTHING TO SEE HERE... */

    // MAX TOTAL TEMPERATURE
        // ---------------------

        public function maxTotalTemperature(){
            $result = dibi::query('SELECT teplota as temperature, datum as date FROM teplota WHERE teplota = (SELECT max(teplota) FROM teplota ) ');

            return $result->fetchAll()[0];

        }

        // MIN TOTAL TEMPERATURE
        // ---------------------

        public function minTotalTemperature(){
            $result = dibi::query('SELECT teplota as temperature, datum as date FROM teplota WHERE teplota = (SELECT min(teplota) FROM teplota ) ');

            return $result->fetchAll()[0];
        }



    // TIME AGO
    // =========
    // - return string

    public function timeAgo($older_time,$newer_time){

        $periods = array("sek.", "min.", "hod.", "d.", "t.", "měs.", "r.");

        $lengths = array("60","60","24","7","4.35","12");

        if(!is_int($older_time))
            $older_time = strtotime($older_time);
        if(!is_int($newer_time))
            $newer_time = strtotime($newer_time);

        $difference = $newer_time - $older_time;

        $difference = round($difference);

        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }


        return round($difference)." ".$periods[$j];
    }

    // COUNT ALL
    // ---------
    // - return int

    public function countAll(){
        $result = dibi::query('SELECT count(teplota) as countrows FROM teplota');
        return $result->fetchSingle();
    }

    // CHECK IF IS NEW DAY AFTER $i DATE
    // ---------------------------------
    // - return true if is older row previous day

    public function newDay($i)
    {
        if ($this->dayFormat($this->getOne($i)["unix_timestamp"]) != $this->dayFormat($this->getOne($i + 1)["unix_timestamp"]))
            return true;
        else
            return false;
    }


    // BOX COLOR
    // ---------
    // - return color in hexadecimal for temp

    public function boxColor($temp){

        if($temp < 18)
            $color = "#3D8EB9";
        elseif ($temp >= 18 && $temp < 20)
            $color = "#83D6DE";
        elseif ($temp >= 20 && $temp < 23)
            $color = "#F29B34";
        elseif ($temp >= 23 && $temp < 25)
            $color = "#FF7416";
        elseif ($temp >= 25)
            $color = "#F04903";
        else
            $color = "#7f8c8d";


        return $color;
    }

    // ENERGY
    // ======

        // ENERGY CONSUMPTION OF PI
        // ------------------------

        public function energyConsumption($kwh_cost){

            $startDate = $this->getOne($this->countAll()-1)["unix_timestamp"];
            $startTime = $this->getOne($this->countAll()-1)["unix_timestamp"]/3600;
            $now = (time())/3600;

            $diff = $now - $startTime;


            // MAX 10 W

            // HOW MANY WATTS:

            $res["watts"] = 10 * $diff;
            $res["cost"] = 0.010 * $diff * $kwh_cost;
            $res["uptime"] = $diff;
            $res["start_date"] = $this->dateFormat($startDate);

            return $res;
        }
}