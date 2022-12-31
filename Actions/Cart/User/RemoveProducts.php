<?php
    session_start();
    include ("../../../conn.php");
    $userId = $_SESSION["active"];
    $response = null;
    $productId = $_POST["val"];

    $result = $conn -> query ("SELECT `quantity` FROM `cart` WHERE `user_id` = '$userId' AND `product_id` = $productId");
    $quantity = $result -> fetch_array();
    $quantity = $quantity[0];
    $conn -> query ("DELETE FROM `cart` WHERE `user_id` = '$userId' AND `product_id` = $productId");
    $response = array('prId' => $productId, 'quantity' => $quantity);

    echo json_encode($response);    
?>