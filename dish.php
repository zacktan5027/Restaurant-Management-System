<?php

require_once "conn.php";
require_once "include/rating.inc.php";

$res_q = $conn->query("select * from dish WHERE Dishid = " . $_GET['id'] . "");
$dishes = [];
while ($res = $res_q->fetch_array()) {
    $dishes = array(
        'dishid' => $res['DishID'],
        'categoryid' => $res['CategoryID'],
        'name' => $res['DishName'],
        'price' => $res['DishPrice'],
        'photo' => $res['DishPhoto'],
        'pax' => $res['DishPerPax'],
        'des' => $res['DishDescription'],
        'spice' => $res['DishSpiciness']
    );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dish</title>

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
                            <h1 class="text-capitalize mb-4 font-lg text-white"><?= $dishes['name'] ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-6">
                        <br>
                        <img src="<?php if (empty($dishes['photo'])) {
                                        echo "upload/noimage.jpg";
                                    } else {
                                        echo "upload/" . $dishes['photo'];
                                    } ?>" height="300px;">
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-6">
                        <div>
                            <h1 class="headline mb-3 font-weight-bold"><?= $dishes['name'] ?></h1>
                        </div>
                        <div>
                            <p style="font-size:18px">
                                <?= $dishes['des'] ?>
                            </p>
                        </div>
                        <br>
                        <p>
                            Recommended pax per serve :
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <span><?= $dishes['pax'] ?></span>
                            <br>
                            Spiceness Level :
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="text-danger">
                                <?php $count = 1;
                                do {
                                    echo '<i class="fas fa-pepper-hot"></i>';
                                    $count++;
                                } while ($count <= $dishes['spice']) ?>
                            </span>
                        </p>
                        <div>
                            <h3>
                                Price:
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                RM <?php echo number_format($dishes['price'], 2); ?>
                            </h3>
                        </div>
                        <br>
                        <div>
                            <div style="text-align:center">
                                <button id="minus" class="btn btn-main">-</button>
                                <input id="quantity" type="text" id="quantity" value="1" style="width:200px;text-align:center" maxlength="2" />
                                <button id="plus" class="btn btn-main">+</button>
                                <form method="post" action="cartManager.php?action=add">
                                    <input id="quantitySubmit" type="hidden" value="1" name="quantities">
                                    <input type="hidden" name="id" value=<?= $dishes["dishid"] ?>>
                                    <input type="submit" value="Add to Cart" class="btn btn-main" />
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-6" style="text-align:center">
                        <h3 style="font-size:30px">Rating & Reviews</h3>
                        <br>
                        <h3> <b> <?php echo round(getAverage($conn, $dishes["dishid"]), 1); ?></b> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i></h3>
                        <p><?= getTotalRating($conn, $dishes["dishid"]); ?> ratings and <?= getTotalReview($conn, 1); ?> reviews</p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-6" style="text-align:center">
                        <?php
                        for ($index = 1; $index <= 5; $index++) {
                            $result = getTotalStar($conn, $dishes["dishid"], $index);
                            if ($result != null) {
                                $db_rating = mysqli_fetch_array($result); ?>
                                <h4><?= $index; ?> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i> Total <?= $db_rating['Total']; ?></h4>
                            <?php
                            } else {
                            ?>
                                <h4><?= $index; ?> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i> Total 0</h4>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <div>
                            <hr>
                            <?php
                            $review = getReview($conn, $dishes["dishid"]);
                            while ($db_review = mysqli_fetch_array($review)) {
                            ?>
                                <p><strong><?php
                                            for ($i = 0; $i < 5; $i++) {
                                                if ($db_review['rating'] > $i)
                                                    echo '<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i>';
                                                else
                                                    echo '<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffffff; text-shadow: 0 0 3px #000;"></i>';
                                            }
                                            ?> by </strong> <span style="font-size:14px;"><?= $db_review['AccountName']; ?></span></p>
                                <p><?= $db_review['FeedbackDetail']; ?></p>
                                <hr>
                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <div style="text-align:center">
                    <a href="feedback.php?id=<?= $dishes["dishid"] ?>" class="btn btn-main">See all review</a>
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
<script>
    $("#plus").click(function() {
        let v = parseInt($("#quantity").val());
        if (isNaN(v)) {
            v = 1;
            $("#quantity").val(v);
            $("#quantitySubmit").val(v);
        } else {
            if (v < 50) {
                $("#quantity").val(v + 1);
                $("#quantitySubmit").val(v + 1);
            }
        }
    });

    $("#minus").click(function() {
        let v = parseInt($("#quantity").val());
        if (isNaN(v)) {
            v = 1;
            $("#quantity").val(v);
            $("#quantitySubmit").val(v);
        } else {
            if (v > 1) {
                $("#quantity").val(v - 1);
                $("#quantitySubmit").val(v - 1);
            }
        }
    });

    $("#quantity").keypress(function(e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            return false;
        }
    });

    $("#quantity").keyup(function() {
        $("#quantitySubmit").val(this.value);
    });

    function get_data(no) {
        $.ajax({
            type: 'post',
            url: 'get_data.php',
            data: {
                row_no: no
            },
            success: function(response) {
                document.getElementById("pagination_div").innerHTML = response;
            }
        });
    }
</script>

</html>