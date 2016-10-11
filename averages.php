<?php
include_once "php/config.php";

$temp = new temperature();

$kwh_cost = 3.76;

$watts = $temp->energyConsumption($kwh_cost)["watts"];
$cost = $temp->energyConsumption($kwh_cost)["cost"];
$up_time = $temp->energyConsumption($kwh_cost)["uptime"];
$start = $temp->energyConsumption($kwh_cost)["start_date"];

?>

<?php include_once "php/head.php"; ?>

<body id="dashboard">

<?php include_once "php/nav.php"; ?>
<div class="obal">
    <h2>Průměrné teploty roku 2016</h2>
    <div id="avgdaysYear" style="width: 100%; height: 400px;"></div>

</div>
<?php include_once "php/footer.php"; ?>
<script src="js/charts/averageYearTemperatures.js" type="text/javascript"></script>


</body>
</html>