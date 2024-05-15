<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "header.html";?>
	 <style>
            #chartdiv {
                width       : 100%;
                height      : 500px;
                font-size   : 11px;
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
          docprint.document.write('</head><body onLoad="self.print()" style="width: 1000px; height:400; font-size: 20px; font-family: arial;">');          
          docprint.document.write(content_vlue); 
          docprint.document.close(); 
          docprint.focus(); 
      }
  </script>
</head>
      <body>


        <?php include('navfixed.php');?>    

        <!-- Page Content -->
        <div id="page-wrapper">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <h1 class="page-header">Yearly Sales</h1>
              </div>


              <div class="content" id="content">
                <p> Yearly Sales Chart</p>
                <div class="row">
                  <?php 
                  include('connect.php');
                  $sql = "SELECT *, year as yea, SUM(amount) as qcount FROM sales GROUP BY year ";
                  $query = $db->prepare($sql); 
                  $query->execute();
                  $fetch = $query->fetchAll();
                  foreach ($fetch as $key => $value) {
                    $data[] = array('title'=>$value['yea'], 'value'=>$value['qcount']);
                  }
                  $d = json_encode($data);
                  ?>

                  <div id="chartdiv"></div>       
                </div>
              </div>
            </div>
            <a href="javascript:Clickheretoprint()" style="font-size:15px"; class="btn btn-primary"><i class="fa fa-print"></i>Print</a>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
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
            "theme": "pattern",
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







        <!-- jQuery -->
        <script src="../vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>

      </body>

      </html>
