<?php
header( 'Content-Type: application/json' );

include_once "php/config.php";

if($_GET["action"] == "alltemp"){
    $temp = new temperature();

    foreach ($temp->getAllReversed() as $key => $item){
        $tempWithDate[$key]["date"] = date("d-m-Y H:i",$item["unix_timestamp"]);
        $tempWithDate[$key]["temperature"] = $item["temperature"];
    }

    echo json_encode($tempWithDate);
}


if($_GET["action"] == "avgdays2016"){
    $temp = new temperature();

    foreach ($temp->averageDaysTemperatureYear(2016) as $key => $item){
        $tempWithDate[$key]["date"] = date("j. n.",$item["unix_timestamp"]);
        $tempWithDate[$key]["temperature"] = round($item["avgtemp"],3);
        $tempWithDate[$key]["color"] = $temp->boxColor($item["avgtemp"]);
    }

    echo json_encode($tempWithDate);
}
