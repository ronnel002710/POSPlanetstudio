<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php include "header.html";?>

</head>

<body>
<br/>

<div class ="container" style="background:#fff;padding:5px;">
<div class="col-md-12">
  
  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
	 <tr>
		<td colspan="3">
		<?php
		  $supplier=$_GET['supplier'];
		  ?>
		  <h3 style="text-align:center"><?php echo $supplier;  ?>'s</h3>
		  <div style="text-align:center;">
			<?php
			$id=$_GET['id'];
			include('connect.php');
			$resultaz = $db->prepare("SELECT * FROM purchases WHERE invoice_number= :xzxz");
			$resultaz->bindParam(':xzxz', $id);
			$resultaz->execute();
			for($i=0; $rowaz = $resultaz->fetch(); $i++){
			  $A = $rowaz['transaction_id'];
			  $B = $rowaz['invoice_number'];
			  $C = $rowaz['date_order'];
			  $D = $rowaz['suplier'];
			  $E = $rowaz['date_deliver'];
			}
			?>
			<?php
			  echo 'Transaction ID : TR-'.$A.'<br>';
			  echo 'Invoice Number : '.$B.'<br>';
			  echo 'Date Order: '.$C.'<br>';
			  echo 'Supplier : '.$D.'<br>';
			  echo 'Date Delivery : '.$E.'<br>';
			?>
		  </div>
		</td>
	 </tr>
     <tr>
      <th width="10%"> Product Name </th>
      <th width="5%"> Quantity </th>
      <th width="5%"> Cost </th>
    </tr>
  </thead>
  <tbody>

   <?php
   $id=$_GET['id'];
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
        <td><?php echo $row['qty']; ?></td>
        <td>
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
      <td colspan="2"><strong style="font-size: 12px; color: #222222;">
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
    $sdsd=$_GET['id'];
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

<div class = "pull-right">
  <button onclick="myFunction()" id="btnPrint" class="btn btn-primary btn-sm " >
    Print PO Form
  </button>
</div>   
<a href = "purchaseslist.php" class="btn btn-primary btn-sm " >
  Back    
</a>
</div>
</div>
<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
<script>
  $(document).ready(function() {
    $('#dataTables-example').DataTable({
      responsive: true
    });
  });
</script>

<script>
 function myFunction() {
   window.print();
 }
</script>



</body>

</html>