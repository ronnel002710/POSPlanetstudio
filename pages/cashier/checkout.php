<html>
<head>
 <title>P.O.S System</title>
<link rel="shortcut icon" href="../src/logo.png">
</head>
<body >
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<br/>
<form action="savesales.php" method="post" class="form-horizontal">
<div id="ac" style="background: #eee;padding:10px" >
<h4>Are you sure about all the details provided? If you do Please Enter Cash Amount.</h4>
<label>Cash Amount</label>
<input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>" />
<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
<input type="hidden" id="amount" name="amount" value="<?php echo $_GET['total']; ?>" />
<input type="hidden" name="ptype" value="<?php echo $_GET['pt']; ?>" />
<input type="hidden" name="cashier" value="<?php echo $_GET['cashier']; ?>" />
<input type="hidden" name="p_amount" value="<?php echo $_GET['p_amount']; ?>" />
<!-- <input type="hidden" name="customers" value="<?php echo $_GET['customers']; ?>" />
<input type="hidden" name="pt" class = "form-control" value="<?php echo $_GET['id']; ?>" />
             -->

<?php
$asas=$_GET['pt'];
if($asas=='credit') {
?><input type="date" name="due" placeholder="Due Date" style="width: 268px; margin-bottom: 15px;" /><br>
<?php
}
if($asas=='cash') {
?><input type="number" name="cash" autocomplete="off" class="form-control" style="height:100px;font-size:15pt;text-align:center" placeholder="Enter Amount" required /><br>
<?php
}
?><button class="btn btn-success btn-block" type="submit"> <i class="fa fa-check-square-o"></i> Save</button>
</div>
</form>

</body>
</html>