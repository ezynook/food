<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Import</title>
    <link rel="stylesheet" href="style/dt.css">
    <?php require 'style/autoload.php'; ?>
</head>
<code>
<?php
    require 'autoload/autoload.inc.php';
    require_once 'payment/lib/PromptPayQR.php';
    $id = $_GET['id'];
    $obj = new Report;
    $data = $obj->Slip($id);
    $row = mysqli_fetch_assoc($data[0]);
    $row_sum = mysqli_fetch_assoc($data[1]);
?>
</code>

<body>
    <div class="container mt-1" align="center">
        <img src="images/logo.png" width="96" alt="">
        <h4><u>ใบเสร็จรับเงิน</u></h4>
        <p>เลขที่บิล: INV-<?=$row['id']?></p>
        <p>วันที่: <?=date('d/m/Y H:s:i', strtotime($row['sale_date']))?></p>
        <p>ลูกค้า: <?=$row['customer']?></p>
        <p>โต๊ะ: <?=$row['tbl']?></p>
        <hr>
        <p>รายละเอียดสินค้า</p>
        <hr>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <td>#</td>
                    <td>สินค้า</td>
                    <td>ราคา</td>
                    <td>จำนวน</td>
                    <td>รวมทั้งสิ้น</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 0;
                    $sum = 0;
                    foreach($data[0] as $value){
                        $count = $count+1;
                        $sum += intval($value['total']);
                        
                ?>
                    <tr>
                        <td><?=$count?></td>
                        <td><?=$value['food_name']?></td>
                        <td><?=$value['price']?></td>
                        <td><?=$value['qty']?></td>
                        <td><?=$value['total']?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <th colspan="5">รวมทั้งสิ้น: <?=number_format($sum,2)?></th>
            </tfoot>
        </table>
        <?php
            $PromptPayQR = new PromptPayQR(); // new object
            $PromptPayQR->size = 8; // Set QR code size to 8
            $PromptPayQR->id = '0937395253'; // PromptPay ID
            $PromptPayQR->amount = $row_sum['total']; // Set amount (not necessary)
            echo "สแกนจ่ายเงิน"."<br>";
            echo '<img src="' . $PromptPayQR->generate() . '" width="150"/>';
        ?>
    </div>
<script src="style/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        window.print();
        window.onafterprint = back;

        function back() {
            window.location.href='home.php?m=food_table';
        }
    });
</script>
</body>
</html>