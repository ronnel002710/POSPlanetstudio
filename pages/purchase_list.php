<?php
$servername='localhost';
$username="root";
$password="";
try
{
    $con=new PDO("mysql:host=$servername;dbname=3590879_inventory",$username,$password);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo 'connected';
}
catch(PDOException $e)
{
    echo '<br>'.$e->getMessage();
}

if(isset($_GET['purchase_list'])){
        $productlist =$_GET['purchase_list'];
        $output = "";
         
        $output .= '
                    
                  <table id="example1" class="table table-bordered table-striped table-hover" border="1">
				  <tr>
					<th style="background:green;color:white" colspan="12">PURCHASE LIST</th>
				  </tr>
                  <tr>
                    <th style="background:#ccc;" width="50">#</th>
                    <th style="background:#ccc;" width="150">INVOICE NO</th>
                    <th style="background:#ccc;" width="150">SUPPLIER</th>
                    <th style="background:#ccc;" width="100">DATE ORDER</th>
                    <th style="background:#ccc;" width="100">DATE DELIVERY</th>
                    <th style="background:#ccc;" width="150">PRODUCT CODE</th>
                    <th style="background:#ccc;" width="300">PRODUCT NAME</th>
                    <th style="background:#ccc;" width="100">PRICE</th>
                    <th style="background:#ccc;" width="100">QTY</th>
                    <th style="background:#ccc;" width="100">COST</th>
                    <th style="background:#ccc;" width="100">STATUS</th>
                    <th style="background:#ccc;" width="100">DATE DELIVER</th>
                  </tr>
                    
                    ';
             

					$sql = "SELECT * FROM purchases po INNER JOIN products p ON po.p_name=p.product_code order by po.date_deliver DESC";
			   $stmt = $con->prepare($sql);
			   $stmt->execute();
			   $data = $stmt->fetchAll(PDO::FETCH_ASSOC);   
        
			foreach($data as $key=>$value){
			 
				$output .= '<tr>  
							<td align="left">'.($key+1).'</td>
							<td>'.$value['invoice_number'].'</td>
							<td>'.$value['suplier'].'</td>
							<td>'.$value['date_order'].'</td>
							<td>'.$value['date_deliver'].'</td>
							<td>'.$value['product_code'].'</td>
							<td>'.$value['description_name'].'</td>
							<td>'.$value['price'].'</td>  
							<td>'.$value['qty'].'</td>  
							<td>'.$value['cost'].'</td>
							<td>'.$value['status'].'</td>
							<td>'.$value['date_recieved'].'</td>
							</tr>
						';  
					}
					  
					$output .= '</table>';
					
					$filename = $productlist."-".date('Y-m-d') . ".xls";         
					header("Content-Type: application/vnd.ms-excel");
					header("Content-Disposition: attachment; filename=\"$filename\"");  
					echo $output;
			

}
?>