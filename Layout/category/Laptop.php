<?php
	$begin = 0;
	$sortBy = "ASC";
	$sortName = "name";
	
	if (isset($_GET['sort']))
	{
		if ($_GET['sort'] == 'za')
		{
			$sortBy = "DESC";
		}
		else if ($_GET['sort'] == 'maxmin')
		{
			$sortName = "sale_price";
			$sortBy = "DESC";
		}
		else if ($_GET['sort'] == 'minmax')
		{
			$sortName = "sale_price";
			$sortBy = "ASC";
		}
	}
	if (isset($_GET['page']))
	{
		$page = $_GET['page'];		
		if ($page > 0)
		{
			$begin = ($page * 20) -20;
		}
	}
	$query = "SELECT * FROM `product` WHERE `product_type_id` = 2
		ORDER BY $sortName $sortBy LIMIT $begin, 20";
	$laptop = mysqli_query($conn, $query);	
?>
<style>
/*product*/
	.product{
		position: relative;
 		margin: 15px 5px;
  		-webkit-box-shadow: 0px 0px 0px 0px #E4E7ED, 0px 0px 0px 1px #E4E7ED;
  		box-shadow: 0px 0px 0px 0px #E4E7ED, 0px 0px 0px 1px #E4E7ED;
  		-webkit-transition: 0.2s all;
  		transition: 0.2s all;
	}
	.product .product-img {
  		position: relative;
		height: 200px;
	}
	section#content {
     	min-height: 600px;
     	padding-top: 40px;
     	text-align: left;
     	background: #f5f5f5;
 	}
/*product*/
/*sort by */
	.sort{
		display: flex;
		float: right;
	}
	.sort ul{
		display: flex;
		padding: 0;
		margin: 0;
		list-style: none;
		float: right;
		justify-content: center;
		align-items: center;
	}
	.sort ul h5{
		float: left;
		margin: 10px;
	}
	.sort .sort-bar{
		margin: none;
		padding: none;
	}
	.sort .sort-bar select{
		background-color:#e0e0e0;
		padding: 6px 15px;
		color: #000;
		border: none;
		font-weight: bold;
	}
	.sort .sort-bar option{
		background-color:#fff;
		color: #000;
		border: none;
	}

/*sort by */
/*FILTER*/
	.filter-group {
		background-color: #fff;
	}
	.card {
		position: relative;
		display: flex;
		flex-direction: column;
		min-width: 0;
		width: 100%;
		word-wrap: break-word;
		background-color: #fff;
		background-clip: border-box;
		margin-top:30px;
	}
	.tittle{
		display: flex;
		justify-content: center;
		align-items: center;
		border: 1px solid #ededed;
		font-weight: bold;
		margin: 10px 10px 10px 0;
		width: 100%;
		background-color: #D10024;
		color: #fff;
	}
	.card-header {
		padding: 0.75rem 1.25rem;
		margin-bottom: 0;
		background-color: #fff;
		width: 200px;
	}
	.card-body {
		display: flex;
		justify-content: center;
		margin-top: 20px;
	}
	.filter-group .card-header {
		border-bottom: 0;
		width: 100%;
		border-bottom: 1px solid #D10024;

	}
	.custom-control {
		display: block;
		line-height: 30px
	}
	.ahihi{
		margin: 10px;
	}
	.form-control{
		width: 100%;
	}
	.price-filter{
		width: 100%;
	}
/*FILTER*/
/*PHÂN TRANG */
	ul.list_trang{
		display: flex;
		padding: 0;
		margin: 0;
		list-style: none;
		float: right;
		justify-content: center;
		align-items: center;

	}
	ul.list_trang h5{
		float: left;
		margin: 10px;
	}
	ul.list_trang li{
		float: left;
		padding: 5px 13px;
		margin: 5px;
		background-color: #D10024;
		display: block;
	}
	ul.list_trang li a{
		color: #fff;
		text-align: center;
		text-decoration:none;
	}
/*PHÂN TRANG */
</style>
<!-- NAVIGATION -->
<nav id="navigation">
	<!-- container -->
	<div class="container">
		<!-- responsive-nav -->
		<div id="responsive-nav">
			<!-- NAV -->
			<ul class="main-nav nav navbar-nav">
				<li class="dropdown">
					<a href="index.php">HOME</a>
				</li>
				<li class="active">
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
<!-- shop -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-2" >
						<!--FILTER-->
							<div class="row d-flex justify-content-center">
								<div class="">
									<div class="card">
										<article class="filter-group">
											<header class="card-header"> 
													<h5 class="title">HÃNG</h5>
											</header>
											<div class="card-body"> 
 												<ul>
													 <li>
													 <label class="ahihi">
													 	<input type="checkbox" id="dell">
  														<label for="1"> Dell</label>
													</label>
													<label class="ahihi">
													 	<input type="checkbox" id="apple">
  														<label for="2"> Apple</label>
													</label>				
													</li>
													<li>
													 <label class="ahihi">
													 	<input type="checkbox" id="asus">
  														<label for="3"> Asus</label>
													</label>			
													</li>		
												</ul>
											</div>
										</article>
										<article class="filter-group">
											<header class="card-header"> 
													<h5 class="title">GIÁ </h5>
											</header>
											<div>
												<div class="form-row">
													<div class="form-group col-md-12"> Min (VNĐ) <input class="form-control" placeholder="0" type="number"> </div>
													<div class="form-group col-md-12"> Max (VNĐ)<input class="form-control" placeholder="100.0000.000 VNĐ" type="number"> </div>
												</div> 
												<a href="#" class="btn btn-danger price-filter" data-abc="true">Apply Now</a>
											</div>
										</article>
									</div>
								</div>
							</div>
						<!--FILTER-->
					</div>
					<div class="col-md-10" >
						<!--Sortby-->
						<div class="col-md-12">
							<div class="sort">
								<ul>
									<li>
										<div class="sort-bar">
											<select onchange="sortBy(this, '<?php echo $_GET['nav']; ?>')">
											<?php
												if (!isset($_GET['sort']) || $_GET['sort'] == 'az')
												{
											?>
												<option value="az" selected>A -> Z</option>
												<option value="za">Z -> A</option>
												<option value="maxmin">Giá Cao -> Thấp</option>
												<option value="minmax">Giá Thấp -> Cao</option>
											<?php
												}
												if ($_GET['sort'] == 'za')
												{
											?>
												<option value="az">A -> Z</option>
												<option value="za" selected>Z -> A</option>
												<option value="maxmin">Giá Cao -> Thấp</option>
												<option value="minmax">Giá Thấp -> Cao</option>
											<?php
												}
											?>
											<?php												
												if ($_GET['sort'] == 'maxmin')
												{
											?>
												<option value="az">A -> Z</option>
												<option value="za">Z -> A</option>
												<option value="maxmin" selected>Giá Cao -> Thấp</option>
												<option value="minmax">Giá Thấp -> Cao</option>
											<?php
												}
											?>
											<?php
												if ($_GET['sort'] == 'minmax')
												{
											?>
												<option value="az">A -> Z</option>
												<option value="za">Z -> A</option>
												<option value="maxmin">Giá Cao -> Thấp</option>
												<option value="minmax" selected>Giá Thấp -> Cao</option>
											<?php
												}
											?>
											</select>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<!--Sortby-->
						<?php
							while ($rows = mysqli_fetch_array($laptop)) {
						?>
						<!-- product -->
						<div class="col-md-3">
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
						</div>
						<!-- /product -->
						<?php } ?>
						<!--/PHANTRANG-->
						<div style="clear:both;"></div>
						<?php
							$sql_trang = mysqli_query($conn,"SELECT * FROM product WHERE product.product_type_id=2");
							$row_count = mysqli_num_rows($sql_trang);
							$trang = ceil($row_count/20);
						?>
						<ul class="list_trang">
							<h5>Trang:</h5>
							<?php
								if (isset($_GET['sort']))
								{
									$sort = $_GET['sort'];
									for($i = 1; $i <= $trang; $i++)
									{																
							?>
								<li>
									<a href="index.php?nav=laptop&sort=<?php echo $sort ?>&page=<?php echo $i ?>"><?php echo $i ?></a>
								</li>
							<?php 
									}
								}
								else
								{
									for($i = 1; $i <= $trang; $i++)
									{
							?>
								<li>
									<a href="index.php?nav=laptop&&page=<?php echo $i ?>"><?php echo $i ?></a>
								</li>
							<?php
									}
								}
							?>
						</ul>		
						<!--/PHANTRANG-->				
					</div>
				</div>
			</div>	
		</div>
		<!-- /row -->
	</div>
	<!-- container -->
</div>
<!--SHOP-->

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