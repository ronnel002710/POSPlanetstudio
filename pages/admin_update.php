<?php
require_once('auth.php');
?>
<?php
  include_once'../conn.php';
  if($id=$_GET['id']){
    $select = $pdo->prepare("SELECT * FROM user WHERE id = '".$_GET['id']."' ");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_OBJ);
    $id  = $row->id ;
    $username = $row->username;
	$password = $row->password;
    $name = $row->name;
    $role = $row->role;
    $firstname = $row->firstname;
    $status = $row->status;
	
  }else{
    header('location:user_update.php');
  }
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
		<h3 class="box-title">UPDATE USER ADMIN</h3>
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
					<i class="fa fa-plus-square fa-fw"></i> USER INFORMATION
				</div>
				<div class="panel-body">
					<form action="admin_update_save.php" method="POST" autocomplete="off">
					<div id="ac">
					<input type="hidden" class="decid" value="<?php echo $id;?>" name="id">
					<span>USERNAME : </span><input type="text" name="user" value="<?php echo $row->username;?>" class = "form-control" readonly />
					<span>PASSWORD: </span><input type="text" name="pass" value="<?php echo $row->password;?>" class = "form-control"  />
					<span>FULL NAME : </span><input type="text" name="firstname" value="<?php echo $row->firstname;?>" class = "form-control" />
				<span>STATUS: </span>
					<select name = "status" class = "form-control" required>
						<option><?php echo $row->status;?></option>
						<option></option>
						<option>Active</option>
						<option>DeActive</option>
					</select>   					
				</div>
				</div>
				<div class="panel-footer">
				<button type="submit" class="btn btn-success btn-sm" name="admin_update"> <i class="glyphicon glyphicon-floppy-save"></i> Update</button>
				</div>
				</form>
			</div>
			<!-- /.panel -->
		</div>

		<div class="col-lg-8">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="glyphicon glyphicon-th-list"></i> List of Admin User
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
								$select = $pdo->prepare('SELECT * FROM user ORDER BY firstname');
								$select->execute();
								while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
								  <tr>
									
									<td><?php echo $row->firstname; ?></td>
									<td><?php echo $row->username; ?></td>
									<td><?php echo $row->password; ?></td>
									<td><?php echo $row->status; ?></td>
									<td>
										<a href="admin_update.php?id=<?php echo $row->id; ?>"
										class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
										<a href="admin_delete.php?id=<?php echo $row->id; ?>"
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
