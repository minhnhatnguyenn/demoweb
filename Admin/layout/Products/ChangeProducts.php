<?php 
    include ("../../../conn.php");
    $id = $_POST["change_prd"];
    $get_properties = $conn -> query("SELECT * FROM product where id = '$id'");
    $row = $get_properties -> fetch_assoc();
?>

<form method="POST" action="actions/products/edit.php" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="">Loại sản phẩm</label>
            <select name="product_type_id" requied class="form-control">
                <?php
                    $sql_type = $conn -> query("SELECT product_type.name as name, product_type.id as id FROM product_type INNER JOIN product ON product_type.id = product.product_type_id WHERE product.id = '$id'");          
                    $row_type= $sql_type -> fetch_assoc();
                    ?>
                    <option value = "<?php echo $row_type["id"];?>"><?php echo $row_type["name"];?></option>
               
            </select>
        </div>
        <div class = "col-md-12 mb-3">
            <label for = "">Thương hiệu</label>
            <select name = "brand_id" requied class="form-control">
                <?php
                    $sql_brand = $conn -> query("SELECT brand.id as id, brand.name FROM brand INNER JOIN product ON brand.id = product.brand_id WHERE product.id = '$id'");
                    $row_brand=$sql_brand -> fetch_assoc();
                ?> 
                    <option value="<?php echo $row_brand["id"];?>"><?php echo $row_brand["name"];?></option>
               
            </select>        
        </div>
        <div class="col-md-12 mb-3">
            <input class="form-control" type="hidden" name="id" value="<?php echo $row['id'];?>">
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
            <textarea name="detail" id="summernote" cols="30" rows="10" value="<?php echo $row['detail'];?>">"<?php echo $row['detail'];?>"</textarea>
        </div>
        
        <div class="col-md-12 mb-3">
        <br>
            <button type="submit" name="sbm" class="btn btn-primary form-control">Cập nhật</button>
        </div>
    </div>
</form>