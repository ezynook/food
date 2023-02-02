<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Sale</title>
</head>
<code>
<?php
    require 'autoload/autoload.inc.php';
    if (!isset($_SESSION)){session_start();};
    $userid = $_SESSION['userid'];
    $msg = '';
    $obj = new Table;
    $data = $obj->TableList();
    if (isset($_POST['btnclick'])){
        $res = $obj->saveTable($_POST['table_name']);
        if ($res){
            echo "
                <script>
                    window.location.href='home.php?m=table'
                </script>
            ";
        }
    }
    if (isset($_GET['delstatus']) && $_GET['delstatus'] == '1') {
        $delstatus = $obj->delTable($_GET['delid']);
        if ($delstatus) {
            echo "
                <script>
                    window.location.href='home.php?m=table'
                </script>
            ";
        }
    }
?>
</code>

<body>
    <div class="container">
    <a href="#!">Table List</a>
        <div class="card mt-3 bg-dar">
            <div class="card-header">
                เพิ่มโต๊ะ
            </div>
            <form action="" method="post">
                <div class="card-body">
                    <label for="">ชื่อโต๊ะ</label>
                    <input type="text" name="table_name" class="form-control" placeholder="ระบุชื่อโต๊ะ">
                    <br>
                    <button type="submit" class="btn btn-success" name="btnclick"><i class="fa-regular fa-floppy-disk"></i> Save</button>
                </div>
            </form>
        </div>
        <hr>
        <div class="row">
            <?php foreach($data as $val){ ?>
            <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                <div class="card mb-3 mt-2" style="width: 9rem;">
                    <div class="card-header">ชื่อโต๊ะ</div>
                    <div class="card-body" align="center">
                        <h5>
                            <span class="badge bg-secondary">
                            <i class="fa-solid fa-border-all"></i> <?=$val['table_name']?>
                            </span>
                        </h5>
                        <hr>
                        <a href="table.php?delid=<?=$val['id']?>&delstatus=1" class="btn btn-danger btn-sm" onclick="return confirm('ต้องการลบโต๊ะนี้ ?')"><i class="fa-solid fa-trash"></i></a>
                    </div>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <script src="style/jquery.min.js"></script>

</body>

</html>