<?php
require 'Main.class.php';
date_default_timezone_set('Asia/Bangkok');

class Auth extends Main{
    public function Login($u, $p){
        $sql = "
            SELECT
                id, username, password
            FROM
                users
            WHERE
                username = '{$u}' AND password = '{$p}'
        ";
        $query = $this->dbcon->query($sql);
        $row = $query->fetch_assoc();
        if ($query->num_rows > 0){
            $this->dbcon->query("UPDATE users SET update_dt = '".date('Y-m-d H:i:s')."' WHERE id=".$row['id']);
            $config = $this->readConfig('cookie');
            $res = array(
                $config,
                $row
            );
            return $res;
        }
    }
    public function changePassword($id, $password){
        $sql = "UPDATE users SET `password` = '{$password}' WHERE id=".$id;
        $query = $this->dbcon->query($sql);
        if ($query) {
            return $query;
        }
    }
    public function showLastLogin(){
        $query = $this->dbcon->query("SELECT MAX(update_dt) AS maxtime FROM users");
        if ($query){
            return $query->fetch_assoc();
        }
    }
}