<?php
    $conn = new mysqli("localhost","root","","db_ecomerce");
    if($conn -> connect_error)
    {
        echo ("lỗi: ". $con -> connect_error);
    }
?>