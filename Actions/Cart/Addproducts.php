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

    function getCategoryName($id, $conn){
        $sql = "SELECT * FROM `product_type` WHERE `id` = $id";
        $result = $conn -> query($sql);
        $rows = $result -> fetch_assoc();
        if ($rows["name"] == "Phụ kiện khác"){
            return "Phụ kiện";
        }
        return $rows["name"];
    }

    function getIMG($id){
        return "./img/products/$id.jpg";
    }

    function getProductNameById($id, $conn){
        $sql = "SELECT * FROM `product` WHERE `id` = $id";
        $result = $conn -> query($sql);
        $rows = $result -> fetch_assoc();
        return $rows["name"];
    }

    function getProductPrice($id, $type, $conn){
        $sql = "SELECT * FROM `product` WHERE `id` = $id";
        $result = $conn -> query($sql);
        $rows = $result -> fetch_assoc();
        return $rows["$type"];
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

    session_start();
    include ("../../conn.php");
    
    $response = null;
    $productId = $_POST["val"];
   
    // GET product information
    $name = getProductNameById($productId, $conn);
    $linkIMG = getIMG($productId);
    $sale_price = getProductPrice($productId, "sale_price", $conn);
    $price = getProductPrice($productId, "price", $conn);
    $display_sale_price = displayPrice($sale_price);
    $display_price = displayPrice($price);
   
    if (isset($_SESSION["active"]))
    {
        $userId = $_SESSION["active"];
        $result = $conn -> query ("SELECT * FROM `cart` WHERE `user_id` = $userId AND `product_id` = $productId");

        // if exist cart_id and product_id ++1 quantity
        if (!empty($result->num_rows))
        {
            $conn -> query("UPDATE `cart` SET `quantity` = `quantity`+1 WHERE `user_id` = $userId AND `product_id` = $productId");
            // Get new quantity to show
            $result = $conn -> query ("SELECT `quantity` FROM `cart` WHERE `user_id` = $userId AND `product_id` = $productId");
            $row = $result -> fetch_array();
            $response = array('existed' => 'true', 'prId' => $productId, 'newQty' => ' '.$row[0].' x ');   
        }
        if (empty($result->num_rows)) 
        {
            $conn -> query("INSERT INTO `cart`(`user_id`,`product_id`) VALUES('$userId', $productId)");         
            if ($sale_price < $price)
            {
                $response = array('existed' => 'false', 'html' => 
                    "<div class='product-widget' id='$productId'>" .
                        "<div class='product-img'>" .
                            "<img src='$linkIMG'>" .
                        "</div>" .
                        "<div class='product-body'>" .
                            "<h3 class='product-name'>" .
                                "<a href='#'>$name</a>" .
                            "</h3>" .
                            "<h4 class='product-price'>" .
                                "<span class='qty' id='quantity'> 1 x </span>" .
                                "$display_sale_price<br>" .
                                    "<del class='product-old-price' style='margin-left: 33px;'>" .
                                    "$display_price" .
                                    "</del>" .	 													
                            "</h4>" .
                        "</div>" .
                        "<button class='delete' id='$productId'><i class='fa fa-close'></i></button>" .
                    "</div>"
                );
            }
            else
            {
                $response = array('existed' => 'false', 'html' => 
                    "<div class='product-widget' id='$productId'>" .
                        "<div class='product-img'>" .
                            "<img src='$linkIMG'>" .
                        "</div>" .
                        "<div class='product-body'>" .
                            "<h3 class='product-name'>" .
                                "<a href='#'>$name</a>" .
                            "</h3>" .
                            "<h4 class='product-price'>" .
                                "<span class='qty' id='quantity'> 1 x </span>" .
                                "$display_price" .	 													
                            "</h4>" .
                        "</div>" .
                        "<button class='delete' id='$productId'><i class='fa fa-close'></i></button>" .
                    "</div>"
                );
            }          
        }
    }
    else
    {
        if (!isset($_COOKIE["guest"]))
        {
            setcookie ("guest", $productId, time() + 172800, "/", "", 1);
            if ($sale_price < $price)
            {
                $response = array('existed' => 'false', 'html' => 
                    "<div class='product-widget' id='$productId'>" .
                        "<div class='product-img'>" .
                            "<img src='$linkIMG'>" .
                        "</div>" .
                        "<div class='product-body'>" .
                            "<h3 class='product-name'>" .
                                "<a href='#'>$name</a>" .
                            "</h3>" .
                            "<h4 class='product-price'>" .
                                "<span class='qty' id='quantity'> 1 x </span>" .
                                "$display_sale_price<br>" .
                                "<del class='product-old-price' style='margin-left: 33px;'>" .
                                "$display_price" .
                                "</del>" .	 													
                            "</h4>" .
                        "</div>" .
                        "<button class='delete' id='$productId'><i class='fa fa-close'></i></button>" .
                    "</div>"
                );
            }
            else
            {
                $response = array('existed' => 'false', 'html' => 
                    "<div class='product-widget' id='$productId'>" .
                        "<div class='product-img'>" .
                            "<img src='$linkIMG'>" .
                        "</div>" .
                        "<div class='product-body'>" .
                            "<h3 class='product-name'>" .
                                "<a href='#'>$name</a>" .
                            "</h3>" .
                            "<h4 class='product-price'>" .
                                "<span class='qty' id='quantity'> 1 x </span>" .
                                "$display_price" .	 													
                            "</h4>" .
                        "</div>" .
                        "<button class='delete' id='$productId'><i class='fa fa-close'></i></button>" .
                    "</div>"
                );
            }
        }

        else
        {
            $cookieVal = $_COOKIE["guest"];
            $products = explode('.', $cookieVal);
            if (oTimeInArray($productId, $products) != 0)
            {
                $response = array('existed' => 'true', 'prId' => $productId, 'newQty' => ' '.(oTimeInArray($productId, $products) + 1).' x ');                                       
            }
            else 
            {
                if ($sale_price < $price)
                {
                    $response = array('existed' => 'false', 'html' => 
                        "<div class='product-widget' id='$productId'>" .
                            "<div class='product-img'>" .
                                "<img src='$linkIMG'>" .
                            "</div>" .
                            "<div class='product-body'>" .
                                "<h3 class='product-name'>" .
                                    "<a href='#'>$name</a>" .
                                "</h3>" .
                                "<h4 class='product-price'>" .
                                    "<span class='qty' id='quantity'> 1 x </span>" .
                                    "$display_sale_price<br>" .
                                        "<del class='product-old-price' style='margin-left: 33px;'>" .
                                        "$display_price" .
                                        "</del>" .	 													
                                "</h4>" .
                            "</div>" .
                            "<button class='delete' id='$productId'><i class='fa fa-close'></i></button>" .
                        "</div>"
                    );
                }
                else
                {
                    $response = array('existed' => 'false', 'html' => 
                        "<div class='product-widget' id='$productId'>" .
                            "<div class='product-img'>" .
                                "<img src='$linkIMG'>" .
                            "</div>" .
                            "<div class='product-body'>" .
                                "<h3 class='product-name'>" .
                                    "<a href='#'>$name</a>" .
                                "</h3>" .
                                "<h4 class='product-price'>" .
                                    "<span class='qty' id='quantity'> 1 x </span>" .
                                    "$display_price" .	 													
                                "</h4>" .
                            "</div>" .
                            "<button class='delete' id='$productId'><i class='fa fa-close'></i></button>" .
                        "</div>"
                    );
                }
            }
            setcookie ("guest", $cookieVal.".".$productId, time() + 172800, "/", "", 1);
        }    
    }
    echo json_encode($response);
?>