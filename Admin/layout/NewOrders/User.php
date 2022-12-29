<div class="container-fluid px-4">
  <div class="card mb-4">
    <div class="card-header">
      <i class="fas fa-table me-1"></i>
      NEW ORDER
    </div>
    <div class="card-body">
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th style="text-align: center;">ID</th>
            <th style="text-align: center;">Total</th>
            <th style="text-align: center;">Time Created</th>
            <th style="text-align: center;">Payment</th>
            <th style="text-align: center;">Address</th>
            <th style="text-align: center;">Status</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = mysqli_query($conn, "SELECT * FROM `user_bill` WHERE `status_id` =1 ORDER BY `created_time` DESC");

          // 3. Hiển thị ra dữ liệu bạn vừa lấy được
          $i = 0;
          while ($row = mysqli_fetch_array($query)) {
            $i++;
          ?>
            <tr id="<?php echo $row['id']; ?>">
              <td style="text-align: center;"><?php echo $row['id']; ?></td>
              <td style="text-align: center;"><?php echo displayPrice($row['total']); ?></td>
              <td style="text-align: center;"><?php echo $row['created_time']; ?></td>
              <td style="text-align: center;">
                <?php
                if ($row['payment_mode_id'] == 1) {
                  echo "COD";
                } else {
                  echo "Chuyển khoản";
                }
                ?>
              </td>
              <td style="text-align: center;"><?php echo $row['address'] ?></td>
              <td style="text-align: center;"><?php echo $row['status_id']; ?></td>
              <td style="text-align: center;">
                <button class="btn btn-primary" id="<?php echo $row['id']; ?>" onclick="approve(this.id, 'user')">Approve</button>
              </td>
            </tr>
          <?php
          }
          // 4. Đóng lại kết nối sau khi dử dụng xong
          mysqli_close($conn);; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>