<?php  
    require 'autoload/autoload.inc.php';
    $obj = new Product;
    $send_data = $obj->editProduct(
        $_POST['id'],
        $_POST['foodname'],
        $_POST['price1'],
        $_POST['price2']
);
    if ($send_data){
        echo json_encode(array('type'=>'success', 'msg'=>'update success'));
    }else{
        echo json_encode(array('type'=>'error', 'msg'=>'update failed'));
    }

 ?>