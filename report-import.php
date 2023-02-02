<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <title>Food Import Report</title>
</head>
<code>
<?php
    error_reporting(0);
    require 'autoload/autoload.inc.php';
    $obj = new Report;
    $customer = $obj->showmemberImport();
    if (isset($_GET['btnclick'])){
        $checking = isset($_GET['c_all']) ? $_GET['c_all'] : '';
        $data = $obj->reportImport(
                $_GET['supplier'], 
                $_GET['import_date'], 
                $checking, 
                $_GET['typeproduct']
            );
    }else{
        $data = $obj->reportImport(0,0,0,0);
    }
?>
</code>

<body>
    <div class="container">
    <a href="#!">Report Import/Return</a>
        <div class="card">
            <form action="" method="get">
                <div class="card-body">
                    <label for="">เลือกวันที่</label>
                    <input type="date" name="import_date" class="form-control import_date" placeholder="เลือกวันที่"
                        value="<?php if(isset($_GET['import_date'])){echo $_GET['import_date'];}else{echo date('Y-m-d');} ?>">
                    <label for="">ลูกค้า</label>
                    <select name="supplier" class="form-control supplier">
                        <option value="" selected>ทั้งหมด</option>
                        <?php foreach($customer as $val_cus){ ?>
                        <option value="<?=$val_cus['supplier']?>"><?=$val_cus['supplier']?></option>
                        <?php } ?>
                    </select>
                    <label for="">ประเภทการจัดการ</label>
                    <select name="typeproduct" class="form-control txttype" required>
                        <option value="" disabled selected>--ประเภทการจัดการ--</option>
                        <option value="นำเข้า">นำเข้า</option>
                        <option value="คืน">คืน</option>
                    </select>
                    <input type="hidden" name="m" value="report-import">
                    <input type="checkbox" name="c_all" id="c_all" value="1"> แสดงข้อมูลทั้งหมด
                    <p></p>
                    <button type="submit" name="btnclick" class="btn btn-success myChk"><i class="fa-solid fa-magnifying-glass"></i> ค้นหา</button>
                </div>
            </form>
        </div>
        <h5 class="mt-1">
            <span class="badge bg-secondary">
                รับเข้าจาก : <?php $row = mysqli_fetch_assoc($data); echo $row['supplier']; ?>
            </span>
        </h5>
        <table class="table table-sm table-bordered" id="myTable">
            <thead>
                <tr class="bg-dark text-white">
                    <td>วันที่รับเข้า</td>
                    <td>ชื่อคู่ค้า</td>
                    <td>ชื่อสินค้า</td>
                    <td>ราคาซื้อ</td>
                    <td>จำนวนรับเข้า</td>
                    <td>รวมจำนวนเงิน</td>
                    <td>ประเภทการจัดการ</td>
                </tr>
            </thead>
            <tbody>
            <?php
                $sum = 0;
                $count = 0;
                $total = 0;
                $price = 0;
                foreach($data as $val){
                    $total = $val['qty'] * $val['price'];
                    $sum += $total;
                    $count += $val['qty'];
                    $price += $val['price'];
            ?>
                <tr>
                    <td><?=date('d-m-Y H:i:s', strtotime($val['import_date']))?></td>
                    <td><?=$val['supplier']?></td>
                    <td><?=$val['food_name']?></td>
                    <td><?=$val['price']?></td>
                    <td><?=$val['qty']?></td>
                    <td><b><?=number_format($total,2)?></b></td>
                    <td><?=$val['type']?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot style="background-color: #CCC;">
                <tr>
                    <th>รวมทั้งสิ้น</th>
                    <th></th>
                    <th></th>
                    <th><?=number_format($price,2)?></th>
                    <th><?=number_format($count,2)?></th>
                    <th><?=number_format($sum,2)?></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="style/button/dataTables.buttons.min.js"></script>
    <script src="style/button/buttons.bootstrap5.min.js"></script>
    <script src="style/button/jszip.min.js"></script>
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