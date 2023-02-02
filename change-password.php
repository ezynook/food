<?php  
    require 'autoload/autoload.inc.php';
    $id = $_POST['id'];
    $pwd = $_POST['password'];
    $obj = new Auth;
    $adjust = $obj->changePassword($id, $pwd);
    if ($adjust){
        echo 'success';
    }else{
        echo 'failed';
    }

 ?>