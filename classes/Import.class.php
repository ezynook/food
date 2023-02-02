<?php

require 'Main.class.php';

class Import extends Main{
    public function getSupplier(){
        $sql = "SELECT DISTINCT supplier FROM import_product ORDER BY supplier ASC";
        return $this->dbcon->query($sql);
    }
    public function getProduct(){
        $sql = "SELECT * FROM product ORDER BY id ASC";
        $query = $this->dbcon->query($sql);
        if ($query){
            return $query;
        }
    }
    public function getimportTemp($userid){
        $sql = "
            SELECT
                i.id as id,
                i.food_id as food_id,
                i.import_date as date,
                i.supplier as supplier,
                p.food_name as food_name,
                i.price as price,
                i.qty as qty,
                i.type as type
            FROM
                import_temp i
            JOIN
                product p ON i.food_id = p.id
            WHERE
                i.user_id = '{$userid}'
            ";
        return $this->dbcon->query($sql);
    }
    public function countImportTemp($userid){
        $sql = "SELECT COUNT(*) as total FROM import_temp WHERE user_id=".$userid;
        $query = $this->dbcon->query($sql);
        $row = $query->fetch_assoc();
        return $row['total'];
    }
    public function importTemp($import_date, $supplier, $food_id, $price, $qty, $type, $userid){
        $sql = "
            INSERT INTO
                import_temp
            SET
                import_date = '{$import_date}',
                supplier = '{$supplier}',
                food_id = '{$food_id}',
                price = '{$price}',
                qty = '{$qty}',
                user_id = '{$userid}',
                type = '{$type}'
        ";
        $query = $this->dbcon->query($sql);
        if ($query){
            return $query;
        }

    }
    public function deltemp($id){
        $sql = "DELETE FROM import_temp WHERE id=".$id;
        if ($this->dbcon->query($sql)){
            return true;
        }
    }
    public function SaveImport($type){
        $sql = "SELECT * FROM import_temp";
        $query = $this->dbcon->query($sql);
        foreach($query as $val){
            $import = "
                INSERT INTO
                    import_product
                SET
                    import_date = '{$val['import_date']}',
                    supplier = '{$val['supplier']}',
                    food_id = '{$val['food_id']}',
                    price = '{$val['price']}',
                    qty = '{$val['qty']}',
                    type = '{$val['type']}'
            ";
            $this->dbcon->query($import);
            if ($type == 'นำเข้า') {
                $update = "UPDATE product SET qty = qty+{$val['qty']}, price1 = '{$val['price']}' WHERE id=".$val['food_id'];
            }else{
                $update = "UPDATE product SET qty = qty+{$val['qty']} WHERE id=".$val['food_id'];
            }
            $this->dbcon->query($update);
        }
        $this->dbcon->query("TRUNCATE import_temp");
        return true;
    }
}