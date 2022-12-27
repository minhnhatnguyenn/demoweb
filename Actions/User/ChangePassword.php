<?php
    include("../../conn.php");
    session_start();
    $userId = $_SESSION["active"];
	$roleId = $_SESSION["role"];
    $oldpsw = $_POST["oldpsw"];
    $newpsw = $_POST["newpsw"];

    $sql_select = "SELECT * FROM `usr` WHERE PASSWORD = '$oldpsw'";
    $result = $conn->query($sql_select);
    if($result -> num_rows > 0)
    {
        $sql_update = "UPDATE usr SET PASSWORD = '$newpsw' WHERE id = '$userId'";
        if($conn->query($sql_update) === true)
            {
                echo"<script>
                alert('đổi mật khẩu thành công');    
                window.location.replace('../../index.php');       
                </script>"; 
            }
    }
    else
    {
        echo"<script>
        alert('mật khẩu cũ không đúng');
        history.back();       
        </script>"; 
    }
?>