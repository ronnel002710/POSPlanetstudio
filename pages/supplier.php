<?php include('auth.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "header.html";?>
</head>
<body>
<div id="wrapper">
    <?php include('navfixed.php');?>
	<div id="page-wrapper">
	<br/>
	<div class="box box-success">
		<div class="box-header with-border">
		<h3 class="box-title">SUPPLIER</h3>
			<button class="btn btn-success pull-right btn-sm" data-toggle="modal" data-target="#adds">
					<i class="fa fa-plus-square fa-fw"></i> Add Supplier
				</button>
			</div>
                    <div class="panel-body">
                        <div class="modal fade" id="adds" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square fa-fw"></i> Add Supplier</h4>
                                    </div>
                                 <div class="modal-body">
                                     <form action="savesupplier.php" method="post" class = "form-group">
                                        <div id="ac">
                                            <span>Supplier : </span><input type="text" name="name" class = "form-control" />
                                            <span>Contact Person : </span><input type="text" name="cperson" class = "form-control" />
                                            <span>Address : </span><input type="text" name="address" class = "form-control" />
                                            <span>Contact : </span><input type="text" name="contact" class = "form-control" />
                                        </div>
                                </div>
                                <div class="modal-footer">
									
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<input class="btn btn-primary"  type="submit" value="Save"/>
                                </div>
								</form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>

                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th> Supplier </th>
                            <th> Contact Person </th>
                            <th> Address </th>
                            <th> Contact </th>
                            <th width="10%"> Action </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include('connect.php');
                        $result = $db->prepare("SELECT * FROM supliers ORDER BY suplier_id DESC");
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){
                            ?>
                            <tr class="record">
                                <td><?php echo $row['suplier_name']; ?></td>
                                <td><?php echo $row['contact_person']; ?></td>
                                <td><?php echo $row['suplier_address']; ?></td>
                                <td align="right"><?php echo $row['suplier_contact']; ?></td>
                                <td><a rel="facebox" class="btn btn-primary btn-sm" href="editsupplier.php?id=<?php echo $row['suplier_id']; ?>"> <i class="fa fa-pencil"></i> </a>  <a href="#" id="<?php echo $row['suplier_id']; ?>" class="btn btn-danger delbutton btn-sm" title="Click To Delete"><i class = "fa fa-trash"></i></a></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
              	<div class="clearfix"></div>
		</div>
	</div>
	</div>
            <script src="js/jquery.js"></script>
            <script type="text/javascript">
                $(function() {


                    $(".delbutton").click(function(){

					//Save the link in a variable called element
					var element = $(this);

					//Find the id of the link that was clicked
					var del_id = element.attr("id");

					//Built a url to send
					var info = 'id=' + del_id;
					if(confirm("Sure you want to delete this update? There is NO undo!"))
					{

					 $.ajax({
					   type: "GET",
					   url: "deletesupplier.php",
					   data: info,
					   success: function(){

					   }
					});
					 $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
					 .animate({ opacity: "hide" }, "slow");

					}

					return false;

					});

                });
            </script>
<?php include"footer.html";?>
</body>
</html>
