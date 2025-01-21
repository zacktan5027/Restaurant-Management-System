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
		<h1 class="page-header text-center">CATEGORY CRUD</h1>
		<div class="row">
			<div class="col-md-12">
				<button onclick="document.getElementById('addcategory').style.display='block'">Category</button>
			</div>
		</div>
		<div>
			<table>
				<th>Category Name</th>
				<th>Action</th>
				<tbody>
					<?php
					$sql = "select * from category order by categoryid asc";
					$query = $conn->query($sql);
					while ($row = $query->fetch_array()) {
					?>
						<tr>
							<td><?php echo $row['CategoryName']; ?></td>
							<td>
								<button onclick="document.getElementById('editcategory<?php echo $row['CategoryID']; ?>').style.display='block'">Edit</button> ||
								<button onclick="document.getElementById('deletecategory<?php echo $row['CategoryID']; ?>').style.display='block'">Delete</button>
								<?php include('category_modal.php'); ?>
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
</body>

</html>