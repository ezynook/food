<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="icon/css/all.css">
    <script src="icon/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code&family=Noto+Sans+Thai&display=swap" rel="stylesheet">
    <title>Food Login</title>
    <style>
        *{
            font-family: 'Noto Sans Thai', sans-serif;
        }
    </style>
    <?php require 'style/autoload.php'; ?>
</head>
<code>
<?php
    if (!isset($_SESSION)){session_start();}
    require 'autoload/autoload.inc.php';
    if (isset($_SESSION['userid'])){
        header("location: home.php?m=food_table");
        exit;
    }
    $msg = '';
    $obj = new Auth;
    $LastLogin = $obj->showLastLogin();
    if (isset($_POST['btnsave'])){
        $res = $obj->Login($_POST['username'], $_POST['password']);
        if ($res){
            if ($res[0] == 'pass'){
                setcookie("username", $res[1]['username'], time()+31556926);
                setcookie("userid", $res[1]['id'], time()+31556926);
            }
            $_SESSION['username'] = $res[1]['username'];
            $_SESSION['userid'] = $res[1]['id'];
            header("location: home.php?m=food_table");
        }else{
            $msg = '
                <div class="alert alert-danger" role="alert">
                    Username or Password went wrong
                </div>
            ';
        }
    }
?>
</code>

<body style=" background-image: url('images/food3.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100%;
" 
>
    <div class="container mt-5">
        <?php if(isset($msg)){echo $msg;} ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">ระบบร้านอาหาร</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="username" placeholder="Username">
                                    <label for="inputEmail">ชื่อผู้ใช้</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                    <label for="inputPassword">รหัสผ่าน</label>
                                </div>
                        </div>
                        <div class="card-footer text-center py-3">
                            <button type="submit" name="btnsave" class="btn btn-success"><i class="fa-solid fa-right-to-bracket"></i> เข้าสู่ระบบ</button>
                            <a href="signup.php" class="btn btn-secondary"><i class="fa-solid fa-user-plus"></i> สมัครสมาชิก</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div align="center">
            <span class="badge bg-warning text-dark">มีผู้เข้าใช้งานล่าสุดเมื่อ :
                <?=date('d/m/Y H:i:s', strtotime($LastLogin['maxtime']))?></span>
        </div>
    </div>
</body>

</html>