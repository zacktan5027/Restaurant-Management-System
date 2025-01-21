<?php

require_once "conn.php";

if (isset($_GET['title'])) {

    $query = $conn->query("SELECT * FROM dish WHERE DishName LIKE '%$_GET[title]%' AND active=1");
} else {
    $query = $conn->query("select * from dish WHERE active=1");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Search</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Plugins Start -->

    <?php include('plugins.php'); ?>

    <!-- Plugins Close -->
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
                            <h1 class="text-capitalize mb-4 font-lg text-white">Search</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="details-form">
                    <h2>Search Here</h2>
                    <form action="search.php?title=" method="get">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search . . . ." name="title" value="<?= (isset($_GET['title'])) ? $_GET['title'] : "" ?>"><br>
                            <div class="form-group" style="text-align:right">
                                <input type="submit" class="btn btn-main" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
                <h2>Result</h2>
                <hr>
                <div>
                    <?php
                    $dishes = [];
                    while ($res = $query->fetch_array()) {
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
                                            <img src="../upload/<?= $dish['photo'] ?>" alt="" class="img-fluid mb-3 mb-lg-0" width=150px>
                                            <div>
                                                <h4><?php if (strlen($dish['name']) > 15)
                                                        echo substr($dish['name'], 0, 15) . "...";
                                                    else
                                                        echo $dish['name'];
                                                    ?> - <span>RM <?= $dish['price'] ?></span></h4>
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
    </section>
    <!--  Banner End -->



    </section>
    <!--Footer start -->

    <?php include('footer.php'); ?>

    <!-- Footer  End -->

</body>

</html>