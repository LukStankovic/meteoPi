<?php
header( 'Content-Type: application/json' );

include_once "php/config.php";

if($_GET["action"] == "alltemp"){
    $temp = new temperature();

    foreach (array_reverse($temp->getAll()) as $key => $item){
        $tempWithDate[$key]["date"] = date("d-m-Y H:i",$item["unix_timestamp"]);
        $tempWithDate[$key]["temperature"] = $item["temperature"];
    }

    echo json_encode($tempWithDate);
}




if($_GET["action"] == "interactiveYear"){
    $temp = new temperature();

    if(isset($_GET["year"]))
        $year = $_GET["year"];
    else
        $year = date("Y");

    foreach (array_reverse($temp->averageDaysTemperatureYear($_GET["year"])) as $key => $item){
        $tempWithDate[$key]["date"] = $item["day"];
        $tempWithDate[$key]["temperature"] = round($item["avgtemp"],3);
        $tempWithDate[$key]["color"] = $temp->boxColor($item["avgtemp"]);
    }

    echo json_encode($tempWithDate);
}

if($_GET["action"] == "interactiveDay" && isset($_GET["year"]) && isset($_GET["month"]) && isset($_GET["day"])) {
    $temp = new temperature();

    foreach (array_reverse($temp->getDay($_GET)) as $key => $item) {
        $tempWithDate[$key]["date"] = $temp->timeFormat($item["date"]);
        $tempWithDate[$key]["temperature"] = round($item["temperature"], 3);
        $tempWithDate[$key]["color"] = $temp->boxColor($item["temperature"]);
    }

    echo json_encode(array_reverse($tempWithDate));
}

if($_GET["action"] == "today"){
    $temp = new temperature();

    foreach (array_reverse($temp->getToday()) as $key => $item){
        $tempWithDate[$key]["date"] = $temp->timeFormat($item["unix_timestamp"]);
        $tempWithDate[$key]["temperature"] = round($item["temperature"],3);
        $tempWithDate[$key]["color"] = $temp->boxColor($item["temperature"]);

    }

    echo json_encode(array_reverse($tempWithDate));
}