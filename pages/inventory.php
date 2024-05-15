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
		<h3 class="box-title">INVENTORY REPORT</h3>
			<button class=" btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#InventoryModal"> <i class="fa fa-file-excel-o fa-fw"></i> Export to Excel</button>			
        </div>
		<div class="box-body ">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">

                    <thead>
                        <tr>

                            <th class="hidden"> Id </th>
                            <th width="10%"> Invoice </th>
                            <th> Product Code </th>
                            <th class="hidden"> Brand Name </th>
                            <th> Description Name </th>
                            <th> Qty Start </th>
                            <th> Qty Sold </th>
                            <th> Qty End </th>
                            <th> Price </th>  
                            <th> Cost </th>
                            <th> Date Purchased </th>
                            <th>Action </th>                               
                        </tr>
                    </thead>
                    <tbody>

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
                        $result = $db->prepare("SELECT *  FROM  sales_order ORDER BY transaction_id  ");
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){
                            ?>
                            <tr class="record">
                                <td class="hidden"><?php echo $row['transaction_id']; ?></td>
                                <td><?php echo $row['invoice']; ?></td>
                                <td><?php echo $row['product']; ?></td>
                                <td class="hidden"><?php echo $row['name']; ?></td>
                                <td><?php echo $row['dname']; ?></td>
                                <?php $qtyend=$row['qtyleft']+$row['qty'];?>
                                <td><?php echo $qtyend; ?></td>
                                <td><?php echo $row['qty']; ?></td>
                                <td><?php echo $row['qtyleft']; ?></td>
                                <td>&#8369; <?php
                                    $pprice=$row['price'];
                                    echo formatMoney($pprice, true);
                                    ?></td>
                                    <td>&#8369; <?php
                                        $pprice=$row['amount'];
                                        echo formatMoney($pprice, true);
                                        ?></td> 

                                        <td><?php echo $row['date']; ?></td> 
                                        
                                        <td>
                                <a href="#" id="<?php echo $row['transaction_id']; ?>" class="btn btn-danger delbutton" title="Click To Delete">
                                    <i class="fa fa-trash"></i>
                                    </tr>
                                    <?php
                                }
                                ?>
                            
                            </tbody>
                        </table>
				</div>
			<div class="clearfix"></div>
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
if(confirm("Sure you want to delete the transaction? There is NO undo!"))
{

   $.ajax({
     type: "GET",
     url: "deletesales.php",
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
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

<!-- DataTables JavaScript -->
<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
            responsive: true
        });
    });
</script>
	</div>
	</div>
	<?php 
	include "export_modal.php";
	include "footer.html";
	?>
   </body>

   </html>
