<!-- NAVIGATION -->
<nav id="navigation">
	<!-- container -->
	<div class="container">
		<!-- responsive-nav -->
		<div id="responsive-nav">
			<!-- NAV -->
			<ul class="main-nav nav navbar-nav">
				<li class="active">
					<a href="index.php">HOME</a>
				</li>
				<li class="dropdown">
					<a href="index.php?nav=laptop">LAPTOP</a>
				</li>
				<li class="dropdown">
					<a href="index.php?nav=pc">PC</a>
				</li>
				<li class="dropdown">
					<a href="index.php?nav=accessories">LINH KIỆN PC</a>
				</li>
				<li class="dropdown">
					<a href="index.php?nav=smartphone">SMARTPHONES</a>
				</li>
				<li class="dropdown">
					<a href="index.php?nav=gear">CHUỘT - BÀN PHÍM</a>
				</li>
				<li class="dropdown">
					<a href="index.php?nav=other">PHỤ KIỆN KHÁC</a>
				</li>
			</ul>
			<!-- /NAV -->
		</div>
		<!-- /responsive-nav -->
	</div>
	<!-- /container -->		
</nav>
<!-- /NAVIGATION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">KHUYẾN MÃI HOT</h3>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab1" class="tab-pane active">
							<div class="products-slick" data-nav="#slick-nav-1">
								<!-- product -->
								<?php
									$sql = "SELECT * FROM `product` WHERE (`price`-`sale_price`) > 0";
									$result = $conn -> query($sql);
									for($i = 0; $i < $result->num_rows ;$i++)
									{
										$rows = $result -> fetch_assoc();
								?>
								<div class="product">
									<div class="product-img">
										<img src="<?php echo getIMG($rows["id"]); ?>" alt="" class="infoproduct" data-id="<?php echo $rows["id"];?>">
									</div>
									<div class="product-body">
										<p class="product-category">
											<?php 
												echo getCategoryName($rows["product_type_id"], $conn) 
											?>
										</p>
										<h3 class="product-name">
											<a href="#" class="infoproduct" data-id="<?php echo $rows["id"];?>">
												<?php 
													echo $rows["name"]; 
												?>
											</a>
										</h3>
										<h4 class="product-price">
											<?php 
												echo displayPrice($rows["sale_price"]);
											?>	
											<br>		
											<del class="product-old-price">
												<?php
													echo displayPrice($rows["price"]);
												?>
											</del>
										</h4>
										
									</div>
									<div class="add-to-cart">
										<button class="add-to-cart-btn" id="<?php echo $rows['id']; ?>">add to cart</button>
									</div>
								</div>
								<?php 
									} 
								?>
								<!-- /product -->	
							</div>
							<div id="slick-nav-1" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- /Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->	

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">SẢN PHẨM BÁN CHẠY</h3>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab2" class="tab-pane fade in active">
							<div class="products-slick" data-nav="#slick-nav-2">
								<!-- product -->
								<?php
									$result = $conn -> query("SELECT product_id, sum(quantity) from user_bill_detail GROUP BY product_id HAVING sum(quantity) >=20;");
									for($i = 0; $i < $result->num_rows ;$i++)
									{
										$product = $result -> fetch_array();
										$product_query = $conn -> query("SELECT * FROM `product` WHERE id = $product[0]");
										$rows = $product_query -> fetch_assoc();
								?>
								<div class="product">
									<div class="product-img">
										<img src="<?php echo getIMG($rows["id"]); ?>" alt="" class="infoproduct" data-id="<?php echo $rows["id"];?>">
									</div>
									<div class="product-body">
										<p class="product-category">
											<?php 
												echo getCategoryName($rows["product_type_id"], $conn) 
											?>
										</p>
										<h3 class="product-name">
											<a href="#" class="infoproduct" data-id="<?php echo $rows["id"];?>">
												<?php 
													echo $rows["name"]; 
												?>
											</a>
										</h3>
										<h4 class="product-price">
										<?php
											if (($rows["price"] - $rows["sale_price"]) > 0)
											{
										?>
												<h4 class="product-price">
													<?php 
														echo displayPrice($rows["sale_price"])
													?>	
													<br>		
													<del class="product-old-price">
														<?php
															echo displayPrice($rows["price"])
														?>
													</del>
												</h4>
										<?php
											}
											else
											{
										?>	
												<h4 class="product-price">
													<?php
														echo displayPrice($rows["price"])
													?>
													<br>
													<del class="product-old-price">

													</del>
												</h4>
										<?php
											}
										?>
										</h4>
										
									</div>
									<div class="add-to-cart">
										<button class="add-to-cart-btn" id="<?php echo $rows['id']; ?>">add to cart</button>
									</div>
								</div>
								<?php 
									} 
								?>
								<!-- /product -->
							</div>
							<div id="slick-nav-2" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- /Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->		

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">SẢN PHẨM MỚI</h3>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab2" class="tab-pane fade in active">
							<div class="products-slick" data-nav="#slick-nav-3">
								<!-- product -->
								<?php
									$sql = "SELECT * FROM `product` WHERE DATEDIFF(CURRENT_DATE,`import_date`)<=31";
									$result = $conn -> query($sql);
									for ($i = 0; $i < $result->num_rows; $i++)
									{
										$rows = $result -> fetch_assoc();	
								?>
										<div class="product">
											<div class="product-img">
												<img src="<?php echo getIMG($rows["id"]); ?>" alt="" class="infoproduct" data-id="<?php echo $rows["id"];?>">
											</div>
											<div class="product-body">
												<p class="product-category">
													<?php 
														echo getCategoryName($rows["product_type_id"], $conn) 
													?>
												</p>
												<h3 class="product-name">
													<a href="#" class="infoproduct" data-id="<?php echo $rows["id"];?>">
														<?php 
															echo $rows["name"]; 
														?>
													</a>
												</h3>
												<?php
													if (($rows["price"] - $rows["sale_price"]) > 0)
													{
												?>
														<h4 class="product-price">
															<?php 
																echo displayPrice($rows["sale_price"])
															?>	
															<br>		
															<del class="product-old-price">
																<?php
																	echo displayPrice($rows["price"])
																?>
															</del>
														</h4>
												<?php
													}
													else
													{
												?>	
														<h4 class="product-price">
															<?php
																echo displayPrice($rows["price"])
															?>
															<br>
															<del class="product-old-price">

															</del>
														</h4>
												<?php
													}
												?>
												
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn" id="<?php echo $rows['id']; ?>">add to cart</button>
											</div>
										</div>
								<?php
									}
								?>						
								<!-- /product -->										
							</div>
							<div id="slick-nav-3" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- /Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">PHỤ KIỆN GIÁ RẺ</h3>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab2" class="tab-pane fade in active">
							<div class="products-slick" data-nav="#slick-nav-4">
								<!-- product -->
								<?php
									$sql = "SELECT * FROM `product` WHERE `product_type_id` = 6 AND (`price` - `sale_price`) > 0 ";
									$result = $conn -> query($sql);
									for ($i = 0; $i < $result -> num_rows; $i++)
									{
										$rows = $result -> fetch_assoc();
								?>
										<div class="product">
											<div class="product-img">
												<img src="<?php echo getIMG($rows["id"]); ?>" alt="" class="infoproduct" data-id="<?php echo $rows["id"];?>">
											</div>
											<div class="product-body">
												<h3 class="product-name">
													<a href="#" class="infoproduct" data-id="<?php echo $rows["id"];?>">
														<?php 
															echo $rows["name"]; 
														?>
													</a>
												</h3>
												<h4 class="product-price">
													<?php 
														echo displayPrice($rows["sale_price"]);
													?>	
													<br>		
													<del class="product-old-price">
														<?php
															echo displayPrice($rows["price"]);
														?>
													</del>
												</h4>
											
											</div>
											<div class="add-to-cart">
											<button class="add-to-cart-btn" id="<?php echo $rows['id']; ?>">add to cart</button>
											</div>	
										</div>					
								<?php
									}
								?>															
								<!-- /product -->	
							</div>
							<div id="slick-nav-4" class="products-slick-nav"></div>	
						</div>						
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- /Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->



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