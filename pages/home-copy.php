<?php
require_once('auth.php');
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
				<span class="info-box-icon bg-red"><i class="fa fa-archive"></i></span>
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
              <span class="info-box-text">Total Product</span>
              <span class="info-box-number"><small><?php echo $row->t ?></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- get today transactions -->
        <?php
		include "../conn.php";
		$today = date('Y-m-d');
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
		$today = date('Y-m-d');
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
              <span class="info-box-number"><small>Rp. <?php echo number_format($total,0); ?> </small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
<!-- /.row -->

               <div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title"> <i class="fa fa-calendar fa-w"> </i> Monthly Sales</h3>
				</div>
				<div class="box-body ">
                <div class="content" id="content">
                    <p> Monthly Sales Chart</p>
                    <div class="row">
                        <?php 
                        include('connect.php');
                        $sql = "SELECT *, month as mon, SUM(amount) as qcount FROM sales GROUP BY month";
                        $query = $db->prepare($sql); 
                        $query->execute();
                        $fetch = $query->fetchAll();
                        foreach ($fetch as $key => $value) {
                            $data[] = array('title'=>$value['mon'], 'value'=>$value['qcount']);
                        }
                        $d = json_encode($data);
                        ?>
                        <div id="chartdiv"></div>       
                    </div>
                </div>
                </div>
                </div>

	</div>
	<!-- /.row --><?php include "footer.html";?>
	</div>
	   <!-- /#page-wrapper -->

        <script src="plugins/amcharts/amcharts.js"></script>
        <script src="plugins/amcharts/serial.js"></script>
        <script src="plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="plugins/export/export.css" type="text/css" media="all" />
        <script src="plugins/amcharts/themes/pattern.js"></script>

        <script>

        var raw = '<?php echo $d; ?>';
        var data = JSON.parse(raw);
        var chart = AmCharts.makeChart( "chartdiv", {
          "type": "serial",
          "theme": "light",
          "dataProvider": data,
          "valueAxes": [ {
            "gridColor": "#FFFFFF",
            "gridAlpha": 0.2,
            "dashLength": 0
        } ],
        "gridAboveGraphs": true,
        "startDuration": 1,
        "graphs": [ {
            "balloonText": "[[category]]: <b>Total Sales [[value]]</b>",
            "fillAlphas": 0.8,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "value"
        } ],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "title",
        "categoryAxis": {
            "gridPosition": "start",
            "gridAlpha": 0,
            "tickPosition": "start",
            "tickLength": 20
        },
        "export": {
            "enabled": true
        }

    } );
</script>

</body>
</html>
