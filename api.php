<?php
header( 'Content-Type: application/json' );

include_once "php/config.php";

if($_GET["action"] == "alltemp"){
    $temp = new temperature();

    foreach ($temp->getAll() as $key => $item){
        $tempWithDate[$key]["date"] = date("Y-m-d",$item["unix_timestamp"]);
        $tempWithDate[$key]["temperature"] = $item["temperature"];
    }

    echo json_encode($tempWithDate);
}

