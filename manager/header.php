<?php
require_once "conn.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    session_destroy();
    echo ("<script>
                window.alert('You need to sign in first to enter this page');
                window.location.href='../index.php';
                </script>");
}
if (!$_SESSION['user']['manager']) {
    session_destroy();
    echo ("<script>
                window.alert('You have no privilege to enter this page.');
                window.location.href='../index.php';
                </script>");
}
?>
<div class="preloader">
    <img src="../images/preloader.gif" alt="preloader" class="img-fluid">
</div>

<header class="navigation">
    <nav class="navbar navbar-expand-lg main-nav py-lg-3 position-absolute w-100" id="main-nav" style="background-image: linear-gradient(rgba(0,0,0,1),rgba(0,0,0,0));">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img style="width:200px" src="../images/logo.png" alt="" class="img-fluid">
            </a>

            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="report.php">Report</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="reservation.php">Reservation</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="manageStaff.php">Staff</a></li>
                            <li><a class="dropdown-item" href="verify.php">Change Password</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href='logout.php'>Log out</a></li>
            </div>
        </div>
    </nav>
</header>