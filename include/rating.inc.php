<?php


function getTotalStar($conn, $dishID,  $star)
{
    $totalStar = mysqli_query($conn, "SELECT count(*) as Total,rating from feedback where DishID = " . $dishID . " AND rating=" . $star . "");
    return $totalStar;
}

function getTotalReview($conn, $dishID)
{

    $query = mysqli_query($conn, "SELECT count(FeedbackDetail) as Total_review from feedback where DishID=" . $dishID . "");
    $row = mysqli_fetch_array($query);
    $Total_review = $row['Total_review'];

    return $Total_review;
}

function getTotalRating($conn, $dishID)
{
    $query = mysqli_query($conn, "SELECT count(rating) as Total_rating from feedback where DishID=" . $dishID . "");
    $row = mysqli_fetch_array($query);
    $Total_rating = $row['Total_rating'];

    return $Total_rating;
}

function getAverage($conn, $dishID)
{
    $query = mysqli_query($conn, "SELECT AVG(rating) as average from feedback where DishID=" . $dishID . "");
    $row = mysqli_fetch_array($query);
    $average = $row['average'];

    return $average;
}

function getReview($conn, $dishID)
{
    $review = mysqli_query($conn, "SELECT FeedbackDetail,rating,AccountName from feedback natural join Account where DishID=" . $dishID . " LIMIT 5");

    return $review;
}

function insertFeedback($conn, $dishID, $userID, $star, $feedback)
{
    $sql = "INSERT INTO feedback(AccountID, DishID, FeedbackDetail, Rating) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $userID, $dishID, $feedback, $star);
    $stmt->execute();
    $stmt->close();
}
