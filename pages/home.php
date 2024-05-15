<?php
require_once('auth.php');
$today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $today = $_GET['year'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "header.html";?>
	 <script language="javascript">
          function Clickheretoprint()
          { 
            var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
            disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
            var content_vlue = document.getElementById("content").innerHTML; 

            var docprint=window.open("","",disp_setting); 
            docprint.document.open(); 
            docprint.document.write('</head><body onLoad="self.print()" style="width: 1000px; height:400; font-size: 20px; font-family: arial;">');          
            docprint.document.write(content_vlue); 
            docprint.document.close(); 
            docprint.focus(); 
          }
        </script>
		<style>
            #chartdiv {
                width       : 100%;
                height      : 300px;
                font-size   : 11px;
            }           
        </style>
</head>

<body >
	<div id="wrapper">
		<?php include('navfixed.php');?>
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header">DASHBOARD</h3>
				</div>
			</div>
		<div class="row">
        <!-- get alert stock -->
        <?php
			include('connect.php');
			$result = $db->prepare("SELECT * FROM products where qty_left < 50 ");
			$result->execute();
			$rowcount = $result->rowcount();
			?>
			<!-- get alert notification -->
			<div class="col-md-3 col-sm-6 col-xs-12">
			  <div class="info-box ">
				 <a href="#ShowBeloW50" id="myTooltips" title="Click me to view  the Job Order list that quantity are low" data-toggle="modal"> <span class="info-box-icon bg-red"><i class="fa fa-archive"></i></span></a>
				<div class="info-box-content">
				  <span class="info-box-text">Supplies RE-ORDER </span>
				  <?php if($rowcount==true){ ?>
				  <span class="info-box-number"><small><?php echo $rowcount;?></small></span>
				  <?php }else{?>  
				  <span class="info-box-text"><strong>There is no</strong></span>
				  <?php }?>
				 
				</div>
				<!-- /.info-box-content -->
			  </div>
			  <!-- /.info-box -->
			</div>


        <!-- get total products-->
        <?php
		include "../conn.php";
        $select = $pdo->prepare("SELECT count(product_code) as t FROM products");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $total = $row->t;
        ?>

        <!-- get total products notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-cubes"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Job Orders</span>
              <span class="info-box-number"><small><?php echo $row->t ?></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- get today transactions -->
        <?php
		include "../conn.php";
        $select = $pdo->prepare("SELECT count(transaction_id) as i FROM sales WHERE date = '$today'");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $invoice = $row->i ;
        ?>
         <!-- get today transactions notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Todays Transanction</span>
              <span class="info-box-number"><small><?php echo $row->i ?></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


        <!-- get today income -->
        <?php
		include "../conn.php";
        $select = $pdo->prepare("SELECT sum(amount) as total FROM sales WHERE date = '$today'");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $total = $row->total ;
        ?>
         <!-- get today income -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Todays Income</span>
              <span class="info-box-number"><small>&#8369; <?php echo number_format($total,0); ?> </small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
    <!-- /.row --><div class="row">
				<div class="col-md-6">
               <div class="box box-success">
				<div class="box-header with-border">
					
					<h3 class="box-title"> <i class="fa fa-calendar fa-w"> </i> Monthly Sales Analytics Reports Year
						
					<?php $year = DATE("Y"); echo $year;?>
					</h3>
				</div>
				<div class="box-body ">
                <div class="content" id="content">
                    <div class="row">
					<?php
					$con  = mysqli_connect("127.0.0.1","root","","3590879_inventory");
					 if (!$con) {
						 # code...
						echo "Problem in database connection! Contact administrator!" . mysqli_error();
					 }else{
							 $sql ="SELECT *, month as mon, SUM(amount) as qcount FROM sales WHERE year='$year' GROUP BY month";
							 $result = mysqli_query($con,$sql);
							 $chart_data="";
							 while ($row = mysqli_fetch_array($result)) { 
					 
								$productname[]  = $row['mon']  ;
								$sales[] = $row['qcount'];
							}
					 }
					?>
                      <canvas  id="chartjs_bar"></canvas>     
                    </div>
                </div>
                </div>
              </div>
              </div>
			
			<div class="col-md-6">
               <div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title"> <i class="fa fa-cart-plus fa-w"> </i> Cashier Dailys Income
					<?php $year = DATE("Y"); echo $year;?>
					</h3>
				</div>
				<div class="box-body ">
                <div class="content" id="content">
                    <div class="row">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th > Cashier Name:</th>
                                <th > Date </th>
                                <th > Total Sales </th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
							$conn  =new mysqli("127.0.0.1","root","","3590879_inventory");
							$sql = "SELECT *, SUM(amount) AS total FROM sales WHERE date ='$today' GROUP BY cashier";
								$query = $conn->query($sql);
								$total = 0;
								while($row = $query->fetch_assoc()){
								  echo "
									<tr>
									  <td>".$row['cashier']."</td>
									  <td>".$row['date']."</td>
									  <td>&#8369; ".formatMoney($row['total'], true)."</td>
									</tr>
								  ";
								}

							  ?>

                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="2" style="border-top:1px solid #999999"> Total Amount </th>
                                <th colspan="2" style="border-top:1px solid #999999"> 
                                    &#8369; <?php
                                    $dates = date('Y-m-d');
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
                                    $results = $db->prepare("SELECT sum(amount) FROM sales WHERE date ='$today'");
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
                </div>
                </div>
              </div>
              </div>
              </div>
	
	</div>
	<!-- /.row --><?php include "footer.html";?>
	</div>
	   <!-- /#page-wrapper -->

        <script src="plugins/amcharts/amcharts.js"></script>
        <script src="12.js"></script>
        <script src="plugins/amcharts/serial.js"></script>
        <script src="plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="plugins/export/export.css" type="text/css" media="all" />
        <script src="plugins/amcharts/themes/pattern.js"></script>
		<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($sales); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>
</body>
</html>
