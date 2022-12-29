<?php 
    include ("../../../conn.php");
    $userId = $_POST['id'];
    if ($_POST["type"] == 'delete')
    {
        $conn -> query("UPDATE `usr` SET `is_deleted` = 1 WHERE `id` = '$userId'");
    }
    else
    {
        $conn -> query("UPDATE `usr` SET `is_deleted` = 0 WHERE `id` = '$userId'");
    }  
?> 