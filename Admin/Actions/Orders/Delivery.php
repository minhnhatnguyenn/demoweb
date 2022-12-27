<?php
    include ("../../../conn.php");
    $deliverId = $_POST["deliverId"];
    if ($_POST['type'] == 'user')
    {
        $user_bill = $_POST['id'];
        $conn -> query("UPDATE `user_bill` set `status_id`= 3, `deliver_id` = $deliverId WHERE `id` = '$user_bill'");    
    }
    else
    {
        $guest_bill = $_POST['id'];
        $conn -> query("UPDATE `guest_bill` set `status_id`= 3, `deliver_id` = $deliverId  WHERE `id` = '$guest_bill'");
    }
    $conn -> query("UPDATE `deliver` SET `is_ready`= 0 WHERE `id` = $deliverId");
?>