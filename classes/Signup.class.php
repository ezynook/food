<?php
require 'Main.class.php';

class Signup extends Main{
    public function sign_Up($user, $pass){
        $check = "SELECT username FROM users WHERE username='{$user}'";
        $query = $this->dbcon->query($check);
        if ($query->num_rows == 0) {
            $sql = "
                INSERT INTO
                    users
                SET
                    username = '{$user}',
                    password = '{$pass}'
            ";
            $query = $this->dbcon->query($sql);
            return $query;
        }else{
            return false;
        }
    }
}
?>