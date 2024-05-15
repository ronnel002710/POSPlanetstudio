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
		<h3 class="box-title">JOB ORDER CATEGORY</h3>
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
		<div class="col-lg-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-plus-square fa-fw"></i> Add Category
				</div>
				<div class="panel-body">
					<form action="product_category_add.php" method="POST" autocomplete="off">
						<div class="form-group">
						  <input type="text" class="form-control" name="category" placeholder="Enter Category" required>
						</div>
				</div>
				<div class="panel-footer"><button type="submit" class="btn btn-success btn-sm" name="submit"> <i class="glyphicon glyphicon-floppy-save"></i> Submit</button></div>
				</form>
			</div>
			<!-- /.panel -->
		</div>

		<div class="col-lg-7">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="glyphicon glyphicon-th-list"></i> Category List
				</div>
				<div class="panel-body">
					<div id="morris-line-chart">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                        <thead>
                            <tr>
                                <th> Category Name </th>
                                <th> Tools </th>
                            </tr>
                        </thead>
						 <tbody>
							<?php
							include_once'../conn.php';
								$select = $pdo->prepare('SELECT * FROM category ORDER BY cat_name');
								$select->execute();
								while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
								  <tr>
									
									<td><?php echo $row->cat_name; ?></td>
									<td>
										<a href="edit_category.php?id=<?php echo $row->cat_id; ?>"
										class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
										<a href="delete_category.php?id=<?php echo $row->cat_id; ?>"
										onclick="return confirm('Remove Category?')"
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
