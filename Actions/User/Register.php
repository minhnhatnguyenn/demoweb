<?php
    include ("../../conn.php");
    $id = $_POST['phonenumber'];
    $hoten = $_POST['hoten'];
    $password = $_POST['password'];

    $sql_select = "SELECT id FROM usr WHERE id = '$id'";
    $result = $conn->query($sql_select);
    if($result -> num_rows>0)
    {
        {
            echo"<script>
                alert('tài khoản đã tồn tại, mời bạn nhập lại');
                window.history.back(-1);            
            </script>"; 
        } 
    }
    else
    {
        $sql_insert = "INSERT INTO usr(id,role_id, PASSWORD , name) VALUES('$id', 3,'$password','$hoten')";
        if($conn->query($sql_insert) === true)
        {
            $_SESSION["active"] = $id;
            echo"<script>
                alert('đăng ký tài khoản thành công');    
                window.location.replace('../../index.php');     
                </script>"; 
            $_SESSION["active"] = $id;
        }
        else
        {
            echo"<script>
                alert('lỗi khi sửa');
                history.back();            
            </script>"; 
        } 
    }
?>
