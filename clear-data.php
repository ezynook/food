<?php
    require 'autoload/autoload.inc.php';

    $submit = $_GET['submit'];

    if ($submit == '1') {
        $obj = new Main;
        $res = $obj->truncateData();
        if ($res == 'success') {
            header("location: logout.php");
        }
    }