<?php
    $conn = new mysqli("localhost","root","","db_ecomerce");
    if($conn -> connect_error)
    {
        echo ("lỗi: ". $conn -> connect_error);
    }
?>