<?php
require_once "conn.php";

$id = $_GET['id'];
$where = "";
if (isset($_GET['star'])) {
    $star = $_GET['star'];
    $where = "Rating=$star AND ";
}
//define total number of results you want per page  
$results_per_page = 10;

//find the total number of results stored in the database  
$query = "select * from feedback WHERE " . $where . " DishID=" . $id . "";
$result = mysqli_query($conn, $query);
$number_of_result = mysqli_num_rows($result);

//determine the total number of pages available  
$number_of_page = ceil($number_of_result / $results_per_page);

//determine which page number visitor is currently on  
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

//determine the sql LIMIT starting number for the results on the displaying page  
$page_first_result = ($page - 1) * $results_per_page;

//retrieve the selected results from database   
$query = "SELECT * FROM feedback NATURAL JOIN account WHERE " . $where . " DishID = " . $id . " LIMIT " . $page_first_result . ',' . $results_per_page;
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Feedback</title>

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
                            <h1 class="text-capitalize mb-4 font-lg text-white">Feedback</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="row">
                    <a class="btn btn-dark" style="margin: 15px;" href="dish.php?id=<?= $id ?>">Back</a><br><br>
                    <div class=" col-lg-12">
                        <div style="text-align: center;">
                            <a class="btn btn-main" href="feedback.php?id=<?= $id ?>" style="margin: 15px;font-size:15px">ALL</i></a>
                            <a class="btn btn-main" href="feedback.php?id=<?= $id ?>&star=1" style="margin: 15px;font-size:15px">1 <i class="fa fa-star" data-rating="2" style="color:#ff9f00;"></i></a>
                            <a class="btn btn-main" href="feedback.php?id=<?= $id ?>&star=2" style="margin: 15px;font-size:15px">2 <i class="fa fa-star" data-rating="2" style="color:#ff9f00;"></i></a>
                            <a class="btn btn-main" href="feedback.php?id=<?= $id ?>&star=3" style="margin: 15px;font-size:15px">3 <i class="fa fa-star" data-rating="2" style="color:#ff9f00;"></i></a>
                            <a class="btn btn-main" href="feedback.php?id=<?= $id ?>&star=4" style="margin: 15px;font-size:15px">4 <i class="fa fa-star" data-rating="2" style="color:#ff9f00;"></i></a>
                            <a class="btn btn-main" href="feedback.php?id=<?= $id ?>&star=5" style="margin: 15px;font-size:15px">5 <i class="fa fa-star" data-rating="2" style="color:#ff9f00;"></i></a>
                        </div>
                    </div>
                    <div class=" col-lg-12">
                        <?php
                        //display the retrieved result on the webpage  
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <p><strong><?php
                                        for ($i = 0; $i < 5; $i++) {
                                            if ($row['Rating'] > $i)
                                                echo '<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i>';
                                            else
                                                echo '<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffffff; text-shadow: 0 0 3px #000;"></i>';
                                        }
                                        ?> by </strong> <span style="font-size:14px;"><?= $row['AccountName']; ?></span></p>
                            <p><?= $row['FeedbackDetail']; ?></p>
                            <hr>
                        <?php
                        }
                        ?>
                        <div style="text-align: center;">
                            <?php
                            //display the link of the pages in URL  
                            for ($page = 1; $page <= $number_of_page; $page++) {
                                if (isset($_GET['page'])) {
                                    if ($_GET['page'] == $page) {
                            ?>
                                        <a class="btn btn-info" href="feedback.php?id=<?= $id ?>&page=<?= $page ?>"><?= $page ?></a>
                                    <?php
                                    } else {
                                    ?>
                                        <a class="btn btn-black" href="feedback.php?id=<?= $id ?>&page=<?= $page ?>"><?= $page ?></a>
                                    <?php
                                    }
                                } else {
                                    if ($page == 1) {
                                    ?>
                                        <a class="btn btn-info" href="feedback.php?id=<?= $id ?>&page=<?= $page ?>"><?= $page ?></a>
                                    <?php
                                    } else {
                                    ?>
                                        <a class="btn btn-black" href="feedback.php?id=<?= $id ?>&page=<?= $page ?>"><?= $page ?></a>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
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