<header>
	<!-- TOP HEADER -->
	<div id="top-header">
		<div class="container">
			<ul class="header-links pull-left">
				<li><a href="#"><i class="fa fa-phone"></i>0868 197 116</a></li>
				<li><a href = "https://www.facebook.com/profile.php?id=100088740327226" target="_blank"><i class = "fa fa-facebook-square"></i>TECH5</a></li>
				<li><a href="https://www.google.com/maps/place/H%E1%BB%8Dc+vi%E1%BB%87n+Ng%C3%A2n+h%C3%A0ng/@21.0091314,105.8266192,17z/data=!3m1!4b1!4m5!3m4!1s0x3135ac800f450807:0x419a49bcd94b693a!8m2!3d21.0091264!4d105.8288132" target="_blank"><i class="fa fa-map-marker"></i>12 Chùa Bộc, Quang Trung, Đống Đa, Hà Nội</a></li>
			</ul>
			<ul class="header-links pull-right" id ="header__right">
				<li>
					<a href="#"><i class="fa fa-dollar"></i>VND</a>
				</li>
				<li class="nav__user">
					<label for="btn" id = "button__user">
						<?php
							$result = $conn -> query("SELECT `name` FROM `usr` WHERE `id`='$userId'");
							$row = $result -> fetch_assoc();
							echo $row['name'];
						?>
					</label>                   
					<ul class="menu__ngdung">
						<?php
							if ($roleId != 3){
						?>
							<li class="menu__ngdung--1">
								<a href="admin/index.php" class="menu__ngdung--2">Quản trị</a>
							</li>
							<li class="menu__ngdung--1">
								<a href="#change_psw" data-toggle="modal" class="menu__ngdung--2">Đổi mật khẩu</a>
							</li>								
						<?php
							}
							else{
						?>
							<li class="menu__ngdung--1">
								<a href="#change_user" data-toggle="modal" class="menu__ngdung--2">Thông tin tài khoản</a>
							</li>
							<li class="menu__ngdung--1">
								<a href="#change_psw" data-toggle="modal" class="menu__ngdung--2">Đổi mật khẩu</a>
							</li>
							<li class="menu__ngdung--1">
								<a href="index.php?nav=history" data-toggle="modal" class="menu__ngdung--2">Lịch sử mua hàng</a>
							</li>
						<?php
							}
						?>		
						<li class="menu__ngdung--1">							
							<a href="actions/User/Logout.php" class="menu__ngdung--2">Đăng xuất</a>
						</li>											
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /TOP HEADER -->
	
	<!-- MAIN HEADER -->
	<div id="header">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- LOGO -->
				<div class="col-md-3">
					<div class="header-logo">
						<a href="index.php" class="logo">
							<img src="img/logo.png" alt="logo">
						</a>
					</div>
				</div>
				<!-- /LOGO -->

				<!-- SEARCH BAR -->
				<div class="col-md-6">
					<div class="header-search">
						<form action="index.php?nav=search" method="POST">
							<select class="input-select" name="typeProduct">
								<option value="0" selected>Tất cả</option>
								<?php
									$result = $conn -> query("SELECT * FROM `product_type`");
									for($i = 0; $i < $result -> num_rows; $i++)
									{
										$row = $result -> fetch_assoc();
								?>
									<option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
								<?php		
									}
								?>
							</select>
							<input class="input" placeholder="Bạn đang tìm gì" name="keyword" style="width: 350px">
							<button class="search-btn" style="width: 75px; ">Search</button>
						</form>
					</div>
				</div>
				<!-- /SEARCH BAR -->

				<!-- ACCOUNT -->
				<div class="col-md-3 clearfix">
					<div class="header-ctn">
						<!-- Cart -->
						<div class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="cursor: pointer;">
								<i class="fa fa-shopping-cart"></i>
								<span>Giỏ hàng</span>
								<div class="qty">
								<?php
									$cart_detail = $conn -> query("SELECT * FROM `cart` WHERE `user_id` = '$userId'"); 
									if ($cart_detail -> num_rows == '0')
									{
										echo "0";
									}
									else 
									{
										echo $cart_detail -> num_rows;
									}
								?>
								</div>
							</a>
							<div class="cart-dropdown">
								<?php
									if ($cart_detail -> num_rows != '0')
									{
								?>
									<div class="cart-list">
										<?php
											for ($i = 0; $i < $cart_detail->num_rows; $i++)
											{
												$rows = $cart_detail -> fetch_assoc();
										?>
											<div class="product-widget" id="<?php echo $rows['product_id']?>">
												<div class="product-img">
													<img src="<?php echo getIMG($rows["product_id"]); ?>" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name">
														<a href="#">
															<?php
																echo getProductNameById($rows["product_id"],$conn);
															?>		
														</a>
													</h3>
													<h4 class="product-price">
														<span class="qty" id="quantity">
															<?php
																echo $rows["quantity"];
															?>
															x
														</span>
														<?php 
															$sale_price = getProductPrice($rows["product_id"], "sale_price", $conn);
															$price = getProductPrice($rows["product_id"], "price", $conn);
															if ($sale_price < $price)
															{
																echo displayPrice($sale_price);
														?>
																<del class="product-old-price" style="margin-left: 33px;">
																	<?php
																		echo displayPrice($price)
																	?>
																</del>
														<?php
															}
															else
															{
																echo displayPrice($price);
															}													
														?>															
													</h4>
												</div>
												<button class="delete" id="<?php echo $rows["product_id"]; ?>" onclick="deleteFromCart(this.id, 'user')"><i class="fa fa-close"></i></button>
											</div>													
										<?php
											}
										?>
									</div>
									<div class="cart-summary">
										<small><?php $sql = "SELECT sum(quantity) from `cart` where `user_id`=$userId"; $result = $conn -> query($sql); echo ($result -> fetch_array())[0]; ?> Item(s) selected</small>									 
									</div>
								<?php		
									}
									else
									{
								?>
									<div class="cart-list"></div>
									<div class="cart-summary">
										<small>0 Item(s) selected</small>
									</div>
								<?php
									}
								?>								
								<div class="cart-btns">
									<a href="javascript:checkout()">Đặt hàng  <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
						<!-- /Cart -->

						<!-- Menu Toogle -->
						<div class="menu-toggle">
							<a href="#">
								<i class="fa fa-bars"></i>
								<span>Menu</span>
							</a>
						</div>
						<!-- /Menu Toogle -->
					</div>
				</div>
				<!-- /ACCOUNT -->
			</div>
			<!-- row -->
		</div>
		<!-- container -->
	</div>
	<!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- Form change user -->
<div class="modal fade" id="change_user" role="dialog">
	<div class="modal-dialog" id = "width_modal">
	<!-- Modal content-->
		<div class="modal-content" id = "width_modal">	
			<div class="formuser">
			<button type="button" class="close" id = "btn_close_changeusr" data-dismiss="modal">&times;</button>
				<div class = "heading_user">
				<h1 class = "heading_user--hd">Hồ Sơ Của Tôi</h1>
					<div class = "hd_comment">
						Quản lý thông tin hồ sơ để bảo mật tài khoản
					</div>
				</div>
					<?php 
					$result_usr = $conn -> query("SELECT * FROM `usr` WHERE `id`='$userId'");
					$row_usr = $result_usr -> fetch_assoc();
					?>
					<hr class = "hr_user">
					<div class = "frm_user">
						<form action="actions/User/ChangeInformation.php" method ="POST">
							<div class = "frm_user__info">
								<label class = "frm_user__info--lbl">số điện thoại</label>
								<input type = "text" class="frm_user__info--input" value = "<?php echo $row_usr['id'];?>" readonly>
							</div>
							<div class = "frm_user__info">
								<label class = "frm_user__info--lbl">Họ tên</label>
								<input type="text" class = "frm_user__info--input" id = "change_name" value = "<?php echo $row_usr['name'];?>" name = "name" required = "required">
							</div>
							<div class = "frm_user__info">
								<label class = "frm_user__info--lbl">Email</label>
								<input type = "email" class = "frm_user__info--input" value = "<?php echo $row_usr['mail'];?>" name = "mail">
							</div>
							<div class = "frm_user__info">
								<label class = "frm_user__info--lbl">địa chỉ</label>
								<input type = "text" class = "frm_user__info--input" value = "<?php echo $row_usr['address'];?>" name = "address">
							</div>
							<div class = "frm_user__info">
								<button type = "submit" class = "btn--user">OK</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>		
	</div>
</div>

<!-- Form change password -->
<div class="modal fade" id="change_psw" role="dialog">
	<div class="modal-dialog" id = "width_modal_2">
		<!-- Modal content-->
		<div class="modal-content" id = "width_modal_2">
			<div class="formpassword">
				<button type="button" class="close" id = "btn_close_changepsw" data-dismiss="modal">&times;</button>
				<div class = "heading_user">
					<h1 class = "heading_user--hd">Đổi mật khẩu</h1>
					<div class = "hd_comment">
						Quản lý mật khẩu để bảo mật tài khoản
					</div>
				</div>
				<hr class = "hr_user">
				<div class = "frm_user">
					<form action="actions/User/ChangePassword.php" method ="POST" onsubmit="return check_info()">
						<div class = "frm_user__info">
							<label class = "frm_user__info--lbl">Mật khẩu cũ</label>
								<input id= "oldpsw" type = "password" class="frm_user__info--input" name="oldpsw" required = "required">
								<span class="show-btn"><i class="fa fa-eye" style="font-size:24px" onclick="showHiddenoldpsw()"></i></span>
							</div>
							<div class = "frm_user__info">
								<label class = "frm_user__info--lbl">Mật khẩu</label>
								<input id= "psw" type = "password" class="frm_user__info--input" name="newpsw" required = "required">
								<span class="show-btn"><i class="fa fa-eye" style="font-size:24px" onclick="showHidden()"></i></span>
							</div>
							<div class = "frm_user__info">
								<label class = "frm_user__info--lbl">Nhập lại mật khẩu</label>
								<input id = "repsw" type="password" class = "frm_user__info--input" name = "renewpsw" required = "required">
								<span class="show-btn"><i class="fa fa-eye" style="font-size:24px" onclick="showHiddenrepsw()"></i></span>
							</div>
							<div class = "frm_user__info">
								<button type = "submit" class = "btn--user">Lưu</button>
							</div>
						</form>
					</div>
				</div>		
			</div>		
	</div>
	</div>
</div>