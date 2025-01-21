<?php include('../header.php'); ?>

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
		<h1 class="page-header text-center">RESTAURANT</h1>
		<div class="row">
			<div class="col-md-12">
				<select id="catList" class="btn btn-default">
					<option value="0">ALL RESTAURANT</option>
					<?php
					$sql = "select * from Restaurant";
					$catquery = $conn->query($sql);
					while ($catrow = $catquery->fetch_array()) {
						$catid = isset($_GET['restaurant']) ? $_GET['restaurant'] : 0;
						$selected = ($catid == $catrow['RestaurantState']) ? " selected" : "";
						echo "<option$selected value=" . $catrow['RestaurantState'] . ">" . $catrow['reststate'] . "</option>";
					}
					?>
				</select>
				<button onclick="document.getElementById('addres').style.display='block'">Restaurant</button>
			</div>
		</div>
		<div style="margin-top:10px;">
			<table class="table table-striped table-bordered">
				<thead>
					<th>Photo</th>
					<th>Restaurant Name</th>
					<th>Restaurant Address 1</th>
					<th>Restaurant Address 2</th>
					<th>Poscode</th>
					<th>District</th>
					<th>State</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php
					$where = "";
					if (isset($_GET['restaurant'])) {
						$catid = $_GET['restaurant'];
						$where = " WHERE restaurant.RestaurantState = $catid";
					}
					$sql = "select * from restaurant $where order by restaurant.RestaurantState asc, RestaurantName asc";
					$query = $conn->query($sql);
					while ($row = $query->fetch_array()) {
					?>
						<tr>
							<td><a href="<?php if (empty($row['RestaurantPhoto'])) {
												echo "upload/noimage.jpg";
											} else {
												echo "../upload/" . $row['RestaurantPhoto'];
											} ?>"><img src="<?php if (empty($row['RestaurantPhoto'])) {
																echo "../upload/noimage.jpg";
															} else {
																echo "../upload/" . $row['RestaurantPhoto'];
															} ?>" height="30px" width="40px"></a></td>
							<td><?php echo $row['RestaurantName']; ?></td>
							<td><?php echo $row['RestaurantAddress1']; ?></td>
							<td><?php echo $row['RestaurantAddress2']; ?></td>
							<td><?php echo $row['RestaurantPostcode']; ?></td>
							<td><?php echo $row['RestaurantDistrict']; ?></td>
							<td><?php echo $row['RestaurantState']; ?></td>
							<td>
								<button onclick="document.getElementById('editres<?php echo $row['RestaurantID']; ?>').style.display='block'">Edit</button> ||
								<button onclick="document.getElementById('deleteres<?php echo $row['RestaurantID']; ?>').style.display='block'">Delete</button>
								<?php include('restaurantmodal.php'); ?>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<?php include('restmodal.php'); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#catList").on('change', function() {
				if ($(this).val() == 0) {
					window.location = 'restaurant.php';
				} else {
					window.location = 'product.php?category=' + $(this).val();
				}
			});
		});
	</script>
</body>

</html>