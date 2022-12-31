<?php
    include ("../../conn.php");
    $id = $_POST["get_id"];

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
?>
     
<div class = "tbl_detail">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <table class="tbl_detail">
        <thead>
            <tr>
                <th class = "name_th">Tên</th>
                <th class = "image_th">Ảnh</th>
                <th class = "quantity_th">Số lượng</th>
                <th class = "price">Giá sản phẩm</th>
            </tr>
        </thead>
        </tbody>
        <?php  
            $sql = "SELECT user_bill_detail.quantity as quantity, product.id as idprd, product.sale_price as price, product.image as image, product.name as name from user_bill_detail INNER JOIN product ON user_bill_detail.product_id = product.id WHERE bill_id = '$id'";
            $result = mysqli_query($conn, $sql);
            While ($row = mysqli_fetch_array($result)){
        ?>     
        <tr>
            <td><?php echo $row["name"];?></td>
            <td><img src="img/products/<?php echo $row["image"];?>" style = "width: 60px"></td>
            <td><?php echo $row["quantity"];?></td>
            <td><?php echo displayPrice($row["price"]);?></td>
        </tr>
        <?php 
            }
            ?>
        </tbody>
    </table>
<div>
<div class = "destroy_bill">
    <?php 
        $get_sttid = $conn -> query("SELECT status_id FROM user_bill WHERE id = '$id'");
        $sttid = $get_sttid -> fetch_assoc();
    ?>
        <form action = "actions/order/Cancel.php" method = "POST">
            <input type ="hidden" value = "<?php echo $id?>" name="id">
        <button type = "submit" id ="btncancel" class = "btn btn-danger" onclick = "return confirm('Bạn có muốn hủy đơn hàng?')">Hủy đơn hàng</button>
    </form>
</div>

<script>
        var x = <?php echo $sttid['status_id']?>;
		if(x <= 2){
            document.getElementById("btncancel").style.display="block";
        }
        else {
            document.getElementById("btncancel").style.display="none";
        }
</script>