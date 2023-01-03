<!-- HEADER -->
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
				<li><a href="#"><i class="fa fa-dollar"></i> VND</a></li>
				<li><a href="#modalRegister" class="trigger-btn" data-toggle="modal">Đăng ký</a></li>
				<li><a href="#modalLogin" class="trigger-btn" data-toggle="modal">Đăng nhập</a></li>
			</ul>
		</div>
	</div>
	<!-- Right -->
	<div id="modalLogin" class="modal fade">
		<div class="modal-dialog modal-login">
			<div class="modal-content">
				<div class="modal-header">
					<div class="avatar">
						<img src="img/avatar.png" alt="Avatar">
					</div>				
					<h4 class="modal-title">Đăng nhập</h4>	
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form action="actions/User/Login.php" method="POST">
						<div class="form-group">
							<input type="text" class="form-control" name="phonenumber" placeholder="Số điện thoại" required="required">		
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Mật khẩu" required="required">	
						</div>        
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-lg btn-block login-btn">OK</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<a href="#">Bạn quên mật khẩu ?</a>
				</div>
			</div>
		</div>
	</div>   

	<div id="modalRegister" class="modal fade">
		<div class="modal-dialog modal-login">
			<div class="modal-content">
				<div class="modal-header">
					<div class="avatar">
						<img src="img/avatar.png" alt="Avatar">
					</div>				
					<h4 class="modal-title">Đăng ký</h4>	
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form action="actions/User/Register.php" method="POST" onsubmit="return check_psw()">
						<div class="form-group">
							<input type="text" class="form-control" name="hoten" placeholder = "Họ tên" required = "required">		
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="phonenumber" placeholder = "Số điện thoại" required = "required">		
						</div>
						<div class="form-group">
							<input type="password" id = "psw_register" class="form-control" name = "password" placeholder = "Mật khẩu" required = "required">	
						</div>    
						<div class="form-group">
							<input type="password" id = "re_psw_register" class="form-control" name = "re-password" placeholder = "Nhập lại mật khẩu" required = "required">	
						</div>        
						<div class="form-group">
							<button id = "btn_dk--ok" type="submit" class="btn btn-primary btn-lg btn-block login-btn">OK</button>
						</div>
					</form>
				</div>
			</div>
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
							<img src="img/logo.png" title="TECH5" alt="logo">
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
										if (!isset($_COOKIE['guest']))
										{
											echo "0";
										}
										else 
										{
											$products = explode('.',$_COOKIE['guest']);
											$products_unique = getUniqueArray($products);
											echo count($products_unique);
										}
									?>
								</div>
							</a>
							<div class="cart-dropdown">
								<div class="cart-list">
								<?php
									if (isset($_COOKIE['guest']))
									{
										$products = explode('.',$_COOKIE['guest']);
										$tmp = array_count_values($products);
										$products_unique = getUniqueArray($products);										
										for ($i = 0; $i < count($products_unique); $i++)
										{
											$count = $tmp[$products_unique[$i]];
											$temp = $conn -> query("SELECT * FROM `product` WHERE `id` = '$products_unique[$i]'");
											$product = $temp -> fetch_assoc();										
								?>
									<div class="product-widget" id="<?php echo $product['id']?>">
										<div class="product-img">
											<img src="<?php echo getIMG($product["id"]); ?>" alt="">
										</div>
										<div class="product-body">
											<h3 class="product-name">
												<a href="#">
													<?php
														echo $product["name"];
													?>		
												</a>
											</h3>
											<h4 class="product-price">
												<span class="qty" id="quantity">
													<?php
														echo $count;
													?>
													x
												</span>
												<?php 
													if ($product["sale_price"] < $product["price"])
													{
														echo displayPrice($product["sale_price"]);
												?>
														<del class="product-old-price" style="margin-left: 33px;">
															<?php
																echo displayPrice($product["price"])
															?>
														</del>
												<?php
													}
													else
													{
														echo displayPrice($product["price"]);
													}													
												?>															
											</h4>
										</div>
										<button class="delete" id="<?php echo $product["id"]; ?>" onclick="deleteFromCart(this.id, 'guest')"><i class="fa fa-close"></i></button>
									</div>
								<?php
										}
									}
								?>
								</div>
								<div class="cart-summary">
									<small>
									<?php
										if (!isset($_COOKIE['guest']))
										{
											echo "0 Item(s) selected";
										}
										else
										{
											$products = explode('.',$_COOKIE['guest']);
											echo count($products)." Item(s) selected";										
										}
									?>									
									</small>
								</div>
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


