<?php
    include_once "php/config.php";

    $temp = new temperature();
?>
<!doctype html>
<html lang="cs">
<head>
    <title>meteoPi</title>
    <meta charset="utf-8">
    <meta name="theme-color" content="#db5945">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Domácí meteostanice"/>
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>-->
</head>
<body>

    <h2>Cajky</h2>
    <ul>
        <li>Průměrná denní teplota: <strong><?php echo $temp->averageTotalTemperature();?></strong></li>
        <li>Průměrná celková teplota: <strong><?php echo $temp->averageDayTemperature();?></strong></li>
    </ul>

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
</body>
</html>