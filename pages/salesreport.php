<?php
require_once('auth.php');

?>
<?php
  include 'timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
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
		<h3 class="box-title">SALES REPORT</h3>
			 <button class="btn btn-success btn-sm pull-right" onclick="Export()">
               <i class="fa fa-file-excel-o fa-fw"></i> Export to Excel
              </button>
			  <div class="row">
				<div class="col-md-12">
			<div class="">
               <form class="form-inline" method="POST" action="">
            <label>Date:</label>
            <input type="date" class="form-control" placeholder="Start"  name="date1"/>
            <label>To</label>
            <input type="date" class="form-control" placeholder="End"  name="date2"/>
            <button class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search"></span></button>
        </form>
              </div>
				</div>
			  </div>
        </div>
		<div class="box-body ">

                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th > Cashier Name:</th>
                                <th > Transaction ID </th>
                                <th > Date </th>
                                <th > Invoice Number </th>
                                <!--<th > Type of Payment </th>-->
                                <th > Total Sales </th>
                                <th > Action </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include('connect.php');
							
							$range_to = date('Y-m-d');
							$range_from = date('Y-m-d');
								
								
							if(!empty($_POST['search'])){
                              $range_from = $_POST['date1'];
							  $range_to = $_POST['date2'];
							}
                            $result = $db->prepare("SELECT * FROM sales WHERE date BETWEEN '$range_from' AND '$range_to' ORDER BY `sales`.`date` DESC");
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){
                                ?>
                                <tr class="record">
								<td><?php echo $row['cashier']; ?></td>
                                    <td>STI-000<?php echo $row['transaction_id']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td><?php echo $row['invoice_number']; ?></td>
                                    
                                    <td>&#8369; <?php
                                        $dsdsd=$row['amount'];
                                        echo formatMoney($dsdsd, true);
                                        ?>
                                    </td>
                                    
                                    <td>
                                        <a href="#" id="<?php echo $row['transaction_id']; ?>" class="btn btn-danger delbutton btn-sm" title="Click To Delete">
                                            <span><i class="fa fa-trash"></i></span>
                                        </a>
                                        &nbsp;
                                        <a class="btn btn-primary btn-sm" href="salesprint.php?id=<?php echo $row['invoice_number']; ?>">
                                            <span><i class="fa fa-print"></i></span>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="4" style="border-top:1px solid #999999"> Total Amount </th>
                                <th colspan="2" style="border-top:1px solid #999999"> 
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
                                    $results = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$range_from' AND '$range_to'");
                                    $results->execute();
                                    for($i=0; $rows = $results->fetch(); $i++){
                                        $dsdsd=$rows['sum(amount)'];
                                        echo formatMoney($dsdsd, true);
                                    }
                                    ?>
                                </th>
                            </tr>
                        </thead>  
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
			
	<?php include"footer.html";?>
	
</body>
</html>
