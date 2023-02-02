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
    $product = array();
    $total = array();
    while($rs = mysqli_fetch_array($result_data)){
        $product[] = "\"".$rs['product']."\"";
        $total[] = "\"".$rs['total']."\"";
    }
    $product = implode(",", $product);
    $total = implode(",", $total);
?>
</code>

<body class="bg-dark" >
    <div class="container content" style="padding-left: 2rem;padding-right:10rem;">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid" align="center">
                    <canvas id="myChart" width="700px" height="300px"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="style/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
    <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php echo $product;?>
            ],
            datasets: [{
                label: 'จำนวนยอดขาย',
                data: [<?php echo $total;?>],
                backgroundColor: [
                    'rgb(255, 0, 0)',
                    'rgb(255, 64, 0)',
                    'rgb(255, 128, 0)',
                    'rgb(255, 191, 0)',
                    'rgb(255, 255, 0)',
                    'rgb(191, 255, 0)',
                    'rgb(128, 255, 0)',
                    'rgb(0, 255, 255)',
                    'rgb(0, 191, 255)',
                    'rgb(0, 128, 255)',
                    'rgb(0, 0, 255)',
                    'rgb(128, 0, 255)',
                    'rgb(191, 0, 255)',
                    'rgb(255, 0, 191)',
                    'rgb(128, 128, 128)',
                    'rgb(0, 0, 0)',
                ],
                borderColor: [
                    'rgba(54, 108, 255, 1)',
                    'rgba(255, 38, 0, 1)',
                    'rgba(255, 130, 0, 0.7)',
                    'rgba(42, 169, 71, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                font: {
                    size: 1
                },
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    ticks: {
                        fontColor: 'black',
                        fontSize: 12,
                    }
                }]
            }
        }
    });
    </script>
</body>

</html>