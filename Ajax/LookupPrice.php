<?php
    $conn = mysqli_connect('mydatabase', 'root', '2909', 'food');
    $sql = "SELECT price1 FROM product WHERE id=".$_POST['id'];
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    echo json_encode(array("price"=>number_format($row['price1'],0)));
