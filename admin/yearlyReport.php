<?php
require_once "conn.php";
$year = $_POST['yearSelected'];

if ($_POST['restaurantID'] == "all") {

    $sql = "SELECT *, SUM(TotalCost) AS Sales FROM orders NATURAL JOIN restaurant WHERE YEAR(OrderDate) = " . $year . " GROUP BY RestaurantName ";

    $result1 = mysqli_query($conn, $sql);
    $chart_data = "";
    while ($row = mysqli_fetch_array($result1)) {
        $dish[] = $row['RestaurantName'];
        $totalsales[] = sprintf('%0.2f', $row['Sales']);
    }
} else {
    $sql = "SELECT *, SUM(TotalCost) AS Sales FROM orders WHERE YEAR(OrderDate) = " . $year . " AND RestaurantID = " . $_POST['restaurantID'] . " GROUP BY MONTH(OrderDate)";

    $result1 = mysqli_query($conn, $sql);
    $chart_data = "";
    while ($row = mysqli_fetch_array($result1)) {
        $dish[] = substr($row['OrderDate'], 0, 7);
        $totalsales[] = sprintf('%0.2f', $row['Sales']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Yearly Report</title>

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
                            <h1 class="text-capitalize mb-4 font-lg text-white">Yearly Report</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div style="text-align: right;">
                    <button id="type" class="btn btn-main">Graph</button>
                </div>
                <div id="table">
                    <table cellpadding="10" cellspacing="0" width="100%">
                        <?php
                        if ($_POST['restaurantID'] == 'all') {
                        ?>
                            <thead>
                                <tr>
                                    <th rowspan="2">Restaurant</th>
                                    <th rowspan="2">Year</th>
                                    <th rowspan="2">Total Sales</th>
                                </tr>
                            </thead>
                            <?php
                            $sql2 = "SELECT *, SUM(TotalCost) AS Sales FROM orders NATURAL JOIN restaurant WHERE YEAR(OrderDate) = " . $year . " GROUP BY RestaurantName";

                            $result = mysqli_query($conn, $sql2);
                            $dateorder = $row['OrderDate'];
                            $sales = $row['Sales'];
                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td><?= $row['RestaurantName'] ?></td>
                                        <td><?= substr($row['OrderDate'], 0, 4) ?></td>
                                        <td>RM <?php echo sprintf('%0.2f', $row['Sales']); ?></td>
                                    </tr>

                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td>0 result</td>
                                    <td></td>
                                </tr>
                            <?php
                            }
                        } else {
                            //$sql2 = "SELECT RestaurantID, OrderDate, SUM(TotalCost) AS Sales FROM orders WHERE OrderDate = date(NOW()) GROUP BY RestaurantID";
                            $sql2 = "SELECT *, SUM(TotalCost) AS Sales FROM orders NATURAL JOIN orderdetail NATURAL JOIN dish WHERE YEAR(OrderDate) = " . $year . " AND RestaurantID = " . $_POST['restaurantID'] . " GROUP BY MONTH(OrderDate) ";
                            ?>
                            <thead>
                                <tr>
                                    <th rowspan="2">Month</th>
                                    <th rowspan="2">Total Sales</th>
                                </tr>
                            </thead>
                            <?php
                            $result = mysqli_query($conn, $sql2);

                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $dateorder = $row['OrderDate'];
                                    $sales = $row['Sales'];
                            ?>
                                    <tr>

                                        <td><?php echo substr($dateorder, 0, 7); ?></td>
                                        <td>RM <?php echo sprintf('%0.2f', $sales); ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td>0 result</td>
                                    <td></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>
                <div id="graph" style="display: none;">
                    <?php
                    if ($result1->num_rows > 0) {
                    ?>
                        <div class="container">
                            <script>
                                function printFunction() {
                                    window.print();
                                }
                            </script>
                            <h2 class="page-header">Analytics Reports </h2>
                            <div>Sales (RM)</div><br />
                            <canvas id="chartjs_bar"></canvas>
                            <?php if ($_POST['restaurantID'] == 'all') { ?>
                                <div style="float:right">Restaurant Name</div>
                            <?php } else { ?>
                                <div style="float:right">Month</div>
                            <?php } ?>
                        </div>
                        <button class="btn btn-dark" onclick="printFunction()">Print</button><br />
                    <?php
                    } else {
                    ?>
                        <div class="container">
                            <center>
                                <h1>0 result</h1>
                            </center>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <script src="//code.jquery.com/jquery-1.9.1.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
                <script type="text/javascript">
                    var ctx = document.getElementById("chartjs_bar").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode($dish); ?>,
                            datasets: [{
                                backgroundColor: [
                                    "#5969ff",
                                    "#ff407b",
                                    "#25d5f2",
                                    "#ffc750",
                                    "#2ec551",
                                    "#7040fa",
                                    "#ff004e"
                                ],
                                data: <?php echo json_encode($totalsales); ?>,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        suggestedMin: 3
                                    }
                                }]
                            },
                            legend: {
                                display: false,
                                position: 'bottom',

                                labels: {
                                    fontColor: '#71748d',
                                    fontFamily: 'Circular Std Book',
                                    fontSize: 14,
                                }
                            },


                        }
                    });
                    myChart.render();
                    document.getElementById("printChart").addEventListener("click", function() {
                        myChart.print();
                    });
                </script>
            </div>
        </section>
    </section>
    <!--  Banner End -->

    <!--Footer start -->

    <?php include('footer.php'); ?>

    <!-- Footer  End -->

</body>

<script>
    $(document).ready(function() {
        $("#type").click(function() {
            $("#table").toggle();
            $("#graph").toggle();
            if (document.getElementById("type").innerHTML === "Graph")
                document.getElementById("type").innerHTML = "Table";
            else
                document.getElementById("type").innerHTML = "Graph";

        });

    });
</script>

</html>