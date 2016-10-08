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

        <h2>Denní statistiky</h2>

        <div class="g-radek">
            <div class="sl-3">
                <div class="box temp-now" style="background: <?php echo $temp->boxColor($temp->actualTemperature()["temperature"]);?>">
                    <div class="box__header">
                        <i class="fa fa-bolt" aria-hidden="true"></i> Aktuální teplota
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo $temp->actualTemperature()["temperature"]; ?> °C
                        </div>
                        <div class="box__date">
                            <?php echo $temp->actualTemperature()["date"]; ?>, před <?php echo $temp->timeAgo($temp->actualTemperature()["unix_timestamp"],time()); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-3">
                <div class="box highest-today" style="background: <?php echo $temp->boxColor($temp->maxTodayTemperature()["temperature"]);?>">
                    <div class="box__header">
                        <i class="fa fa-arrow-up" aria-hidden="true"></i> Nejvyšší denní teplota
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo $temp->maxTodayTemperature()["temperature"]; ?> °C
                        </div>
                        <div class="box__date">
                            <?php echo $temp->maxTodayTemperature()["date"]; ?>, před <?php echo $temp->timeAgo($temp->maxTodayTemperature()["unix_timestamp"],time()); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-3">
                <div class="box lowest-today" style="background: <?php echo $temp->boxColor($temp->minTodayTemperature()["temperature"]);?>">
                    <div class="box__header">
                        <i class="fa fa-arrow-down" aria-hidden="true"></i> Nejnižší denní teplota
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo $temp->minTodayTemperature()["temperature"]; ?> °C
                    </div>
                        <div class="box__date">
                            <?php echo $temp->minTodayTemperature()["date"]; ?>, před <?php echo $temp->timeAgo($temp->minTodayTemperature()["unix_timestamp"],time()); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-3">
                <div class="box avg-temp-today" style="background: <?php echo $temp->boxColor($temp->averageTodayTemperature());?>">
                    <div class="box__header">
                        <i class="fa fa-tasks" aria-hidden="true"></i> Průměrná denní teplota
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo round($temp->averageTodayTemperature(),3); ?> °C
                        </div>
                        <div class="box__date">
                            <?php echo date("j. n."); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <h2>Celkové statistiky</h2>
        <div class="g-radek">
            <div class="sl-4">
                <div class="box temp-now" style="background: <?php echo $temp->boxColor($temp->maxTotalTemperature()["temperature"]);?>">
                    <div class="box__header">
                        <i class="fa fa-arrow-up" aria-hidden="true"></i> Celková nejvyšší teplota
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo $temp->maxTotalTemperature()["temperature"]; ?> °C
                        </div>
                        <div class="box__date">
                            <?php echo $temp->dateTimeFormat($temp->maxTotalTemperature()["date"]) ?>, před <?php echo $temp->timeAgo($temp->maxTotalTemperature()["date"],time()); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-4">
                <div class="box temp-now" style="background: <?php echo $temp->boxColor($temp->minTotalTemperature()["temperature"]); ?>">
                    <div class="box__header">
                        <i class="fa fa-arrow-down" aria-hidden="true"></i> Celková nejnižší teplota
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo $temp->minTotalTemperature()["temperature"]; ?> °C
                        </div>
                        <div class="box__date">
                            <?php echo $temp->dateTimeFormat($temp->minTotalTemperature()["date"]) ?>, před <?php echo $temp->timeAgo($temp->minTotalTemperature()["date"],time()); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sl-4">
                <div class="box avg-temp-today" style="background: <?php echo $temp->boxColor($temp->averageTotalTemperature());?>">
                    <div class="box__header">
                        <i class="fa fa-tasks" aria-hidden="true"></i> Celková průměrná teplota
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo round($temp->averageTotalTemperature(),3); ?> °C
                        </div>
                        <div class="box__date">
                            <?php echo date("j. n."); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2>Spotřeba</h2>
        <div class="g-radek">
            <div class="sl-4">
                <div class="box" style="background: #9E8E5A">
                    <div class="box__header">
                        <i class="fa fa-plug" aria-hidden="true"></i> Spotřebované energie
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo round($watts,2); ?> W
                        </div>

                    </div>
                </div>
            </div>
            <div class="sl-4">
                <div class="box" style="background: #9E8E5A">
                    <div class="box__header">
                        <i class="fa fa-money" aria-hidden="true"></i> Cena za provoz od startu
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo round($cost); ?> Kč
                        </div>
                        <div class="box__date">
                            Při ceně za kWh <?php echo $kwh_cost; ?> Kč
                        </div>
                    </div>
                </div>
            </div>

            <div class="sl-4">
                <div class="box" style="background: #9E8E5A">
                    <div class="box__header">
                        <i class="fa fa-hourglass-half" aria-hidden="true"></i> Spuštěných hodin
                    </div>
                    <div class="box__data">
                        <div class="box__temp">
                            <?php echo round($up_time) ?> hodin
                        </div>
                        <div class="box__date">
                            od <?php echo $start; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2>Teplota od začátku dne</h2>
        <div id="teplota_od_zacatku_dne" style="width: 100%; height: 400px;"></div>

     </div>
<?php include_once "php/footer.php"; ?>
    <script>
        var chart = AmCharts.makeChart("teplota_od_zacatku_dne", {
            "type": "serial",
            "dataLoader": {
                "url": "api.php?action=alltemp",
                "format": "json"
            },
            "categoryField": "date",
            "dataDateFormat": "YYYY-MM-DD",
            "startDuration": 1,
            "rotate": false,
            "categoryAxis": {
                "parseDates": true
            },
            "graphs": [ {
                "valueField": "temperature",
                "bullet": "round",
                "bulletBorderColor": "#000",
                "bulletBorderThickness": 2,
                "lineThickness ": 2,
                "lineAlpha": 0.5
            }]
        } );

        /*
        var chart;
        var chartData = [];
        var chartCursor;



        AmCharts.ready(function () {
            // generate some data first
            generateChartData();

            // SERIAL CHART
            chart = new AmCharts.AmSerialChart();

            chart.dataProvider = chartData;
            chart.categoryField = "date";
            chart.balloon.bulletSize = 5;

            // listen for "dataUpdated" event (fired when chart is rendered) and call zoomChart method when it happens
            chart.addListener("dataUpdated", zoomChart);

            // AXES
            // category
            var categoryAxis = chart.categoryAxis;
            categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
            categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
            categoryAxis.dashLength = 1;
            categoryAxis.minorGridEnabled = true;
            categoryAxis.twoLineMode = true;
            categoryAxis.dateFormats = [{
                period: 'fff',
                format: 'JJ:NN:SS'
            }, {
                period: 'ss',
                format: 'JJ:NN:SS'
            }, {
                period: 'mm',
                format: 'JJ:NN'
            }, {
                period: 'hh',
                format: 'JJ:NN'
            }, {
                period: 'DD',
                format: 'DD'
            }, {
                period: 'WW',
                format: 'DD'
            }, {
                period: 'MM',
                format: 'MMM'
            }, {
                period: 'YYYY',
                format: 'YYYY'
            }];

            categoryAxis.axisColor = "#DADADA";

            // value
            var valueAxis = new AmCharts.ValueAxis();
            valueAxis.axisAlpha = 0;
            valueAxis.dashLength = 1;
            chart.addValueAxis(valueAxis);

            // GRAPH
            var graph = new AmCharts.AmGraph();
            graph.title = "red line";
            graph.valueField = "visits";
            graph.bullet = "round";
            graph.bulletBorderColor = "#FFFFFF";
            graph.bulletBorderThickness = 2;
            graph.bulletBorderAlpha = 1;
            graph.lineThickness = 2;
            graph.lineColor = "#5fb503";
            graph.negativeLineColor = "#efcc26";
            graph.hideBulletsCount = 50; // this makes the chart to hide bullets when there are more than 50 series in selection
            chart.addGraph(graph);

            // CURSOR
            chartCursor = new AmCharts.ChartCursor();
            chartCursor.cursorPosition = "mouse";
            chartCursor.pan = true; // set it to fals if you want the cursor to work in "select" mode
            chart.addChartCursor(chartCursor);

            // SCROLLBAR
            var chartScrollbar = new AmCharts.ChartScrollbar();
            chart.addChartScrollbar(chartScrollbar);

            chart.creditsPosition = "bottom-right";

            // WRITE
            chart.write("teplota_od_zacatku_dne");
        });

        function generateChartData() {


        }

        // this method is called when chart is first inited as we listen for "dataUpdated" event
        function zoomChart() {
            // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
            chart.zoomToIndexes(chartData.length - 40, chartData.length - 1);
        }

        // changes cursor mode from pan to select
        function setPanSelect() {
            if (document.getElementById("rb1").checked) {
                chartCursor.pan = false;
                chartCursor.zoomable = true;
            } else {
                chartCursor.pan = true;
            }
            chart.validateNow();
        }
*/
    </script>
</body>
</html>