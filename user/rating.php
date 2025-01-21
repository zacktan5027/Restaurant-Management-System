<?php
require_once "conn.php";
if (!isset($_SESSION)) session_start();
$id = $_GET['id'];
$userID = $_SESSION['user']['id'];

$sql = "SELECT * FROM orders NATURAL JOIN orderdetail WHERE dishID=$id AND AccountID=$userID";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $sql1 = "SELECT * FROM feedback WHERE dishID=$id AND AccountID=$userID";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        echo ("<script LANGUAGE='JavaScript'>
    window.alert('You already gave your feedback.');
    window.location.href='dish.php?id=" . $id . "';
    </script>");
    }
} else {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('You are not allow to leave your rating because you have not purchased the dish in the past');
    window.location.href='dish.php?id=" . $id . "';
    </script>");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Rating</title>

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
                            <h1 class="text-capitalize mb-4 font-lg text-white">Add your Rating</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <h1>Add Your Rating</h1>
                <hr>
                <div class="col-lg-12">
                    <h3>Put your Rating </h3>
                    <span id="error_msg" style="display: none;color:red"></span>
                    <br>
                    <div style="background: #f1f1f1; padding: 30px;color:white;text-align:center">
                        <?php
                        for ($counter = 0; $counter < 5; $counter++) {
                            echo '<i class="fa fa-star fa-2x star" data-index="' . $counter . '" style="text-shadow: 0 0 3px #000;"></i>';
                        }
                        ?>

                    </div>

                </div>

                <input type="hidden" name="demo_id" id="demo_id" value="1">
                <br>
                <div class="col-lg-12">
                    <h3>Put your Feedback</h3><br>
                    <textarea class="form-control" rows="5" style="font-size:16px" placeholder="Write your review here..." name="feedback" id="feedback" required></textarea><br>
                    <button class="btn btn-main-border mr-3 float-right" id="rating_submit">Submit</button>
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
<script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
<script>
    var ratedIndex = -1,
        feedback = null,
        dishID = '<?= $id ?>',
        userID = '<?= $userID ?>';

    $(document).ready(function() {
        resetStarColors();

        if (localStorage.getItem('ratedIndex') != null) {
            setStars(parseInt(localStorage.getItem('ratedIndex')));
        }

        $('.star').on('click', function() {
            ratedIndex = parseInt($(this).data('index'));
        });

        $('.star').mouseover(function() {
            resetStarColors();
            var currentIndex = parseInt($(this).data('index'));
            setStars(currentIndex);
        });

        $('.star').mouseleave(function() {
            resetStarColors();

            if (ratedIndex != -1)
                setStars(ratedIndex);
        });

        $('#rating_submit').on('click', function() {
            feedback = $('#feedback').val();
            if (ratedIndex != -1) {
                insertToTheDB();
                window.location.href = "dish.php?id=" + dishID + "";
            } else {
                $("#error_msg")
                    .html("Please choose a star for your rating")
                    .show()
                    .fadeOut("slow");
            }
        })

    });

    function insertToTheDB() {
        $.ajax({
            url: "ratingManager.php",
            method: "POST",
            dataType: 'json',
            data: {
                insert: 1,
                userID: userID,
                dishID: dishID,
                ratedIndex: ratedIndex,
                feedback: feedback
            },
            success: function(r) {
                uID = r.id;
                localStorage.setItem('uID', uID);
            }
        });

    }

    function setStars(max) {
        for (var i = 0; i <= max; i++)
            $('.star:eq(' + i + ')').css('color', 'green');
    }

    function resetStarColors() {
        $('.star').css('color', 'white');
    }
</script>

</html>