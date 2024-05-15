<?php
require_once('auth.php');
?>
<html>
	<head>
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	 <link rel="shortcut icon" href="src/logo.jpg">
	<title>Invoice</title>
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
	 <style>

	#table2 tr, td{
	  border-collapse: collapse;
	  border-color: none;
	  font-size:11pt;
	  padding: 2px;
	}
	  </style>
 </head>
 <body style="background:white">
	<br/>
	<!---<div class="container">
	<a href="javascript:Clickheretoprint()" style="font-size:20px"  class="btn btn-success btn-sm" title="Print" data-toggle="tooltip">
        <i class="glyphicon glyphicon-print" ></i> Print</a> | 
	<a href="salesreport.php" style="font-size:20px" class="btn btn-default btn-sm" title="Back" data-toggle="tooltip"><i class="fa fa-arrow-circle-left"></i> Back</a>
	</div>---->

	<?php
	$invoice=$_GET['id'];
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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a class = "btn btn-default btn-sm" href="salesreport.php" style="font-size:20px"> <i class="fa fa-arrow-circle-left"></i> Back</a>
	<div class="container" id="content">
	<hr style="border-top: 1px dashed #ccc"/>
			<div style="width: 100%;">
				<table width="100%>
					<thead>
						<tr>
							<td rowspan="4" width="100"><img src="src/logo.png" class="img-thumbnail" width="100"/></td>
						</tr>
						<tr>
							<td><b>PLANETSTUDIO</b></td>
							<td align="right"><b>SALES INVOICE</b></td>
						</tr>
						<tr>
							<td>Street Address: Roman Diaz Street, Calinan, Davao City</td>
							<td align="right">Invoice#: <?php echo $invoice;?></td>
						</tr>
						<tr>
							<td>Email Address : planetjup2020@gmail.com</td>
							<td align="right">Date: <?php echo $date;?></td>
						</tr>
					</thead>
				</table>
			</div>
			<hr style="border-top: 1px dashed #ccc"/>
			<div style="width: 100%">
				<table width="100%" border="0" id="table2"  class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th> CODE</th>
							<th> ITEM </th>
							<th> QTY </th>
							<th> PRICE </th>
							<th> DISCOUNT </th>
							<th> AMOUNT </th>
						</tr>
					</thead>
					<tbody>

						<?php
						$id=$_GET['id'];
						$result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid");
						$result->bindParam(':userid', $id);
						$result->execute();
						for($i=0; $row = $result->fetch(); $i++){
							?>
							<tr class="record">
								<td><?php echo $row['product']; ?></td>
								
								<td><?php echo $row['dname']; ?></td>
								<td><?php echo $row['qty']; ?></td>
								<td>
									&#8369; <?php
									$ppp=$row['price'];
									echo formatMoney($ppp, true);
									?>
								</td>
								<td>
									&#8369; <?php
									$ddd=$row['discount'];
									echo formatMoney($ddd, true);
									?>
								</td>
								<td>
									&#8369; <?php
									$dfdf=$row['total_amount'];
									echo formatMoney($dfdf, true);
									?>
								</td>
							</tr>
							<?php
						}
						?>
						<tr>
							<td colspan="6">
							<hr style="border-top: 1px dashed #ccc"/>
							</td>
						</tr>
						<tr>
							<td colspan="5" align="right"><strong style="font-size: 12px; color: #222222;">Sub Total:</strong></td>
							<td colspan="2"><strong style="font-size: 12px; color: #222222;">
								&#8369; <?php
									$sdsd=$_GET['id'];
									$resultas = $db->prepare("SELECT sum(total_amount) FROM sales_order WHERE invoice= :a");
									$resultas->bindParam(':a', $sdsd);
									$resultas->execute();
									for($i=0; $rowas = $resultas->fetch(); $i++){
										$fgfg=$rowas['sum(total_amount)'];
										echo formatMoney($fgfg, true);
									}
									?>
							</strong></td>
						</tr>
						<tr>
							<td colspan="5" align="right"><strong style="font-size: 12px; color: #222222;">Vat:</strong></td>
							<td colspan="2">
							<strong style="font-size: 12px; color: #222222;">
								&#8369; <?php
								$sdsd=$_GET['id'];
								$resultas = $db->prepare("SELECT sum(vat) FROM sales_order WHERE invoice= :a");
								$resultas->bindParam(':a', $sdsd);
								$resultas->execute();
								for($i=0; $rowas = $resultas->fetch(); $i++){
									$fgfg=$rowas['sum(vat)'];
									echo formatMoney($fgfg, true);
								}
								?>
								</strong>
							</td>
						</tr>
						<?php if($pt=='cash'){
							?>
							<tr>
								<td colspan="5" align="right"><strong style="font-size: 12px; color: #222222;">Cash Tendered:</strong></td>
								<td colspan="2"><strong style="font-size: 12px; color: #222222;">
									&#8369; <?php
									echo formatMoney($cash, true);
									?>
								</strong></td>
							</tr>
							
							<tr>
								<td colspan="5" align="right"><strong style="font-size: 12px; color: #222222;">Total Amount:</strong></td>
								<td colspan="2" ><strong style="font-size: 12px; color: #222222;">
									&#8369; <?php
									$sdsd=$_GET['id'];
									$resultas = $db->prepare("SELECT sum(total_amount) FROM sales_order WHERE invoice= :a");
									$resultas->bindParam(':a', $sdsd);
									$resultas->execute();
									for($i=0; $rowas = $resultas->fetch(); $i++){
										$fgfg=$rowas['sum(total_amount)'];
										echo formatMoney($fgfg, true);
									}
									?>
								</strong></td>
							</tr>
							<?php
						}
						?>
						
						<tr>
							<td colspan="5" align="right" ><strong style="font-size: 12px; color: #222222;">
								<?php
								if($pt=='cash'){
									echo 'Change:';
								}
								if($pt=='credit'){
									echo 'Due Date:';
								}
								?>
							</strong></td>

							<td colspan="2" ><strong style="font-size: 12px; color: #222222;">
								&#8369; <?php
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
							</strong></td>
							
						</tr>
					</tbody>
					<tfoot>
					<tr>
					  <td colspan="6"><div style="text-align: left; margin-top: 13px;">Cashier : <u><?php echo $cashier ?></u></div></td>
					</tr>
					</tfoot>
				</table>
				<hr style="border-top: 1px dashed #ccc"/>
			<name>
			 Thank you for choosing our service.We look forward to meet you again. Money once paid will not we refunded. However, it can be abjected towards any services
			</name>
			<hr style="border-top: 1px dashed #ccc"/>
			</div>
	</div>
</body>
</html>
