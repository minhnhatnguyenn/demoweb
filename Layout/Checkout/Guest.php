<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Đặt hàng</h3>
				<ul class="breadcrumb-tree">
					<li><a href="index.php">Trang chủ</a></li>
					<li class="active">Đặt hàng</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
		<form action="actions/Order/Create.php" method="POST">
			<div class="col-md-7">
				<!-- Billing Details -->			
				<div class="billing-details">
					<div class="section-title">
						<h3 class="title">Địa chỉ thanh toán</h3>
					</div>
					<div class="form-group">
						<input class="input" type="text" name="name" placeholder="Tên" required = "required">
					</div>
					<div class="form-group">
						<input class="input" type="email" name="mail" placeholder="Email">
					</div>
					<div class="form-group">
						<input class="input" type="text" name="address" id ="address" placeholder="Địa chỉ">
					</div>
					<div class="form-group">
						<input class="input" type="tel" name="tel" id="tel" placeholder="Số điện thoại" required = "required">
					</div>
				</div>
				<!-- /Billing Details -->
				<!-- Order notes -->
				<div class="order-notes">
					<textarea class="input" placeholder="Ghi chú" name="note"></textarea>
				</div>
				<!-- /Order notes -->

				<!-- Shiping Details -->
				<div class = "shiping-details" style="margin-top: 20px">					
					<div class="input-checkbox">
						<input type = "checkbox" value="yes" name="shiping-address" id="shiping-address">
						<label for = "shiping-address">
							<span></span>
							Bạn muốn giao hàng tới địa chỉ khác?
						</label>
						<div class="caption">
							<div class="form-group">
								<input class="input" id='otherAddress' type="text" name="otherAddress" placeholder="Địa chỉ">
							</div>
						</div>
					</div>
				</div>
				<!-- /Shiping Details -->

			</div>

			<!-- Order Details -->
			<div class="col-md-5 order-details">
				<div class="section-title text-center">
					<h3 class="title">Đơn hàng của bạn</h3>
				</div>
				<div class="order-summary">
					<div class="order-col">
						<div>
							<strong>SẢN PHẨM</strong>
						</div>
						<div class = "fix_quantity">
							<strong>SỐ LƯỢNG</strong>
						</div>
						<div>
							<strong>GIÁ</strong>
						</div>
						<?php
                            $products = explode('.',$_COOKIE['guest']);
                            $tmp = array_count_values($products);
                            $products_uniqe = getUniqueArray($products);
							for ($i = 0; $i < count($products_uniqe); $i++)
							{
                                $temp = $conn -> query("SELECT * FROM `product` WHERE id = '$products_uniqe[$i]'");
								$product = $temp -> fetch_assoc();
						?>
					</div>
					<div class="order-products">
						<div class="order-col">												
							<div>
								<button class="delete" id="<?php echo $product["id"]; ?>" onclick="deleteFromCheckOut(this, 'guest')"><i class="fa fa-close"></i></button>
								<?php									
									echo $product["name"];
								?>
							</div>
							<div class = "fix_quantity">
								<input class = "fix_quantity--quantity" id="<?php echo $product["id"]; ?>" type="number" value = "<?php echo $tmp[$products_uniqe[$i]] ?>" min=1 max="<?php echo getQuantityProduct($product["id"], $conn) ?>">
							</div>
							<div>
                                <?php
									$gia = $tmp[$products_uniqe[$i]] * $product["sale_price"];
									echo displayPrice($gia);
									?>
							</div>
						</div>
						<?php
							}
							?>
					</div>
					<div class="order-col">
						<div>Phí giao hàng</div>
						<div><strong>Miễn phí</strong></div>
					</div>
					<div class="order-col">
						<div><strong>TỔNG TIỀN</strong></div>
						<div>
							<strong class="order-total">
								<?php
									$total = totalByGuest($conn);
									echo displayPrice($total);
								?>									
							</strong>		
							<input style="width: 100%;" value="<?php echo $total?>" type="hidden" name="total" id ="total">				
						</div>
					</div>
				</div>
				<div class="payment-method">
					<div class="input-radio">
						<input type="radio" name="payment" value=1 id="payment-1" checked="checked">
						<label for="payment-1">
							<span></span>
							Thanh toán tiền mặt
						</label>
						<div class="caption">
						</div>
					</div>
					<div class="input-radio">
						<input type="radio" name="payment" value=2 id="payment-2">
						<label for="payment-2">
							<span></span>
							Thanh toán chuyển khoản
						</label>
						<div class="caption">
							<div class ="info_ck">
								<div class = "info_ck--p">
									<div>
										Tên chủ tài khoản
									</div>
									<div>
										Trần An Bình
									</div>
								</div>
								<div class = "info_ck--p">
									<div>
										Số tài khoản
									</div>
									<div>
										19036750603012
									</div>
								</div>
								<div class = "info_ck--p">
									<div>
										Ngân hàng
									</div>
									<div>
										Techcombank
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="submit" onclick ="return checkpayment()" id="btn_payment" class="primary-btn order-submit">Đặt hàng</button>
			</div>
			<!-- /Order Details -->
		</form>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->