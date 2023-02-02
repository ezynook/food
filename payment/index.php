<?Php
require_once("lib/PromptPayQR.php");
if (isset($_POST['btnSave'])){
    $price = $_POST['price'];
    $PromptPayQR = new PromptPayQR(); // new object
    $PromptPayQR->size = 8; // Set QR code size to 8
    $PromptPayQR->id = '0937395253'; // PromptPay ID
    $PromptPayQR->amount = $price; // Set amount (not necessary)
    echo '<img src="' . $PromptPayQR->generate() . '" />';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <title>ชำระเงิน</title>
</head>

<body>
    <div class="container">
            <form action="" method="post">
                <input type="text" name="price" placeholder="จำนวนเงิน" class="form-control">
                <br>
                <input type="submit" value="Submit" name="btnSave" class="btn btn-success">
            </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
</body>

</html>