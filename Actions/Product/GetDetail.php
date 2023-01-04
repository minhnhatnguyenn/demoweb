<?php
    include ('../../conn.php');
    $productid = $_POST['get_id'];
    
    $sql_select = "select * from product where id=".$productid;
    $result = $conn -> query($sql_select);
    $sql_select_brand = "SELECT name, origin FROM brand WHERE id = (SELECT brand_id FROM product WHERE id = $productid);";
    $result_brand = $conn -> query($sql_select_brand);
    $parameter = $conn -> query("SELECT detail FROM product WHERE id = '$productid'");
    $get_parameter = $parameter -> fetch_assoc();
    $temp = explode('\n',$get_parameter['detail']);
    while ($row_brand = mysqli_fetch_array($result_brand))
    {
    while ($rows = mysqli_fetch_array($result))
    {
?>
    <div class = "detai_product_img">
         <img src = "img/products/<?php echo $rows['image']?>" alt = "img_product">    
    </div>
    <div class ="detail_product_info">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p><strong>Tên sản phẩm: </strong> <?php echo $rows['name']?></p>
       <p><strong>Thông số chi tiết: </strong> <?php echo $rows['detail']?></p>
       <p><strong>Bảo hành: </strong> <?php echo $rows['warranty_day']/30?> tháng</p>
       <p><strong>Ngày sản xuất: </strong> <?php echo $rows['import_date']?> </p>
       <p><strong>Hãng sản xuất: </strong> <?php echo $row_brand['name']?> </p>
       <p><strong>Nước sản xuất: </strong> <?php echo $row_brand['origin']?> </p>
    </div>
<?php
     }
     }
?>