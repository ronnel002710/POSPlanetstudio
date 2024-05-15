<?php
require_once('auth.php');
?>
<html>
<head>
  <title>P.O.S System</title>
  <link rel="shortcut icon" href="../src/logo.png">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="dist/css/sb-admin-2.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<style>
	body{
		font-family: "Lucida Console", "Courier New", monospace;
	}
	#table1{
		 border-collapse: collapse;
		 border: 1px solid #eee;
		 font-family: "Lucida Console", "Courier New", monospace;
	}
	hr{
		height: 1px;
		background-color: #eee;
		border: 1px dotted #ccc;
	}
	p{
		
		text-align:justify;
	}
</style>

<script language="javascript">
	function Clickheretoprint()
	{ 
		var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
		disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
		var content_vlue = document.getElementById("content").innerHTML; 

		var docprint=window.open("","",disp_setting); 
		docprint.document.open(); 
		docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');          
		docprint.document.write(content_vlue); 
		docprint.document.close(); 
		docprint.focus(); 
	}
</script>
</head>
 <body style="background:white;font-family:;">
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
<div class="container">
<a class = "btn btn-success btn-sm" href="javascript:Clickheretoprint()" style="font-size:20px";><i class="glyphicon glyphicon-print" ></i> Print</a>|<a class = "btn btn-default btn-sm" href="sales.php?id=cash&invoice=<?php echo $finalcode ?>" style="font-size:20px"> <i class="fa fa-arrow-circle-left"></i> Back</a>

</div>
<br/>
<?php
$invoice=$_GET['invoice'];
include('connect.php');
$result = $db->prepare("SELECT * FROM sales WHERE invoice_number= :userid");
$result->bindParam(':userid', $invoice);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
	$cname=$row['name'];
	$invoice=$row['invoice_number'];
	$date=$row['date'];
	$cash=$row['due_date'];
	$cashier=$row['cashier'];

	$pt=$row['type'];
	$am=$row['amount'];
	if($pt=='cash'){
		$cash=$row['cash'];
		$amount=$cash-$am;
	}
}

?>

<center>
<div class="content container" id="content" style="background:#fff">
			<div style="width: 139.7mm;">
			<hr style="border: 1px dashed #000"/>
				<table width="100%">
					<tr>
						<th style="font-size:25pt"><center>PLANETSTUDIO</center></th>
					</tr>
					
					<tr>
						<td><center>Invoice: <?=$invoice;?></center></td>
						
					</tr>
					<tr>
					<td><center>Date: <?=date('Y-m-d');?></center></td>
					</tr>
					
					<tr>
						<th><br></th>
					</tr>
					<tr>
						<th><center>*** RECEIPT ***</center></th>
					</tr>
					
				</table>	
			<hr style="border: 1px dashed #000"/>
			</div>
			
			<div style="width: 139.7mm;">
			
				<table border="0" cellpadding="4" cellspacing="0"  style="font-size: 15px;text-align:left;" width="100%">
					<thead>
						<tr>
							<th> ITEM</th>
							<th> QTY</th>
							<th> PRICE </th>
							<th style="float:right"> SUB TOTAL</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$id=$_GET['invoice'];
						$result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid");
						$result->bindParam(':userid', $id);
						$result->execute();
						for($i=0; $row = $result->fetch(); $i++){
							?>
							<tr class="record">
								<td hidden><?php echo $row['product']; ?></td>
								<td><?php echo $row['dname']; ?></td>
								<td><?php echo $row['qty']; ?></td>
								
								<td>
									&#8369; <?php
									$ppp=$row['price'];
									echo formatMoney($ppp, true);
									?>
								</td>
								<td align="right">
									<?php
									$dfdf=$row['total_amount'];
									echo formatMoney($dfdf, true);
									?>
								</td>

							</tr>
							<?php
						}
						?>
					
						<tr>
							<td colspan="4">
								<hr style="border: 1px dashed #000"/>
							</td>
						</tr>
						
						<?php if($pt=='cash'){
							?>
							
							<tr>
								<td colspan="3" align="left"><strong>Total Amount</strong></td>
								<td colspan="1" align="right">
									<?php
									$sdsd=$_GET['invoice'];
									$resultas = $db->prepare("SELECT sum(total_amount) FROM sales_order WHERE invoice= :a");
									$resultas->bindParam(':a', $sdsd);
									$resultas->execute();
									for($i=0; $rowas = $resultas->fetch(); $i++){
										$fgfg=$rowas['sum(total_amount)'];
										echo formatMoney($fgfg, true);
									}
									?>
								</td>
							</tr>
							
							<tr>
							<td colspan="3" align="left"><strong>Vat</strong></td>
							<td colspan="1" align="right">
								<?php
								$sdsd=$_GET['invoice'];
								$resultas = $db->prepare("SELECT sum(vat) FROM sales_order WHERE invoice= :a");
								$resultas->bindParam(':a', $sdsd);
								$resultas->execute();
								for($i=0; $rowas = $resultas->fetch(); $i++){
									$fgfg=$rowas['sum(vat)'];
									echo formatMoney($fgfg, true);
								}
								?>
							</td>
						</tr>
							<tr>
								<td colspan="3" align="left"><strong>Cash </strong></td>
								<td colspan="1" align="right">
									<?php
									echo formatMoney($cash, true);
									?>
								</td>
							</tr>
						
							
								<?php
						}
						?>
						<tr>
							<td colspan="3" align="left">
								<?php
								if($pt=='cash'){
									echo '<strong>Change</strong>';
								}
								if($pt=='credit'){
									echo 'Due Date:';
								}
								?>
							</td>

							<td colspan="2" align="right">
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
								if($pt=='credit'){
									echo $cash;
								}
								if($pt=='cash'){
									echo formatMoney($amount, true);
								}
								?>
							</td>
						</tr>
						<td><br/><br/><b>Customer/s<b><td>
						
						<?php
						$customer=$_GET['invoice'];
						$result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid");
						$result->bindParam(':userid', $id);
						$result->execute();
						for($i=0; $row = $result->fetch(); $i++){
							?>
							<tr class="record">
								<td><i><?php echo $row['customer_name']; ?></i></td>
							</tr>
							<?php
						}
						?>
						
						</tr>
					</thead>
					</tbody>
				</table>
			</div>

			<div style="margin-top: 13px;width:139.7mm;height:120.65mm">
			<span style="text-align:left;">Cashier: <?=$cashier ?></span>
			
			<hr style="border: 1px dashed #000"/>
			<name >
			 Thank you for choosing our service.We look forward to meet you again. Money once paid will not we refunded. However, it can be abjected towards any services
			</name>
			<hr style="border: 1px dashed #000"/>
			</div>
		</div>
		</center>

</body>
</html>
