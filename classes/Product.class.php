<?php
require 'Main.class.php';

class Product extends Main{
    public function getProductById($id){
        $sql = "SELECT * FROM product WHERE id=".$id;
        $query = $this->dbcon->query($sql);
        if ($query){
            return $query->fetch_assoc();
        }
    }
    public function editProduct($id, $product, $p1, $p2){
        $sql = "
            UPDATE
                product
            SET
                food_name = '{$product}',
                price1 = '{$p1}',
                price2 = '{$p2}'
            WHERE
                id = {$id}
        ";
        $query = $this->dbcon->query($sql);
        return $query;
    }
    public function removeProduct($id){
        $sql = "DELETE FROM product WHERE id=".$id;
        $query = $this->dbcon->query($sql);
        if ($query){
            return '1';
        }else{
            return '0';
        }
    }
    public function getProduct(){
        $sql = "SELECT * FROM product ORDER BY id ASC";
        $query = $this->dbcon->query($sql);
        if ($query){
            return $query;
        }
    }
    public function addProduct($food_name, $price1, $price2, $qty, $image_name){
        $check = "SELECT food_name FROM product WHERE food_name = '{$food_name}'";
        $strCheck = $this->dbcon->query($check);
        if ($strCheck->num_rows == 0){
            $sql = "
                INSERT INTO 
                    product
                SET
                    food_name = '{$food_name}',
                    price1 = '{$price1}',
                    price2 = '{$price2}',
                    qty = '{$qty}',
                    img_path = '{$image_name}'
                ";
            $result = $this->dbcon->query($sql);
            return $result;
        }    
    }
}