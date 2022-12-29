<?php
    include ("../../../conn.php");
    $id = $_POST['id'];
    $admin_product = "SELECT * FROM product WHERE id='$id' ORDER BY product.id ASC";
    // 2. Thực thi câu lệnh truy vấn (mục đích trả về dữ liệu các bạn cần)
    $query_product = mysqli_query($conn, $admin_product);

    // 3. Hiển thị ra dữ liệu bạn vừa lấy được
    $row = mysqli_fetch_array($query_product);

    if(isset($_POST['sbm'])){
        $product_type_id = $_POST['product_type_id'];
        $brand_id = $_POST['brand_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $sale_priceil = $_POST['sale_price'];
        $import_date = $_POST['import_date'];
        $quantity = $_POST['quantity'];
        $warranty_day = $_POST['warranty_day'];
        $detail = $_POST['detail'];

        $query ="UPDATE `product` SET `product_type_id`='$product_type_id',`brand_id`='$brand_id',`name`='$name',
        `price`='$price',`sale_price`='$sale_priceil',`import_date`='$import_date',`quantity`='$quantity',
        `warranty_day`='$warranty_day',`detail`='$detail' 
        WHERE id=$id";
        $query_run = mysqli_query($conn, $query);
   
        echo "
          <script type='text/javascript'>
                alert('Bạn đã sửa thành công');
                window.location.href='../../index.php?nav=products';
          </script>";         
    }
    
?>
<!-- <form method="POST" action="actions/products/edit.php" enctype="multipart/form-data">
    <input type="hidden" name="id_product" value="<?php echo $row['id'] ;?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="">Loại sản phẩm</label>
            <select name="product_type_id" requied class="form-control">
                <option value="">---Select---</option>
                <option value="1" <?php echo $row['product_type_id'] == '1' ? 'selected':'' ?> >Smartphone</option>
                <option value="2" <?php echo $row['product_type_id'] == '2' ? 'selected':'' ?> >Laptop</option>
                <option value="3" <?php echo $row['product_type_id'] == '3' ? 'selected':'' ?> >PC</option>
                <option value="4" <?php echo $row['product_type_id'] == '4' ? 'selected':'' ?> >Linh kiện PC</option>
                <option value="5" <?php echo $row['product_type_id'] == '5' ? 'selected':'' ?> >Chuột - bàn phím</option>
                <option value="6" <?php echo $row['product_type_id'] == '6' ? 'selected':'' ?> >Phụ kiện khác</option>
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="">Thương hiệu</label>
            <select name="brand_id" requied class="form-control">
                <option value="">---Select---</option>
                <option value="1" <?php echo $row['brand_id'] == '1' ? 'selected':'' ?> >Apple</option>
                <option value="2" <?php echo $row['brand_id'] == '2' ? 'selected':'' ?> >Samsung</option>
                <option value="3" <?php echo $row['brand_id'] == '3' ? 'selected':'' ?> >Asus</option>
                <option value="4" <?php echo $row['brand_id'] == '4' ? 'selected':'' ?> >Dell</option>
                <option value="5" <?php echo $row['brand_id'] == '5' ? 'selected':'' ?> >Dareu</option>
                <option value="6" <?php echo $row['brand_id'] == '6' ? 'selected':'' ?> >LG</option>
                <option value="1" <?php echo $row['brand_id'] == '7' ? 'selected':'' ?> >Cooler Master</option>
                <option value="2" <?php echo $row['brand_id'] == '8' ? 'selected':'' ?> >AMD</option>
                <option value="3" <?php echo $row['brand_id'] == '9' ? 'selected':'' ?> >Intel</option>
                <option value="4" <?php echo $row['brand_id'] == '10' ? 'selected':'' ?> >Kingstion</option>
                <option value="5" <?php echo $row['brand_id'] == '11' ? 'selected':'' ?> >JBL</option>
                <option value="6" <?php echo $row['brand_id'] == '12' ? 'selected':'' ?> >Xigmatek</option>
                <option value="1" <?php echo $row['brand_id'] == '13' ? 'selected':'' ?> >Logitech</option>
                <option value="2" <?php echo $row['brand_id'] == '14' ? 'selected':'' ?> >Sony</option>
                <option value="3" <?php echo $row['brand_id'] == '15' ? 'selected':'' ?> >MSI</option>
            </select>        
        </div>
        <div class="col-md-12 mb-3">
            <label for="">Tên sản phẩm</label>
            <input class="form-control" type="text" name="name" value="<?php echo $row['name'];?>">
        </div>
        <div class="col-md-12 mb-3">
            <label for="">Giá</label>
            <input class="form-control" type="text" name="price" value="<?php echo $row['price'];?>">
        </div>
        <div class="col-md-12 mb-3">
            <label for="">Giá sale</label>
            <input class="form-control" type="text" name="sale_price" value="<?php echo $row['sale_price'];?>">
        </div>
        <div class="col-md-12 mb-3">
            <label for="">Ngày nhập</label>
            <input class="form-control" type="date" name="import_date" value="<?php echo $row['import_date'];?>">
        </div>
        <div class="col-md-12 mb-3">
            <label for="">Số lượng</label>
            <input class="form-control" type="text" name="quantity" value="<?php echo $row['quantity'];?>">
        </div>
        <div class="col-md-12 mb-3">
            <label for="">Ngày bảo hành</label>
            <input class="form-control" type="text" name="warranty_day" value="<?php echo $row['warranty_day'];?>">
        </div>
        <div class="col-md-12 mb-3">
            <label for="">Chi tiết</label>
            <input class="form-control" type="text" name="detail" value="<?php echo $row['detail'];?>">
        </div>
        
        <div class="col-md-12 mb-3">
        <br>
            <button type="submit" name="sbm" class="btn btn-primary form-control">Cập nhật</button>
        </div>
    </div>
</form> -->