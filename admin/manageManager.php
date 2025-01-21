<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage Manager</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Plugins Start -->

    <?php include('plugins.php'); ?>

    <!-- Plugins Close -->
</head>

<style>
    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 9999;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        padding: 20px;
        margin: auto;
        /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 70%;
        /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.4s;
        animation: animatezoom 0.4s
    }

    @-webkit-keyframes animatezoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes animatezoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }

        .cancelbtn {
            width: 100%;
        }
    }

    #message {
        display: none;
        background: #f5f5f5;
        color: #000;
        position: relative;
        padding: 20px;
        margin-top: 10px;
    }

    #message p {
        padding: 10px 35px;
        font-size: 18px;
    }

    #message2 {
        display: none;
        background: #f5f5f5;
        color: #000;
        position: relative;
        padding: 20px;
        margin-top: 10px;
    }

    #message2 p {
        padding: 10px 35px;
        font-size: 18px;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
        color: green;
    }

    .valid:before {
        position: relative;
        left: -35px;
        content: "✔";
    }

    /* Add a red text color and an "x" icon when the requirements are wrong */
    .invalid {
        color: red;
    }

    .invalid:before {
        position: relative;
        left: -35px;
        content: "✖";
    }
</style>

<body>
    <!-- Header Start -->

    <?php include('Managerheader.php'); ?>

    <!-- Header Close -->

    <section class="slider-hero hero-slider  hero-style-1  ">
        <section class="section-header bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h1 class="text-capitalize mb-4 font-lg text-white">Manager</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div style="margin: auto;width:80%">
                <select id="conList" class="btn btn-default">
                    <option value="0">All condition</option>
                    <?php
                    $select1 = "";
                    $select2 = "";
                    if (isset($_GET['condition'])) {
                        if ($_GET['condition'] == 1)
                            $select1 = "selected";
                        else
                            $select2 = "selected";
                    }
                    ?>
                    <option <?= $select1 ?> value="1">Active</option>
                    <option <?= $select2 ?> value="2">Deactive</option>
                </select>
                <button class="btn btn-main float-right" onclick="document.getElementById('addManager').style.display='block'"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Manager</button>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table text-center table-cart">
                                <thead>
                                    <tr>
                                        <td>Manager Name</td>
                                        <td>Restaurant Name</td>
                                        <td>Email</td>
                                        <td>Phone Number</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $where = "";
                                    if (isset($_GET['condition'])) {
                                        $active = 1;
                                        if ($_GET['condition'] == 2)
                                            $active = 0;
                                        $where = "AND active = " . $active . "";
                                    }
                                    $sql = "SELECT * FROM staff NATURAL JOIN restaurant WHERE StaffPosition='Manager' $where ORDER BY restaurant.RestaurantName";

                                    $res_q = $conn->query($sql);
                                    $dishes = [];
                                    $totalPrice = 0;
                                    if (mysqli_num_rows($res_q) > 0) {
                                        while ($res = $res_q->fetch_array()) {
                                    ?>
                                            <tr>
                                                <td><?= $res['StaffName'] ?></td>
                                                <td><?= $res['RestaurantName'] ?></td>
                                                <td><?= $res['StaffEmail'] ?></td>
                                                <td><?= $res['StaffPhoneNumber'] ?></td>
                                                <td>
                                                    <button class="btn btn-main" onclick="document.getElementById('editManager<?php echo $res['StaffID']; ?>').style.display='block'">Edit</button>
                                                    <?php
                                                    if ($res['active']) {
                                                    ?>
                                                        <button class="btn btn-main" onclick="document.getElementById('deactiveManager<?php echo $res['StaffID']; ?>').style.display='block'">Deactive</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn btn-dark" onclick="document.getElementById('deactiveManager<?php echo $res['StaffID']; ?>').style.display='block'">Active</button>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <?php include('manager_modal.php'); ?>
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
            </div>
            <?php include('addManager_modal.php'); ?>
        </section>
    </section>
    <!--  Banner End -->

    </section>
    <!--Footer start -->

    <?php include('footer.php'); ?>

    <!-- Footer  End -->

</body>


<script type="text/javascript">
    $(document).ready(function() {
        $("#conList").on('change', function() {

            if ($(this).val() == 0) {
                window.location = 'manageManager.php';
            } else {
                localStorage.setItem('con', $(this).val());
                window.location = '?condition=' + $(this).val();
            }

        });

        $("#username").keypress(function(e) {
            if (e.which === 32) return false;
        });

        $("#pwd").keypress(function(e) {
            if (e.which === 32) return false;
        });

        $("#pwd2").keypress(function(e) {
            if (e.which === 32) return false;
        });

        $("#email").keypress(function(e) {
            if (e.which === 32) return false;
        });

        $("#phoneNumber").keypress(function(e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#phone_error_msg").html("Number only").show().fadeOut("slow");
                return false;
            }
        });
        let pwd = document.getElementById("pwd");
        let pwd2 = document.getElementById("pwd2");
        let letter = document.getElementById("letter");
        let capital = document.getElementById("capital");
        let number = document.getElementById("number");
        let length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        pwd.onfocus = function() {
            document.getElementById("message").style.display = "block";
            pwd.style.removeProperty("border");
        };

        // When the user clicks outside of the password field, hide the message box
        pwd.onblur = function() {
            document.getElementById("message").style.display = "none";
            if (pwd.value == "") {
                pwd.style.borderColor = "red";
            }
        };

        // When the user clicks on the password field, show the message box
        pwd2.onfocus = function() {
            document.getElementById("message2").style.display = "block";
            pwd2.style.removeProperty("border");
        };

        // When the user clicks outside of the password field, hide the message box
        pwd2.onblur = function() {
            document.getElementById("message2").style.display = "none";
            if (pwd2.value == "") {
                pwd2.style.borderColor = "red";
            }
        };

        // When the user starts to type something inside the password field
        pwd.onkeyup = function() {
            console.log("yes");
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (pwd.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (pwd.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (pwd.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if (pwd.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        };
        pwd2.onkeyup = function() {
            if (
                document.getElementById("pwd2").value ==
                document.getElementById("pwd").value
            ) {
                letter2.classList.remove("invalid");
                letter2.classList.add("valid");
            } else {
                letter2.classList.remove("valid");
                letter2.classList.add("invalid");
            }
        };
    });
</script>

</html>