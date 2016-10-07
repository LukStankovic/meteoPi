<?php
header( 'Content-Type: application/json' );

include_once "../temperature.php";


$temp = new temperature();

echo json_encode($temp->getAll());