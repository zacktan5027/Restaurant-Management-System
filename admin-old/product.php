<?php include('../header.php'); ?>
<?php include('../conn.php'); ?>
<!DOCTYPE html>
<html>
<style>
	.fade {
		display: none;
		/* Hidden by default */
		position: fixed;
		/* Stay in place */
		z-index: 1;
		/* Sit on top */
		left: 0;
		top: 0;
		width: 100%;
		/* Full width */
		height: 100%;
		/* Full height */
		overflow: auto;
		/* Enable scroll if needed */
		background-color: rgb(0, 0, 0);
		/* Fallback color */
		background-color: rgba(0, 0, 0, 0.4);
		/* Black w/ opacity */
		padding-top: 60px;
	}

	/* Modal Content/Box */
	.modal-content {
		background-color: #fefefe;
		margin: 5% auto 15% auto;
		/* 5% from the top, 15% from the bottom and centered */
		border: 1px solid #888;
		width: 80%;
		/* Could be more or less, depending on screen size */
	}
</style>

<body>
	<?php include('../navbar.php'); ?>
	<div class="container">
		<h1 class="page-header text-center">PRODUCTS CRUD</h1>
		<div class="row">
			<div class="col-md-12">
				<select id="catList" class="btn btn-default">
					<option value="0">All Category</option>
					<?php
					$sql = "select * from category";
					$catquery = $conn->query($sql);
					while ($catrow = $catquery->fetch_array()) {
						$catid = isset($_GET['category']) ? $_GET['category'] : 0;
						$selected = ($catid == $catrow['CategoryID']) ? " selected" : "";
						echo "<option$selected value=" . $catrow['CategoryID'] . ">" . $catrow['CategoryName'] . "</option>";
					}
					?>
				</select>
				<button onclick="document.getElementById('addproduct').style.display='block'">Product</button>
			</div>
		</div>
		<div style="margin-top:10px;">
			<table class="table table-striped table-bordered">
				<thead>
					<th>Photo</th>
					<th>Dish Name</th>
					<th>Price</th>
					<th>Dish PerPax</th>
					<th>Dish Description</th>
					<th>Dish Spiciness</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php
					$where = "";
					if (isset($_GET['category'])) {
						$catid = $_GET['category'];
						$where = " WHERE dish.CategoryID = $catid";
					}
					$sql = "select * from dish left join category on category.CategoryID=dish.CategoryID $where order by dish.CategoryID asc, DishName asc";
					$query = $conn->query($sql);
					while ($row = $query->fetch_array()) {
					?>
						<tr>
							<td><a href="<?php if (empty($row['DishPhoto'])) {
												echo "../upload/noimage.jpg";
											} else {
												echo "../upload/" . $row['DishPhoto'];
											} ?>"><img src="<?php if (empty($row['DishPhoto'])) {
																echo "../upload/noimage.jpg";
															} else {
																echo "../upload/" .  $row['DishPhoto'];
															} ?>" height="30px" width="40px"></a></td>
							<td><?php echo $row['DishName']; ?></td>
							<td>&#82;&#77; <?php echo number_format($row['DishPrice'], 2); ?></td>
							<td><?php echo $row['DishPerPax']; ?></td>
							<td><?php echo $row['DishDescription']; ?></td>
							<td><?php echo $row['DishSpiciness']; ?></td>
							<td>
								<button onclick="document.getElementById('editproduct<?php echo $row['DishID']; ?>').style.display='block'">Edit</button> ||
								<button onclick="document.getElementById('deleteproduct<?php echo $row['DishID']; ?>').style.display='block'">
									<?php
									if ($row['active'])
										echo "Deactive";
									else
										echo "Active";
									?>
								</button>
								<?php include('product_modal.php'); ?>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<?php include('modal.php'); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#catList").on('change', function() {
				if ($(this).val() == 0) {
					window.location = 'product.php';
				} else {
					window.location = 'product.php?category=' + $(this).val();
				}
			});
		});
	</script>
</body>

</html>