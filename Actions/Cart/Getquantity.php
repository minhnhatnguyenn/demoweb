<?php
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
    function getProductPrice($id, $type, $conn){
        $sql = "SELECT * FROM `product` WHERE `id` = $id";
        $result = $conn -> query($sql);
        $rows = $result -> fetch_assoc();
        return $rows["$type"];
    }

    function oTimeInArray ($item, $array =  array()){
        if (!in_array($item, $array))
        {
            return "0";
        }
        else
        {
            $tmp = array_count_values($array);
            return $tmp[$item]; 
        }
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

    session_start();
    include ("../../conn.php");
    $productId = $_POST["id"];
    $quantity = (int)$_POST["val"];
    if (isset($_SESSION["active"]))
    {
        $userId = $_SESSION["active"];
        $response = null;
        
        if ($conn -> query("UPDATE `cart` SET `quantity`= $quantity WHERE `user_id` = '$userId' AND `product_id` = $productId"))
        {
            $price = (int)getProductPrice($productId, "sale_price", $conn);
            $response = array ('quantity' => $quantity,'price' => displayPrice($price*$quantity), 'total' => displayPrice(totalByUser($userId, $conn)), 'inputTotal' => totalByUser($userId, $conn));
        }
    }
    else
    {
        $cookieVal = $_COOKIE["guest"];
        $products = explode('.', $cookieVal);
        if ($quantity < oTimeInArray($productId, $products))
        {
            for ($i = 0; $i < count($products); $i++)
            {
                if ($products[$i] == $productId)
                {
                    array_splice($products, $i, 1);
                }
            }
            $newCookieVal = implode(".", $products);
        }
        else
        {
            $newCookieVal = $cookieVal.".$productId";
        }
        $price = (int)getProductPrice($productId, "sale_price", $conn);
        setcookie ("guest", "$newCookieVal", time() + 172800, "/", "", 1);
        $total = totalByGuest($conn);
        $response = array ('quantity' => $quantity,'price' => displayPrice($price*$quantity), 'total' => displayPrice($total), 'inputTotal' => $total);       
    }

    echo json_encode($response); 
?>