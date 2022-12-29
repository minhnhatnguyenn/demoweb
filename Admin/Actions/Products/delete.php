<?php 
    include ("../../../conn.php");
    $id = $_POST['id'];
    if ($_POST["type"] == 'Cancel')
    {
        $conn -> query("UPDATE `product` SET `is_deleted` = 1 WHERE `id` = '$id'");
    }
    else
    {
        $conn -> query("UPDATE `product` SET `is_deleted` = 0 WHERE `id` = '$id'");
    }  
?> 