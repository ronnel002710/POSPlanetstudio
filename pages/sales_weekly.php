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
                        <h1 class="page-header">Weekly Sales  <div class="box-tools pull-right">
                
              </div></h1>
                    </div>
                </div>

                <!-- /.row -->

                <div class="content" id="content">
                    <div class="row">
                        
                         <div>
                   <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                    <thead>
                      <tr>

                        <th> Date </th>
                        <th> Total </th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      include('connect.php');
                      $result = $db->prepare("SELECT *, SUM(amount) AS total FROM sales WHERE WEEK(date)= week(NOW())");
                      $result->execute();
                      for($i=0; $row = $result->fetch(); $i++){
                        ?>
                        <tr class="record">

                          <td><?php echo $row['date']; ?></td>
						  <td>&#8369; <?php echo number_format($row['total'],2);?></td>
                        </tr>
                        <?php
                      }
                      ?>

                    </tbody>
                  </table>

                </div>
                    </div>
                </div>
                <a href="javascript:Clickheretoprint()" style="font-size:15px"; class="btn btn-primary"><i class="fa fa-print"></i>Print</a>
            </div>
            <!-- /.container-fluid -->
        </div>
          <?php include"footer.html";?>
<script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'sales_Weekly.php?year='+$(this).val();
  });
});
</script>
</body>

</html>
