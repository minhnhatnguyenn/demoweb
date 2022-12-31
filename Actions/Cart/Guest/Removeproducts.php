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

    include ("../../../conn.php");
    $products = explode('.',$_COOKIE['guest']);
    $response = null;
    $productId = $_POST["val"];
    $quantity = oTimeInArray($productId, $products);
    for ($i = 0; $i < count($products); $i++)
    {
        if ($products[$i] == $productId)
        {
            array_splice($products, $i, 1);
        }
    }    
    $valueCookie = implode(".", $products);
    setcookie ("guest", "$valueCookie", time() + 172800, "/", "", 1);
    $response = array('prId' => $productId, 'quantity' => $quantity);
    echo json_encode($response);  
?>