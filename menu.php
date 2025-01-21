<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="utf-8">
	<title>CafeDine - Restuarant template</title>

	<!-- mobile responsive meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Plugins Start -->

	<?php include('plugins.php'); ?>

	<!-- Plugins Close -->

</head>

<body>
	<div class="preloader">
		<img src="images/preloader.gif" alt="preloader" class="img-fluid">
	</div>
	<!-- Header Start -->

	<?php include('header.php'); ?>

	<!-- Header Close -->
	<section class="section-header bg-1">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center">
						<h1 class="text-capitalize mb-4 font-lg text-white">Food menu</h1>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- DISHES start -->
	<section class="section menu">
		<div class="container">
			<div class="row  justify-content-center mb-5">
				<div class="col-lg-8 text-center">
					<span class="text-primary font-extra font-md">CafeDine Dishes</span>
					<h2 class="mt-3 mb-4">We provide quality food.We care about your health </h2>
				</div>
			</div>

			<div class="col-12 text-center mb-5">
				<div class="btn-group btn-group-toggle" data-toggle="buttons">
					<label class="btn active">
						<input type="radio" name="shuffle-filter" value="all" checked="checked" />All
					</label>
					<?php $query = $conn->query("select * from category");
					while ($row = $query->fetch_array()) {  ?>
						<label class="btn">
							<input type="radio" name="shuffle-filter" value="<?= $row['CategoryID'] ?>" /><?= $row['CategoryName'] ?>
						</label>
					<?php } ?>
				</div>
			</div>

			<?php
			$res_q = $conn->query("select * from dish natural join category WHERE active=1  and activeCategory=1");
			$dishes = [];
			while ($res = $res_q->fetch_array()) {
				$dishes[] = array(
					'dishid' => $res['DishID'],
					'categoryid' => $res['CategoryID'],
					'name' => $res['DishName'],
					'price' => $res['DishPrice'],
					'photo' => $res['DishPhoto'],
					'pax' => $res['DishPerPax'],
					'des' => $res['DishDescription'],
					'spice' => $res['DishSpiciness']
				);
			} ?>
			<div class="row shuffle-wrapper food-gallery">
				<?php foreach ($dishes as $key => $dish) {  ?>
					<div class="col-lg-6 col-md-6 mb-4 shuffle-item" data-groups="[&quot;<?= $dish['categoryid'] ?>&quot;]">
						<div class="menu-item position-relative ">
							<a href="dish.php?id=<?= $dish['dishid'] ?>">
								<div class="d-flex align-items-center">
									<img src="upload/<?= $dish['photo'] ?>" alt="" style="width:50px;height:110px">
									<div>
										<h4><?= $dish['name'] ?> - <span>RM <?= $dish['price'] ?></span></h4>
										<p>
											<?php if (strlen($dish['des']) > 80)
												echo substr($dish['des'], 0, 80) . "...";
											else
												echo $dish['des'];
											?>
										</p>
									</div>
								</div>
							</a>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<!-- DISHES  End -->



	<section class="section menu-3 secondary-bg">
		<div class="container">
			<div class="row  justify-content-center mb-5">
				<div class="col-lg-8 text-center">
					<span class="text-primary font-extra font-md">Main Dishes</span>
					<h2 class="mt-3 mb-4">We provide quality food.We care about your health </h2>
				</div>
			</div>

			<div class="row ">
				<?php foreach ($dishes as $key => $dish) {  ?>
					<div id="<?= $dish['dishid'] ?>" class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="00">
						<div class="card border-0 menu-item3">
							<center>
								<img src="upload/<?= $dish['photo'] ?>" alt="" class="img-fluid" style="height:200px;width:250px">
							</center>
							<div class="card-body">
								<h3 class="card-title"><?= $dish['name'] ?> - <span class="text-primary">RM <?= $dish['price'] ?></span></h3>
								<p>
									<?php if (strlen($dish['des']) > 80)
										echo substr($dish['des'], 0, 80) . "...";
									else
										echo $dish['des'];
									?>
								</p>
								<div style="position:absolute; bottom:10px;width:85%">
									<div style="text-align:center">
										<form method="post" action="cartManager.php?action=add">
											<input type="text" style="margin-top: 0;text-align:center" id="quantity" class="product-quantity" name="quantity" value="1" maxlength="2" required>
											<input type="hidden" name="id" value=<?= $dish["dishid"] ?>>
											<input type="submit" value="Add to Cart" class="btn btn-main mt-2" />
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>
	</section>

	<!--Footer start -->

	<?php include('footer.php'); ?>

	<!-- Footer  End -->

</body>

<script>
	$("#quantity").keypress(function(e) {
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			//display error message
			return false;
		}
	});
</script>

</html>