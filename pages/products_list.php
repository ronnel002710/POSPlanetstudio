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

if(isset($_GET['product-list'])){
        $productlist =$_GET['product-list'];
        $output = "";
         
        $output .= '
                    
                  <table id="example1" class="table table-bordered table-striped table-hover" border="1">
				  <tr>
					<th style="background:green;color:white" colspan="11">PRODUCT LIST</th>
				  </tr>
                  <tr>
                    <th style="background:#ccc;" width="50">#</th>
                    <th style="background:#ccc;" width="150">PRODUCT CODE</th>
                    <th style="background:#ccc;" width="300">PRODUCT NAME</th>
                    <th style="background:#ccc;" width="300">DESCRIPTION</th>
                    <th style="background:#ccc;" width="100">UNIT</th>
                    <th style="background:#ccc;" width="50">COST</th>
                    <th style="background:#ccc;" width="50">PRICE</th>
                    <th style="background:#ccc;" width="300">SUPPLIER</th>
                    <th style="background:#ccc;" width="50">QTY</th>
                    <th style="background:#ccc;" width="200">CATEGORY</th>
                    <th style="background:#ccc;" width="100">DATE DELIVER</th>
					
                  </tr>
                    
                    ';
             

					$sql = "SELECT * FROM products ORDER BY description_name ASC";
			   $stmt = $con->prepare($sql);
			   $stmt->execute();
			   $data = $stmt->fetchAll(PDO::FETCH_ASSOC);   
        
			foreach($data as $key=>$value){
			 
				$output .= '<tr>  
							<td align="left">'.($key+1).'</td>
							<td>'.$value['product_code'].'</td>
							<td>'.$value['product_name'].'</td>
							<td>'.$value['description_name'].'</td>
							<td>'.$value['unit'].'</td>
							<td>'.$value['cost'].'</td>
							<td>'.$value['price'].'</td>  
							<td>'.$value['supplier'].'</td>  
							<td>'.$value['qty_left'].'</td>  
							<td>'.$value['category'].'</td>  
							<td>'.$value['date_delivered'].'</td>  
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