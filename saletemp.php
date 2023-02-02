<?php
    error_reporting(1);
    require 'autoload/autoload.inc.php';
    $obj = new Sale;
    $config = new Main;
    $qtycheck =$obj->checkQty($_GET['id']);
    $pass = $config->readConfig('stock');
    if ($qtycheck <= 0 && $pass == 'pass') {
        $res = $obj->saveTemp($_GET['id'], $_GET['price'], $_GET['userid'], $_GET['table']);
    }elseif ($qtycheck > 0) {
        $res = $obj->saveTemp($_GET['id'], $_GET['price'], $_GET['userid'], $_GET['table']);
    }
    if ($res){
        header("location: home.php?m=sale&table=".$_GET['table']);
    }else{
        header("location: home.php?m=sale&message=สินค้าไม่พอขาย&table=".$_GET['table']);
    }
?>