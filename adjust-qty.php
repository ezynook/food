<?php  
    require 'autoload/autoload.inc.php';
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $obj = new Sale;
    $adjust = $obj->adjustQty($id, $qty);
    if ($adjust == 'success'){
        echo json_encode(array('type'=>'success', 'msg'=>'update success'));
    }else{
        echo json_encode(array('type'=>'error', 'msg'=>'update failed'));
    }

 ?>