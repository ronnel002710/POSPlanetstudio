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
		<h3 class="box-title">PURCHASE LIST</h3>
        </div>
		<div class="box-body ">
          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
             <tr>
			  <th> Supplier </th>
              <th> Date Order</th>
              <th> Date Delivery</th>
              <th> Product Code </th>
              <th> Product Name</th>
              <th> Price</th>
              <th> Qty </th>
              <th> Cost </th>
              <th> Status </th>
              <th> Action </th>
            </tr>
          </thead>
          <tbody >


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

          include('connect.php');
          $result = $db->prepare("SELECT * FROM purchases");
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
            ?>
            <tr class="record">
			 <td><?php echo $row['suplier']; ?></td>
             <td><?php echo $row['date_order']; ?></td>
             <td><?php echo $row['date_deliver']; ?></td>
             <td><?php echo $row['p_name']; ?></td>

             <td><?php
               $rrrrrrr=$row['p_name'];
               $resultss = $db->prepare("SELECT * FROM products WHERE product_code= :asas");
               $resultss->bindParam(':asas', $rrrrrrr);
               $resultss->execute();
               for($i=0; $rowss = $resultss->fetch(); $i++){
                echo $rowss['description_name'];
              }
              ?></td>
               <td><?php
               $rrrrrrr=$row['p_name'];
               $resultss = $db->prepare("SELECT * FROM products WHERE product_code= :asas");
               $resultss->bindParam(':asas', $rrrrrrr);
               $resultss->execute();
               for($i=0; $rowss = $resultss->fetch(); $i++){
                echo $rowss['cost'];
              }
              ?></td>
              <td><?php echo $row['qty']; ?></td>
			 
              <td><?php
                $dsdsd=$row['cost'];
                echo formatMoney($dsdsd, true);
                ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><a href="#" id="<?php echo $row['transaction_id']; ?>" class="btn btn-danger delbutton btn-sm" title="Click To Delete">
                <span><i class="fa fa-trash"></i></span>
                </a> 
                <a rel="facebox" class = "btn btn-success btn-sm"  href="stockin.php?name=<?php echo $row['p_name']; ?>&iv=<?php echo $row['invoice_number']; ?>&qty=<?php echo $row['qty']; ?>&date=<?php echo $row['date_order']; ?>&tid=<?php echo $row['transaction_id']; ?>">
                <span><i class="fa fa-plus"></i></span>
                </a>
				</td>
              </tr>
              <?php
            }
            ?>

          </tbody>
        </table>
     	</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
	<script src="js/jquery.js"></script>
      <script type="text/javascript">
       $(function() {

        $(".delbutton").click(function(){

		//Save the link in a variable called element
		var element = $(this);

		//Find the id of the link that was clicked
		var del_id = element.attr("id");

		//Built a url to send
		var info = 'id=' + del_id;
		if(confirm("Sure you want to delete this update? There is NO undo!"))
		{

			$.ajax({
				type: "GET",
				url: "deletepppp.php",
				data: info,
				success: function(){

				}
			});
			$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
			.animate({ opacity: "hide" }, "slow");

		}

		return false;

		});

      });
    </script>
<?php include "footer.html";?>
</body>
</html>
