<?php
    include_once 'php/config.php';
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
        <li>Průměrná celková teplota: <?php echo "";?></li>
    </ul>

    <h2>Teploty po 15 minutách</h2>
    <ul>
    <?php foreach($all as $i => $row){
        $date = $row["datum"];
        $temp = $row["teplota"];
        ?>
        <li><?php echo date("j. n. Y H:i",strtotime($date))." - $temp";?></li>
        <?php
            if( date("j",strtotime($date)) != date("j",strtotime($all[$i+1]["datum"])) )
                echo "<hr>";
        ?>
    <?php } ?>
    </ul>
</body>
</html>