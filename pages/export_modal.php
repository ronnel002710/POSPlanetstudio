
<!-- Modal -->
<div class="modal fade" id="InventoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-excel-o fa-fw"></i> Advance Report</h4>
			</div>
			<div class="modal-body">
				<form class="form-inline" method="POST" action="exportdata/OrderSalesReportDateRange.php">
			  <label for="text">From:</label>
			  <input type="text" class="form-control datepicker" placeholder="From date" name="from_date" id="from_date" required readonly>
			  <label for="pwd">To:</label>
			  <input type="text" class="form-control datepicker" placeholder="To date" name="to_date" id="to_date" required readonly>
			  <button type="submit" name="Export" class="btn btn-success"><i class="fa fa-filter fa-fw"></i> Filter</button>
			  <a href="exportdata/OrderSalesReport.php" class="btn btn-info"> <i class="fa fa-database fa-fw"></i>All records</a>
			</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
