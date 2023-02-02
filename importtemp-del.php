<?php
    require 'autoload/autoload.inc.php';
    $obj = new Import;
    $res = $obj->deltemp($_GET['id']);
    if ($res){
        header("location: home.php?m=import");
    }
?>