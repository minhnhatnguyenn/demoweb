<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demoweb";
    $conn = new mysqli("localhost","root","","demoweb");
    if($conn->connect_error)
    {
        echo ("Connection failed: ". $conn->connect_error);
    }
?>