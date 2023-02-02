<?php
require 'Main.class.php';

class Report extends Main{
    public function showMember(){
        $sql = "SELECT * FROM customer ORDER BY id ASC";
        $query = $this->dbcon->query($sql);
        return $query;
    }
    public function showmemberImport(){
        $sql = "SELECT DISTINCT supplier FROM import_product ORDER BY supplier ASC";
        $query = $this->dbcon->query($sql);
        return $query;
    }
    public function reportData($customer,$dt, $check){
        $date = date('Y');
        if (isset($check) && $check == '1'){
            $sql = "
                SELECT
                    c.cus_name as customer,
                    h.sale_date as sale_date,
                    p.food_name as food_name,
                    l.price as price,
                    l.qty as qty,
                    l.total as total
                FROM
                    sale_h h
                    JOIN sale_l l ON h.id = l.id
                    JOIN customer c ON c.id = h.customer
                    JOIN product p ON l.food_id = p.id 
                WHERE
                    YEAR(h.sale_date) = '{$date}'
                ORDER BY
                    h.sale_date DESC
            ";
        }else{
            $sql = "
                SELECT
                    c.cus_name as customer,
                    h.sale_date as sale_date,
                    p.food_name as food_name,
                    l.price as price,
                    l.qty as qty,
                    l.total as total
                FROM
                    sale_h h
                    JOIN sale_l l ON h.id = l.id
                    JOIN customer c ON c.id = h.customer
                    JOIN product p ON l.food_id = p.id 
                WHERE
                    DATE(h.sale_date) = '{$dt}' AND h.customer LIKE '%{$customer}%'
                ORDER BY
                    h.sale_date DESC
            ";
        }
        $query = $this->dbcon->query($sql);
        return $query;
    }
    public function reportImport($customer,$dt, $check, $type){
        $date = date('Y');
        if ($check == '1'){
            $sql = "
                SELECT
                    i.supplier AS supplier,
                    i.import_date AS import_date,
                    p.food_name AS food_name,
                    i.price AS price,
                    i.qty AS qty,
                    i.type as type
                FROM
                    import_product i
                    JOIN product p ON i.food_id=p.id
                WHERE
                    YEAR ( i.import_date ) = '{$date}' 
                ORDER BY
                    i.import_date DESC
                ";
        }else{
            $sql = "
                SELECT
                    i.supplier AS supplier,
                    i.import_date AS import_date,
                    p.food_name AS food_name,
                    i.price AS price,
                    i.qty AS qty,
                    i.type as type
                FROM
                    import_product i
                    JOIN product p ON i.food_id=p.id
                WHERE
                    DATE ( i.import_date ) = '{$dt}' AND i.supplier = '{$customer}' AND i.type = '{$type}'
                ORDER BY
                    i.import_date DESC
            ";
        }
        
        $query = $this->dbcon->query($sql);
        return $query;
    }
    public function Slip($id){
        $sql = "
            SELECT
                h.id AS id,
                h.sale_date AS sale_date,
                c.cus_name AS customer,
                p.food_name AS food_name,
                l.price AS price,
                l.qty AS qty,
                f.table_name as tbl,
                ( l.qty * l.price ) AS total
            FROM
                sale_h h
                JOIN sale_l l ON h.id = l.id
                JOIN customer c ON h.customer = c.id
                JOIN product p ON l.food_id = p.id
                JOIN food_table f ON h.table_id=f.id
            WHERE
                h.id = {$id}
        ";
        $query = $this->dbcon->query($sql);
        $sum = "SELECT FORMAT(SUM(qty * price), 0) as total FROM sale_l WHERE id=".$id;
        $q_sum = $this->dbcon->query($sum);
        return array($query, $q_sum);
    }
    public function SlipLast(){
        $sql = "
            SELECT
                h.id AS id,
                h.sale_date AS sale_date,
                c.cus_name AS customer,
                p.food_name AS food_name,
                l.price AS price,
                l.qty AS qty,
                f.table_name as tbl,
                ( l.qty * l.price ) AS total 
            FROM
                sale_h h
                JOIN sale_l l ON h.id = l.id
                JOIN customer c ON h.customer = c.id
                JOIN product p ON l.food_id = p.id
                JOIN food_table f ON h.table_id=f.id
            WHERE
                h.id = (SELECT id FROM sale_h ORDER BY id DESC LIMIT 1)
        ";
        $query = $this->dbcon->query($sql);
        $sum = "SELECT FORMAT(SUM(qty * price), 0) as total FROM sale_l WHERE id = (SELECT id FROM sale_h ORDER BY id DESC LIMIT 1)";
        $q_sum = $this->dbcon->query($sum);
        return array($query, $q_sum);
    }
}