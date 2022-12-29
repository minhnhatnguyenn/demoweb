<?php
    include ("../../../conn.php");
    
    $product_type_id = $_POST['product_type_id'];
    $brand_id = $_POST['brand_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale_priceil = $_POST['sale_price'];
    $import_date = $_POST['import_date'];
    $quantity = $_POST['quantity'];
    $warranty_day = $_POST['warranty_day'];
    $detail = $_POST['detail'];

        $sql_insert = "INSERT INTO `product`(`product_type_id`, `brand_id`, `name`, `price`, `sale_price`, `import_date`, `quantity`, `warranty_day`, `detail`, `is_deleted`) 
        VALUES ('$product_type_id','$brand_id','$name','$price','$sale_priceil','$import_date','$quantity','$warranty_day','$detail','0')";    
        $result = $conn -> query($sql_insert);
?>