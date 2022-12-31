<?php
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
    function getUniqueArray($array){
        $unique_array = [];
        for ($i = 0; $i < count($array); $i++)
        {
            if (!in_array($array[$i], $unique_array))
            {
                array_push($unique_array, $array[$i]);
            }
        }
        return $unique_array;
    }
    session_start();
    include ("../../conn.php");
        
    $toltal = $_POST["total"];
    $payment = (int)$_POST["payment"];
    $note = $_POST["note"];  
    // Create user_bill
    if (!isset($_POST["shiping-address"]))
    {
        $address = $_POST["address"];
    }
    else
    {
        echo "false";
        $address = $_POST["otherAddress"];
    }


	if (isset($_SESSION["active"]))
    {          
        $userId = $_SESSION["active"]; 
        if ($conn -> query("INSERT INTO `user_bill`(`user_id`, `status_id`, `total`, `address`, `payment_mode_id`, `note`) VALUES('$userId', 1, $toltal, '$address', $payment, '$note')") ===true)
        {
            // Get user_bill_id And create bill_detail
            $result = $conn -> query("SELECT `id` FROM `user_bill` WHERE `user_id` = '$userId' AND `created_time` <= CURRENT_TIMESTAMP() ORDER BY `created_time` desc LIMIT 1;");
            $billId = $result ->fetch_array();
            $query = $conn -> query("SELECT * FROM `cart` WHERE `user_id` = $userId");
            for ($i = 0; $i < $query -> num_rows; $i++)
            {
                $detail = $query -> fetch_assoc();
                $product = $detail["product_id"];
                $quantity = $detail["quantity"];
                $conn -> query("INSERT INTO `user_bill_detail`(`bill_id`, `product_id`, `quantity`) VALUES ('$billId[0]', $product, $quantity)");
            }
            $conn -> query("DELETE FROM `cart` WHERE `user_id` = $userId");       
        }    
    }
    else if (isset($_COOKIE["guest"]))
    {
        $name = $_POST["name"];
        $phoneNum = $_POST["tel"];
        if ($conn -> query("INSERT INTO `guest_bill`(`status_id`,`name`, `phone_number`, `address`, `total`, `payment_mode_id`, `note`) VALUES(1, '$name' , '$phoneNum', '$address', $toltal, $payment, '$note')") === true)
        {
            $result = $conn -> query("SELECT `id` FROM `guest_bill` WHERE `created_time` <= CURRENT_TIMESTAMP() ORDER BY `created_time` desc LIMIT 1;");
            $billId = $result ->fetch_array();
            // Get products from cookie
            $products = explode('.', $_COOKIE["guest"]);
            $unique_products = getUniqueArray($products);
            foreach($unique_products as $item)
            {
                $quantity = oTimeInArray($item, $products);
                $conn -> query("INSERT INTO `guest_bill_detail`(`bill_id`, `product_id`, `quantity`) VALUES ('$billId[0]', $item, $quantity)");
            }
            setcookie ("guest", "", time() + 172800, "/", "", 1);
        }
    }
    header('location: ../../index.php');
?>