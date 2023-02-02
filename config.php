<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Sale</title>
</head>
<code>
<?php
    require 'autoload/autoload.inc.php';
    if (!isset($_SESSION)){session_start();};
    $userid = $_SESSION['userid'];
    $msg = '';
    $obj = new Main;
    $data = $obj->getConfig();
    if (isset($_POST['btnsave'])){
        foreach($_POST['values'] as $val){
            $value = intval(preg_replace('/[^0-9]+/', '', $val), 10);
            $where = preg_replace('/[^a-zA-Z]+/', '', $val);
            $obj->saveConfig($value, $where);
        }
        echo "<script>
                alert('อัพเดต Config แล้ว')
                window.location.href='home.php?m=config'
            </script>";
    }
?>
</code>

<body>
    <div class="container">
    <a href="#!">Setting</a>
        <div class="card">
            <form action="" method="post">
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <td>ชื่อการทำงาน</td>
                            <td>การตั้งค่า</td>
                        </tr>
                        <tr>
                            <?php foreach($data as $val){ ?>
                        <tr>
                            <td><?=$val['config']?></td>
                            <td>
                                <select name="values[]" class="form-control">
                                    <?php
                                        if ($val['value'] == '1'){
                                            echo "
                                            <option value='$val[id],1' selected>เปิดใช้งาน</option>
                                            <option value='$val[id],0'>ปิดใช้งาน</option>
                                            ";
                                        }else{
                                            echo "
                                            <option value='$val[id],0' selected>ปิดใช้งาน</option>
                                            <option value='$val[id],1'>เปิดใช้งาน</option>
                                            ";
                                        }
                                    ?>

                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                        </tr>
                    </table>
            </form>
            <button type="submit" name="btnsave" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> บันทึก</button>
            <a href="clear-data.php?submit=1" class="btn btn-warning" onclick="return confirm('ข้อมูลทั้งหมดจะถูกลบ แน่ใจแล้วหรือไม่')"><i class="fa-solid fa-trash-can"></i> ล้างข้อมูลการขาย</a>
        </div>
    </div>
    </div>
    <script src="style/jquery.min.js"></script>
</body>
</html>