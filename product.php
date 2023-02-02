<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css"> 
    <style>
        .dataTables_filter {
            text-align: right !important;
        }
    </style>
</head>
<code>
<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!$_SESSION['userid']){
        echo "<script>window.location.href='logout.php'</script>";
        exit;
    }
    require 'autoload/autoload.inc.php';
    $tempdt = date('dmy');
    $timestamp = round(microtime(true));
    $msg = '';
    $obj = new Product;
    $product_list = $obj->getProduct();
    if (isset($_POST['btnclick'])){
        $file_name = $_FILES['fileToUpload']['name'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $tempname = explode(".", $_FILES["fileToUpload"]["name"]);
        $newfilename = $tempdt.$timestamp . '.' . end($tempname);
        move_uploaded_file($file_tmp, "images/" . $newfilename);
        $send_data = $obj->addProduct(
            $_POST['food_name'],
            $_POST['price1'],
            $_POST['price2'],
            $_POST['qty'],
            $newfilename
        );

        if ($send_data){
            echo "<script>window.location.href='home.php?m=product'</script>";
        }else{
            $msg = '
                <div class="alert alert-danger" role="alert">
                    บันทึกไม่สำเร็จ
                </div>
            ';
        }
    }
?>
</code>

<body >
    <div class="container">
    <a href="#!">Product</a>
        <?php if(isset($msg)){echo $msg;} ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card bg-dark text-light">
                <div class="card-body">
                    <label for="">ชื่อสินค้า</label>
                    <input type="text" name="food_name" class="form-control " placeholder="ชื่อสินค้า" required>
                    <label for="">ราคาซื้อ</label>
                    <input type="number" name="price1" class="form-control" placeholder="ราคาซื้อ" required>
                    <label for="">ราคาขาย</label>
                    <input type="number" name="price2" class="form-control" placeholder="ราคาขาย" required>
                    <label for="">จำนวนคงเหลือ</label>
                    <input type="number" name="qty" class="form-control" placeholder="จำนวนคงเหลือ" required>
                    <p></p>
                    <label for="">อัพโหลดรูปภาพสินค้า</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
                    <br>
                    <button type="submit" name="btnclick" class="btn btn-success"><i class="fa-solid fa-download"></i> บันทึกสินค้า</button>
                </div>
            </div>
        </form><br>
        <table class="table table-hover table-bordered table-sm bg-dark text-light"  id="myTable">
            <thead>
                <tr>
                    <td>ชื่อสินค้า</td>
                    <td>ราคาซื้อ</td>
                    <td>ราคาขาย</td>
                    <td>จำนวนคงเหลือ</td>
                    <td>จัดการ</td>
                </tr>
            </thead>
            <?php
                $strColor = '';
                foreach($product_list as $value){
                    if ($value['qty'] < 1) {
                        $strColor = 'class="text-danger"';
                    } else {
                        $strColor = '';
                    }
            ?>
            <tr>
                <td><?=$value['food_name']?></td>
                <td><?=number_format($value['price1'], 2)?></td>
                <td><?=number_format($value['price2'], 2)?></td>
                <td <?=$strColor?>><?=$value['qty']?></td>
                <td>
                    <a href="#" class="btn btn-warning qty_update" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        id="<?=$value['id']?>" data-id="<?=$value['id']?>" data-qty="<?=$value['qty']?>"><i class="fa-solid fa-arrow-down-short-wide"></i></a>

                    <a href="#" class="btn btn-primary edit_update" data-bs-toggle="modal" data-bs-target="#editModal"
                        id="<?=$value['id']?>" 
                        data-id="<?=$value['id']?>" 
                        data-foodname="<?=$value['food_name']?>" 
                        data-price1="<?=$value['price1']?>"
                        data-price2="<?=$value['price2']?>"><i class="fa-solid fa-pencil"></i></a>
                        <a href="delete.php?id=<?=$value['id']?>"
                        class="btn btn-danger" onclick="return confirm('ลบรายการนี้ ?')"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <!-- Qty Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่ม/แก้ไข จำนวนสินค้า</h5>
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
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="edit_data">
                            <div class="card">
                                <div class="card-body">
                                    <label for="">ชื่อสินค้า</label>
                                    <input type="text" name="food_name" class="form-control txtfoodname">
                                    <label for="">ราคาซื้อ</label>
                                    <input type="number" name="price1" class="form-control txtprice1">
                                    <label for="">ราคาขาย</label>
                                    <input type="number" name="price2" class="form-control txtprice2">
                                    <input type="hidden" name="id">
                                    <br>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="form1" id="hidden_id" />
                        <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
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
            url: "adjust-qty.php",
            method: "POST",
            data: params,
            dataType: 'JSON',
            success: function(data) {
                if (data.type == 'success') {
                    location.reload();
                    // $("#myTable").load(window.location + " #myTable");
                    // $('#exampleModal').modal('hide');
                } else {
                    alert(data.msg);
                }
            }
        });
    });
    </script>
    <script>
    $(document).on('click', '.edit_update', function() {
        var id = $(this).data('id');
        var foodname = $(this).data('foodname');
        var price1 = $(this).data('price1');
        var price2 = $(this).data('price2');

        $("#edit_data").trigger('reset');

        $("#hidden_id").val(id);
        $('.txtfoodname').val(foodname);
        $('.txtprice1').val(price1);
        $('.txtprice2').val(price2);

    });
    $("#edit_data").submit(function(e) {
        e.preventDefault();
        var params = {
            id: $("#hidden_id").val(),
            foodname: $('.txtfoodname').val(),
            price1: $('.txtprice1').val(),
            price2: $('.txtprice2').val()
        }
        $.ajax({
            url: "adjust-edit.php",
            method: "POST",
            data: params,
            dataType: 'JSON',
            success: function(data) {
                if (data.type == 'success') {
                    location.reload();
                    // $("#myTable").load(location.href + " #myTable");
                    // $('#editModal').modal('hide');
                } else {
                    alert(data.msg);
                }
            }
        });
    });
    </script>
</body>

</html>