<nav class="pcoded-navbar  ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				
				<div class="">
					<div class="main-menu-header">
						<img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="User-Profile-Image">
						<div class="user-details">
							<span><?php echo $_SESSION['name'];?></span>
							<div id="more-details"><?php echo $_SESSION['usertype'];?></div>
						</div>
					</div>
					
				</div>
				
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<label>Navigation</label>
					</li>
					<li class="nav-item">
					    <a href="index.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Suppliers</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="view_suppliers.php">View Suppliers</a></li>
					        
					    </ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Brands</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="view_brands.php">View Brands</a></li>
					    </ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Units</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="view_units.php">View Units</a></li>
					    </ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Categories</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="view_categories.php">View Category</a></li>
					    </ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Customers</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="view_customers.php">View Customer</a></li>
					        <li><a href="credit_customers.php">Credit Customer</a></li>
					        <li><a href="paid_customers.php">Paid Customer</a></li>
					    </ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Products</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="view_products.php">View Products</a></li>
					    </ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Purchase</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="view_purchase.php">View Purchase</a></li>
					        <li><a href="daily_purchase_report.php">Daily Purchase</a></li>
					    </ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Invoices</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="view_invoices.php">View Invoices</a></li>
					        <li><a href="daily_invoice_report.php">Daily Invoice Report</a></li>
					    </ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Manage Stock</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="view_stock.php">Stock Report</a></li>
					        <li><a href="supplier_product_wise_report.php">Supplier/Product Wise Report</a></li>
					    </ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>