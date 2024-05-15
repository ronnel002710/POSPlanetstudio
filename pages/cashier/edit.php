<html>
<head>
<title>UPDATE</title>
</head>
<body >
<br/>
<form action="edit_save.php" method="post" class="form-horizontal">
<div id="ac" style="background: #eee;padding:10px" >
<label> Update Quantity</label>
<input type="hidden" name="cash" value="<?=$_GET['dle']; ?>" />
<input type="hidden" name="invoice" value="<?=$_GET['invoice']; ?>" />
<input type="hidden" name="transaction_id" value="<?=$_GET['transaction_id']; ?>" />
<input type="hidden" name="productcode" value="<?=$_GET['productcode']; ?>" />

<input type="number" name="qty" autocomplete="off" class="form-control" style="height:100px;font-size:12pt;text-align:center" placeholder="Enter Quantity" required /><br>
<button class="btn btn-success btn-block" type="submit"><i class="fa fa-check-square-o"></i> Save</button>
</div>
</form>

</body>
</html>