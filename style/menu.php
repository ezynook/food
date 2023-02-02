<style>
body {
    margin: 0;
    font-family: "Lato", sans-serif;
}

.sidebar {
    margin: 0;
    padding: 0;
    /* width: 200px; */
    background-color: #343a40;
    position: fixed;
    height: 100%;
    overflow: auto;
    color: #FFF;
}

.sidebar a {
    display: block;
    color: black;
    padding: 16px;
    text-decoration: none;
    color: #FFF;
}

.sidebar a.active {
    background-color: #ebecec;
    color: black;
}

.sidebar a:hover:not(.active) {
    background-color: #555;
    color: white;
}

div.content {
    margin-left: 200px;
    padding: 1px 16px;
    /* height: 1000px; */
}

@media screen and (max-width: 700px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }

    .sidebar a {
        float: left;
    }

    div.content {
        margin-left: 0;
    }
}

@media screen and (max-width: 400px) {
    .sidebar a {
        text-align: center;
        float: none;
    }
}

</style>
<?php
    $menu = $_GET['m'];
?>
<div class="sidebar">
    <h3 align="center" class="mt-3"><b>Food System</b></h3>
    <a class="<?php if($menu == 'food_table'){echo 'active';}else{'';}?> border-bottom border-top" href="food_table.php?m=food_table">หน้าจอขาย</a>
    <a class="<?php if($menu == 'product'){echo 'active';}else{'';}?> border-bottom border-top" href="product.php?m=product">ข้อมูลสินค้า</a>
    <a class="<?php if($menu == 'customer'){echo 'active';}else{'';}?> border-bottom border-top" href="customer.php?m=customer">เพิ่มลูกค้า</a>
    <a class="<?php if($menu == 'table'){echo 'active';}else{'';}?> border-bottom border-top" href="table.php?m=table">เพิ่มโต๊ะ</a>
    <a class="<?php if($menu == 'report'){echo 'active';}else{'';}?> border-bottom border-top" href="report.php?m=report">รายงานการขาย</a>
    <a class="<?php if($menu == 'report-import'){echo 'active';}else{'';}?> border-bottom border-top" href="report-import.php?m=report-import">รายงานนำเข้า/คืนสินค้า</a>
    <a class="<?php if($menu == 'chart'){echo 'active';}else{'';}?> border-bottom border-top" href="chart.php?m=chart&tab=1">สรุปข้อมูลแบบกราฟ</a>
    <a class="<?php if($menu == 'config'){echo 'active';}else{'';}?> border-bottom border-top" href="config.php?m=config">ตั้งค่า</a>
    <a class="" href="logout.php" onclick="return confirm('ออกจากระบบใช่หรือไม่ ?')">ออกจากระบบ</a>
</div>