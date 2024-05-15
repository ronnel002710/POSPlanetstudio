<?php
	include('connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
   <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- MetisMenu CSS -->
	<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<style>
		#ac{
		background:#eee;
		padding:10px;
		border-top-left-radius: 3px;
		border-top-right-radius: 3px;
		border-bottom-left-radius: 3px;
		border-bottom-right-radius: 3px;
		}
	</style>
	<div id="ac">
	<h4><label class="label label-success">PRODUCT DETAILS</label></h4>
	<b><span>Product Code : </span></b><?php echo $row['product_code']; ?><br/>
	<b><span>Brand Name : </span></b><?php echo $row['product_name']; ?><br/>
	<b><span>Product Name : </span></b><?php echo $row['description_name']; ?><br/>
	<b><span>Qty Left: </span></b><?php echo $row['qty_left']; ?><br/>
	<b><span>Unit : </span></b><?php echo $row['unit']; ?><br/>
	<b><span>Cost : </span></b><?php echo $row['cost']; ?><br/>
	<b><span>Price : </span></b><?php echo $row['price']; ?><br/>
	<b><span>Category: </span></b><?php echo $row['category']; ?><br/>
	
</div>

<?php
}
?>