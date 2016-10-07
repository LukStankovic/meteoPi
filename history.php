<?php
include_once "php/config.php";

$temp = new temperature();

$maxDay = $temp->maxDayTemperature();
$minDay = $temp->minDayTemperature();

$maxTotal = $temp->maxTotalTemperature();
$minTotal = $temp->minTotalTemperature();
?>

<?php include_once "php/head.php"; ?>

<body id="dashboard">

<?php include_once "php/nav.php"; ?>

<div class="obal">

    <h2>Teploty po 15 minutách</h2>
    <ul>
        <?php for($i = 0; $i < $temp->countRows(); $i++){ ?>

            <li><?php echo $temp->dateFormat($temp->getDate($i)).": <strong>".$temp->getTemperature($i)."</strong>"?></li>

            <?php
            if($temp->newDay($i))
                echo "<hr>";
            ?>

        <?php } ?>
    </ul>
</div>
<?php include_once "php/footer.php"; ?>