<?php  include_once'auth.php';?>
<?php
 
  include_once'../conn.php';
  if($id=$_GET['id']){
    $select = $pdo->prepare("SELECT * FROM product_unit WHERE unit_id = '".$_GET['id']."' ");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_OBJ);
    $unit = $row->unit;
    $unit_id = $row->unit_id;
  }else{
    header('location:product_category.php');
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
		<h3 class="box-title">UPDATE UNIT</h3>
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
				 <i class="glyphicon glyphicon-edit"></i> Update Unit Name
			</div>
			<div class="panel-body">
				<form action="product_unit_edit.php" method="POST" autocomplete="off">
					<div class="form-group">
					  <input type="hidden" class="decid" value="<?php echo $unit_id;?>" name="id">
						<input type="text" class="form-control" name="unit" placeholder="Enter unit" value="<?php echo $unit;?>" required>
					</div>
			</div>
			<div class="panel-footer"><button type="submit" class="btn btn-success btn-sm" name="btn_unit"> <i class="glyphicon glyphicon-floppy-save"></i> Update</button></div>
			</form>
		</div>
		<!-- /.panel -->
	</div>

		<div class="col-lg-7">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="glyphicon glyphicon-th-list"></i> Unit List
				</div>
				<div class="panel-body">
					<div id="morris-line-chart">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Category Name </th>
                                <th> Tools </th>
                            </tr>
                        </thead>
						 <tbody>
							<?php
							include_once'../conn.php';
								$select = $pdo->prepare('SELECT * FROM product_unit ORDER BY unit asc');
								$select->execute();
								while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
								  <tr>
									<td><?php echo $row->unit_id; ?></td>
									<td><?php echo $row->unit; ?></td>
									<td>
										<a href="edit_unit.php?id=<?php echo $row->unit_id; ?>"
										class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
										<a href="delete_unit.php?id=<?php echo $row->unit_id; ?>"
										onclick="return confirm('Do you want to remove this product unit?')"
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
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div> <!--BOX BODY-->
		
	  </div>
	  </div> <!-- /.PAGE WRAPPER -->
	</div>
<!-- /.row -->
</div><!-- /.WRAPPER -->
<?php include "footer.html";?>
</body>
</html>
