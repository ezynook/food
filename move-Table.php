<?php  
    require 'autoload/autoload.inc.php';
    $table_id = $_POST['table_id'];
    $table_save = $_POST['table_save'];
    $obj = new Sale;
    $adjust = $obj->moveTable($table_id, $table_save);
    if ($adjust == 'success'){
        echo json_encode(array('type'=>'success', 'msg'=>'update success','table'=>$table_save));
    }else{
        echo json_encode(array('type'=>'error', 'msg'=>'update failed'));
    }

 ?>