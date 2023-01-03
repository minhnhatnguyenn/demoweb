<div class = "frm_history">
    <div class = "heading">
        <table class="tbl_detail">
            <thead>
                    <tr>
                        <th>STT</th>
                        <th class = "id_th">Mã hóa đơn</th>
                        <th class = "total_th">Tổng tiền</th>
                        <th class = "crttime_th">Ngày tạo đơn</th>
                        <th class = "address_th">Địa chỉ</th>
                        <th class = "status_th">Tình trạng</th>
                        <th class = "info_th">Chi tiết</th>
                    </tr>
            </thead>
            <tbody>
                <?php
                    $sotranghienthi = 10;
                    if(!isset($_GET["trang"]))
                    {
                        $offset = 0;
                    }
                    else
                    {
                        $offset = ($_GET["trang"]-1)*$sotranghienthi;
                    }

                    $sql_select1 = "SELECT id FROM user_bill";
                    $result = $conn ->query($sql_select1); 
                    $sotrang = ceil($result->num_rows/$sotranghienthi);
                    $sql_select2 = "SELECT user_bill.id, user_bill.total, user_bill.address, user_bill.created_time, status.name FROM user_bill INNER JOIN status ON user_bill.status_id = status.id WHERE user_id = '$userId' ORDER BY created_time DESC LIMIT $sotranghienthi OFFSET $offset;";
                    $result = $conn ->query($sql_select2);
                    if($result ->num_rows>0)                   
                    {
                        $i=1;
                        while($row=$result->fetch_assoc())
                    {
                ?>
                <tr>
                    <td ><?php echo $i;?></td>
                    <td><?php echo $row["id"];?></td>
                    <td><?php echo displayPrice($row["total"]);?></td>
                    <td><?php echo $row["created_time"];?></td>
                    <td><?php echo $row["address"];?></td>
                    <td><?php echo $row["name"];?></td>
                    <td><button data-id="<?php echo $row["id"];?>" class ="ga btn btn-danger">Xem chi tiết</button></td> 
                </tr>
                <?php
                    $i =$i+1;
                }}
                ?>
                
            </tbody>
        </table>
        <div class = "page_number_h">
            <ul class = "pagination justify-content-center" id = "nb_page">
                <?php
                    $i=1;
                    while($i<=$sotrang)
                    {
                ?>
                    <li class = "page-item"><a class = "page-link" href = "index.php?nav=history&trang=<?php echo $i;?>"><?php echo $i;?></a></li>
                <?php    
                $i=$i+1;    
                } 
                ?>
            </ul>
        </div>
    </div>
<div>




 <!-- Modal -->
 <div class="modal fade" id="prdetail" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sản phẩm Đã mua</h4>
        </div> -->
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>      
    </div>
</div>