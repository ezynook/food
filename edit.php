<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Product</title>
    <?php require 'style/autoload.php'; ?>
</head>
<code>
<?php
    require 'autoload/autoload.inc.php';
    $msg = '';
    $obj = new Product;
    $product_list = $obj->getProductById($_GET['id']);
    if (isset($_POST['btnclick'])){
        $send_data = $obj->editProduct(
            $_POST['id'],
            $_POST['food_name'],
            $_POST['price1'],
            $_POST['price2'],
            $_POST['qty']
    );
        if ($send_data){
            header("location: product.php?m=product");
        }else{
            $msg = '
                <div class="alert alert-danger" role="alert">
                    แก้ไขไม่สำเร็จ
                </div>
            ';
        }
    }
?>
</code>

<body>
    <?php require 'style/menu.php'; ?>
    <div class="container content" style="padding-left: 2rem;padding-right:10rem;">
        <?php if(isset($msg)){echo $msg;} ?>
        <form action="" method="POST">
            <div class="card">
                <div class="card-body">
                    <label for="">ชื่อสินค้า</label>
                    <input type="text" name="food_name" class="form-control" value="<?=$product_list['food_name']?>">
                    <label for="">ราคาซื้อ</label>
                    <input type="number" name="price1" class="form-control" value="<?=$product_list['price1']?>">
                    <label for="">ราคาขาย</label>
                    <input type="number" name="price2" class="form-control" value="<?=$product_list['price2']?>">
                    <label for="">จำนวนคงเหลือ</label>
                    <input type="number" name="qty" disabled class="form-control" value="<?=$product_list['qty']?>">
                    <input type="hidden" name="id" value="<?=$product_list['id']?>">
                    <br>
                    <button type="submit" name="btnclick" class="btn btn-success">แก้ไขสินค้า</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>