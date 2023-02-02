<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Sale</title>
    <style>
    .ahref {
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }

    .ahref-green {
        background-color: #4CAF50;
    }

    /* Green */
    .ahref-blue {
        background-color: #008CBA;
    }

    /* Blue */
    .ahref-red {
        background-color: #f44336;
    }

    /* Red */
    .ahref-gray {
        background-color: #e7e7e7;
        color: black;
    }

    /* Gray */
    .ahref-black {
        background-color: #555555;
    }

    /* Black */
    .ahref-orange {
        background-color: #EDBB99;
    }

    /* Black */

    .taga {
        text-decoration: none;
        font-weight: bold;
    }

    #picsale {
        border-radius: 25px;
    }
    </style>
</head>
<code>
<?php
    if (!isset($_SESSION)){session_start();};
    if (!isset($_SESSION['userid'])){
        header('location: index.php');
        exit;
    }
    if (!isset($_GET['table']) || empty($_GET['table'])) {
        echo "
            <script>
                alert('ไม่มีการระบุชื่อโต๊ะ ไม่สามารถทำรายการได้')
                window.location.href='home.php?m=food_table'
            </script>
        ";
    }
    require 'autoload/autoload.inc.php';
    $find = '';
    if (isset($_GET['find'])){
        $find = $_GET['find'];
    }else{
        $find = '';
    }
    $msg = '';
    $userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : $_COOKIE['userid'];
    $obj = new Sale;
    $list = $obj->getProduct($find);
    $temp = $obj->getsaleTemp($userid, $_GET['table']);
    $customer = $obj->showMember();
    $table_list = $obj->TableList();
    
    if (isset($_POST['btnclick'])){
        if ($obj->countTemp($userid) > 0){
            $savedata = $obj->saveSale($_POST['sale_date'], $_POST['customer'], $userid, $_POST['table']);
            if ($savedata){
                if ($savedata[0] == 'pass'){
                    echo "
                        <script>
                            alert('บันทึกรายการขายเรียบร้อยแล้ว')
                            window.location.href='slip.php?id={$savedata[1]}'
                        </script>
                ";
                }else{
                    echo "
                        <script>
                            alert('บันทึกรายการขายเรียบร้อยแล้ว')
                            window.location.href='home.php?m=food_table'
                        </script>
                ";
                }
            }else{
                $msg = '
                    <div class="alert alert-danger" role="alert">
                        บันทึกลูกค้าไม่สำเร็จ
                    </div>
                ';
            }
        }else{
            $msg = '
            <div class="alert alert-warning" role="alert">
                กรุณาเลือกสินค้าก่อนการขาย
            </div>
        ';
        }
    }
    if (isset($_GET['message'])){
        $msg = "
            <div class='alert alert-danger' role='alert'>
                {$_GET['message']}
            </div>
        ";
    }
    if (isset($_GET['clear']) && $_GET['clear'] == '1'){
        $clear_temp = $obj->clearTemp($_GET['clear'], $_SESSION['userid']);
        if ($clear_temp){
            echo "<script>window.location.href='home.php?m=sale&table=$_GET[table]'</script>";
        }
    }
?>
</code>

<body>
    <div class="content">
        <a href="#!">Home >> Sale</a><br>
        <h5><span class="badge bg-dark">โต๊ะ: <?=$_GET['table']?></span></h5>
        <?php if(isset($msg)){echo $msg;} ?>
        <div class="card-body">
            <a href="slip2.php" class="btn btn-primary btn-block" target="_blank"><i class="fa-solid fa-print"></i> ปริ้น Slip บิลล่าสุด</a>
            <a href="#" class="btn btn-warning btn-block table_update" data-bs-toggle="modal" data-bs-target="#exampleModal2"
                data-table_list="<?=$_GET['table']?>"><i class="fa-solid fa-person-walking"></i> ย้ายโต๊ะ</a>
            <form action="" method="POST" id="form1">
                <table>
                    <tr>
                        <td>
                            <label for="">วันที่/เวลา</label>
                            <input type="datetime" name="sale_date" class="form-control sale_date"
                                value="<?=date('Y-m-d H:i:s')?>" style="width: 250px">
                        </td>
                        <td>
                            <label for="">ลูกค้า</label>
                            <select name="customer" class="form-control customer" style="width: 250px">
                                <?php foreach($customer as $key => $val_cus){ ?>
                                <option value="<?=$val_cus['id']?>" <?php if($val_cus['id'] == 1){echo "selected";} ?>>
                                    <?=$val_cus['cus_name']?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="row">
                    <div class="food-list col">
                        <div class="mt-2 mb-2">
                            <input type="text" class="form-control mb-1" id="txtfind" style="width: 250px"
                                placeholder="ค้นหาชื่อสินค้า">
                            <input type="hidden" name="table" id="tableval" value="<?=$_GET['table']?>">
                            <a href="#" id="btnfind" class="btn btn-success btn-block btn-sm"><i class="fa-solid fa-magnifying-glass"></i> ค้นหา</a>
                        </div>
                        <div class="row">
                            <?php foreach($list as $val){ ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" >
                                <div class="card text-white bg-default mb-3 mt-2" style="width: 12rem;">
                                    <div class="card-header" align="center">
                                        <a href="saletemp.php?id=<?=$val['id']?>&price=<?=$val['price2']?>&userid=<?=$userid?>&table=<?=$_GET['table']?>"
                                            class="text-dark taga"><?php echo $val['food_name']; ?>
                                            <small><?php echo $val['price2'] ?> บาท</small>
                                            <hr>
                                            <small>เหลือ <?php echo $val['qty'] ?></small>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title text-dark" align="center">
                                            <img src="images/<?=$val['img_path']?>" alt="" id="picsale" width="120"
                                                height="80">
                                        </h6>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col" align="right">
                        <a href="sale.php?m=sale&clear=1&table=<?=$_GET['table']?>" class="btn btn-danger mt-2 mb-2"
                            onclick="return confirm('ยืนยันล้างรายการนี้ ?')" style="margin-left: 460px;"
                            id="btnclear"> <i class="fa-solid fa-trash-can"></i> ล้างรายการ</a>
                        <table class="table table-sm table-bordered">
                            <tr>
                                <td>ชื่อสินค้า</td>
                                <td>ราคา</td>
                                <td>จำนวน</td>
                                <td>รวมทั้งสิ้น</td>
                                <td>ลบ</td>
                            </tr>
                            <?php foreach($temp as $val_temp){ ?>
                            <tr>
                                <td><?=$val_temp['food_name']?></td>
                                <td><?=number_format($val_temp['price'],2)?></td>
                                <td>
                                    <input type="text" name="" value="<?=number_format($val_temp['qty'],0)?>">
                                    <a href="#" class="btn btn-secondary btn-sm qty_update" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" id="<?=$val_temp['id']?>"
                                        data-id="<?=$val_temp['id']?>" data-qty="<?=$val_temp['qty']?>">Edit</a>
                                </td>
                                <td><b><?=number_format($val_temp['total'],2)?></b></td>
                                <td><a href="saledel.php?id=<?=$val_temp['id']?>&userid=<?=$_SESSION['userid']?>&table=<?=$_GET['table']?>"
                                        class="btn btn-danger btn-sm"><i class="fa-solid fa-ban"></i> ลบ</a></td>
                            </tr>
                            <?php } ?>
                        </table>
                        <p></p>
                        <div align="right">
                            <input type="hidden" name="table" value="<?=$_GET['table']?>">
                            <button type="submit" name="btnclick" class="btn btn-info btnclick"
                                style="width: 200px;height: 50px"
                                onclick="return confirm('ยืนยันการขาย')"><i class="fa-regular fa-floppy-disk"></i> บันทึกการขาย</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขจำนวนสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="qty_data">
                            <input type="number" name="qty" class="form-control qty_val">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="form1" id="hidden_id" />
                        <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ย้ายโต๊ะ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="table_form">
                            <select name="table_save" class="form-control table_save">
                                <option value="" selected disabled>-- ย้ายไปโต๊ะ? --</option>
                                <?php foreach($table_list as $table_val){ ?>
                                <option value="<?=$table_val['id']?>"><?=$table_val['table_name']?></option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="table_list" id="table_id" />
                        <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
</body>
<script src="style/jquery.min.js"></script>
<script>
$(document).on('click', '.table_update', function() {
    var table_list = $(this).data('table_list');
    $("#qty_data").trigger('reset');

    $("#table_id").val(table_list);
});
$("#table_form").submit(function(e) {
    e.preventDefault();
    var params = {
        table_id: $("#table_id").val(),
        table_save: $('.table_save').val()
    }
    $.ajax({
        url: "move-Table.php",
        method: "POST",
        data: params,
        dataType: 'JSON',
        success: function(data) {
            if (data.type == 'success') {
                window.location.href = 'home.php?m=sale&table=' + data.table;
            } else {
                alert(data.msg);
            }
        }
    });
});
$('#txtfind').change(function() {
    localStorage.setItem('find', $(this).val());
});
$('#btnfind').click(function() {
    window.location.href = "home.php?m=sale&find=" + $('#txtfind').val() + "&table=" + $('#tableval').val();
});
</script>
<script>
$(document).ready(function() {
    var currentdate = new Date();
    var datetime = currentdate.getFullYear() + "-" +
        (currentdate.getMonth() + 1) + "-" +
        currentdate.getDate() + " " +
        currentdate.getHours() + ":" +
        currentdate.getMinutes() + ":" +
        currentdate.getSeconds();

    $('.sale_date').focusout(function() {
        localStorage.setItem('sale_date', $(this).val());
    });
    $('.customer').change(function() {
        localStorage.setItem('customer', $(this).val());
    });
    $('.table_name').change(function() {
        localStorage.setItem('table_name', $(this).val());
    });
    if (localStorage.getItem('sale_date')) {
        $('.sale_date').val(localStorage.getItem('sale_date'));
    } else {
        $('.sale_date').val(datetime);
    }
    if (localStorage.getItem('customer')) {
        $('.customer').val(localStorage.getItem('customer'));
    } else {
        $(".customer").append(new Option("ลูกค้าทั่วไป", "1"));
    }
    if (localStorage.getItem('table_name')) {
        $('.table_name').val(localStorage.getItem('table_name'));
    } else {
        $(".table_name").append(new Option("ไม่ระบุ", "1"));
    }
});
$('.btnclick').submit(function(e) {
    localStorage.clear();
});
</script>
<script>
$(document).on('click', '.qty_update', function() {
    var id = $(this).data('id');
    var qty = $(this).data('qty');

    $("#qty_data").trigger('reset');

    $("#hidden_id").val(id);
    $('.qty_val').val(qty);

});
$("#qty_data").submit(function(e) {
    e.preventDefault();
    var params = {
        id: $("#hidden_id").val(),
        qty: $('.qty_val').val()
    }
    $.ajax({
        url: "adjust-qty-temp.php",
        method: "POST",
        data: params,
        dataType: 'JSON',
        success: function(data) {
            if (data.type == 'success') {
                location.reload();
            } else {
                alert(data.msg);
            }
        }
    });
});
</script>

</html>