<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Report</title>

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
                            <h1 class="text-capitalize mb-4 font-lg text-white">Report</h1>
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
                                        <th>Type of report</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Daily Report</td>
                                        <td>
                                            <div class="form-group">
                                                <form action="dailyReport.php?type=table" method="POST">
                                                    <?php

                                                    $month = date('m');
                                                    $day = date('d');
                                                    $year = date('Y');

                                                    $today = $year . '-' . $month . '-' . $day;
                                                    $thisMonth = $year . '-' . $month;
                                                    ?>
                                                    <input style="text-align: center;background:white" class="form-control" value="<?= $today ?>" name="date" disabled type="date">
                                                    <input class="btn btn-main float-right" type="submit" name="daily" value="Generate Report" />
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date Report</td>
                                        <td>
                                            <div class="form-group">
                                                <form action="dateReport.php" method="POST">
                                                    <input style="text-align: center;" class="form-control" id="myDate" name="dateSelected" max="<?= $today ?>" min="2000-01-01" required type="date">
                                                    <input class="btn btn-main float-right" onsubmit="return validateForm()" type="submit" name="date" value="Generate Report" />
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Monthly Report</td>
                                        <td>
                                            <div class="form-group">
                                                <form action="monthlyReport.php" method="POST">
                                                    <input style="text-align: center;" class="form-control" id="myMonth" min="2000-01" max="<?= $thisMonth ?>" name="monthSelected" required type="month">
                                                    <input class="btn btn-main float-right" onsubmit="return validateForm()" type="submit" name="month" value="Generate Report" />
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Yearly Report <br> <span style="color:red" class="year_error_msg"></span></td>
                                        <td>
                                            <div class="form-group">
                                                <form action="yearlyReport.php" method="POST">
                                                    <form class="row">
                                                        <input id="year" style="text-align: center;" class="form-control" name="yearSelected" required type="text" onkeyup="year_format('year');" maxlength="4" max="<?php echo $year ?>">
                                                        <input class="btn btn-main float-right" onsubmit="return validateForm()" type="submit" name="year" value="Generate Report" />
                                                    </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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

<script>
    $(document).ready(function() {
        $("#resList").on("change", function() {
            if ($(this).val() == 0) {
                window.location = "report.php";
            } else {
                window.location = "?restaurant=" + $(this).val();
            }
        });

        $("#year").keypress(function(e) {
            //if the letter is not digit then display error and don't type anything
            if (
                e.which != 8 &&
                e.which != 0 &&
                e.which != 46 &&
                (e.which < 48 || e.which > 57)
            ) {
                //display error message
                $(".year_error_msg").html("Number only").show().fadeOut("slow");
                return false;
            }
        });
    });

    function year_format(year) {
        let date = new Date();
        let thisYear = date.getFullYear();
        let yearNumString = document.getElementById(year).value;

        if (yearNumString.length >= 4) {
            if (yearNumString < 2000) {
                yearNumString = yearNumString.substring(0, 0);
                document.getElementById(year).value = yearNumString;
                alert("Please choose year more than 2000");
            }
            if (yearNumString > thisYear) {
                yearNumString = yearNumString.substring(0, 0);
                document.getElementById(year).value = yearNumString;
                alert("Please choose year less than or equal to " + thisYear);
            }
        }
    }
</script>

</html>