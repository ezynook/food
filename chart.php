<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Sale</title>
</head>
<code>
<?php
    error_reporting(0);
    $tab = $_GET['tab'];
    $tab_name = '';
    $href1 = '';
    $href2 = '';
    $tab_msg = '';
    if ($tab == '1') {
        $tab_name = 'chart-bar.php';
        $href1 = 'active';
        $tab_msg = 'Chart Report >> Bar Chart';
    }elseif ($tab == '2') {
        $tab_name = 'chart-pie.php';
        $href2 = 'active';
        $tab_msg = 'Chart Report >> Pie Chart';
    }
?>
</code>

<body style=" background-image: url('images/food3.jpg');
              background-repeat: no-repeat;
              background-attachment: fixed; 
              background-size: 100%;
">
    <div class="content">
    <a href="#!" id="tabchart"><?=$tab_msg?></a>
        <?php if(isset($msg)){echo $msg;} ?>
        <div class="card bg-dark">
            <div class="card-header bg-dark">
                <ul class="nav nav-tabs bg-dark">
                    <li class="nav-item bg-dark">
                        <a class="nav-link bg-dark <?=$href1?>" aria-current="page" id="tab1" href="home.php?m=chart&tab=1">แผนภูมิแท่ง (Bar Chart)</a>
                    </li>
                    <li class="nav-item bg-dark">
                        <a class="nav-link bg-dark <?=$href2?>" aria-current="page" id="tab2" href="home.php?m=chart&tab=2">แผนภูมิวงกลม (Pie Chart)</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="ratio ratio-16x9 text-center mt-4 mb-4 ">
                    <iframe class="embed-responsive-item" src="<?=$tab_name?>" style="max-width: 100%;height: 100%;"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <script src="style/jquery.min.js"></script>
</html>