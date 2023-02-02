<?php
    require 'autoload/autoload.inc.php';
    $id = $_GET['id'];
    $obj = new Customer;
    $del_status = $obj->delCus($id);
    if ($del_status){
        header("location: home.php?m=customer");
    }