<?php
    include ("../../conn.php");
    $id = $_POST['id'];
    
    $result = $conn -> query("UPDATE `user_bill` SET status_id = 5 WHERE id = '$id'");
    echo"<script>
        alert('Hủy đơn hàng thành công');
        history.back();           
        </script>"; 
 ?>