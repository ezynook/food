<?php
    require 'autoload/autoload.inc.php';
    $obj = new Sale;
    $res = $obj->deltemp($_GET['id']);
    if ($res){
        header("location: home.php?m=sale&table=".$_GET['table']);
    }
?>