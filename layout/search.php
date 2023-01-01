<div class = "show_product_lookingfor">
<?php
    $keyword = $_POST["keyword"];
    $productType = $_POST["typeProduct"];
    if ($productType == "0")
    {
        $result = $conn -> query ("SELECT * FROM `product` WHERE `name` LIKE '%".$keyword."%'");        
    }
    else
    {
        $result = $conn -> query ("SELECT * FROM `product` WHERE `product_type_id` = $productType AND `name` LIKE '%".$keyword."%'");
    }
?>


<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">TÌM KIẾM</h3>
                <ul class="breadcrumb-tree">
                    <?php
                        if ($result -> num_rows == 0)
                        {
                    ?>
                        <li class="active"> Không tìm thấy</li>
                    <?php        
                        }
                        else
                        {
                    ?>
                        <li class="active"> Từ khoá: "<?php echo $keyword; ?>"</li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
    if ($result -> num_rows != 0)
    {
        for ($i = 0; $i < $result -> num_rows; $i++)
        {
            $product = $result -> fetch_assoc();
?>
            <div class="col-md-3" id = "product_show_lookingfor">
                <div class="product" id = "set_product">
                    <div class="product-img" class= "div__img">
                        <img src="<?php echo getIMG($product["id"]); ?>" alt="" class="infoproduct" data-id="<?php echo $product["id"];?>">
                    </div>
                    <div class="product-body" id = "product_body_lookingfor">
                        <h3 class="product-name">
                            <a href="#" class="infoproduct" data-id="<?php echo $product["id"];?>">
                                <?php 
                                    echo $product["name"]; 
                                ?>
                            </a>
                        </h3>
                        <h4 class="product-price" id = "product_price_lookingfor">
                            <?php 
                                echo displayPrice($product["sale_price"]);
                            ?>	
                            <br>		
                            <del class="product-old-price">
                                <?php
                                    echo displayPrice($product["price"]);
                                ?>
                            </del>
                        </h4>
                    </div>
                    <div class="add-to-cart">
                        <button class="add-to-cart-btn" id="<?php echo $product['id']; ?>">add to cart</button>
                    </div>
                </div>		
            </div>
<?php
        }
    }
?>

<div>



<!-- Modal detail product -->
<div class="modal fade" id="product_detail" role="dialog">
    <div class="modal-dialog" id = "detai_product_main">
    
      <!-- Modal content-->
      <div class="modal-content" id = "detai_product_main">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sản phẩm Đã mua</h4>
        </div> -->
        <div class="modal-body--detail">
          <p>Some text in the modal.</p>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
      
    </div>
  </div>