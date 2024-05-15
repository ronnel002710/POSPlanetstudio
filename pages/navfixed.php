<?php
require_once('auth.php');
?>
<?php
function createRandomPassword() {
	$chars = "012345678911223344556677889900";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 8) {

		$num = rand() % 33;

		$tmp = substr($chars, $num, 1);

		$pass = $pass . $tmp;

		$i++;

	}
	return $pass;
}
$finalcode='IN00'.createRandomPassword();
?>
<style>
	#dropme:hover{
		background:green;
	}
</style>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0;" >
	<div class=""><!----navbar-header--->
		<button type="button" class="navbar-toggle navbar" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="home.php" style="color:#fff">P.O.S System</a>
	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right" > 
		<li class="dropdown" >
			<a class="dropdown-toggle btn-success" data-toggle="dropdown" href="#" style="color:#fff;" id="dropme">
			<?php echo $fname?>
				<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li><a  href="#profile" data-toggle="modal"><i class="fa fa-user fa-fw"></i> Profile</a></li>
				<li><a href="#logout" data-toggle="modal"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
			</ul>
				<!-- /.dropdown-user -->
			</li>
			<!-- /.dropdown -->
		</ul>
		
		<!-- /.navbar-top-links -->
		<div class="navbar-default sidebar" role="navigation" >
			<div class="sidebar-nav navbar-collapse" >
				
				<ul class="nav" id="side-menu" >
					<li>
						<div class="user-panel">
						<div class="pull-left image">
						  <img src="<?php echo (!empty($userprofile)) ? $userprofile : 'src/logo.png'; ?>" class="img-s" alt="User Image">
						</div>
						<div class="pull-left info">
						  <p><?php echo $fname?> (Admin)</p>
						  <a><i class="fa fa-circle text-success"></i> Online</a>
						</div>
					  </div>
					</li>
					<li>
						<a href="home.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
					</li>
					<li>
					<a href="customer.php"><i class="fa fa-user fa-fw"></i>Customer</a>
				
							</li>
	
					</li>
					<li>
							<a href="#"><i class="fa fa-archive fa-fw"></i> Job Order<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
							<li>
							<a href="products.php"><i class="fa fa-table fa-fw"></i> Job Order</a>
							</li>
							<li>
								<a href="product_category.php"><i class="fa fa-list-alt fa-fw"></i> Job Order Category</a>
							</li>
							<li>
								<a href="product_unit.php"><i class="fa fa-balance-scale fa-fw"></i> Job Order Unit</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="purchaseslist.php"><i class="fa fa-list fa-fw"></i> Purchase Order List</a>
					</li>
					<li>
						<a href="orderpo.php"><i class="fa fa-list fa-fw"></i> Purchase Order Form</a>
					</li>
					<li>
						<a href="supplier.php"><i class="fa fa-truck fa-fw"></i> Supplier</a>
					</li>
					</li>
					<li>
						<a href="#"><i class="fa fa-newspaper-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">

							<li>
								<a href="salesreport.php"> <i class="fa fa-money"></i> Sales Report</a>
							</li>
							<li>
								<a href="sales_daily.php"> <i class="fa fa-calendar"></i> Daily Sales </a>
							</li>
							<li>
								<a href="sales_Weekly.php"> <i class="fa fa-calendar"></i> Weekly Sales</a>
							</li>
							<li>
								<a href="sales_monthly.php"> <i class="fa fa-calendar"></i> Monthly Sales</a>
							</li>
							<li>
								<a href="inventory.php"><i class="fa fa-shopping-cart"></i> Inventory Report</a>
							</li>
							
							<li>
								<a href="products_list.php?product-list=product list"><i class="fa fa-shopping-cart"></i> List of Products</a>
							</li>
							<li>
							</li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<!--<li>
								<a href="chart.php"> Graph By Category</a>
							</li>
							<li>
								<a href="charts.php"> Graph For Cash</a>
							</li>
							-->
							<li>
								<a href="daily_chart.php"> Daily Sales </a>
							</li>
							<li>
								<a href="month_chart.php"> Monthly Sales Chart</a>
							</li>
							<li>
								<a href="yearly_chart.php"> Yearly Sales Chart</a>
							</li>
						</ul>
					</li>
					<li>
					<a href="#"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
					<li>
						<a href="user.php"><i class="fa fa-user fa-fw"></i> Staff</a>
					</li>
					<li>
						<a href="admin.php"><i class="fa fa-user fa-fw"></i> Admin</a>
					</li>
				</ul>
				</li>
					<!---<li>
						<a href="#ShowVat" data-toggle="modal"><i class="fa fa-gear fa-fw"></i> Vat/Tax Setting</a>
					</li>-->
					</ul>
				</div>
				
			</div>
			<!-- /.navbar-static-side -->
			
		</nav>
	