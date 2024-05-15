<?php
require_once('auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "header.html";?>
</head>
<body>
<div id="wrapper">
	<?php include('navfixed.php');?>
	<div id="page-wrapper">
	<br/>
	<div class="box box-success">
		<div class="box-header with-border">
		<h3 class="box-title">USER TABLE</h3>
        </div>
	  <div class="box-body">
		<div class="col-lg-12">
			<?php
			if(isset($_SESSION['error'])){
			  echo "
				<div class='alert alert-danger alert-dismissible'>
				  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				  <h4><i class='icon fa fa-warning'></i> Error!</h4>
				  ".$_SESSION['error']."
				</div>
			  ";
			  unset($_SESSION['error']);
			}
			if(isset($_SESSION['success'])){
			  echo "
				<div class='alert alert-success alert-dismissible'>
				  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				  <h4><i class='icon fa fa-check'></i> Success!</h4>
				  ".$_SESSION['success']."
				</div>
			  ";
			  unset($_SESSION['success']);
			}
		  ?>
	  </div>
		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-plus-square fa-fw"></i> Add User
				</div>
				<div class="panel-body">
					<form action="user_add.php" method="POST" autocomplete="off">
						<div id="ac">
					<span>USERNAME : </span><input type="text" name="user" placeholder="Username" class = "form-control" required />
					<span>PASSWORD: </span><input type="password" name="pass" placeholder="Password" class = "form-control" required />
					<span>FULL NAME : </span><input type="text" name="name" placeholder="Complete Name" class = "form-control" required />
					<span>POSITION: </span>
					<select name = "post" class = "form-control" required>
						<option>Cashier</option>
					</select>    
				</div>
				</div>
				<div class="panel-footer"><button type="submit" class="btn btn-success btn-sm" name="user_add"> <i class="glyphicon glyphicon-floppy-save"></i> Submit</button></div>
				</form>
			</div>
			<!-- /.panel -->
		</div>

		<div class="col-lg-8">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="glyphicon glyphicon-th-list"></i> List of User 
				</div>
				<div class="panel-body">
					<div id="morris-line-chart">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                        <thead>
                            <tr>
                                <th> Name</th>
                                <th> Username</th>
                                <th> Password</th>
                                <th> Status</th>
                                <th> Tools </th>
                            </tr>
                        </thead>
						 <tbody>
							<?php
							include_once'../conn.php';
								$select = $pdo->prepare('SELECT * FROM cashier ORDER BY cashier_name');
								$select->execute();
								while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
								  <tr>
									
									<td><?php echo $row->cashier_name; ?></td>
									<td><?php echo $row->username; ?></td>
									<td><?php echo $row->password; ?></td>
									<td><?php echo $row->status; ?></td>
									<td>
										<a href="user_update.php?id=<?php echo $row->cashier_id; ?>"
										class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
										<a href="user_delete.php?id=<?php echo $row->cashier_id; ?>"
										onclick="return confirm('Are you sure do you really want to delete this user?')"
										class="btn btn-danger btn-sm" name="btn_delete"><i class="fa fa-trash"></i></a>
									</td>
								  </tr>
								<?php
								}
							?>
                         </tbody>
                        </table>
					 </div>
					</div>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div> <!--BOX BODY-->
		
	  </div>
	  </div> <!-- /.PAGE WRAPPER -->
	
<!-- /.row -->
</div><!-- /.WRAPPER -->
	<?php include "footer.html"; ?>
</body>
</html>
