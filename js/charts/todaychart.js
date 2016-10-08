/**
 * Created by lukstankovic on 08.10.16.
 */
var chart = AmCharts.makeChart("todaychart", {
    "type": "serial",
    "theme": "light",
    "marginTop":0,
    "marginRight": 80,

    "dataLoader": {
        "url": "api.php?action=today"
    },
    "valueAxes": [{
        "axisAlpha": 0,
        "position": "left"
    }],
    "graphs": [{
        "id":"g1",
        "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]] °C</span></b>",
        "fillAlphas": 0.8,
        "lineAlpha": 0,
        "valueField": "temperature",
        "fillColorsField": "color",
    }],
    "chartScrollbar": {
        "graph": "g1",
        "scrollbarHeight": 80,
        "backgroundAlpha": 0,
        "selectedBackgroundAlpha": 0.1,
        "selectedBackgroundColor": "#888888",
        "graphFillAlpha": 0,
        "graphLineAlpha": 0.5,
        "selectedGraphFillAlpha": 0,
        "selectedGraphLineAlpha": 1,
        "autoGridCount": true,
        "color": "#AAAAAA"
    },
    "chartCursor": {
        "categoryBalloonDateFormat": "JJ:NN, DD MMMM",
        "cursorPosition": "mouse"
    },
    "dataDateFormat": "HH:NN",
    "categoryField": "date",
    "categoryAxis": {
        "minPeriod": "NN",
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