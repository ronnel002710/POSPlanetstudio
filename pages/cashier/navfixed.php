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

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0;color:#fff">
	<div class=""><!---navbar-header--->
		<button type="button" class="navbar-toggle navbar" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#" style="color:#fff"> P.O.S System</a>
	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">     
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<?php echo $session_cashier_name; ?> <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
			<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
			</ul>
				<!-- /.dropdown-user -->
			</li>
			<!-- /.dropdown -->
		</ul>
		<!-- /.navbar-top-links -->



		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">
				<ul class="nav" id="side-menu">
					<li>
						<a href="#"><i class="fa fa-money fa-fw"></i> PAYMENT METHOD<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>">CASH</a>
							</li>
							
							<!--<li>
								<a href="sales.php?id=credit&invoice=<?php echo $finalcode ?>">Credit</a>
							</li>---->
						</ul>
						<li>
							<a href="customer.php"><i class="fa fa-user fa-fw"></i>Customer</a>
				
							</li>
					</li>
				</div>
			</div>
			<!-- /.navbar-static-side -->
		</nav>
