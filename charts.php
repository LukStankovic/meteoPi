<?php
include_once "php/config.php";

$temp = new temperature();

$kwh_cost = 3.76;

$watts = $temp->energyConsumption($kwh_cost)["watts"];
$cost = $temp->energyConsumption($kwh_cost)["cost"];
$up_time = $temp->energyConsumption($kwh_cost)["uptime"];
$start = $temp->energyConsumption($kwh_cost)["start_date"];

if($_GET["year"] == "")
    $year = date("Y");
else
    $year = $_GET["year"];

if($_GET["month"] == "")
    $month = date("n");
else
    $month = $_GET["month"];

if($_GET["day"] == "")
    $day = date("j");
else
    $day = $_GET["day"];
?>

<?php include_once "php/head.php"; ?>

<body id="dashboard">

<?php include_once "php/nav.php"; ?>
<div class="obal">
    <form method="get">
    <h2>Průměrné teploty roku <input type="text" name="year" class="interactiveYear" value="<?php echo $year; ?>" maxlength="4"></h2>
    </form>
    <div id="interactiveYear" style="width: 100%; height: 400px;"></div>

    <form method="get">
        <h2>Teploty dne: <input type="text" name="day" class="interactiveDay" value="<?php echo $day; ?>" maxlength="2">.
            <input type="text" name="month" class="interactiveDay" value="<?php echo $month; ?>" maxlength="2">.
            <input type="text" name="year" class="interactiveDay" value="<?php echo $year; ?>" maxlength="2">
            <input type="submit" value="->"style="position: absolute; left: -9999px; width: 1px; height: 1px;"
                   tabindex="-1" >
        </h2>
    </form>
    <div id="interactiveDay" style="width: 100%; height: 400px;"></div>


</div>
<?php include_once "php/footer.php"; ?>
<script>

    var chart = AmCharts.makeChart("interactiveYear", {
        "type": "serial",
        "theme": "light",
        "marginTop":0,
        "marginRight": 20,

        "dataLoader": {
            "url": "api.php?action=interactiveYear&year=<?php echo $year; ?>&month=<?php echo $month; ?>&day=<?php echo $day; ?>"
        },
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left"
        }],
        "graphs": [{
            "id":"g1",
            "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]] °C</span></b>",
            "fillAlphas": 0.8,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "temperature",
            "fillColorsField": "color",
        }],
        "chartScrollbar": {
            "graph":"g1",
            "gridAlpha":0,
            "color":"#888888",
            "scrollbarHeight":55,
            "backgroundAlpha":0,
            "selectedBackgroundAlpha":0.1,
            "selectedBackgroundColor":"#888888",
            "graphFillAlpha":0,
            "autoGridCount":true,
            "selectedGraphFillAlpha":0,
            "graphLineAlpha":0.2,
            "graphLineColor":"#c61931",
            "selectedGraphLineColor":"#888888",
            "selectedGraphLineAlpha":1

        },
        "chartCursor": {
            "categoryBalloonDateFormat": "D. M.",
            "cursorAlpha": 0,
            "valueLineEnabled":true,
            "valueLineBalloonEnabled":true,
            "valueLineAlpha":0.5,
            "fullWidth":true
        },
        "dataDateFormat": "D. M.",
        "categoryField": "date",
        "categoryAxis": {
            "minPeriod": "D",
            "parseDates": false,
            "minorGridAlpha": 0.1,
            "minorGridEnabled": true
        },
        "export": {
            "enabled": true
        }
    });

    chart.addListener("rendered", zoomChart);
    if(chart.zoomChart){
        chart.zoomChart();
    }

    function zoomChart(){
        chart.zoomToIndexes(Math.round(chart.dataProvider.length * 0.4), Math.round(chart.dataProvider.length * 0.55));
    }

</script>

<script>

    var interactiveDay = AmCharts.makeChart("interactiveDay", {
        "type": "serial",
        "theme": "light",
        "marginTop":0,
        "marginRight": 20,

        "dataLoader": {
            "url": "api.php?action=interactiveDay&year=<?php echo $year; ?>&month=<?php echo $month; ?>&day=<?php echo $day; ?>"
        },
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left"
        }],
        "graphs": [{
            "id":"g1",
            "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]] °C</span></b>",
            "fillAlphas": 0.8,
            "lineAlpha": 0.2,
            "type": "line",
            "valueField": "temperature",
            "fillColorsField": "color",
        }],
        "chartScrollbar": {
            "graph":"g1",
            "gridAlpha":0,
            "color":"#888888",
            "scrollbarHeight":55,
            "backgroundAlpha":0,
            "selectedBackgroundAlpha":0.1,
            "selectedBackgroundColor":"#888888",
            "graphFillAlpha":0,
            "autoGridCount":true,
            "selectedGraphFillAlpha":0,
            "graphLineAlpha":0.2,
            "graphLineColor":"#c61931",
            "selectedGraphLineColor":"#888888",
            "selectedGraphLineAlpha":1

        },
        "chartCursor": {
            "cursorPosition": "mouse",
            "categoryBalloonDateFormat": "D. M."
        },
        "dataDateFormat": "D. M.",
        "categoryField": "date",
        "categoryAxis": {
            "minPeriod": "D",
            "parseDates": false,
            "minorGridAlpha": 0.1,
            "minorGridEnabled": true
        },
        "export": {
            "enabled": true
        }
    });

    chart.addListener("rendered", zoomChart);
    if(chart.zoomChart){
        chart.zoomChart();
    }

    function zoomChart(){
        chart.zoomToIndexes(Math.round(chart.dataProvider.length * 0.4), Math.round(chart.dataProvider.length * 0.55));
    }

</script>
</body>
</html>
