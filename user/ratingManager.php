<?php

require_once "../include/dbh.inc.php";
require_once "../include/rating.inc.php";

$userID   = $conn->real_escape_string($_POST["userID"]);
$dishID   = $conn->real_escape_string($_POST["dishID"]);
$star     = $conn->real_escape_string($_POST["ratedIndex"]);
$feedback = $conn->real_escape_string($_POST["feedback"]);
$star++;

insertFeedback($conn, $dishID, $userID, $star, $feedback);
