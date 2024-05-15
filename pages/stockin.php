  <!--<?php
  include('connect.php');
  $id=$_GET['iv'];
  $p_name = $_GET['name'];
  $qty = $_GET['qty'];
  $date = $_GET['date'];
  $t_id = $_GET['tid'];
  $result = $db->prepare("SELECT * FROM purchases_item WHERE id= :userid");
  $result->bindParam(':userid', $t_id);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    ?>
    <form action="update.php" method="post" class = "form-group" name="stockin_form">
      <div id="ac">
        <input type="hidden" name="invoice" value="<?php echo $id; ?>" class = "form-control" required />
        <label>Product Code</label>
        <input type="text" name="product_code" value="<?php
           $rrrrrrr=$row['name'];
            $resultss = $db->prepare("SELECT * FROM products WHERE product_code= :asas");
            $resultss->bindParam(':asas', $rrrrrrr);
            $resultss->execute();
            for($i=0; $rowss = $resultss->fetch(); $i++){
              echo $rowss['product_code'];
            }
            ?>" class = "form-control" required readonly />
            
        <label>Quantity : </label>
        <input type="text" name="qty" value = "<?php echo $qty; ?>"  class = "form-control" required />
        <label>Status</label>
        <select name="status"  class = "form-control" required>
         <option value="">Select</option>
         <option value="">--</option>
         <option value="Received">Received</option>
       </select>
       <label>Date Received</label>
       <input type = "date" name = "recieved" class = "form-control" required />
       <span>&nbsp;</span>
       <label> Remarks </label>
       <textarea style="width:265px; height:50px;" name="remark" class="form-control" required> </textarea>
	   <br/>
	   <div class="pull-right">
	   <a href="purchaseslist.php" class="btn btn-warning">Cancel</a>
       <input class="btn btn-primary" type="submit" value="Received" />
     </div>
     </div>
   </form>
   <?php
 }
 ?>--->
 
 
 <?php 
	$conn = new mysqli('localhost', 'root', '', '3590879_inventory');
	$id=$_GET['iv'];
    $p_name = $_GET['name'];
    $qty = $_GET['qty'];
    $date = $_GET['date'];
    $t_id = $_GET['tid'];	
	$result=mysqli_query($conn, "SELECT * FROM purchases_item WHERE id='$t_id'")or die('Opps! sayop imong napendot.');
	$row=mysqli_fetch_array($result);
	?>
	<?php
	
	$conn = new mysqli('localhost', 'root', '', '3590879_inventory');
	$p_name = $_GET['name'];
	$result=mysqli_query($conn, "SELECT * FROM products WHERE product_code='$p_name'")or die('Opps! sayop imong napendot.');
	$p=mysqli_fetch_array($result);
	?>
				
				
	<form action="update.php" method="post" class = "form-group" name="stockin_form">
      <div id="ac">
        <input type="hidden" name="invoice" value="<?php echo $id; ?>" class = "form-control" required />
        <label>Product Code</label>
        <input type="text" name="product_code" value="<?php echo $p['product_code'];?>" class = "form-control" required readonly />
            
        <label>Quantity : </label>
        <input type="text" name="qty" value = "<?php echo $qty; ?>"  class = "form-control" required />
        <label>Status</label>
        <select name="status"  class = "form-control" required>
         <option value="">Select</option>
         <option value="">--</option>
         <option value="Received">Received</option>
       </select>
       <label>Date Received</label>
       <input type = "date" name = "recieved" class = "form-control" required />
       <span>&nbsp;</span>
       <label> Remarks </label>
       <textarea style="width:265px; height:50px;" name="remark" class="form-control" required> </textarea>
	   <br/>
	   <div class="pull-right">
	   <a href="purchaseslist.php" class="btn btn-warning">Cancel</a>
       <input class="btn btn-primary" type="submit" value="Received" />
     </div>
     </div>
   </form>