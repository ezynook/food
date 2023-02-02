<?php
    spl_autoload_register('myAutoload');

    function myAutoload($classname){
        $path = 'classes/';
        $ext = '.class.php';
        $fullpath = $path.$classname.$ext;
        if (!file_exists($path)){
            echo 'Folder Classes Not Found';
            return false;
        }

        include_once $fullpath;
    }