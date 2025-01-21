<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Reservation</title>

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
            <h1 class="text-capitalize mb-4 font-lg text-white">Reservation</h1>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="section reservation">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 form-wrap">
          <span class="text-primary font-extra font-md">Reservation</span>

          <?php
          if (!isset($_GET['type'])) {
          ?>
            <h2 class="mt-3 mb-5">Reserve your seat for betterment</h2>
            <div class="row">
              <div class="col-md-10 col-lg-6">
                <h3>
                  Reserve for a table? <br><br>
                </h3> <a href="reservation.php?type=normal" class="btn btn-main">Reserve Now</a>
              </div>
              <div class="col-md-10 col-lg-6">
                <h3>
                  Wanna reserve the whole restaurant for a party?
                </h3> <a href="reservation.php?type=full" class="btn btn-main">Reserve Now</a>
              </div>
            </div>
          <?php
          } else if ($_GET['type'] == "normal") {
          ?>
            <h2 class="mt-3 mb-3">Reserve your seat for betterment <br> <span style="font-size: 16px;">Each reservation only have 2 hour duration</span></h2>

            <a href="reservation.php" class="btn btn-main">Back</a><br><br>
            <form action="reservationManager.php" method="POST">
              <div class="form-group">
                <label for="restaurant">Choose your restaurant:</label>
                <select class="form-control" name="RestaurantID" id="restaurant">
                  <option value="">Please choose one restaurant</option>
                  <?php $query = $conn->query("select * from restaurant");
                  while ($row = $query->fetch_array()) {  ?>
                    <option value="<?= $row['RestaurantID'] ?>"><?= $row['RestaurantName'] . " - " . $row['RestaurantCity'] . "," . $row['RestaurantState'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="Date">Choose your date:</label>
                <input type="date" class="form-control" name="ReservationDate" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime(date('Y-m-d') . '+60 days')) ?>" required>
              </div>
              <div class="form-group">
                <label for="Time">Choose your time: </label>
                <Select class="form-control" name="ReservationTime" id="Time">
                  <option value="">Please choose a time</option>
                  <option value="09:00:00" name="09:00:00">9:00</option>
                  <option value="09:30:00" name="09:30:00">9:30</option>
                  <option value="10:00:00" name="10:00:00">10:00</option>
                  <option value="10:30:00" name="10:30:00">10:30</option>
                  <option value="11:00:00" name="11:00:00">11:00</option>
                  <option value="11:30:00" name="11:30:00">11:30</option>
                  <option value="12:00:00" name="12:00:00">12:00</option>
                  <option value="12:30:00" name="12:30:00">12:30</option>
                  <option value="13:00:00" name="13:00:00">13:00</option>
                  <option value="13:30:00" name="13:30:00">13:30</option>
                  <option value="14:00:00" name="14:00:00">14:00</option>
                  <option value="14:30:00" name="14:30:00">14:30</option>
                  <option value="15:00:00" name="15:00:00">15:00</option>
                  <option value="15:30:00" name="15:30:00">15:30</option>
                  <option value="16:00:00" name="16:00:00">16:00</option>
                  <option value="16:30:00" name="16:30:00">16:30</option>
                  <option value="17:00:00" name="17:00:00">17:00</option>
                  <option value="17:30:00" name="17:30:00">17:30</option>
                  <option value="18:00:00" name="18:00:00">18:00</option>
                  <option value="18:30:00" name="18:30:00">18:30</option>
                  <option value="19:00:00" name="19:00:00">19:00</option>
                  <option value="19:30:00" name="19:30:00">19:30</option>
                  <option value="20:00:00" name="20:00:00">20:00</option>
                  <option value="20:30:00" name="20:30:00">20:30</option>
                  <option value="21:00:00" name="21:00:00">21:00</option>
                  <option value="21:30:00" name="21:30:00">21:30</option>
                </Select>
              </div>
              <div class="form-group">
                <label for="Pax">Choose your table size:</label>
                <select class="form-control" name="ReservationPax" id="pax">
                  <option value="">PLease choose the size</option>
                  <option value="2" name="2">Table for 2</option>
                  <option value="4" name="4">Table for 4</option>
                  <option value="8" name="8">Table for 8</option>
                </select>
              </div>
              <div class="form-group">
                <label for="Comment">Enter your comment:</label>
                <textarea type="text" class="form-control" rows="5" name="ReservationComment" placeholder="Enter your notes"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" name="normal" class="btn btn-main float-right" value="RESERVE">
              </div>
            </form>
          <?php
          } else if ($_GET['type'] == "full") {
          ?>
            <h2 class="mt-3 mb-3">Reserve for your party <br> <span style="font-size: 16px;">Each party reservation will have 4 hour duration</span></h2>
            <a href="reservation.php" class="btn btn-main">Back</a><br><br>
            <form action="reservationManager.php" method="POST">
              <div class="form-group">
                <label for="restaurant">Choose your restaurant:</label>
                <select class="form-control" name="RestaurantID" id="restaurant" required>
                  <option value="">Please choose one restaurant</option>
                  <?php $query = $conn->query("select * from restaurant");
                  while ($row = $query->fetch_array()) {  ?>
                    <option value="<?= $row['RestaurantID'] ?>"><?= $row['RestaurantName'] . " - " . $row['RestaurantCity'] . "," . $row['RestaurantState'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="Date">Choose your date:</label>
                <input class="form-control" type="date" name="ReservationDate" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime(date('Y-m-d') . '+60 days')) ?>" required>
              </div>
              <div class="form-group">
                <label for="Time">Choose Your time: </label>
                <Select class="form-control" name="ReservationTime" id="Time" required>
                  <option value="">Please choose a time</option>
                  <option value="09:00:00">9:00</option>
                  <option value="09:30:00">9:30</option>
                  <option value="10:00:00">10:00</option>
                  <option value="10:30:00">10:30</option>
                  <option value="11:00:00">11:00</option>
                  <option value="11:30:00">11:30</option>
                  <option value="12:00:00">12:00</option>
                  <option value="12:30:00">12:30</option>
                  <option value="13:00:00">13:00</option>
                  <option value="13:30:00">13:30</option>
                  <option value="14:00:00">14:00</option>
                  <option value="14:30:00">14:30</option>
                  <option value="15:00:00">15:00</option>
                  <option value="15:30:00">15:30</option>
                  <option value="16:00:00">16:00</option>
                  <option value="16:30:00">16:30</option>
                  <option value="17:00:00">17:00</option>
                  <option value="17:30:00">17:30</option>
                  <option value="18:00:00">18:00</option>
                  <option value="18:30:00">18:30</option>
                  <option value="19:00:00">19:00</option>
                  <option value="19:30:00">19:30</option>
                  <option value="20:00:00">20:00</option>
                  <option value="20:30:00">20:30</option>
                  <option value="21:00:00">21:00</option>
                  <option value="21:30:00">21:30</option>
                </Select>
              </div>
              <div class="form-group">
                <label for="Comment">Enter your comment:</label>
                <textarea type="text" class="form-control" rows="5" name="ReservationComment" placeholder="Enter your notes"></textarea>
              </div>
              <div class="form-group">
                <input class="btn btn-main float-right" type="submit" name="full" value="RESERVE">
              </div>
            </form>
          <?php
          }
          ?>
        </div>
        <div class="col-lg-4">
          <div class="text-center py-5 form-2 secondary-bg mt-5 mt-lg-0">
            <span class="font-extra font-md text-primary">Check availabilty</span>
            <h3 class="font-md mb-5">Opening Times</h3>
            <ul class="list-unstyled">
              <li class="mb-4">
                <h4 class="mb-0">Monday - Sunday</h4>
                <span>9.00-22.00</span>
              </li>
            </ul>
            <div class="mt-5">
              <span class="font-extra text-capitalize font-md text-primary">Call us for</span>
              <h2 class="mb-0">1300 00 0000</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!--Footer start -->

  <?php include('footer.php'); ?>

  <!-- Footer  End -->

</body>

</html>