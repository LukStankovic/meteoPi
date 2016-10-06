<?php
    include_once "php/config.php";

    $temp = new temperature();

    $maxDay = $temp->maxDayTemperature();
    $minDay = $temp->minDayTemperature();

    $maxTotal = $temp->maxTotalTemperature();
    $minTotal = $temp->minTotalTemperature();
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&subset=greek-ext" rel="stylesheet">
</head>
<body id="dashboard">

    <?php include_once "nav.php"; ?>

    <div class="obal">
        <h2>Denní statistiky</h2>

        <div class="g-radek">
            <div class="sl-3">
                <div class="box temp-now" style="background: <?php echo $temp->boxColor($temp->actualTemperature());?>">
                    <div class="box__header">
                        <i class="fa fa-bolt" aria-hidden="true"></i> Aktuální teplota
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo $temp->actualTemperature(); ?> °C
                        </div>
                        <div class="box__date">
                            <?php echo $temp->actualTemperatureTime(); ?> (před <?php echo $temp->timeAgo($temp->actualTemperatureTime(),time()); ?>)
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-3">
                <div class="box highest-today" style="background: <?php echo $temp->boxColor($maxDay["temperature"]);?>">
                    <div class="box__header">
                        <i class="fa fa-arrow-up" aria-hidden="true"></i> Nejvyšší denní teplota
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo $maxDay["temperature"]; ?> °C
                        </div>
                        <div class="box__date">
                            <?php echo $maxDay["date"]; ?> (před <?php echo $temp->timeAgo($maxDay["date"],time()); ?>)
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-3">
                <div class="box lowest-today" style="background: <?php echo $temp->boxColor($minDay["temperature"]);?>">
                    <div class="box__header">
                        <i class="fa fa-arrow-down" aria-hidden="true"></i> Nejnižší denní teplota
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo $minDay["temperature"]; ?> °C
                    </div>
                        <div class="box__date">
                            <?php echo $minDay["date"]; ?> (před <?php echo $temp->timeAgo($minDay["date"],time()); ?>)
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-3">
                <div class="box avg-temp-today" style="background: <?php echo $temp->boxColor($temp->averageDayTemperature());?>">
                    <div class="box__header">
                        <i class="fa fa-tasks" aria-hidden="true"></i> Průměrná denní teplota
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo round($temp->averageDayTemperature(),3); ?> °C
                        </div>
                        <div class="box__date">
                            <?php echo date("j. n."); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="obal">

        <h2>Celkové statistiky</h2>
        <ul>
            <li style="color: #CC2222;">Celková nejvyšší teplota: <strong><?php echo $maxTotal["temperature"]. "°C dne ". $temp->dateFormat($maxTotal["date"]); ?></strong></li>
            <li style="color: #006aeb">Celková nejnižší teplota: <strong><?php echo $minTotal["temperature"]. "°C dne ". $temp->dateFormat($minTotal["date"]); ?></strong></li>
            <li>Průměrná celková teplota: <strong><?php echo $temp->averageTotalTemperature();?></strong></li>
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
     </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script>
        $("document").ready(function () {

            var show = 0;

            $(".mobile--btn").click(function () {

                if(show == 0) {
                    $("header nav ul").slideDown();
                    show = 1;
                }
                else {
                    $("header nav ul").slideUp();
                    show = 0;
                }
            });
        });

    </script>
</body>
</html>