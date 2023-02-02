<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Signup</title>
    <?php require 'style/autoload.php'; ?>
<style>
    .forminput{
        background: transparent;
        width: 800px;
        padding: 1em;
        margin-bottom: 2em;
        border: none;
        border-left: 1px solid rgba(255,255,255,0.4);
        border-top: 1px solid rgba(255,255,255,0.4);
        border-radius: 5000px;
        backdrop-filter: blur(5px);
        box-shadow: 4px 4px 60px rgba(0,0,0,0.2);
        color: #000;
        font-family: Montserrat, sans-serif;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }::placeholder {
         color: #000;
         opacity: 1; /* Firefox */
         font-weight: bold;
}
</style>
</head>
<code>
<?php
    require 'autoload/autoload.inc.php';
    $obj = new Signup;
    if (isset($_POST['btnclick'])){
        $res = $obj->sign_Up($_POST['username'], $_POST['password2']);
        if ($res){
            echo "
                <script>
                    alert('สมัครสมาชิกเรียบร้อยแล้ว')
                    window.location.href='index.php'
                </script>
            ";
        }else{
        echo "
                <script>
                    alert('ชื่อผู้ใช้งานซ้ำกับในระบบ กรุณาลองใหม่')
                    window.location.href='signup.php'
                </script>
        ";
        }
    }
?>
</code>
<body style=" background-image: url('images/food3.jpg');
              background-repeat: no-repeat;
              background-attachment: fixed; 
              background-size: 100%;
" >
            </div><br><br>
            <div class="container" align="center">
                <form action="" method="post" style="background: rgba(255,255,255,0.3);;
                                                     padding: 3em;
                                                     width: 900px;
                                                     height: auto;
                                                     border-radius: 20px;
                                                     border-left: 1px solid rgba(255,255,255,0.3);
                                                     border-top: 1px solid rgba(255,255,255,0.3);;
                                                     backdrop-filter: blur(10px);
                                                     box-shadow: 20px 20px 40px -6px rgba(0,0,0,0.2);
                                                     text-align: center;
                                                     position: relative;
                                                     transition: all 0.2s ease-in-out;
  "
                >
                <span class="badge rounded-pill bg-success text-dark" style="font-size: 30px;">สมัครสมาชิก</span>
                    <div class="container" align="left">
                     <label for="" > <b style="font-weight: bold;">Username</b></label>
                    </div>
                    <input type="text" name="username"class="forminput mt-3" placeholder="username" id="user">
                    <div class="container" align="left">
                    <label for=""> <b style="font-weight: bold;">Password</b></label>
                    </div>
                    <input type="password" name="password" class="forminput mt-3" id="passwd1" placeholder="รหัสผ่าน" >
                    <div class="container" align="left">
                    <label for=""> <b style="font-weight: bold;">retry-Password</b> </label>
                    </div>
                    <input type="password" name="password2" class="forminput mt-3" id="passwd2" placeholder="ยืนยันรหัสผ่าน">
                    <p></p>
                    <input type="submit" name="btnclick" class="btn btn-success rounded-pill"  value="สมัครสมาชิก" id="btnclick" style=" font-weight: bold;">
                    <a href="index.php" class="btn btn-secondary rounded-pill"> <b>กลับไปหน้าLogin</b> </a>
                    
                </form>
            </div>
    <script src="style/jquery.min.js"></script>
    <script>
        $('#btnclick').click(function(){
            var user = $('#user').val();
            var pass1 = $('#passwd1').val();
            var pass2 = $('#passwd2').val();
            if (pass1 != pass2){
                alert('รหัสผ่าไม่ตรงกัน');
                return false;
            }else if(pass1 == ''){
                alert('คุณไม่ได้กรอกรหัส');
                return false;
            }else if(pass2 == ''){
                alert('คุณไม่ได้กรอกยืนยันรหัส');
                return false;
             }else if(user == ''){
                alert('คุณไม่ได้กรอกuser');
                return false;
             }else if(pass1 == '', pass2 == '',user == ''){
                alert('คุณไม่ได้กรอกข้อมูล');
                return false;
             }else{
                return true;
             }
        });
    </script>
</body>
</html>