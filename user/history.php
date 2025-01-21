<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>History</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Plugin Start -->

    <?php include('plugins.php'); ?>

    <!-- Plugin Close -->
</head>


<body>
    <!-- Header Start -->

    <?php include('header.php'); ?>

    <!-- Header Close -->

    <section class="slider-hero hero-slider  hero-style-1  ">
        <section class="section-header bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h1 class="text-capitalize mb-4 font-lg text-white">History</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table text-center table-cart">
                                <thead>
                                    <tr>
                                        <td>Date</td>
                                        <td>Time</td>
                                        <td>Cost</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select * from orders WHERE AccountID=" . $_SESSION['user']['id'] . " order by OrderID asc";
                                    $query = $conn->query($sql);
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = $query->fetch_array()) {
                                    ?>
                                            <tr>
                                                <td><?= $row['OrderDate'] ?></td>
                                                <td><?= $row['OrderTime'] ?></td>
                                                <td><?= $row['TotalCost'] ?></td>
                                                <td><?= $row['DeliveryStatus'] ?></td>
                                                <td>
                                                    <a class="btn btn-main" href="invoice.php?order=<?= $row['OrderID'] ?>">Download Receipt</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!--  Banner End -->

    <!--Footer start -->

    <?php include('footer.php'); ?>

    <!-- Footer  End -->

</body>

</html>