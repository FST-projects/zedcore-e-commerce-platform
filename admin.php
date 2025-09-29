<?php
session_start();
include "Process/connection.php";
if (isset($_SESSION["admin"])) {

	$adminDetails_rs = Database::search("SELECT * FROM `admin` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "'");

	$adminDetails = $adminDetails_rs->fetch_assoc();

	if (!empty($adminDetails['img'])) {
		$img = $adminDetails['img'];
	} else {
		if ($adminDetails["gender_gender_id"] == 1) {
			$img = "profilepic/default/male.png";
		} else {
			$img = "profilepic/default/female.png";
		}
	}


?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Boxicons -->
		<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
		<link href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
		<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
		<!-- My CSS -->

		<link rel="stylesheet" href="Styles/admin.css">
		<link rel="icon" href="resourses/logotop.svg" />
		<link rel="stylesheet" href="Styles/style.css">


		<title>Zedcore | Admin Panel</title>
	</head>

	<body onload="dashOrders(1);">

		<?php
		include "loading.php";
		?>

		<!-- SIDEBAR -->
		<section id="sidebar">
			<a href="#" class="brand">
				<img src="resourses/logotop.svg" style="width: 35px; margin-left: 15px; margin-right: 15px;" alt="">
				<span class="text">Zedcore</span>
			</a>
			<ul class="side-menu top">
				<?php
				$adminlogged_rs = Database::search("SELECT * FROM `admin` INNER JOIN `admin_cat` ON `admin`.`admin_email`=`admin_cat`.`admin_email` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "'");
				for ($i = 0; $i < $adminlogged_rs->num_rows; $i++) {
					$adminlogged = $adminlogged_rs->fetch_assoc();

					if ($adminlogged["cat_id"] == 1) {
				?>
						<li <?php if ($i == 0) { ?>class="active" <?php }; ?> onclick="dashToggle();" id="dashboardbtn">
							<a href="#">
								<i class='bx bxs-dashboard'></i>
								<span class="text">Dashboard</span>
							</a>
						</li>
					<?php
					} else if ($adminlogged["cat_id"] == 2) {

					?>
						<li <?php if ($i == 0) { ?>class="active" <?php }; ?> onclick="productToggle();">
							<a href="#">
								<i class='bx bxs-shopping-bag-alt'></i>
								<span class="text">Manage Products</span>
							</a>
						</li>
					<?php
					} else if ($adminlogged["cat_id"] == 8) {
					?>
						<li <?php if ($i == 0) { ?>class="active" <?php }; ?> onclick="orderToggle();">
							<a href="#">
								<i class='bx bxs-doughnut-chart'></i>
								<span class="text">Orders</span>
							</a>
						</li>
					<?php
					} else if ($adminlogged["cat_id"] == 3) {

					?>
						<li <?php if ($i == 0) { ?>class="active" <?php }; ?> onclick="historyToggle();">
							<a href="#">
								<i class='bx bx-history'></i>
								<span class="text">Selling History</span>
							</a>
						</li>
					<?php

					} else if ($adminlogged["cat_id"] == 4) {

					?>
						<li <?php if ($i == 0) { ?>class="active" <?php }; ?> onclick="chatToggle();">
							<a href="#">
								<i class='bx bxs-message-dots'></i>
								<span class="text">Chats</span>
							</a>
						</li>
					<?php


					} else if ($adminlogged["cat_id"] == 5) {

					?>
						<li <?php if ($i == 0) { ?>class="active" <?php }; ?> onclick="userToggle();" id="usersbtn">
							<a href="#">
								<i class='bx bxs-group'></i>
								<span class="text">Manage Users</span>
							</a>
						</li>
					<?php

					} else if ($adminlogged["cat_id"] == 6) {

					?>
						<li <?php if ($i == 0) { ?>class="active" <?php }; ?> onclick="sellerToggle();" id="shopbtn">
							<a href="#">
								<i class='bx bxs-store-alt'></i>
								<span class="text">Manage Shops</span>
							</a>
						</li>
					<?php

					} else if ($adminlogged["cat_id"] == 7) {

					?>
						<li <?php if ($i == 0) { ?>class="active" <?php }; ?> onclick="adminToggle();" id="adminbtn">
							<a href="#">
								<i class='bx bxs-group'></i>
								<span class="text">Manage Admins</span>
							</a>
						</li>
					<?php

					} else if ($adminlogged["cat_id"] == 9) {

					?>
						<li <?php if ($i == 0) { ?>class="active" <?php }; ?> onclick="homeToggle();" id="homebtn">
							<a href="#">
								<i class='bx bx-home'></i>
								<span class="text">Manage Home Content</span>
							</a>
						</li>
				<?php
					}
				}
				?>









				<li onclick="reportToggle();" id="reportbtn">
					<a href="#">
						<i class='bx bx-copy-alt'></i>
						<span class="text">Reports</span>
					</a>
				</li>
			</ul>
			<ul class="side-menu">

				<li onclick="logoutAdmin();">
					<a href="#" class="logout">
						<i class='bx bxs-log-out-circle'></i>
						<span class="text">Logout</span>
					</a>
				</li>
			</ul>
		</section>
		<!-- SIDEBAR -->



		<!-- CONTENT -->
		<section id="content">
			<!-- NAVBAR -->
			<nav>
				<i class='bx bx-menu'></i>

				<div style="position: absolute; display: flex; align-items: center; right: 10px;">
					<div style="display: flex; margin-left: 25px; align-items: center; cursor: pointer;" onclick="profileModal();">
						<span id="profFname"><?php echo $adminDetails["fname"]; ?></span>
						<a class="profile" style="margin-left: 15px;">
							<img src="<?php echo $img; ?>" id="profilepic">
						</a>
					</div>

				</div>

			</nav>
			<!-- NAVBAR -->
			<?php

			$today = date("Y-m-d");
			$thismonth = date("m");
			$thisyear = date("Y");

			$a = "0";
			$b = "0";
			$c = "0";
			$e = "0";
			$f = "0";
			$t = "0";

			$new_orders_rs = Database::search("SELECT * FROM `invoice` WHERE `status` = '0'");
			$new_order_num = $new_orders_rs->num_rows;

			$total_orders_rs = Database::search("SELECT * FROM `invoice`");
			$total_orders_num = $total_orders_rs->num_rows;

			$total_shop_rs = Database::search("SELECT * FROM `shop`");
			$total_shop = $total_shop_rs->num_rows;

			$active_user_rs = Database::search("SELECT * FROM `user` WHERE `status_status_id` = '1'");
			$active_user = $active_user_rs->num_rows;

			$active_admin_rs = Database::search("SELECT * FROM `admin` WHERE `status` = '1'");
			$active_admin = $active_admin_rs->num_rows;

			$total_products = Database::search("SELECT * FROM `product`");
			$total_product_num = $total_products->num_rows;

			$invoice_rs = Database::search("SELECT * FROM `invoice`");
			$invoice_num = $invoice_rs->num_rows;

			for ($x = 0; $x < $invoice_num; $x++) {
				$invoice_data = $invoice_rs->fetch_assoc();
				$product = Database::search("SELECT * FROM `product` WHERE `product`.`id` = '" . $invoice_data["p_invoice_id"] . "'");
				$product = $product->fetch_assoc();
				$income = ((int)$product["price"] * (int)$invoice_data["in_qty"]) * 5 / 100;

				$f = $f + $invoice_data["in_qty"];
				$t = $t + $income;

				$d = $invoice_data["date"];
				$splitdate = explode(" ", $d);
				$pdate = $splitdate["0"];

				if ($pdate == $today) {
					$a = $a + $income;
					$c = $c + $invoice_data["in_qty"];
				}
				$splitMonth = explode("-", $pdate);
				$pyear = $splitMonth["0"];
				$pmonth = $splitMonth["1"];

				if ($pyear == $thisyear) {
					if ($pmonth == $thismonth) {
						$b = $b + $income;
						$e = $e + $invoice_data["in_qty"];
					}
				}
			}
			?>


			<!-- MAIN -->
			<main id="Dashboard" class="d-none">
				<div class="head-title">
					<div class="left">
						<h1 class="fred">Dashboard</h1>
						<ul class="breadcrumb">
							<li>
								<a href="#">Dashboard</a>
							</li>
							<li><i class='bx bx-chevron-right'></i></li>
							<li>
								<a class="active" href="#">Home</a>
							</li>
						</ul>
					</div>
				</div>

				<ul class="box-info">
					<li>
						<i class='bx bxs-calendar-check'></i>
						<span class="text">
							<h3 class="fred"><?php echo $new_order_num ?></h3>
							<p class="fred">New Orders</p>
						</span>
					</li>
					<li>
						<i class='bx bxs-group'></i>
						<span class="text">
							<h3 class="fred" id="activeUsers"><?php echo $active_user ?></h3>
							<p class="fred">Active Users</p>
						</span>
					</li>
					<li>
						<i class='bx bxs-calendar'></i>
						<span class="text">
							<h3 class="fred"><?php echo $e ?></h3>
							<p class="fred">Monthly Sales</p>
						</span>
					</li>
					<li>
						<i class='bx bxs-calendar-event'></i>
						<span class="text">
							<h3 class="fred"><?php echo $c ?></h3>
							<p class="fred">Daily Sales</p>
						</span>
					</li>
				</ul>
				<ul class="box-info">
					<li>
						<i class='bx bx-dollar-circle'></i>
						<span class="text">
							<h3 class="fred">LKR <?php echo $b ?>.00</h3>
							<p class="fred">Monthly Earnings</p>
						</span>
					</li>
					<li>
						<i class='bx bx-dollar-circle'></i>
						<span class="text">
							<h3 class="fred">LKR <?php echo $a ?>.00</h3>
							<p class="fred">Daily Earnings</p>
						</span>
					</li>
				</ul>
				<ul class="box-info" style="display: block;">
					<li style="margin-bottom: 20px;">
						<i class='bx bx-line-chart'></i>
						<span class="text">
							<h3 class="fred"><?php echo $f ?></h3>
							<p class="fred">Total Sales</p>
						</span>
					</li>
					<li>
						<i class='bx bxs-dollar-circle'></i>
						<span class="text">
							<h3 class="fred">LKR <?php echo $t ?>.00</h3>
							<p class="fred">Total Earnings</p>
						</span>
					</li>
				</ul>

				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 class="fred">Recent Orders</h3>
						</div>

						<div id="orderdash">

						</div>
					</div>
					<?php

					$bestshop_rs = Database::search("SELECT `shop_name`,`seller_id` FROM shop INNER JOIN product ON product.user_email = shop.seller_id INNER JOIN invoice ON invoice.p_invoice_id = product.id GROUP BY `shop_name`,`shop_id` ORDER BY COUNT(`shop_name`) DESC LIMIT 1");
					$bestshop = $bestshop_rs->fetch_assoc();

					$best_user_rs = Database::search("SELECT `email`,`fname`,`lname` FROM `user` INNER JOIN `invoice` ON invoice.in_user_email = user.email GROUP BY `in_user_email` ORDER BY COUNT(`in_user_email`) DESC LIMIT 1;");
					$best_user = $best_user_rs->fetch_assoc();

					?>

					<ul class="box-info" style="display: block;">
						<?php
						if ($bestshop_rs->num_rows > 0) {
						?>
							<li style="margin-bottom: 20px; cursor: pointer;" onclick="bestShop();">
								<i class='bx bxs-trophy'></i>
								<span class="text">
									<h3 class="fred" id="bestShopId" data-value="<?php echo $bestshop['seller_id'] ?>"><?php echo $bestshop["shop_name"] ?></h3>
									<p class="fred">Best Shop</p>
								</span>
							</li>
						<?php
						} else {
						?>

							<li style="margin-bottom: 20px; cursor: pointer;">
								<i class='bx bxs-trophy'></i>
								<span class="text">
									<h3 class="fred">No one yet</h3>
									<p class="fred">Best Shop</p>
								</span>
							</li>
						<?php
						}
						if ($best_user_rs->num_rows > 0) {
						?>
							<li style="cursor:pointer ;" onclick="bestCustomer();">
								<i class='bx bxs-certification'></i>
								<span class="text">
									<h3 class="fred" id="bestcustomerId" data-value="<?php echo $best_user['email'] ?>"><?php echo $best_user["fname"] ?> <?php echo $best_user["lname"] ?></h3>
									<p class="fred">Best Customer</p>
								</span>
							</li>
						<?php
						} else {
						?>

							<li style="cursor:pointer ;">
								<i class='bx bxs-certification'></i>
								<span class="text">
									<h3 class="fred">No one yet</h3>
									<p class="fred">Best Customer</p>
								</span>
							</li>
						<?php
						}
						?>


					</ul>

				</div>
				<br><br><br>
			</main>
			<!-- MAIN -->
		</section>
		<!-- CONTENT -->


		<!-- CONTENT -->
		<section id="content">
			<main id="product" class="d-none">
				<div class="head-title">
					<div class="left">
						<h1 class="fred">Manage Products</h1>
						<ul class="breadcrumb">
							<li>
								<a href="#">Dashboard</a>
							</li>
							<li><i class='bx bx-chevron-right'></i></li>
							<li>
								<a class="active" href="#">Manage Products</a>
							</li>
						</ul>
					</div>
				</div>

				<ul class="box-info">

					<li>
						<i class='bx bxs-shopping-bags'></i>
						<span class="text">
							<h3 class="fred"><?php echo $total_product_num ?></h3>
							<p class="fred">Total Products</p>
						</span>
					</li>
				</ul>

				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 class="fred">Products</h3>
							<div class="searchboxcom">
								<input type="text" class="searchInput" placeholder="Search Products here" id="productInput" onkeyup="searchProduct(1);">
								<i class='bx bx-search' onclick="searchProduct(1);"></i>
							</div>
						</div>
						<div id="productInner">

						</div>
					</div>
				</div>
				<div class="table-data" id="manageProductCat">
					<div class="order">
						<div class="head">
							<h3 class="fred">Manage</h3>
							<!-- <div class="searchboxcom">
								<input type="text" class="searchInput" placeholder="Search Products here" id="productInput" onkeyup="searchProduct(1);">
								<i class='bx bx-search' onclick="searchProduct(1);"></i>
							</div> -->
						</div>
						<?php
						$model_rs = Database::search("SELECT * FROM `model`");
						$model_max_id = Database::search("SELECT MAX(`model_id`) as maxmod FROM `model`");
						$model_max = $model_max_id->fetch_assoc();

						$category_rs = Database::search("SELECT * FROM `category`");
						$cat_max_id = Database::search("SELECT MAX(`cat_id`) as maxcat FROM `category`");
						$cat_max = $cat_max_id->fetch_assoc();

						$brand_rs = Database::search("SELECT * FROM `brand`");
						$brand_max_id = Database::search("SELECT MAX(`brand_id`) as maxbd FROM `brand`");
						$brand_max = $brand_max_id->fetch_assoc();

						$color_rs = Database::search("SELECT * FROM `color`");
						$clr_max_id = Database::search("SELECT MAX(`clr_id`) as maxclr FROM `color`");
						$clr_max = $clr_max_id->fetch_assoc();

						$modelAccess = Database::search("SELECT * FROM `seller_product_add_permission` WHERE `id` = '1'");
						$catAccess = Database::search("SELECT * FROM `seller_product_add_permission` WHERE `id` = '2'");
						$clrAccess = Database::search("SELECT * FROM `seller_product_add_permission` WHERE `id` = '4'");
						$brandAccess = Database::search("SELECT * FROM `seller_product_add_permission` WHERE `id` = '3'");
						$modelAccess = $modelAccess->fetch_assoc();
						$catAccess = $catAccess->fetch_assoc();
						$clrAccess = $clrAccess->fetch_assoc();
						$brandAccess = $brandAccess->fetch_assoc();


						?>
						<div id="catManage">
							<div class="ui form">
								<div class="field">
									<label style="font-size: larger; font-weight: 600;">Model</label>
									<div class="togglebtnseller">
										<div class="checkbox-wrapper-2">
											<input type="checkbox" <?php if ($modelAccess["status"] == 1) { ?> checked<?php } ?> class="sc-gJwTLC ikxBAC" id="sellerModalAccees" onchange="SellerAccess();">
											<label>Seller Access</label>
										</div>
									</div>

									<div class="two fields">
										<div class="field">

											<select class="ui fluid search dropdown" id="modelDrop">
												<option value="">Select Model</option>
												<?php
												for ($x = 0; $x < $model_rs->num_rows; $x++) {
													$model_data = $model_rs->fetch_assoc();

												?>
													<option value="<?php echo $model_data["model_id"] ?>"><?php echo $model_data["model_name"] ?></option>
												<?php
												}
												?>


											</select>
										</div>
										<button onclick="modelDel();" id="a1" class="ui red button">
											Remove
										</button>
										<div class="field">
											<input id="modeladd" type="text" name="shipping[last-name]" placeholder="Add New Model">
										</div>
										<button onclick="modeladd(<?php echo $model_max['maxmod']; ?>);" id="a1" class="ui secondary button">
											Add
										</button>
									</div>
								</div>
								<div class="field">
									<label style="font-size: larger; font-weight: 600;">Brand</label>
									<div class="togglebtnseller">
										<div class="checkbox-wrapper-2">
											<input type="checkbox" <?php if ($brandAccess["status"] == 1) { ?> checked<?php } ?> class="sc-gJwTLC ikxBAC" id="sellerBrandAccees" onchange="SellerAccess();">
											<label>Seller Access</label>
										</div>
									</div>
									<div class="two fields">
										<div class="field">

											<select class="ui fluid search dropdown" id="brandDrop">
												<option value="">Select Brand</option>
												<?php
												for ($x = 0; $x < $brand_rs->num_rows; $x++) {
													$brand_data = $brand_rs->fetch_assoc();

												?>
													<option value="<?php echo $brand_data["brand_id"] ?>"><?php echo $brand_data["brand_name"] ?></option>
												<?php
												}
												?>


											</select>
										</div>
										<button onclick="brandDel();" id="a1" class="ui red button">
											Remove
										</button>
										<div class="field">
											<input id="brandadd" type="text" name="shipping[last-name]" placeholder="Add New Brand">
										</div>
										<button onclick="brandadd(<?php echo $brand_max['maxbd']; ?>);" class="ui secondary button">
											Add
										</button>
									</div>
								</div>

								<div class="field">
									<label style="font-size: larger; font-weight: 600;">Category</label>
									<div class="togglebtnseller">
										<div class="checkbox-wrapper-2">
											<input type="checkbox" <?php if ($catAccess["status"] == 1) { ?> checked<?php } ?> class="sc-gJwTLC ikxBAC" id="sellerCategoryAccees" onchange="SellerAccess();">
											<label>Seller Access</label>
										</div>
									</div>
									<div class="two fields">
										<div class="field">

											<select class="ui fluid search dropdown" id="CatDrop">
												<option value="">Select Category</option>
												<?php
												for ($x = 0; $x < $category_rs->num_rows; $x++) {
													$category_data = $category_rs->fetch_assoc();

												?>
													<option value="<?php echo $category_data["cat_id"] ?>"><?php echo $category_data["cat_name"] ?></option>
												<?php
												}
												?>

											</select>
										</div>
										<button onclick="catDel(<?php echo $model_max['maxmod']; ?>);" id="a1" class="ui red button">
											Remove
										</button>
										<div class="field">
											<input id="category" type="text" placeholder="Add New Category">
										</div>
										<button onclick="catadd(<?php echo $cat_max['maxcat']; ?>);" class="ui secondary button">
											Add
										</button>
									</div>
								</div>

								<div class="field">
									<label style="font-size: larger; font-weight: 600;">Color</label>
									<div class="togglebtnseller">
										<div class="checkbox-wrapper-2">
											<input type="checkbox" <?php if ($clrAccess["status"] == 1) { ?> checked<?php } ?> class="sc-gJwTLC ikxBAC" id="sellerColorAccees" onchange="SellerAccess();">
											<label>Seller Access</label>
										</div>
									</div>
									<div class="two fields">
										<div class="field">

											<select class="ui fluid search dropdown" id="colorDrop">
												<option value="">Select Color</option>
												<?php
												for ($x = 0; $x < $color_rs->num_rows; $x++) {
													$color_data = $color_rs->fetch_assoc();

												?>
													<option value="<?php echo $color_data["clr_id"] ?>"><?php echo $color_data["clr_name"] ?></option>
												<?php
												}
												?>

											</select>
										</div>
										<button onclick="clrDel(<?php echo $model_max['maxmod']; ?>);" id="a1" class="ui red button">
											Remove
										</button>
										<div class="field">
											<input id="coloradd" type="text" placeholder="Add New Color">
										</div>
										<button onclick="clradd(<?php echo $clr_max['maxclr']; ?>);" class="ui secondary button">
											Add
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br><br><br>

			</main>
			<!-- MAIN -->
		</section>
		<!-- CONTENT -->

		<!-- CONTENT -->
		<section id="content">
			<main id="orders" class="d-none">
				<div class="head-title">
					<div class="left">
						<h1 class="fred">Orders</h1>
						<ul class="breadcrumb">
							<li>
								<a href="#">Dashboard</a>
							</li>
							<li><i class='bx bx-chevron-right'></i></li>
							<li>
								<a class="active" href="#">Orders</a>
							</li>
						</ul>
					</div>
				</div>

				<ul class="box-info">

					<li>
						<i class='bx bxs-basket'></i>
						<span class="text">
							<h3 class="fred"><?php echo $total_orders_num ?></h3>
							<p class="fred">Total Orders</p>
						</span>
					</li>
				</ul>

				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 class="fred">Orders</h3>
							<div class="searchboxcom">
								<input type="text" class="searchInput" placeholder="Search orders here" id="orderInput" onkeyup="searchOrders(1);">
								<i class='bx bx-search' onclick="searchOrders(1);"></i>
							</div>
						</div>
						<div id="orderInner">

						</div>
					</div>
				</div>
				<br><br><br>

			</main>
			<!-- MAIN -->
		</section>
		<!-- CONTENT -->

		<!-- CONTENT -->
		<section id="content">
			<main id="History" class="d-none">
				<div class="head-title">
					<div class="left">
						<h1 class="fred">Selling History</h1>
						<ul class="breadcrumb">
							<li>
								<a href="#">Dashboard</a>
							</li>
							<li><i class='bx bx-chevron-right'></i></li>
							<li>
								<a class="active" href="#">Selling History</a>
							</li>
						</ul>
					</div>
				</div>

				<ul class="box-info">

					<li>
						<i class='bx bxs-receipt'></i>
						<span class="text">
							<h3 class="fred"><?php echo $total_orders_num ?></h3>
							<p class="fred">Total Invoices</p>
						</span>
					</li>
				</ul>

				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 class="fred">History</h3>
							<div class="searchboxcom">
								<input type="text" class="searchInput" placeholder="Search History here" id="historyInput" onkeyup="searchHistory(1);">
								<i class='bx bx-search' onclick="searchHistory(1);"></i>
							</div>
						</div>
						<div id="historyInner">

						</div>
					</div>
				</div>
				<br><br><br>

			</main>
			<!-- MAIN -->
		</section>
		<!-- CONTENT -->

		<!-- CONTENT -->
		<section id="content">
			<main id="user" class="d-none">
				<div class="head-title">
					<div class="left">
						<h1 class="fred">Manage Users</h1>
						<ul class="breadcrumb">
							<li>
								<a href="#">Dashboard</a>
							</li>
							<li><i class='bx bx-chevron-right'></i></li>
							<li>
								<a class="active" href="#">Manage Users</a>
							</li>
						</ul>
					</div>
				</div>

				<ul class="box-info">

					<li>
						<i class='bx bxs-group'></i>
						<span class="text">
							<h3 class="fred" id="activeUsers"><?php echo $active_user ?></h3>
							<p class="fred">Active Users</p>
						</span>
					</li>
				</ul>

				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 class="fred">Users</h3>
							<div class="searchboxcom">
								<input type="text" class="searchInput" placeholder="Search Users here" id="userInput" onkeyup="searchUser(1);">
								<i class='bx bx-search' onclick="searchUser(1);"></i>
							</div>
						</div>
						<div id="userInner">

						</div>
					</div>
				</div>
				<br><br><br>

			</main>
			<!-- MAIN -->
		</section>
		<!-- CONTENT -->

		<!-- CONTENT -->
		<section id="content">
			<main id="shop" class="d-none">
				<div class="head-title">
					<div class="left">
						<h1 class="fred">Manage Shops</h1>
						<ul class="breadcrumb">
							<li>
								<a href="#">Dashboard</a>
							</li>
							<li><i class='bx bx-chevron-right'></i></li>
							<li>
								<a class="active" href="#">Manage Shops</a>
							</li>
						</ul>
					</div>
				</div>

				<ul class="box-info">

					<li>
						<i class='bx bxs-store-alt'></i>
						<span class="text">
							<h3 class="fred" id="activeShops"><?php echo $total_shop; ?></h3>
							<p class="fred">Active Shops</p>
						</span>
					</li>
				</ul>

				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 class="fred">Shops</h3>
							<div class="searchboxcom">
								<input type="text" class="searchInput" placeholder="Search Shops here" id="shopInput" onkeyup="searchShop(1);">
								<i class='bx bx-search' onclick="searchShop(1);"></i>
							</div>
						</div>
						<div id="shopInner">

						</div>
					</div>
				</div>
				<br><br><br>

			</main>
			<!-- MAIN -->
		</section>
		<!-- CONTENT -->

		<!-- CONTENT -->
		<section id="content">
			<main id="chat" class="d-none">
				<div class="head-title">
					<div class="left">
						<h1 class="fred">Chats</h1>
						<ul class="breadcrumb">
							<li>
								<a href="#">Dashboard</a>
							</li>
							<li><i class='bx bx-chevron-right'></i></li>
							<li>
								<a class="active" href="#">Chats</a>
							</li>
						</ul>

						<div class="chatbackCenter">

							<div class="chatBox d-block" id="cusPage">
								<div class="head">
									Customers
								</div>
								<div class="cusList" id="cusList">

									<!-- customer list load here -->
								</div>
							</div>


							<div class="chatBox d-none" id="chatPage">




							</div>
						</div>



					</div>
				</div>
				<br><br><br>

			</main>
			<!-- MAIN -->
		</section>
		<!-- CONTENT -->

		<!-- CONTENT -->
		<section id="content">
			<main id="admin" class="d-none">
				<div class="head-title">
					<div class="left">
						<h1 class="fred">Manage Admins</h1>
						<ul class="breadcrumb">
							<li>
								<a href="#">Dashboard</a>
							</li>
							<li><i class='bx bxs-group'></i></li>
							<li>
								<a class="active" href="#">Manage Admins</a>
							</li>
						</ul>
					</div>
				</div>

				<ul class="box-info">

					<li>
						<i class='bx bxs-group'></i>
						<span class="text">
							<h3 class="fred" id="activeAdmins"><?php echo $active_admin; ?></h3>
							<p class="fred">Active Admins</p>
						</span>
					</li>
				</ul>

				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 class="fred">Admin Reset Password Requests</h3>
						</div>
						<div id="adminResetLoad">

						</div>
					</div>
				</div>
				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 class="fred">Admins</h3>
							<div class="searchboxcom">
								<input type="text" class="searchInput" placeholder="Search Shops here" id="adminInput" onkeyup="searchAdmin(1);">
								<i class='bx bx-search' onclick="searchAdmin(1);"></i>
							</div>
						</div>
						<div id="adminInner">

						</div>
					</div>
				</div>

				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 class="fred">Add New Admins</h3>
						</div>
						<div>
							<form class="ui form">
								<div class="field">
									<label>Name</label>
									<div class="two fields">
										<div class="field">
											<input type="text" id="adminfname" placeholder="First Name">
										</div>
										<div class="field">
											<input type="text" id="adminlname" placeholder="Last Name">
										</div>
									</div>
								</div>
								<div class="fields">
									<div class="seven wide field">
										<label>Email</label>
										<input type="text" id="adminemail" placeholder="example@gmail.com">
									</div>
									<div class="six wide field">
										<label>Role</label>
										<input type="text" id="role" placeholder="Product Manager">
									</div>
									<div class="three wide field">
										<label>Gender</label>

										<div class="field">
											<select class="ui fluid search dropdown" id="genderId">
												<option value="">Gender</option>
												<option value="1">Male</option>
												<option value="2">Female</option>
											</select>
										</div>

									</div>
								</div>
								<div class="field">
									<label>Permissions</label>
									<div class="checkbox-wrapper-33">
										<label class="checkbox">
											<input class="checkbox__trigger visuallyhidden" type="checkbox" id="dashCheck" />
											<span class="checkbox__symbol">
												<svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
													<path d="M4 14l8 7L24 7"></path>
												</svg>
											</span>
											<p class="checkbox__textwrapper">Dashboard</p>
										</label>
									</div>
									<br>
									<div class="checkbox-wrapper-33">
										<label class="checkbox">
											<input class="checkbox__trigger visuallyhidden" id="prodCheck" type="checkbox" />
											<span class="checkbox__symbol">
												<svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
													<path d="M4 14l8 7L24 7"></path>
												</svg>
											</span>
											<p class="checkbox__textwrapper">Manage Products</p>
										</label>
									</div>
									<br>
									<div class="checkbox-wrapper-33">
										<label class="checkbox">
											<input class="checkbox__trigger visuallyhidden" id="orderCheck" type="checkbox" />
											<span class="checkbox__symbol">
												<svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
													<path d="M4 14l8 7L24 7"></path>
												</svg>
											</span>
											<p class="checkbox__textwrapper">Manage Orders</p>
										</label>
									</div>
									<br>
									<div class="checkbox-wrapper-33">
										<label class="checkbox">
											<input class="checkbox__trigger visuallyhidden" id="histCheck" type="checkbox" />
											<span class="checkbox__symbol">
												<svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
													<path d="M4 14l8 7L24 7"></path>
												</svg>
											</span>
											<p class="checkbox__textwrapper">Selling History</p>
										</label>
									</div>
									<br>
									<div class="checkbox-wrapper-33">
										<label class="checkbox">
											<input class="checkbox__trigger visuallyhidden" id="userCheck" type="checkbox" />
											<span class="checkbox__symbol">
												<svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
													<path d="M4 14l8 7L24 7"></path>
												</svg>
											</span>
											<p class="checkbox__textwrapper">Manage Users</p>
										</label>
									</div>
									<br>
									<div class="checkbox-wrapper-33">
										<label class="checkbox">
											<input class="checkbox__trigger visuallyhidden" id="shopCheck" type="checkbox" />
											<span class="checkbox__symbol">
												<svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
													<path d="M4 14l8 7L24 7"></path>
												</svg>
											</span>
											<p class="checkbox__textwrapper">Manage Shops</p>
										</label>
									</div>
									<br>
									<div class="checkbox-wrapper-33">
										<label class="checkbox">
											<input class="checkbox__trigger visuallyhidden" id="adminCheck" type="checkbox" />
											<span class="checkbox__symbol">
												<svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
													<path d="M4 14l8 7L24 7"></path>
												</svg>
											</span>
											<p class="checkbox__textwrapper">Manage Admins</p>
										</label>
									</div>
									<br>
									<div class="checkbox-wrapper-33">
										<label class="checkbox">
											<input class="checkbox__trigger visuallyhidden" id="homeCheck" type="checkbox" />
											<span class="checkbox__symbol">
												<svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
													<path d="M4 14l8 7L24 7"></path>
												</svg>
											</span>
											<p class="checkbox__textwrapper">Manage Home Content</p>
										</label>
									</div>
									<br>
								</div>




							</form>
							<br>
							<button class="ui black button" id="adminAddBtn" onclick="addAdmin();">ADD</button>
							<br><br>
						</div>
					</div>
				</div>
				<br><br><br>

			</main>
			<!-- MAIN -->
		</section>
		<!-- CONTENT -->

		<!-- CONTENT -->
		<section id="content">
			<main id="home" class="d-none">
				<div class="head-title">
					<div class="left">
						<h1 class="fred">Manage Home Content</h1>
						<ul class="breadcrumb">
							<li>
								<a href="#">Dashboard</a>
							</li>
							<li><i class='bx bx-chevron-right'></i></li>
							<li>
								<a class="active" href="#">Manage Home Content</a>
							</li>
						</ul>
					</div>
				</div>



				<div class="table-data">
					<div class="order">
						<?php
						$homeURL = 'http://localhost/project/index.php';
						$homeURL = htmlspecialchars($homeURL, ENT_QUOTES, 'UTF-8');
						?>
						<div class="head">
							<h3 class="fred">Category Summary</h3>
						</div>
						<div class="categoryChart">
							<div class="nochart d-none" id="nochart">No Enough Informations</div>
							<canvas id="categorySummary"></canvas>
						</div>
						<div class="head">
							<h3 class="fred">Home Preview</h3>
						</div>
						<div class="homePreviewBox">
							<iframe src="<?php echo $homeURL; ?>" class="homePreview" frameborder="0" id="homePreview"> </iframe>
						</div>
						<br>
						<div class="head">
							<h3 class="fred">Categories</h3>
						</div>
						<hr>
						<?php

						$homeContentRs = Database::search("SELECT * FROM `home_content_manage` INNER JOIN `category` ON `category`.`cat_id` = `home_content_manage`.`category_id`");

						for ($i = 0; $i < $homeContentRs->num_rows; $i++) {
							$homeContent = $homeContentRs->fetch_assoc();

						?>

							<div>
								<br>
								<div class="head">
									<div class="checkbox-wrapper-33" onclick="categoryStatus(<?php echo $homeContent['cat_id'] ?>);">
										<label class="checkbox">
											<input class="checkbox__trigger visuallyhidden" <?php if ($homeContent["status"] == 1) { ?> checked <?php } ?> id="cat<?php echo $homeContent['cat_id'] ?>" type="checkbox" />
											<span class="checkbox__symbol">
												<svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
													<path d="M4 14l8 7L24 7"></path>
												</svg>
											</span>
											<p class="checkbox__textwrapper" style="font-size: 20px;"><?php echo $homeContent["cat_name"] ?></p>
										</label>
									</div>
									<!-- <h3 class="fred">Laptops</h3> -->
								</div>
								<div class="field">
									<div style="overflow: hidden; display: flex; align-items: center; align-content: center; position: relative;" onclick="changeslides(<?php echo $homeContent['cat_id'] ?>);">
										<input id="imageUp<?php echo $homeContent['cat_id'] ?>" type="file" accept=".jpg,.jpeg,.png,.xml" multiple style="position: absolute;transform: translateX(0px);transform: scale(1); opacity: 0; cursor: pointer; width: 230px; z-index: 3;">
										<img src="resourses/addfile.svg" width="50px" alt="">
										<div class="ui labeled icon teal button" style=" cursor: pointer;">
											<i class="upload icon"></i>
											Upload Slides
										</div>
									</div>
									<div class="">
										<div class="ui small images" style="display: flex; align-content: center; align-items: center;">
											<?php
											$img1 = "resourses/image (2).png";
											$img2 = "resourses/image (2).png";
											$img3 = "resourses/image (2).png";
											if (isset($homeContent["img1"]) && !empty($homeContent["img1"])) {
												$img1 = $homeContent["img1"];
											}
											if (isset($homeContent["img2"]) && !empty($homeContent["img2"])) {
												$img2 = $homeContent["img2"];
											}
											if (isset($homeContent["img3"]) && !empty($homeContent["img3"])) {
												$img3 = $homeContent["img3"];
											}
											?>
											<img src="<?php echo $img1; ?>" id="img<?php echo $homeContent['cat_id'] ?>0">
											<img src="<?php echo $img2; ?>" id="img<?php echo $homeContent['cat_id'] ?>1">
											<img src="<?php echo $img3; ?>" id="img<?php echo $homeContent['cat_id'] ?>2">
										</div>
										<h4>Dimensions (1200 x 600)</h4>
										<br>
									</div>
									<hr>
								</div>
							</div>

						<?php
						}
						?>



					</div>
				</div>
				<br><br><br>

			</main>
			<!-- MAIN -->
		</section>
		<!-- CONTENT -->

		<!-- CONTENT -->
		<section id="content">
			<main id="report" class="d-none">
				<div class="head-title">
					<div class="left">
						<h1 class="fred">Reports</h1>
						<ul class="breadcrumb">
							<li>
								<a href="#">Dashboard</a>
							</li>
							<li><i class='bx bx-chevron-right'></i></li>
							<li>
								<a class="active" href="#">Reports</a>
							</li>
						</ul>
					</div>
				</div>


				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 class="fred">Select Report</h3>
						</div>
						<div id="">
							<form class="ui form">
								<div class="fields">
									<div class="three wide field">
										<label>Type</label>
										<select class="ui dropdown" id="SelectReport" onchange="disableActive();">
											<option value="">Report</option>
											<option value="1">Product Report</option>
											<option value="2">User Report</option>
											<option value="3">Admin Report</option>
											<option value="4">Shop Report</option>
											<option value="5">Selling Report</option>
											<option value="6">Income Report</option>
										</select>
									</div>
									<div class="three wide field">
										<label>Start</label>
										<input type="date" class="datetime" id="startDate">
									</div>
									<div class="three wide field">
										<label>End</label>
										<input type="date" class="datetime" id="endDate">
									</div>
									<div class="two wide field">
										<label>Status</label>
										<button class="ui button" style="width: 100px;" value="3" onclick="changeRportStatus();" id="reportstatusBtn">All</button>
									</div>
									<div class="five wide field">
										<label></label>
										<br>
										<button class="ui red button" id="printbtn" style="width: 120px;" onclick="redirectPrint();">Print</button>
									</div>
								</div>
							</form>




						</div>
					</div>
				</div>
				<br><br><br>

			</main>
			<!-- MAIN -->
		</section>
		<!-- CONTENT -->


		<div class="ui modal" id="changeAddress">
			<div class="header">
				Admin Profile
			</div>
			<div class="content">
				<form class="ui form">
					<div class="fields">
						<div style="display: flex; flex-direction: column; justify-content: center; align-items: center;" class="four wide field">
							<div class="profileImg">
								<img src="<?php echo $img; ?>" id="ImagePlace" alt="">
							</div>
							<div style="overflow: hidden; display: flex; align-items: center; align-content: center;" onclick="changeProf();">
								<input id="image" type="file" accept=".jpg,.jpeg,.png,.xml" style="position: absolute;transform: translateX(0px);transform: scale(1); opacity: 0; cursor: pointer; width: 230px; z-index: 3;">
								<div class="ui labeled icon teal button" style=" cursor: pointer;">
									<i class="upload icon"></i>
									Upload pictures
								</div>
							</div>
						</div>
						<div class="twelve wide field">
							<div class="fields">

								<div class="eight wide field" style="margin-bottom: 15px;">
									<label>First Name</label>
									<input type="text" value="<?php echo $adminDetails["fname"]; ?>" id="fname">
								</div>


								<div class="eight wide field" style="margin-bottom: 15px;">
									<label>Last Name</label>
									<input type="text" value="Amarasinghe" id="lname" value="<?php echo $adminDetails["lname"]; ?>">
								</div>

							</div>
							<div class="field">
								<div class="sixteen wide field" style="margin-bottom: 15px;">
									<label>Email</label>
									<input type="email" value="<?php echo $adminDetails["admin_email"]; ?>" disabled>
								</div>
							</div>
							<div class="field">
								<div class="sixteen wide field" style="margin-bottom: 15px;">
									<label>Role</label>
									<input type="text" value="<?php echo $adminDetails["role"]; ?>" disabled>
								</div>
							</div>
							<div class="fields">
								<div class="ten wide field" style="margin-bottom: 15px;">
									<label>Password</label>
									<input type="password" value="**********" disabled>
								</div>
								<div class="six wide field" style="margin-bottom: 15px;">
									<label>Password Reset</label>
									<div class="ui teal button" onclick="reqpwReset();">Request reset</div>
								</div>
							</div>
						</div>
					</div>


				</form>

			</div>
			<div class="actions">
				<input type="hidden" value="" id="orderId">
				<div class="ui button deny" onclick="closeprofilemodel();">Cancel</div>
				<div class="ui black deny button" onclick="updateadminProfile();">UPDATE</div>
			</div>
		</div>


		<div class="ui modal p" id="ProductModel">

		</div>


		<div class="ui modal u" id="userModel">

		</div>




		<script>
			$('.ui.dropdown')
				.dropdown();
			$('#modelDrop')
				.dropdown();

			$('#brandDrop')
				.dropdown();

			$('#CatDrop')
				.dropdown();
			$('#colorDrop')
				.dropdown();
		</script>
		<script src="Animations/script.js"></script>
		<script src="Process/admin.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<?php
		$adminlogged_rs = Database::search("SELECT * FROM `admin` INNER JOIN `admin_cat` ON `admin`.`admin_email`=`admin_cat`.`admin_email` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "'");

		$adminlogged = $adminlogged_rs->fetch_assoc();

		if ($adminlogged["cat_id"] == 1) {
		?>
			<script>
				dashToggle();
			</script>
		<?php
		} else if ($adminlogged["cat_id"] == 2) {
		?>
			<script>
				productToggle();
			</script>
		<?php
		} else if ($adminlogged["cat_id"] == 8) {
		?>
			<script>
				orderToggle();
			</script>
		<?php

		} else if ($adminlogged["cat_id"] == 3) {
		?>
			<script>
				historyToggle();
			</script>
		<?php
		} else if ($adminlogged["cat_id"] == 4) {
		?>
			<script>
				chatToggle();
			</script>
		<?php

		} else if ($adminlogged["cat_id"] == 5) {

		?>
			<script>
				userToggle();
			</script>
		<?php


		} else if ($adminlogged["cat_id"] == 6) {

		?>
			<script>
				sellerToggle();
			</script>
		<?php


		} else if ($adminlogged["cat_id"] == 7) {

		?>
			<script>
				adminToggle();
			</script>
		<?php



		} else if ($adminlogged["cat_id"] == 9) {
		?>
			<script>
				homeToggle();
			</script>
		<?php


		}
		?>
	</body>

	</html>

<?php
} else {
	header("location:adminlogin.php");
}
?>