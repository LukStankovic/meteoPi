<?php
include_once "php/config.php";

$temp = new temperature();

?>

<?php include_once "php/head.php"; ?>

<body id="dashboard">

<?php include_once "php/nav.php"; ?>

<div class="obal">

    <h2>Teploty po 15 minutách</h2>
    <ul>
        <?php foreach ($temp->getAll() as $i => $item){ ?>

            <li><?php echo $temp->dateTimeFormat($item["unix_timestamp"]).": <strong>".$item["temperature"]." °C</strong>"?></li>

            <?php
            if($temp->newDay($i))
                echo "<hr>";
            ?>

        <?php } ?>
    </ul>
</div>
<?php include_once "php/footer.php"; ?>
</body>
</html>