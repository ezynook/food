<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Sale</title>
    <style>
    .taga {
        text-decoration: none;
    }
    #tdiff {
  position: relative;
  width: 100%;
    }
    </style>
</head>
<code>
<?php
    require 'autoload/autoload.inc.php';
    if (!isset($_SESSION)){session_start();};
    $userid = $_SESSION['userid'];
    $msg = '';
    $obj = new Table;
    $obj->updateTableEmpty();
    $data = $obj->TableList();

    if (isset($_POST['btnclick'])){
        $res = $obj->saveTable($_POST['table_name']);
        if ($res){
            echo "
                <script>
                    window.location.href='home.php?m=food_table'
                </script>
            ";
        }
    }
    if (isset($_GET['table'])) {
        $update = $obj->updateTableStatus($_GET['table']);
        if ($update) {
            header("location: home.php?m=sale&table=".$_GET['table']);
        }
    }
    if (isset($_GET['cancelpending'])) {
        if ($cancelpending) {
            header("location: home.php?m=sale&table=".$_GET['table']);
        }
    }
    if (isset($_GET['cleartable']) && $_GET['cleartable'] == '1') {
        $cleartable = $obj->clearTable($userid, $_GET['table']);
        if ($cleartable) {
            echo "<script>window.location.href='home.php?m=food_table'</script>";
        }
    }
?>
</code>

<body>
    <div class="container-fluid" id="example_div">
    <div class="container">
   <a href="#!">Home</a>
        <div class="card mt-3 bg-dark">
            <div class="card-header text-light">
                รายการโต๊ะ
            </div>
            <div class="row ml-2 mr-2  ">
                <?php
                    $color = '';
                    $link = '';
                    $timediff = '';
                    foreach($data as $val){
                        if ($val['status'] == '0') {
                            $color = 'bg-dark';
                            $link = 'ว่าง';
                            $timediff = '';
                        }else{
                            $color = 'bg-danger';
                            $link = "<a href='home.php?m=food_table&table=$val[id]&userid=$userid&cleartable=1' class='text-white btncancel'>ยกเลิกโต๊ะ</a>";
                            $timediff = ' '.date('H:i:s', strtotime($val['count_time'])).' นาที';
                        }
                ?>
               

               
                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 ">
                    <div class="card text-white  <?=$color?> mb-3 mt-2" style="width: 10rem;">
                        <div class="card-body">
                            <h6 class="card-title text-white" align="center">
                                <strong>
                                <i class="fa-solid fa-paper-plane "></i>
                                    <a href="food_table.php?m=food_table&table=<?=$val['id']?>"
                                        class="text-white taga"><?=$val['table_name']?></a>
                                </strong>
                            </h6>
                           <hr class="mt-1 mb-1">
                           <div align="center">
                            <span class="badge bg-warning text-dark"><?=$timediff?></span>
                            <hr class="mt-1 mb-1">
                            <?=$link?>
                           </div>
                        </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>

   
    <script src="style/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        var e = document.getElementById("example_div");
        setInterval(function(){
            var eLeftPos = e.offsetLeft;
            e.style.left = (eLeftPos) + 'px';
            $("#example_div").load(window.location.href + " #example_div");
        }, 1000);

    })

    </script>
    <script>
        $('.btncancel').click(function(){
            var cf = confirm('ยืนยันยกเลิกโต๊ะ')
            if (cf) {
                return true;
            }else{
                return false;
            }
        });
    </script>
</body>

</html>