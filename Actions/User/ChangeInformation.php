<?php
    session_start();
    include ("../../conn.php");
	$userId = $_SESSION["active"];
    $roleId = $_SESSION["role"];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $mail = $_POST['mail'];
    
    $conn -> query("UPDATE usr SET `name` = '$name', `mail` = '$mail', `address` = '$address' WHERE id = '$userId'");
    echo "<script>
            alert('đổi thành công');
            window.location.replace('../../index.php');     
        </script>"; 
?>