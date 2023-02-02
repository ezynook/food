<?php
    require 'Main.class.php';
    class Sale extends Main {

        public function getProduct($find){
            $sql = "SELECT * FROM product WHERE food_name LIKE '%{$find}%' ORDER BY id ASC";
            $query = $this->dbcon->query($sql);
            if ($query){
                return $query;
            }
        }
        public function countTemp($userid){
            $sql = "SELECT COUNT(*) as total FROM sale_temp WHERE user_id=".$userid;
            $query = $this->dbcon->query($sql);
            $row = $query->fetch_assoc();
            return $row['total'];
        }
        public function checkQty($id){
            $sql = "SELECT qty as qty FROM product WHERE id=".$id;
            $query = $this->dbcon->query($sql);
            $row = $query->fetch_assoc();
            return $row['qty'];
        }
        public function saveTemp($food_id, $price, $userid, $table){
            $check = "SELECT food_id FROM sale_temp WHERE food_id = {$food_id} AND user_id = '{$userid}' AND table_id = '{$table}'";
            $q = $this->dbcon->query($check);
            if ($q->num_rows == 0){
                $sql = "
                    INSERT INTO
                        sale_temp
                    SET
                        food_id = '{$food_id}',
                        price = '{$price}',
                        qty = 1,
                        total = (price*qty),
                        user_id = '{$userid}',
                        table_id = '{$table}'
                ";
            }else{
                $sql = "
                    UPDATE
                        sale_temp
                    SET
                        qty = qty+1,
                        total = (price*qty)
                    WHERE
                        food_id = {$food_id} AND user_id = '{$userid}'
                ";
            }
            $query = $this->dbcon->query($sql);
            if ($query){
                return $query;
            }
        }
        public function deltemp($id){
            $sql = "DELETE FROM sale_temp WHERE id=".$id;
            if ($this->dbcon->query($sql)){
                return true;
            }
        }
        public function getsaleTemp($userid, $table){
            $sql = "
                    SELECT
                        t.id as id,
                        d.food_name as food_name,
                        t.price as price,
                        t.qty as qty,
                        t.total as total
                    FROM
                        sale_temp t
                    LEFT JOIN
                        product d ON d.id = t.food_id
                    WHERE
                        t.user_id = '{$userid}' AND table_id = '{$table}'
                    ORDER BY
                        t.id ASC
                ";
            $query = $this->dbcon->query($sql);
            return $query;
        }
        public function saveSale($sale_date, $customer, $userid, $table){
            if (empty($customer)){
                $customer = 1;
            }
            $sql = "
                INSERT INTO
                    sale_h
                SET
                    sale_date = '{$sale_date}',
                    customer = '{$customer}',
                    table_id = '{$table}'
            ";
            $this->dbcon->query($sql);
            $id_last = mysqli_insert_id($this->dbcon);
            $sql = "SELECT * FROM sale_temp";
            $query = $this->dbcon->query($sql);
            foreach($query as $insert_l){
                $sql = "
                    INSERT INTO
                        sale_l
                    SET
                        id = {$id_last},
                        food_id = '".$insert_l['food_id']."',
                        price = '".$insert_l['price']."',
                        qty = '".$insert_l['qty']."',
                        total = '".$insert_l['total']."'
                ";
                $this->dbcon->query($sql);
                $sql_qty = "UPDATE product SET qty = qty - {$insert_l['qty']} WHERE id=".$insert_l['food_id'];
                $this->dbcon->query($sql_qty);
            }
            $this->dbcon->query("DELETE FROM sale_temp WHERE user_id = '{$userid}' AND table_id = '{$table}'");
            $this->dbcon->query("UPDATE food_table SET `status` = 0 WHERE id=".$table);
            
            $print = $this->readConfig('print');
            $res = array($print, $id_last);
            $this->messageToLine($id_last);
            return $res;

        }
        public function messageToLine($id){
            $message = '';
            $sql = "
                SELECT
                    c.cus_name AS customer,
                    h.sale_date AS sale_date,
                    p.food_name AS food_name,
                    l.price AS price,
                    l.qty AS qty,
                    l.total AS total 
                FROM
                    sale_h h
                    JOIN sale_l l ON h.id = l.id
                    JOIN customer c ON c.id = h.customer
                    JOIN product p ON l.food_id = p.id 
                WHERE
                    h.id = '{$id}'
            ";
            $query = $this->dbcon->query($sql);
            $rows = $query->fetch_assoc();
            $message .= "\n";
            $message .= 'วันที่ขาย: '.$rows['sale_date']."\n";
            $message .= 'ลูกค้า: '.$rows['customer']."\n";
            foreach($query as $val){
                $message .= 'ชื่อสินค้า: '.$val['food_name'].' ';
                $message .= 'ราคา: '.$val['price'].' ';
                $message .= 'จำนวน: '.$val['qty'].' ';
                $message .= 'รวมทั้งสิ้น: '.$val['total']."\n";
                $message .= '-----'."\n";
            }
            $this->sendline($message);
        }
        public function showMember(){
            $sql = "SELECT * FROM customer ORDER BY id ASC";
            $query = $this->dbcon->query($sql);
            return $query;
        }
        public function clearTemp($clear, $userid){
            if ($clear == '1'){
                $query = $this->dbcon->query("DELETE FROM sale_temp WHERE user_id=".$userid);
                return $query;
            }
        }
        public function TableList(){
            $sql = "SELECT * FROM food_table ORDER BY id ASC";
            $query = $this->dbcon->query($sql);
            if ($query->num_rows > 0){
                return $query;
            }
        }
        public function adjustQty($id, $qty){
            $dt = date('Y-m-d H:i:s');
            $sql = "UPDATE product SET qty = '{$qty}', update_dt = '{$dt}' WHERE id=".$id;
            $query = $this->dbcon->query($sql);
            if ($query){
                return 'success';
            }else{
                return 'fail';
            }
        }
        public function adjustqtyTemp($id, $qty){
            $dt = date('Y-m-d H:i:s');
            $sql = "UPDATE sale_temp SET qty = '{$qty}', total = (price*{$qty}) WHERE id=".$id;
            $query = $this->dbcon->query($sql);
            if ($query){
                return 'success';
            }else{
                return 'fail';
            }
        }
        public function moveTable($table_id, $table_save){
            $sql = "
                UPDATE
                    sale_temp
                SET
                    table_id = '{$table_save}'
                WHERE
                    table_id = '{$table_id}'
            ";
            $query = $this->dbcon->query($sql);
            $this->dbcon->query("UPDATE food_table SET `status` = '1' WHERE id={$table_save}");
            $this->dbcon->query("UPDATE food_table SET `status` = '0' WHERE id={$table_id}");
            if ($query){
                return 'success';
            }else{
                return 'fail';
            }
        }
        public function getProductById($id){
            $sql = "SELECT * FROM product WHERE id=".$id;
            $query = $this->dbcon->query($sql);
            if ($query){
                return $query->fetch_assoc();
            }
        }
        public function editQty($id,$qty){
            $sql = "
                UPDATE
                    product
                SET
                    qty = '{$qty}'
                WHERE
                    id = {$id}
            ";
            $query = $this->dbcon->query($sql);
            return $query;
        }
        public function sendline($data){
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $chOne = curl_init();
            $sToken = '49OcZOLHJgJALAmh1DBsI7eK9EGtDbxLS4ue2E5OpwA';
            curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($chOne, CURLOPT_POST, 1);
            curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=".$data);
            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($chOne);
            //Result error
            if(curl_error($chOne)){
                echo 'error:' . curl_error($chOne);
            }else{
                return json_decode($result, true);
            }
            curl_close( $chOne );
        }
        public function __destruct() {
            try{
                $this->dbcon->close();
            }catch(Exception $e){
                echo "Destructor not Complete: "."<b>".$e->getMessage()."</b>";
            }
        }
    }
?>