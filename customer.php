<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <title>Food Sale</title>
</head>
<code>
<?php
    require 'autoload/autoload.inc.php';
    error_reporting(0);
    $msg = '';
    $obj = new Customer;
    $list = $obj->showMember();
    if (isset($_POST['btnclick'])){
        $res = $obj->saveCus($_POST['id'], $_POST['cus_name'], $_POST['contact']);
        if ($res){
            header("location: home.php?m=customer");
        }else{
            $msg = '
            <div class="alert alert-danger" role="alert">
                บันทึกลูกค้าไม่สำเร็จ
            </div>
        ';
        }
    }
?>
</code>

<body>
    <div class="container">
    <a href="#!">Customer</a>
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <label for="">รหัสลูกค้า</label>
                    <input type="text" name="id" class="form-control" placeholder="รหัสลูกค้า" required>
                    <label for="">ชื่อลูกค้า</label>
                    <input type="text" name="cus_name" class="form-control" placeholder="ชื่อลูกค้า" required>
                    <label for="">เบอร์โทรศัพท์</label>
                    <input type="text" name="contact" class="form-control" placeholder="เบอร์โทรศัพท์" required>
                    <p></p>
                    <button type="submit" name="btnclick" class="btn btn-success"
                        onclick="return confirm('บันทึกรายการลูกค้า ?')"><i class="fa-solid fa-floppy-disk"></i> บันทึกลูกค้า</button>
                </form>
            </div>
        </div>
        <span class="badge bg-secondary">รายการลูกค้า</span>
        <table class="table table-bordered table-sm" id="myTable">
            <thead>
                <tr>
                    <td>รหัสลูกค้า</td>
                    <td>ชื่อลูกค้า</td>
                    <td>เบอร์โทรศัพท์</td>
                    <td>Option</td>
                </tr>
            </thead>
            <tbody>
            <?php foreach($list as $val){ ?>
            <tr>
                <td><?=$val['id']?></td>
                <td><?=$val['cus_name']?></td>
                <td><?=$val['contact']?></td>
                <td>
                    <a href="cus_del.php?id=<?=$val['id']?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('ลบรายการนี้ ?')"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
        });
    });
    </script>
</body>

</html>