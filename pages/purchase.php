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
		<h3 class="box-title"><?php echo $_GET['name']; ?></h3>
        </div>
	  <div class="box-body">
	  <div class="col-lg-5">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-info-circle fa-fw"></i> Purchase Order Form
			</div>
			<div class="panel-body">
		<form action="savepurchase.php" method="post" class = "form-group">
        <input type="hidden" name="invoice" class = "form-control" value="<?php echo $_GET['invoice']; ?>" />
        <?php
        $today = date('Y-m-d');
        ?>
        <label>Date : </label>
		<input type="text"  class = "form-control" name="date" value = "<?php echo $today; ?>" required readonly />
        <label>Supplier : </label>
		<input type = "text"  class = "form-control" name = "supplier" value = "<?php echo $_GET['name']; ?>" required readonly>
        <label>Delivery Date : </label>
		<input type="date" class = "form-control" name="date_delivered" required />
        <input type="hidden" class = "form-control"  value="<?php echo $_GET['name']; ?>" />
        <label>Select a Product</label><br />
        <select name="product" class="chzn-select form-control">
         <?php
         include('connect.php');
         $id =$_GET['name'];
         $result = $db->prepare("SELECT * FROM products WHERE supplier = :supp");
         $result->bindParam(':supp', $id);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){
          ?>
          <option value="<?php echo $row['product_code']; ?>"><?php echo $row['product_name']; ?> - <?php echo $row['description_name']; ?></option>
          <?php
        }
        ?>
      </select>
      <label>Number of items </label>
      <input type="text" name="qty" class ="form-control" value="" placeholder="Qty" autocomplete="off" />
      <label> Status </label>
      <input type ="text" name = "status" value = "pending" class = "form-control" required readonly>
			</div>
			<div class="panel-footer">
			<button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-plus-square fa-fw"></i> Add Product</button>
			</div>
			</form>
		</div>
		<!-- /.panel -->
	</div>

		<div class="col-lg-7">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-list-ul fa-fw"></i> Purchase Order
				</div>
				<div class="panel-body">
					<div id="morris-line-chart">
						
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
							  <thead>
							   <tr>
								<th> Product Name </th>
								<th> Quantity </th>
								<th> Cost </th>
							  </tr>
							</thead>
							<tbody>

							 <?php
							 $id=$_GET['invoice'];
							 include('connect.php');
							 $result = $db->prepare("SELECT * FROM purchases_item WHERE invoice= :userid");
							 $result->bindParam(':userid', $id);
							 $result->execute();
							 for($i=0; $row = $result->fetch(); $i++){
							  ?>
							  <tr class="record">
								<td><?php
								  $rrrrrrr=$row['name'];
								  $resultss = $db->prepare("SELECT * FROM products WHERE product_code= :asas");
								  $resultss->bindParam(':asas', $rrrrrrr);
								  $resultss->execute();
								  for($i=0; $rowss = $resultss->fetch(); $i++){
									echo $rowss['description_name'];
								  }
								  ?></td>
								  <td align="right"><?php echo $row['qty']; ?></td>
								  <td align="right">
									<?php
									$dfdf=$row['cost'];
									echo formatMoney($dfdf, true);
									?>
								  </td>
								</tr>
								<?php
							  }
							  ?>
							  <tr>
								<td colspan="2"><strong style="font-size: 12px; color: #222222;">Total:</strong></td>
								<td align="right" colspan="2"><strong style="font-size: 12px; color: #222222;">
								 <?php
								 function formatMoney($number, $fractional=false) {
								  if ($fractional) {
								   $number = sprintf('%.2f', $number);
								 }
								 while (true) {
								   $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
								   if ($replaced != $number) {
									$number = $replaced;
								  } else {
									break;
								  }
								}
								return $number;
							  }
							  $sdsd=$_GET['invoice'];
							  $resultas = $db->prepare("SELECT sum(cost) FROM purchases_item WHERE invoice= :a");
							  $resultas->bindParam(':a', $sdsd);
							  $resultas->execute();
							  for($i=0; $rowas = $resultas->fetch(); $i++){
								$fgfg=$rowas['sum(cost)'];
								echo formatMoney($fgfg, true);
							  }
							  ?>
							</strong></td>
						  </tr>

						</tbody>
						</table>
					</div>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		
	  </div>
	</div>
	
<!-- /.row -->
</div>
</div>




<script src="../vendor/jquery/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
<link href="vendors/chosen.min.css" rel="stylesheet" media="screen">
<script src="vendors/chosen.jquery.min.js"></script>
<script>
  $(function() {
    $(".chzn-select").chosen();

  });
</script>
</body>
</html>