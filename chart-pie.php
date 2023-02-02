<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Chart</title>
    <?php require 'style/autoload.php'; ?>
</head>
<code>
<?php
    require 'autoload/autoload.inc.php';
    error_reporting(0);
    $obj = new Chart;
    $result_data = $obj->Chartjs();
?>
</code>

<body class="bg-dark">
    <div class="container content" style="padding-left: 2rem;padding-right:10rem;">
        <div class="card bg-dark">
            <div class="card-body " align="center">
                <div style="width:900px;">
                    <div id="piechart" style="width: 900px; height: 500px;" align="center"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="style/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Product', 'Total'], 
            <?php
                while($rs = mysqli_fetch_array($result_data)){
                    echo "['".$rs['product']."', ".$rs['total']."],";
                }
            ?>
        ]);
        var options = {
            title: '',
            is3D: true,
            legend: 'right',
            //   pieHole: 0.4  
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
    </script>
</body>

</html>