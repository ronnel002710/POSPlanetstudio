 <div class="panel-body">
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square fa-fw"></i> Add Product</h4>
                </div>
                <div class="modal-body">
                    <form action="saveproduct.php" method="post" class = "form-group" >
                        <div id="ac">
                            <span>Select Category: </span>
                            <select name="categ" class = "form-control" required>
							<option value=""></option>
							<option value="Others">Others</option>
                             <?php
                                include('connect.php');
                                $result = $db->prepare("SELECT * FROM category");
                                $result->bindParam(':userid', $res);
                                $result->execute();
                                for($i=0; $row = $result->fetch(); $i++){
                                    ?>
                                    <option value="<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span>Product Code : </span><input type="text" name="code" value = "<?php echo $pcode ?>" class = "form-control" readonly />
                            <span>Brand Name : </span><input type="text" name="bname" class = "form-control" required />
                            <span>Description Name : </span><input type="text" name="dname" class = "form-control" required />
                            <span>Product Unit : </span>
                            <select name="unit" class = "form-control" required>
                            <option value=""></option>
							<option value="Others">Others</option>
                             <?php
                                include('connect.php');
                                $result = $db->prepare("SELECT * FROM product_unit");
                                $result->bindParam(':userid', $res);
                                $result->execute();
                                for($i=0; $row = $result->fetch(); $i++){
                                    ?>
                                    <option value="<?php echo $row['unit']; ?>"><?php echo $row['unit']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span>Cost : </span><input type="text" name="cost" class = "form-control" required />
                            <span>SRP : </span><input type="text" name="price"  class = "form-control" required />
                    
                            </select>
                            <span>Quantity : </span><input type="text" name="qty" class = "form-control" required />
                            <span>Date Purchased: </span><input type="date" name="date_del" class = "form-control"  required/>
                            <input type="hidden" name="ex_date" class = "form-control" hidden/>
  
                        </div>
                    </div>
                    <div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle fa-fw"></i> Close</button>
					<button class="btn btn-primary btn-sm" type="submit"> <i class="fa fa-save fa-fw"></i>  Save</button>
                    </div>
					</form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
                        <!-- /.modal -->