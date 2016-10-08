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
    <div id="avgdays2016" style="width: 100%; height: 400px;"></div>

</div>
<?php include_once "php/footer.php"; ?>

<script>
    var chart = AmCharts.makeChart("avgdays2016", {
        "type": "serial",
        "theme": "light",
        "marginTop":0,
        "marginRight": 80,

        "dataLoader": {
            "url": "api.php?action=avgdays2016"
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

</body>
</html>