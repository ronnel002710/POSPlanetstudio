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
<form action="saveeditproduct.php" method="post" class = "form-group">
	<div id="ac">
	<input type="hidden" name="memi" value="<?php echo $id; ?>" />
	<span>Product Code : </span><input type="text" name="code" class = "form-control" value="<?php echo $row['product_code']; ?>" readonly />
	<span>Brand Name : </span><input type="text" name="bname" class = "form-control" value="<?php echo $row['product_name']; ?>" />
	<span>Description Name : </span><input type="text" name="dname" class = "form-control" value="<?php echo $row['description_name']; ?>" />
	<span>Quantity : </span><input type="text" name="qty" class = "form-control" value="<?php echo $row['qty_left']; ?>" />
	<span>Cost : </span><input type="text" name="cost" class = "form-control" value="<?php echo $row['cost']; ?>">
	<span>Price : </span><input type="text" name="price" class = "form-control" value="<?php echo $row['price']; ?>" />
	
	<span>Category: </span>
	<select name="categ" class = "form-control" required>
	<option><?php echo $row['category']; ?></option>
		 <?php
			include('connect.php');
			$result = $db->prepare("SELECT * FROM category");
			$result->bindParam(':userid', $res);
			$result->execute();
			for($i=0; $row = $result->fetch(); $i++){
				?>
				<option value="<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; ?></option>
				<?php
			}
			?>
		</select>
	<br/>
	<span>&nbsp;</span><button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save fa-fw"></i> Update</button>
	<span>&nbsp;</span><a href="products.php" class="btn btn-default btn-sm"> <i class="fa fa-times-circle fa-fw"></i> Cancel</a>
</div>
</form>
<?php
}
?>