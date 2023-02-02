<?php
require 'Main.class.php';

class Chart extends Main{
    public function Chartjs(){
        $sql = "
            SELECT
                p.food_name as product,
                sum(s.qty) as total
            FROM
                sale_l s
                LEFT JOIN product p ON s.food_id = p.id 
            GROUP BY
                p.food_name
        ";
        $query = $this->dbcon->query($sql);
        if ($query->num_rows > 0){
            return $query;
        }
    }
}