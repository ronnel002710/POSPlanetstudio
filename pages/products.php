<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "header.html"; ?>
	<?php
	function productcode()
	{
		$chars = "012345678911223344556677889900";
		srand((float)microtime() * 1000000);
		$i = 0;
		$pass = '';
		while ($i <= 6) {

			$num = rand() % 33;

			$tmp = substr($chars, $num, 1);

			$pass = $pass . $tmp;

			$i++;
		}
		return $pass;
	}
	$pcode = 'PC' . productcode();
	?>
	<link rel="stylesheet" href="../js/basicLightbox.min.css">
</head>

<body>
	<div id="wrapper">
		<?php include('navfixed.php'); ?>
		<div id="page-wrapper">
			<br />
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">JOB ORDER LIST</h3>
					<div class="pull-right">LEGEND:
						<span class="btn btn-success btn-sm">Low</span>
						<span class="btn btn-warning btn-sm">Medium</span>
						<span class="btn btn-danger btn-sm">High</span> &nbsp;
						<a href="#add" data-toggle="modal" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-plus-square fa-fw"></i> Add Product</a>
					</div>

				</div>
				<div class="box-body ">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th class=""> Job Order Code </th>
								<th class="hidden"> Brand Name </th>
								<th> Job Order Name </th>
								<th class="hidden">Category </th>
								<th> Cost </th>
								<th> SRP </th>

								<th> Qty Left </th>
								<th> Action </th>
							</tr>
						</thead>
						<tbody>

							<?php
							function formatMoney($number, $fractional = false)
							{
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
							include('connect.php');
							$result = $db->prepare("SELECT * FROM products ORDER BY description_name");
							$result->execute();
							for ($i = 0; $row = $result->fetch(); $i++) {
								$qty = $row['qty_left']
							?>
								<tr class="record">
									<td class="barcode-container">
										<a href="" download>
										<svg class="barcode" jsbarcode-height="40" jsbarcode-value="<?php echo $row['product_code'] ?>" jsbarcode-textmargin="0" jsbarcode-fontoptions="bold">
										</svg>
										</a>
								
										
									</td>
									<td class="hidden"><?php echo $row['product_name']; ?></td>
									<td><?php echo $row['description_name']; ?></td>
									<td class="hidden"><?php echo $row['category']; ?></td>
									<td align="right"> &#8369; <?php
																$pcost = $row['cost'];
																echo formatMoney($pcost, true);
																?></td>
									<td align="right">&#8369; <?php
																$pprice = $row['price'];
																echo formatMoney($pprice, true);
																?></td>

									<td align="right">
										<?php if ($qty == "0") { ?>
											<span class="label label-success"><?php echo $row['qty_left']; ?> </span>
										<?php } elseif ($qty <= 20) { ?>
											<span class="label label-warning"><?php echo $row['qty_left']; ?> </span>
										<?php } else { ?>
											<span class="label label-danger"><?php echo $row['qty_left']; ?> </span>
										<?php } ?>
										<!---<span class="label label-default"><?php echo $row['unit']; ?></span>--->
									</td>
									<td>
										<a rel="facebox" class="btn btn-info btn-sm" href="editproduct.php?id=<?php echo $row['product_id']; ?>">
											<i class="fa fa-pencil"></i>
										</a>
										<a rel="facebox" href="product_view.php?id=<?php echo $row['product_id']; ?>" class="btn btn-primary btn-sm" title="Click To View">
											<i class="fa fa-eye-slash"></i>
										</a>
										<a href="#" id="<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm delbutton" title="Click To Delete">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
								
							<?php
							}
							?>

						</tbody>
					</table>
				</div>
				<div class="clearfix"></div>
			</div>

		</div>
	</div>
	<script src="../js/jquery.js"></script>
	<script src="../js/basicLightbox.min.js"></script>
	<script src="../js/qrcode/qrcode.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="
https://cdn.jsdelivr.net/npm/notiflix@3.2.7/dist/notiflix-aio-3.2.7.min.js
"></script>
	<link href="
https://cdn.jsdelivr.net/npm/notiflix@3.2.7/src/notiflix.min.css
" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
	<script>
		$(document).ready(function() {
			JsBarcode(".barcode").init();
			const barcode = document.querySelectorAll('.barcode');
			const qrClick = document.querySelector('tbody');
			


		});
		window.addEventListener('load', () => {
  // Wait for a short time (e.g., 500ms) to allow the jsbarcode library to render the SVG
  setTimeout(() => {
    const barcodeContainers = document.querySelectorAll('.barcode-container');

    barcodeContainers.forEach((container) => {
      const barcodeLink = container.querySelector('a');
      const barcode = container.querySelector('.barcode');
      const productCode = barcode.getAttribute('jsbarcode-value');

      svgToImage(barcode, 'png', (imageData) => {
        barcodeLink.href = imageData;
        barcodeLink.download = `barcode-${productCode}.png`;
      });
    });
  }, 500);
});

function svgToImage(svgElement, imageType, callback) {
  const canvas = document.createElement('canvas');
  const context = canvas.getContext('2d');
  const svgData = new XMLSerializer().serializeToString(svgElement);
  const img = new Image();

  img.onload = function() {
    canvas.width = img.width;
    canvas.height = img.height;
    context.drawImage(img, 0, 0);
    const imageData = canvas.toDataURL(`image/${imageType}`);
    callback(imageData);
  };

  img.src = 'data:image/svg+xml;base64,' + window.btoa(unescape(encodeURIComponent(svgData)));
}
		

		$(function() {
			$(".delbutton").click(function() {

				//Save the link in a variable called element
				var element = $(this);

				//Find the id of the link that was clicked
				var del_id = element.attr("id");

				//Built a url to send
				var info = 'id=' + del_id;
				if (confirm("Sure you want to delete this product? There is NO undo!")) {

					$.ajax({
						type: "GET",
						url: "deleteproduct.php",
						data: info,
						success: function() {

						}
					});
					$(this).parents(".record").animate({
							backgroundColor: "#fbc7c7"
						}, "fast")
						.animate({
							opacity: "hide"
						}, "slow");

				}

				return false;

			});

		});

	
	
	</script>
	<?php include 'addproduct.php'; ?>
	<!-- <?php include "footer.html"; ?> -->
</body>

</html>