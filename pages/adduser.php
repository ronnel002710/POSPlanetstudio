<div class="modal fade" id="AddCashier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"> <i class="fa fa-plus-square fa-fw"></i> Add Cashier</h4>
			</div>
			<div class="modal-body">
				<form action="saveuser.php" method="post" class = "form-group" >
				<div id="ac">
					<span>USERNAME : </span><input type="text" name="user" placeholder="Username" class = "form-control" required />
					<span>PASSWORD: </span><input type="password" name="pass" placeholder="Password" class = "form-control" required />
					<span>FULL NAME : </span><input type="text" name="name" placeholder="Complete Name" class = "form-control" required />
					<span>POSITION: </span>
					<select name = "post" class = "form-control" required>
						<option>Cashier</option>
					</select>    
				</div>
			</div>
			<div class="modal-footer">
                 <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-success btn-sm">Save</button>
                 </div>
		  </form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"> <i class="glyphicon glyphicon-question-sign"></i> Please confirm</h4>
			</div>
			<div class="modal-body">
				<center>
					<b>Log Out?</b><br/>
					You will be returned to the login screen.
				</center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle fa-w"></i> Close</button>
				<a href="logout.php" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="profile" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" enctype="multipart/form-data" action="update_profile.php">
					<div class="modal-header">
						<h4 class="modal-title"> <i class="fa fa-info-circle fa-fw"></i>Update Password</h4>
					</div>
					<div class="modal-body">
						<div class="col-md-12"></div>
						<div class="col-md-12">
							<!--<label>Current Profile</label>
							<img src="<?php echo (!empty($userprofile)) ? $userprofile : 'src/A.png'; ?>" class="img-circle" alt="User Image" width="200px">
							<hr style="border-top:1px solid #000;"/>
							<div class="form-group">
								<label>New Profile</label>
								<input type="file" class="form-control" name="profile" required="required"/>
								<input type="hidden" class="form-control" name="current" value="<?php echo $userprofile;?>" required="required"/>
							</div>
							-->
							<div class="form-group">
								<label>Full Name</label>
								<input type="text" class="form-control" name="fullname" value="<?php echo $session_admin_name;?>" required="required"/>
								<input type="hidden" class="form-control" name="id" value="<?php echo $session_id;?>"/>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="text" class="form-control" name="password" value="<?php echo $password;?>" required="required"/>
							</div>
						</div>
					</div>
					<br style="clear:both;"/>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						<button name="update" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-edit"></span> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	
	<div class="modal fade" id="ShowBeloW50" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"> <i class="glyphicon glyphicon-question-sign"></i> Product(s) list that quantity are below 50 </h4>
			</div>
			<div class="modal-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th> PCode </th>
                                <th> PName </th>
                                <th> Supplier </th>
                                <th> Qty </th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php

                          include('connect.php');
                          $result = $db->prepare("SELECT * FROM products where qty_left < 50 ORDER BY product_id DESC");
                          $result->execute();
                          for($i=0; $row = $result->fetch(); $i++){
                            ?>
                            <tr class="record">
                                <td><font style="color:red;"><?php echo $row['product_code']; ?></td>
                                <td><font style="color:red;"><?php echo $row['description_name']; ?></td>
                                <td><font style="color:red;"><?php echo $row['supplier']; ?></td>
                                <td><font style="color:red;"><?php echo $row['qty_left']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle fa-w"></i> Close</button>
			</div>
		</div> 
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<div class="modal fade" id="ShowVat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"> <i class="glyphicon glyphicon-question-sign"></i> Vat/Tax Setting </h4>
			</div>
			<div class="modal-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th > Vat/Tax </th>
                               
                            </tr>
                        </thead>
                        <tbody>
                          <?php

                          include('connect.php');
                          $result = $db->prepare("SELECT * FROM vat_table");
                          $result->execute();
                          for($i=0; $row = $result->fetch(); $i++){
                            ?>
                            <tr class="record">
                                <td><font style="color:red;"><?php echo $row['vat']; ?></td>
                                <td><a href=""></a></td>
								
                            </tr>
                            <?php
                        }
                        ?>


                    </tbody>
                </table>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle fa-w"></i> Close</button>
			</div>
		</div> 
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->