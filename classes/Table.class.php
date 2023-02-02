<?php

require 'Main.class.php';
date_default_timezone_set('Asia/Bangkok');

class Table extends Main{

    public function TableList(){
        $sql = "
            SELECT
                *, TIMEDIFF(TIME(NOW()),TIME(timediff)) AS count_time
            FROM
                food_table
            ORDER BY
                id ASC
            ";
        $query = $this->dbcon->query($sql);
        if ($query->num_rows > 0){
            return $query;
        }
    }
    //////////
    public function updateTableEmpty(){
        $sql = "
            SELECT
                id as table_id,
                (select count(*) from sale_temp where table_id = f.id) as count_food
            FROM
                food_table f
            WHERE
                f.`status` = 1
        ";
        $query = $this->dbcon->query($sql);
        if ($query) {
            foreach($query as $table){
                if ($table['count_food'] == 0) {
                    $this->dbcon->query("UPDATE food_table SET `status` = 0, timediff = NOW() WHERE id=".$table['table_id']);
                }
            }
            return $query;
        }
    }
    public function saveTable($table){
        $sql = "INSERT INTO food_table (table_name, timediff,`status`) VALUES ('{$table}', NOW(),0)";
        $query = $this->dbcon->query($sql);
        if ($query){
            return $query;
        }
    }
    public function updateTableStatus($table_id){
        $sql = "UPDATE food_table SET `status` = 1, timediff = NOW() WHERE id =".$table_id;
        $query = $this->dbcon->query($sql);
        if ($query) {
            return $query;
        }
    }

    public function clearTable($userid, $table){
        $query = $this->dbcon->query("UPDATE food_table SET `status` = 0 WHERE id=".$table);
        if ($query) {
            $this->dbcon->query(
                "DELETE FROM sale_temp WHERE user_id = '{$userid}' AND table_id = '{$table}'"
            );
            return $query;
        }
    }
    public function delTable($id){
        $sql = "DELETE FROM food_table WHERE id=".$id;
        $query = $this->dbcon->query($sql);
        if ($query){
            return $query;
        }
    }
}