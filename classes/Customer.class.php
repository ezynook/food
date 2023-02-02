<?php
require 'Main.class.php';

class Customer extends Main{
    public function delCus($id){
        $sql = "DELETE FROM customer WHERE id=".$id;
        $query = $this->dbcon->query($sql);
        if ($query){
            return $query;
        }
    }
    public function showMember(){
        $sql = "SELECT * FROM customer ORDER BY id ASC";
        $query = $this->dbcon->query($sql);
        return $query;
    }
    public function saveCus($id, $cus_name, $contact){
        $sql = "
            INSERT INTO
                customer
            SET
                id = '{$id}',
                cus_name = '{$cus_name}',
                contact= '{$contact}'
        ";
        $query = $this->dbcon->query($sql);
        if ($query){
            return $query;
        }
    }
}