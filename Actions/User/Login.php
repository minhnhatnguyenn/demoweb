<?php
    session_start();
    include ("../../conn.php");
    $id = $_POST["phonenumber"];
    $pws = $_POST["password"];
    $sql = "SELECT * FROM `usr` WHERE `id` = '$id' AND `password` = '$pws'";
    $result = $conn -> query($sql);
    if($result -> num_rows <= 0)
    {
        echo "
        <script>
            alert('Sai số điện thoại hoặc mật khẩu');
            window.history.go(-1);
        </script>";
    }
    else 
    {
        $sql_check = $conn -> query("SELECT is_deleted FROM usr WHERE id = '$id'");
        $rows = $sql_check -> fetch_array();
        $check = $rows[0];
        if($check == 1){
            session_destroy();
            echo "
            <script>
                alert('tài khoản bị khóa');
                window.history.go(-1);
            </script>";
        }
        else
        {
            $row = $result->fetch_assoc();
            $_SESSION["active"] = $id;
            $_SESSION["role"] = $row["role_id"];
            header('location: ../../index.php');
        }
    }
?> 