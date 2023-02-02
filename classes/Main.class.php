<?php 
    class Main {
        private $dbhost = 'localhost';
        private $dbuser = 'root';
        private $dbpass = '';
        private $dbname = 'food';
        public $dbcon = '';

        function __construct() {
            try {
                $conn = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
                $this->dbcon = $conn;

            }catch(Exception $e){
                echo "
                    <div>
                        Database is Error connection : <b>".$e->getMessage()."</b><br/>
                    </div>
                ";
            }
        }
        public function readConfig($key){
            $sql = "SELECT * FROM config WHERE id='{$key}'";
            $query = $this->dbcon->query($sql);
            $rows = $query->fetch_assoc();
            if ($rows['value'] == 1){
                return 'pass';
            }else{
                return 'denied';
            }
        }
        public function getConfig(){
            $sql = "SELECT * FROM config";
            $query = $this->dbcon->query($sql);
            return $query;
        }
        public function saveConfig($value, $where){
            $sql = "UPDATE config SET `value` = {$value} WHERE id='{$where}'";
            return $this->dbcon->query($sql);
        }
        public function truncateData(){
            $this->dbcon->query("TRUNCATE import_product");
            // $this->dbcon->query("TRUNCATE product");
            $this->dbcon->query("TRUNCATE sale_h");
            $this->dbcon->query("TRUNCATE sale_l");
            return 'success';
        }
    }
?>