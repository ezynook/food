<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food System</title>
    <?php require 'autoload.php'; ?>
</head>
<!-- Check Active Menu -->
<?php
    $menu = $_GET['m'];
?>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Food System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if($menu == 'sale'){echo 'active';}else{'';}?>" href="sale.php?m=sale">หน้าจอขาย</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($menu == 'product'){echo 'active';}else{'';}?>" href="product.php?m=product">ข้อมูลสินค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($menu == 'customer'){echo 'active';}else{'';}?>" href="customer.php?m=customer">เพิ่มลูกค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($menu == 'report'){echo 'active';}else{'';}?>" href="report.php?m=report">รายงานการขาย</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($menu == 'report-import'){echo 'active';}else{'';}?>" href="report-import.php?m=report-import">รายงานนำเข้าสินค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($menu == 'chart'){echo 'active';}else{'';}?>" href="chart.php?m=chart">สรุปข้อมูลแบบกราฟ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($menu == 'config'){echo 'active';}else{'';}?>" href="config.php?m=config">ตั้งค่า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">ออกจากระบบ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>