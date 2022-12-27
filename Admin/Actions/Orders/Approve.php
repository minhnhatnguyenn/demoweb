<?php
    include ("../../../conn.php");
    if ($_POST['type'] == 'user')
    {
        $user_bill = $_POST['id'];
        $conn -> query("UPDATE `user_bill` set `status_id`= 2  WHERE `id` = '$user_bill'");
    }
    else
    {
        $guest_bill = $_POST['id'];
        $conn -> query("UPDATE `guest_bill` set `status_id`= 2  WHERE `id` = '$guest_bill'");
    }
?>