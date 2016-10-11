<header>
    <nav class="obal">
        <i class="mobile--btn fa fa-bars" aria-hidden="true"></i>
        <ul>
            <li><a <?php if(basename($_SERVER['SCRIPT_NAME']) == 'index.php' || basename($_SERVER['SCRIPT_NAME']) == '') echo "class=\"active\""; ?> href="../index.php"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Dashboard</a></li>
            <li><a <?php if(basename($_SERVER['SCRIPT_NAME']) == 'charts.php') echo "class=\"active\""; ?> href="../charts.php?day=<?php echo date("j"); ?>&month=<?php echo date("n"); ?>&year=<?php echo date("Y"); ?>"><i class="fa fa-area-chart" aria-hidden="true"></i> Interaktivní Grafy</a></li>
            <li><a <?php if(basename($_SERVER['SCRIPT_NAME']) == 'averages.php') echo "class=\"active\""; ?> href="../averages.php"><i class="fa fa-tasks" aria-hidden="true"></i> Průměry teplot</a></li>
            <li><a <?php if(basename($_SERVER['SCRIPT_NAME']) == 'history.php') echo "class=\"active\""; ?> href="../history.php"><i class="fa fa-history" aria-hidden="true"></i> Historie teplot</a></li>
        </ul>
    </nav>
</header>