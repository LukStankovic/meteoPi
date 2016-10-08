<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="js/amcharts/amcharts.js" type="text/javascript"></script>
<script src="js/amcharts/serial.js" type="text/javascript"></script>
<script src="js/amcharts/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>
<script src="js/amcharts/plugins/export/export.min.js"></script>

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
