<?php
    session_start();
    foreach ($_COOKIE as $name => $value) {
        setcookie($name, '', 1);
        setcookie ("PHPSESSID", "", time() - 3600, '/');
    }
    session_destroy();
    header("location: index.php");