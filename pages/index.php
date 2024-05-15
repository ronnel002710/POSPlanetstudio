<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	 <title>P.O.S</title>
  <link rel="shortcut icon" href="#">
	<!-- Bootstrap Core CSS -->
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../vendor/css/AdminLTE.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>

    <body  style="background:#34495e">
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
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<div class="col-md-offset-4 col-md-4">
			<div class="box box-primary">
			  <div class="box-header with-border">
				<div class="col-md-12">
				  <center><h1 class="box-title"><img src="src/logo.png" class=""/> 
                                  <br>LOGIN</h1></center>
				  </div>
			  </div>
			  <div class="box-body">
				<div class="col-md-12">
				  <div style="overflow-x:auto;">
                    
					  <ul class="nav nav-pills">
    						<li class="active"><a data-toggle="pill" href="#home">Admin</a></li>
    						<li><a data-toggle="pill" href="#menu2">Staff</a></li>
    					</ul>
    					<div class="tab-content">
    						<!-- Department -->
    						<div id="home" class="tab-pane fade in active">
    							<br />
    							<form method="post" name="admin_form">
    								<div class="form-group">
    									<input type="text" class="form-control" name="username" placeholder="Username">
    								</div>
    								<div class="form-group">
    									<input type="password" class="form-control" name="pass" placeholder="Password">
    								</div>
    								<div class="form-group">
    									<button class="btn btn-block btn-success" id = "btn-login" name = "btn-login">SIGN IN</button>
    								</div>
    								<div class="form-group" id="alert-msg">
    								</div>
    							</form>
    						</div>
                                                
    						<div id="menu2" class="tab-pane fade">
    							<br />
    							<form method="post" name="cashier_form">
    								<div class="form-group">
    									<input type="text" class="form-control" name="cashier_username" placeholder="Username">
    								</div>
    								<div class="form-group">
    									<input type="password" class="form-control" name="cashier_pass" placeholder="Password">
    								</div>
    								<div class="form-group">
    									<button class="btn btn-block btn-success" id = "btn" name = "btn">SIGN IN</button>
    								</div>
    								<div class="form-group" id="alert-msg1">
    								</div>
    							</form>
    						</div>
                                               
    					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
    	<!-- jQuery -->
    	<script src="../vendor/jquery/jquery.min.js"></script>

    	<!-- Bootstrap Core JavaScript -->
    	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    	<!-- Metis Menu Plugin JavaScript -->
    	<script src="../vendor/metisMenu/metisMenu.min.js"></script>

    	<!-- Custom Theme JavaScript -->
    	<script src="../dist/js/sb-admin-2.js"></script>

    	<script type="text/javascript">
    		jQuery(function(){
    			$('form[name="admin_form"]').on('submit', function(donard){
    				donard.preventDefault();

    				var a = $(this).find('input[name="username"]').val();
    				var b = $(this).find('input[name="pass"]').val();

    				if (a === '' && b ===''){
    					$('#alert-msg').html('<div class="alert alert-danger">All fields are required!</div>');
    				}else{
    					$.ajax({
    						type: 'POST',
    						url: 'new_login.php',
    						data: {
    							username: a,
    							password: b
    						},
    						beforeSend:  function(){
    							$('#alert-msg').html('');
    						}
    					})
    					.done(function(donard){
    						if (donard == 0){
    							$('#alert-msg').html('<div class="alert alert-danger">Incorrect username or password!</div>');
    						}else{
    							$("#btn-login").html('<img src="find me/loading.gif" /> &nbsp; Signing In ...');
    							setTimeout(' window.location.href = "home.php"; ',2000);
    						}
    					});
    				}
    			});

    			$('form[name="cashier_form"]').on('submit', function(donard){
    				donard.preventDefault();

    				var a = $(this).find('input[name="cashier_username"]').val();
    				var b = $(this).find('input[name="cashier_pass"]').val();

    				if (a === '' && b ===''){
    					$('#alert-msg1').html('<div class="alert alert-danger">All fields are required!</div>');
    				}else{
    					$.ajax({
    						type: 'POST',
    						url: 'cashier/new_login.php',
    						data: {
    							username: a,
    							password: b
    						},
    						beforeSend:  function(){
    							$('#alert-msg1').html('');
    						}
    					})
    					.done(function(donard){
    						if (donard == 0){
    							$('#alert-msg1').html('<div class="alert alert-danger">Incorrect username or password!</div>');
    						}else{
    							$("#btn").html('<img src="find me/loading.gif" /> &nbsp; Signing In ...');
    							setTimeout(' window.location.href = "cashier/sales.php?id=cash&invoice=<?php echo $finalcode ?>"; ',2000);
    						}
    					});
    				}
    			});
    		});
    	</script>

    </body>

    </html>
