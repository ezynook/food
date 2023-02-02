<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Import</title>
</head>
<code>
<?php
    error_reporting(0);
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!$_SESSION['userid']){
        echo "<script>window.location.href='logout.php'</script>";
        exit;
    }
    require 'autoload/autoload.inc.php';
   
    $obj = new Import;
    $list = $obj->getSupplier();
    $product = $obj->getProduct();
    $temp = $obj->getimportTemp($_SESSION['userid']);
    if (isset($_POST['add'])){
        $type_p = isset($_POST['typeproduct']) ? $_POST['typeproduct'] : '';
        $res = $obj->importTemp(
            $_POST['import_date'],
            $_POST['supplier'],
            $_POST['food_id'],
            $_POST['price'],
            $_POST['qty'],
            $type_p,
            $_SESSION['userid']
        );
        if ($res){
            echo "<script>window.location.href='home.php?m=import'</script>";
        }
    }
    if (isset($_POST['save'])){
        if ($obj->countImportTemp($_SESSION['userid']) > 0){
            $res2 = $obj->SaveImport($_POST['typeproduct']);
            if ($res2){
                echo "
                    <script>
                        alert('บันทึกการนำเข้าเรียบร้อยแล้ว')
                        window.location.href='home.php?m=product'
                    </script>
                ";
            }
        }else{
            echo "<script>
                    alert('กรุณาเลือกสินค้าก่อนการนำเข้า');
                </script>";
        }
    }
?>
</code>

<body>
    <div class="container">
    <a href="#!">Product >> Import/Return Product</a>
        <div class="container mt-3">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        <label for="">ประเภทการจัดการ</label>
                        <select name="typeproduct" class="form-control txttype">
                            <option value="" disabled selected>--ประเภทการจัดการ--</option>
                            <option value="นำเข้า">นำเข้า</option>
                            <option value="คืน">คืน</option>
                        </select>
                        <label for="" class="label1">วันที่นำเข้า</label>
                        <input type="datetime" name="import_date" class="form-control" value="<?=date('Y-m-d H:s:i')?>">
                        <label for="">ลูกค้า</label>
                        <input list="supplier" name="supplier" class="form-control supplier" placeholder="กรุณาเลือกลูกค้า" required>
                        <datalist id="supplier">
                            <?php foreach($list as $val){ ?>
                            <option value="<?=$val['supplier']?>"><?=$val['supplier']?></option>
                            <?php } ?>
                        </datalist>
                        <p></p>
                        <table>
                            <tr>
                                <td width="400px">
                                    <select name="food_id" class="form-control txtfood" required>
                                        <option value="" selected disabled>--กรุณาเลือกสินค้า--</option>
                                        <?php foreach($product as $p_list){ ?>
                                        <option value="<?=$p_list['id']?>"><?=$p_list['food_name']?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="price" placeholder="ราคาซื้อต่อชิ้น"
                                        class="form-control txtprice" required>
                                </td>
                                <td>
                                    <input type="number" name="qty" placeholder="จำนวนที่รับเข้า"
                                        class="form-control txtqty" required>
                                </td>
                                <td>
                                    <input type="text" name="txtbill" style="display: none;" placeholder="เลขที่อ้างอิง"
                                        class="form-control txtbill" required>
                                </td>
                            </tr>
                        </table>
                        <p></p>
                        <button type="submit" name="add" class="btn btn-secondary btnadd"><i class="fa-solid fa-plus"></i> 1.เพิ่มรายการนำเข้า</button>
                    </form>
                </div>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <td id="tbl-1">วันที่นำเข้า</td>
                            <td>ลูกค้า</td>
                            <td>รายการสินค้า</td>
                            <td>ราคาต่อชิ้น</td>
                            <td>จำนวนที่รับเข้า</td>
                            <td>ประเภทการจัดการ</td>
                            <td>ลบ</td>
                        </tr>
                    </thead>
                    <?php foreach($temp as $value){ ?>
                    <tr>
                        <td><?=$value['date']?></td>
                        <td><?=$value['supplier']?></td>
                        <td><?=$value['food_name']?></td>
                        <td><?=$value['price']?></td>
                        <td><?=$value['qty']?></td>
                        <td><?=$value['type']?></td>
                        <td><a href="importtemp-del.php?id=<?=$value['id']?>" class="btn btn-danger btn-sm">ลบ</a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <p></p>
            <div align="right">
                <form action="" method="post">
                    <button type="submit" name="save" class="btn btn-danger btnsave"
                        onclick="return confirm('ยืนยันการนำเข้า')" style="width: 300px;"><i class="fa-solid fa-circle-check"></i> 2.ยืนยันการนำเข้า</button>
                </form>
            </div>
        </div>
    </div>
    <script src="style/jquery.min.js"></script>               
    <script>
    $('.txttype').change(function() {
        if ($(this).val() == 'คืน') {
            $('.txtbill').show();
            $('.txtbill').prop('required', true);
            $('.txtprice').hide();
            $('.txtprice').prop('required', false);
            $('.txtqty').attr("placeholder", "จำนวนที่รับคืน");
            $('.titles').html('คืนสินค้า');
            $('.label1').html('วันที่คืน');
            $('.btnadd').val('1.เพิ่มรายการรับคืน');
            $('#tbl-1').html('วันที่คืน');
            $('.btnsave').html('2.ยืนยันการรับคืน');
        } else {
            $('.txtbill').hide();
            $('.txtbill').prop('required', false);
            $('.txtprice').show();
            $('.txtprice').prop('required', true);
            $('.txtqty').attr("placeholder", "จำนวนที่นำเข้า");
            $('.titles').html('นำเข้าสินค้า');
            $('.label1').html('วันที่นำเข้่า');
            $('.btnadd').val('1.เพิ่มรายการนำเข้า');
            $('#tbl-1').html('วันที่นำเข้า');
            $('.btnsave').html('2.ยืนยันการการนำเข้า');
        }
    });
    $('.txtfood').change(function(e) {
        e.preventDefault();
        var params = {
            id: $('.txtfood').val()
        }
        $.ajax({
            url: "Ajax/LookupPrice.php",
            method: "POST",
            data: params,
            dataType: 'JSON',
            success: function(data) {
                $('.txtprice').val(data.price);
            }
        });
    });

    $('.supplier').change(function() {
        localStorage.setItem('supplier', $(this).val());
    });
    $(document).ready(function() {
        if (localStorage.getItem('supplier')) {
            $('.supplier').val(localStorage.getItem('supplier'));
        }
    });
    $('.btnsave').click(function() {
        localStorage.clear();
    })
    </script>
</body>

</html>