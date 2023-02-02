
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Food System</title>
    <link rel="icon" href="images/favicon.ico">
    <link href="css/style2.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="icon/css/all.css">
    <script src="icon/js/all.js"></script>
    <script src="js/all.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code&family=Noto+Sans+Thai&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'Noto Sans Thai', sans-serif;
            font-size: 14px;
        }
    </style>
</head>
<code>
        <?php
            if (!isset($_SESSION)) {
                session_start();
            }
            $menu = $_GET['m'];
        ?>
    </code>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3 text-white bg-dark" href="#"><i class="fa-solid fa-utensils"></i> Food System</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a href="#" class="dropdown-item pass_update" data-bs-toggle="modal" 
                            data-id="<?php echo $_SESSION['userid']; ?>" data-bs-target="#exampleModal2">
                            <i class="fa-solid fa-key"></i> เปลี่ยนรหัสผ่าน</a>
                        <a class="dropdown-item" href="logout.php" onclick="return confirm('ออกจากระบบ ?')">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> ออกจากระบบ
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">บันทึกข้อมูล</div>
                        <a class="nav-link <?php if($menu == 'food_table'){ echo 'active';}elseif ($menu == 'sale'){echo 'active';}else{'';}?>"
                            href="home.php?m=food_table">
                            <div class="sb-nav-link-icon"><i class="fa fa-cart-arrow-down"></i></div>
                            หน้าจอขาย
                        </a>
                        <a class="nav-link <?php if($menu == 'product'){echo 'active';}else{'';}?>"
                            href="home.php?m=product">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-bowl-food"></i></div>
                            ข้อมูลสินค้า
                        </a>
                        <a class="nav-link <?php if($menu == 'import'){echo 'active';}else{'';}?>"
                            href="home.php?m=import">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-folder-tree"></i></div>
                            นำเข้า/คืนสินค้า
                        </a>
                        <a class="nav-link <?php if($menu == 'customer'){echo 'active';}else{'';}?>"
                            href="home.php?m=customer">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                            เพิ่มลูกค้า
                        </a>
                        <a class="nav-link <?php if($menu == 'table'){echo 'active';}else{'';}?>"
                            href="home.php?m=table">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-toilet-portable"></i></div>
                            เพิ่มโต๊ะ
                        </a>
                        <div class="sb-sidenav-menu-heading">รายงาน</div>
                        <a class="nav-link collapsed <?php if($menu == 'report'){echo 'active';}elseif($menu == 'report-import'){echo 'active';}elseif($menu == 'chart'){echo 'active';}else{echo '';} ?>" href="#!" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-ranking-star"></i></div>
                            รายงาน
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?php if($menu == 'report'){echo 'active';}else{'';}?>"
                                    href="home.php?m=report">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                                    รายงานการขาย
                                </a>
                                <a class="nav-link <?php if($menu == 'report-import'){echo 'active';}else{'';}?>"
                                    href="home.php?m=report-import">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-pie"></i></div>
                                    รายงานนำเข้า/คืนสินค้า
                                </a>
                                <a class="nav-link <?php if($menu == 'chart'){echo 'active';}else{'';}?>"
                                    href="home.php?m=chart&tab=1">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-area"></i></div>
                                    สรุปข้อมูลแบบกราฟ
                                </a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">ตั้งค่าระบบ</div>
                            <a class="nav-link <?php if($menu == 'config'){echo 'active';}else{'';}?>"
                                href="home.php?m=config">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-wrench"></i></div>
                                ตั้งค่า
                            </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small"><i class="fa-solid fa-toolbox"></i> &nbsp; <i class="text-white">พัฒนาโดย: Nutthakorn P.</i></div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?php 
                        if (empty($menu)) {
                            require_once 'food_table.php';
                            exit;
                        }
                        if ($menu == 'food_table') {
                            require_once 'food_table.php';
                        }elseif ($menu == 'product'){
                            require_once 'product.php';
                        }elseif ($menu == 'sale'){
                            require_once 'sale.php';
                        }elseif ($menu == 'customer'){
                            require_once 'customer.php';
                        }elseif ($menu == 'table'){
                            require_once 'table.php';
                        }elseif ($menu == 'report'){
                            require_once 'report.php';
                        }elseif ($menu == 'report-import'){
                            require_once 'report-import.php';
                        }elseif ($menu == 'chart'){
                            require_once 'chart.php';
                        }elseif ($menu == 'config'){
                            require_once 'config.php';
                        }elseif ($menu == 'import'){
                            require_once 'import.php';
                        }else{
                            require_once '404.html';
                        }
                    ?>
                </div>
            </main>
        </div>
    </div>
    <!-- Change Password Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal2Label"><i class="fa-solid fa-key"></i> เปลี่ยนรหัสผ่าน | <?=$_SESSION['username']?></h5><br>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="pass_data">
                        <input type="password" name="password" class="form-control pass_val" placeholder="กรุณากรอกรหัสผ่านใหม่">
                        <p></p>
                        <input type="password" name="password" class="form-control pass_val2" placeholder="กรุณากรอกรหัสผ่านใหม่อีกครั้ง">
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="form1" id="hidden_id" />
                    <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="style/jquery.min.js"></script>
    <script>
    $(document).on('click', '.pass_update', function() {
        var id = $(this).data('id');
        $("#pass_data").trigger('reset');
        $("#hidden_id").val(id);
    });
    $("#pass_data").submit(function(e) {
        e.preventDefault();
        if ($('.pass_val').val().length == 0 && $('.pass_val2').val().length == 0) {
            alert('กรุณากรอกข้อมูลให้ครบถ้วน');
            return false;
        }
        if ($('.pass_val').val() != $('.pass_val2').val()) {
            alert('รหัสที่ท่านกรอกไม่ตรงกัน กรุณาลองใหม่!');
            return false;
        }
        var params = {
            id: $("#hidden_id").val(),
            password: $('.pass_val2').val()
        }
        $.ajax({
            url: "change-password.php",
            method: "POST",
            data: params,
            type: 'JSON',
            success: function(data) {
                if (data == 'success') {
                    location.reload();
                } else {
                    alert(data);
                }
            }
        });
    });
    </script>
</body>

</html>