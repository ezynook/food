<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <title>Food Report</title>
</head>
<code>
<?php
    error_reporting(0);
    require 'autoload/autoload.inc.php';
    $obj = new Report;
    $customer = $obj->showMember();
    if (isset($_GET['btnclick'])){
        $data = $obj->reportData($_GET['customer'], $_GET['sale_date'], $_GET['c_all']);
    }else{
        $data = $obj->reportData(0, 1, 0);
    }
?>
</code>

<body style=" background-image: url('images/food3.jpg');
              background-repeat: no-repeat;
              background-attachment: fixed; 
              background-size: 100%;
">
    <div class="container">
    <a href="#!">Sale Report</a>
        <div class="card bg-dark text-white">
            <form action="" method="get">
                <div class="card-body">
                    <label for="">เลือกวันที่</label>
                    <input type="date" name="sale_date" class="form-control sale_date" placeholder="เลือกวันที่"
                        value="<?php if(isset($_GET['sale_date'])){echo $_GET['sale_date'];}else{echo date('Y-m-d');} ?>">
                    <label for="">ลูกค้า</label>
                    <select name="customer" class="form-control customer">
                        <option value="" selected>ทั้งหมด</option>
                        <?php foreach($customer as $val_cus){ ?>
                        <option value="<?=$val_cus['id']?>"><?=$val_cus['cus_name']?></option>
                        <?php } ?>
                    </select> 
                    <br>
                    <input type="hidden" name="m" value="report">
                    <input type="checkbox"  name="c_all" id="c_all" value="1"> แสดงข้อมูลทั้งหมด
                    <p></p>
                    <button type="submit" name="btnclick" class="btn btn-success myChk"><i class="fa-solid fa-magnifying-glass"></i> ค้นหา</button>
                </div>
            </form>
        </div>
        <h5 class="mt-3">
            <span class="badge bg-secondary">
                รายงานของลูกค้า : <?php $row = mysqli_fetch_assoc($data); echo $row['customer']; ?>
            </span>
        </h5>
        <table class="table table-sm table-bordered" id="myTable">
            <thead>
                <tr class="bg-dark text-white">
                    <td>วันที่</td>
                    <td>ชื่อสินค้า</td>
                    <td>ราคาขาย</td>
                    <td>จำนวน</td>
                    <td>รวมทั้งสิ้น</td>
                </tr>
            </thead>
            <tbody>
            <?php
                $sum = 0;
                $count = 0;
                $price = 0;
                foreach($data as $val){
                    $sum += $val['total'];
                    $count += $val['qty'];
                    $price += $val['price'];
            ?>
            <tr class="bg-dark text-white">
                <td><?=date('d-m-Y H:i:s', strtotime($val['sale_date']))?></td>
                <td><?=$val['food_name']?></td>
                <td><?=$val['price']?></td>
                <td><?=$val['qty']?></td>
                <td><?=$val['total']?></td>
            </tr>
            <?php } ?>
            </tbody>
            <tfoot style="background-color: #CCC;" align="right">
                <th colspan="2">รวมทั้งสิ้น</th>
                <th><?=number_format($price, 2)?></th>
                <th><?=number_format($count, 2)?></th>
                <th><?=number_format($sum,2)?></th>
            </tfoot>
        </table>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="style/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="style/button/dataTables.buttons.min.js"></script>
    <script src="style/button/buttons.bootstrap5.min.js"></script>
    <script src="style/button/jszip.min.js"></script>
    <script src="style/button/pdfmake.min.js"></script>
    <script src="style/button/vfs_fonts.js"></script>
    <script src="style/button/buttons.html5.min.js"></script>
    <script src="style/button/buttons.print.min.js"></script>
    <script src="style/button/buttons.colVis.min.js"></script>
    <script src="style/button/vfs_fonts2.js"></script>
    <script>
        $(document).on('click','#c_all',function(){
            var isChecked = $(this).is(':checked');
            if (isChecked){
                $('.form-control').prop('disabled', true)
            }else{
                $('.form-control').prop('disabled', false)
            }
        });
    </script>
    <script>
    $(document).ready(function() {
    var dt = new Date();
    var dt2 = dt.getDate() +'_' + dt.getMonth() + '_' + dt.getFullYear() + '_' + dt.getHours() + "_" + dt.getMinutes();
    $('#myTable').dataTable({
        dom: 'Blfrtip',
        "lengthMenu": [ 10, 25, 50],
        buttons: [{
                extend: 'csv',
                charset: 'UTF-8',
                fieldSeparator: ',',
                bom: true,
                filename: 'export_csv_report_'+dt2,
                title: 'Export to csv',
                footer: true
            },
            {
                extend: 'excel',
                charset: 'UTF-8',
                bom: true,
                filename: 'export_excel_report_'+dt2,
                title: 'Export to Excel',
                footer: true
            },
            {
                extend: "print",
                footer: true,
                exportOptions: {
                    stripHtml: true,
                    orthogonal: "myDocument"
                },
            },
        ],
        "scrollX": false,
        responsive: true,
        "oLanguage": {
            "sLengthMenu": "แสดง _MENU_ รายการ ต่อหน้า",
            "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
            "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ รายการ",
            "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
            "sInfoFiltered": "(จากรายการทั้งหมด _MAX_ รายการ)",
            "sSearch": "ค้นหา :",
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "หน้าสุดท้าย"
            }
        }
    });
});
    </script>
</body>

</html>