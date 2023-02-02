<?php
    require 'autoload/autoload.inc.php';
    $id = $_GET['id'];
    $obj = new Product;
    $del_status = $obj->removeProduct($id);
    if ($del_status == '1'){
        header("location: home.php?m=product");
    }