<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>P.O.S System</title>
  
   <link rel="shortcut icon" href="../src/logo.png">
  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../../vendor/css/AdminLTE.min.css" rel="stylesheet" type="text/css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
        <script src="lib/jquery.js" type="text/javascript"></script>
        <script src="src/facebox.js" type="text/javascript"></script>
        <script type="text/javascript">
          jQuery(document).ready(function($) {
            $('a[rel*=facebox]').facebox({
              loadingImage : 'src/loading.gif',
              closeImage   : 'src/closelabel.png'
            })
          })
        </script>

<style>
	hr{
		height: 1px;
		background-color: #eee;
		border: 1px dotted #ccc;
	}
	p{
		
		text-align:justify;
	}
</style>
      </head>

<body>
<div id="wrapper">
	<?php include('navfixed.php');?>
	<div id="page-wrapper">
	<br/>
	<div class="col-md-5">
	 <div class="box box-success">
		<div class="box-header with-border">
		<h3 class="box-title">Payment | <?php echo $_GET['id']; ?></h3>
        </div>
	    <div class="box-body">
      <div class="form-group">

		<form action="incoming.php" method="post">

			 <input type="hidden" name="pt" class = "form-control" value="<?php echo $_GET['id']; ?>" />
             <input type="hidden" name="invoice" class = "form-control" value="<?php echo $_GET['invoice']; ?>" />
             <label for="email">SELECT CUSTOMER:</label>
			<select  name="customers" class="chzn-select form-control">
                <option>Select Customer</option>
                
                <?php
                include('connect.php');
                $result = $db->prepare("SELECT * FROM customer");
                $result->bindParam(':userid', $res);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
                  ?>
                  <option value="<?php echo $row['customer_name'];?>" 
                  
                    >
					<?php echo $row['customer_name']; ?>
                    - <?php echo $row['contact']; ?>
                  </option>
                  <?php
                }
                ?>
              </select>
		  </div>
		  <div class="form-group">
			<label for="email">SELECT PRODUCT:</label>
			<select  name="product" class="chzn-select form-control" required>
                <option></option>
                <?php
                include('connect.php');
                $result = $db->prepare("SELECT * FROM products");
                $result->bindParam(':userid', $res);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
                  ?>
                  <option value="<?php echo $row['product_code'];?>" 
                    <?php
                    if($row['qty_left'] == 0)
                    {
                      echo'disabled';
                    }
					?>
                    >
					<?php echo $row['product_code']; ?>
                    - <?php echo $row['product_name']; ?>
                    - <?php echo $row['description_name']; ?>
                    - <?php echo $row['qty_left']; ?>

                  </option>
                  <?php
                }
                ?>
              </select>
		  </div>
      
      <div class="form-group">
      <label for="pwd">NUMBER OF ITEM</label>
      <input type="text" name="qty" class = "form-control"  autocomplete="off" min="0" max="100" required />
      <br/>
      </div>
      <div class="form-group">
      </select>
      </div>
      
      <div class="form-group">
			<label for="pwd">DISCOUNT</label>
			<input type="text" name="discount" value="0" class = "form-control"  autocomplete="off" style="width: 100px; padding-top: 6px; padding-bottom: 6px; margin-right: 4px;" />

              <input type="hidden" name="vat" value="0" class = "form-control"  autocomplete="off" style="width: 100px; padding-top: 6px; padding-bottom: 6px; margin-right: 4px;" />
		  </div>
		  <div class="form-group">
		   <button type="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-shopping-cart"></i> Add to Cart</button>
		   </div>
       
		</form>
		</div>
		 </div>
		 </div>
		 <div class="col-md-7">
		 <div class="box box-info">
			<div class="box-header with-border">
			<h3 class="box-title">List of Item</h3>
			</div>
			<div class="box-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <!--<th> Product Code </th>-->
                  <th class="hidden"> Brand Name </th>
                  <th> Item </th>
                  <th class="hidden"> Category </th>
                  <th> Qty </th>
                  <th> Price </th>
                  <th> Discount </th>
                  <th class="hidden"> VAT </th>
                  <th class="hidden"> Amount </th>
                  <th> Total Amount </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>

                <?php
                $id=$_GET['invoice'];
                include('connect.php');
                $result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid");
                $result->bindParam(':userid', $id);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
                  ?>
                  <tr class="record">
                    <td class="hidden"><?php echo $row['customer_name']; ?></td>
                    <td class="hidden"><?php echo $row['product']; ?></td>
                    <td class="hidden"><?php echo $row['name']; ?></td>
                    <td><?php echo $row['dname']; ?></td>
                    <td class="hidden"><?php echo $row['category']; ?></td>
                    <td><?php echo $row['qty']; ?></td>
                    <td>
                      &#8369; <?php
                      $ppp=$row['price'];
                      echo formatMoney($ppp, true);
                      ?>
                    </td>
                    <td class="">
                      &#8369; <?php
                      $ddd=$row['discount'];
                      echo formatMoney($ddd, true);
                      ?>
                    </td>
                    <td class="hidden">
                      &#8369; <?php
                      $fff=$row['vat'];
                      echo formatMoney($fff, true);
                      ?>
                    </td>
                    <td class="hidden">
                      &#8369; <?php
                      $ccc=$row['amount'];
                      echo formatMoney($ccc, true);
                      ?>
                    </td>

                    <td>
                     &#8369; <?php
                      $dfdf=$row['total_amount'];
                      echo formatMoney($dfdf, true);
                      ?>
                    </td>
                    
                    <td><a href="delete.php?id=<?php echo $row['transaction_id']; ?>&invoice=<?php echo $_GET['invoice']; ?>&dle=<?php echo $_GET['id']; ?>&qty=<?php echo $row['qty'];?>&code=<?php echo $row['product'];?>"> Delete</a></td>
                  </tr>
                  <?php
                }
                ?>
                <tr>	
                  <td colspan="5" align="right"><strong style="font-size: 15px; color: #222222;" >Sub Total:</strong></td>
                  <td colspan="2"><strong style="font-size: 15px; color: #222222;">
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
                    $sdsd=$_GET['invoice'];
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
					<td colspan="7">
					<a rel="facebox" class = "btn btn-success pull-right" href="checkout.php?pt=<?php echo $_GET['id']?>&invoice=<?php echo $_GET['invoice']?>&total=<?php echo $fgfg ?>&cashier=<?php echo $session_cashier_name?>&p_amount=<?php echo $fgfg?>"> <i class="glyphicon glyphicon glyphicon-share"></i> Check Out</a>
					</td>
				</tr>
              </tbody>
            </table>
            
			</div>
			</div>
			</div>
			
        <div class="clearfix"></div>
		<hr/>
		<p>
		Mini Point of Sale System in PHP MySqli,
		Basically point of sale system or POS is a computer system
		that record financial transactions. The POS System is made using PHP mysqli 
		that handles sales by keeping records of products like item name, buy price, sell price, profit, etc. It generates bill/receipts and make it available to print it.
		</p>
		<hr/>
		
      </div>
      </div>
	  
      <!-- /#page-wrapper -->



      <!-- jQuery -->
      <script src="vendor/jquery/jquery.min.js"></script>

      <!-- Bootstrap Core JavaScript -->
      <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

      <!-- Metis Menu Plugin JavaScript -->
      <script src="vendor/metisMenu/metisMenu.min.js"></script>

      <!-- Custom Theme JavaScript -->
      <script src="dist/js/sb-admin-2.js"></script>

      <link href="vendor/chosen.min.css" rel="stylesheet" media="screen">
      <script src="vendor/chosen.jquery.min.js"></script>
      <script>
        $(function() {
          $(".chzn-select").chosen();

        });
      </script>

    </body>

    </html>
