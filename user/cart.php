<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Cart</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Plugin Start -->

  <?php include('plugins.php'); ?>

  <!-- Plugin Close -->

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
            <h1 class="text-capitalize mb-4 font-lg text-white">Cart Page</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section cart">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-lg-12">
          <div class="table-responsive">
            <table class="table text-center table-cart">
              <thead>
                <tr>
                  <th scope="col" colspan="2">product name</th>
                  <th scope="col">price</th>
                  <th scope="col">quantity</th>
                  <th scope="col">subtotal</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($_SESSION["cart_item"])) {
                  $res_q = $conn->query("select * from dish WHERE active=1");
                  $dishes = [];
                  $totalPrice = 0;
                  while ($res = $res_q->fetch_array()) {
                    $dishes[] = array(
                      'dishid' => $res['DishID'],
                      'photo' => $res['DishPhoto'],
                    );
                  }
                  foreach ($_SESSION["cart_item"] as $i => $value) {
                    foreach ($dishes as $key => $dish) {
                      if ($value['id'] == $dish['dishid']) {
                        $totalPrice += $value["price"] * $value["quantity"];
                ?>
                        <tr>
                          <td class="text-left">
                            <img src="../upload/<?= $dish['photo'] ?>" alt="" class="img-fluid w-25 mr-3">
                            <?= $value['name'] ?>
                          </td>
                          <td></td>
                          <td>RM<?= sprintf('%0.2f', $value["price"]) ?></td>
                          <td>
                            <div style='display: flex; flex-direction: row;align-items:baseline'>
                              <a href='cartManager.php?action=minus1&id=<?= $value["id"] ?>&location=mycart'><button class="btn-main" style="height:31px;width:50px">-</button></a>
                              <form class='myForm' action='cartManager.php?action=change' method='post'>
                                <input type='hidden' name='id' value='<?= $value["id"] ?>'>
                                <input type='text' class="quantity form-control" name="quantities" value='<?= $value["quantity"] ?>' style="height:100%;text-align:center" maxlength=2 required>
                              </form>
                              <a href='cartManager.php?action=add1&id=<?= $value["id"] ?>&location=mycart'><button class="btn-main" style="height:31px;width:50px">+</button></a>
                            </div>

                          </td>
                          <td>RM<?= sprintf('%0.2f', $value["price"] * $value["quantity"]) ?></td>
                          <td><a href='cartManager.php?action=remove&id=<?= $value['id'] ?>&location=cart' class="btn btn-main mr-3">Delete</a></td>
                        </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr class="border-bottom">
                    <td><a href="cartManager.php?action=empty" class="btn btn-main-border mr-3">Clear cart</a></td>
                    <td></td>
                    <td></td>
                    <td><strong>Total Price:</strong></td>
                    <td>RM<?= sprintf('%0.2f', $totalPrice) ?></td>
                  </tr>
                <?php
                } else { ?>
                  <tr>
                    <td colspan="6">The cart is empty</td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

        <?php
        if (isset($_SESSION["cart_item"])) {
        ?>
          <div class="col-md-6 col-lg-6 mt-4">
            <div class="px-xl-5 py-4 card border-0 ">
              <div class="">
                <h4 class="text-dark font-size-20">Order Summery</h4>
                <hr>
              </div>

              <div class="media align-items-center border-bottom font-weight-medium py-3">
                <div class="media-body">
                  <span class="text-black">Subtotal</span>
                </div>
                <span class="text-dark">RM<?= sprintf('%0.2f', $totalPrice) ?></span>
              </div>

              <div class="media align-items-center border-bottom font-weight-medium py-3">
                <div class="media-body">
                  <span class="text-black">Delivery Fee <br> <span style="color:grey;font-size:13px">(Free shipping above RM40 order)</span> </span>
                </div>
                <span class="text-dark">RM
                  <?php
                  $deliveryFee = 0;
                  if ($totalPrice > 40) {
                    $deliveryFee = 0;
                    echo sprintf('%0.2f', $deliveryFee);
                  } else {
                    $deliveryFee = 5;
                    echo sprintf('%0.2f', $deliveryFee);
                  }
                  ?>
                </span>
              </div>

              <div class="media align-items-center border-bottom font-weight-medium py-3">
                <div class="media-body">
                  <span class="text-black">Estimated Tax</span>
                </div>
                <span class="text-dark">RM<?php echo sprintf('%0.2f', $totalPrice * 0.06) ?></span>
              </div>

              <div class="media justify-content-between align-items-center py-3">
                <span class="text-dark ">Grand Total</span>
                <span class="text-dark font-weight-bold">RM<?= sprintf('%0.2f', $totalPrice * 1.06 + $deliveryFee) ?></span>
              </div>

              <form action="delivery.php" method="post">
                <input type="hidden" name="totalPrice" value="<?= $totalPrice ?>">
                <input type="submit" name="checkout" value="PROCEED TO CHECKOUT" class="btn btn-main mt-2">
              </form>
            </div>
          </div>
        <?php } else { ?>
          <div class="col-md-6 col-lg-6 mt-4">
            <div class="px-xl-5 py-4 card border-0 ">
              <div class="">
                <h4 class="text-dark font-size-20">Order Summary</h4>
                <hr>
              </div>

              <div class="media align-items-center border-bottom font-weight-medium py-3">
                <div class="media-body">
                  <span class="text-black">Subtotal</span>
                </div>
                <span class="text-dark">RM 0.00</span>
              </div>

              <div class="media align-items-center border-bottom font-weight-medium py-3">
                <div class="media-body">
                  <span class="text-black">Delivery Fee <br> <span style="color:grey;font-size:13px">(Free shipping above RM40 order)</span> </span>
                </div>
                <span class="text-dark">RM 0.00
                </span>
              </div>

              <div class="media align-items-center border-bottom font-weight-medium py-3">
                <div class="media-body">
                  <span class="text-black">Estimated Tax</span>
                </div>
                <span class="text-dark">RM 0.00</span>
              </div>

              <div class="media justify-content-between align-items-center py-3">
                <span class="text-dark ">Grand Total</span>
                <span class="text-dark font-weight-bold">RM 0.00</span>
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
  $(".quantity").keypress(function(e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      return false;
    }
  });

  $(".quantity").blur(function() {
    if ($(this).val() != "")
      $(this).parent().submit();
  });
</script>

</html>