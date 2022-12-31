<?php
    function getProductPrice($id, $type, $conn){
        $sql = "SELECT * FROM `product` WHERE `id` = $id";
        $result = $conn -> query($sql);
        $rows = $result -> fetch_assoc();
        return $rows["$type"];
    }

    function countDigit($number){
        return strlen($number);
    }

    function displayPrice($input){
        $temp = substr_replace($input, '.', '-3', 0); 
        if (countDigit($input) > 6){
            $temp = substr_replace($temp, '.', '-7', 0);
        }
        return $temp. "₫";
    }

    function totalByGuest($conn){
        $total = 0;
        $products = explode('.',$_COOKIE['guest']);
        for ($i = 0; $i < count($products); $i++)
        {
            $temp = $conn -> query("SELECT `sale_price` FROM `product` WHERE `id` = '$products[$i]'");
            $price = $temp->fetch_array();
            $total += (int)$price[0];
        }
        return $total;
    }
    function totalByUser($id, $conn){
        $total = 0;
        $result = $conn -> query("SELECT * FROM `cart` WHERE `user_id` = '$id'");
        for ($i = 0; $i < $result -> num_rows; $i++)
        {
            $cart = $result -> fetch_assoc();
            $total += ((int)$cart["quantity"] * (int)getProductPrice($cart["product_id"], "sale_price", $conn));
        }
        return $total;
    }

    session_start();
    include ("../../conn.php");
    if (isset($_SESSION['active']))
    {
        $userId = $_SESSION["active"]; 
        $total = totalByUser($userId, $conn);
    }
    else
    {
        $total = totalByGuest($conn);
    }
    echo displayPrice($total);
?>