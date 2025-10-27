<?php
// Include database connection
require 'DBconnect.php';
session_start();

// Check if the user is logged in, else redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Get the review details from the form
$place_id = $_POST['place_id'];
$user_id = $_SESSION['user_id'];
$comment = $_POST['comment'];
$rating = $_POST['rating'];

// Insert the review into the database
$sql = "INSERT INTO Review (user_id, place_id, comment, rating) VALUES ('$user_id', '$place_id', '$comment', '$rating')";

if ($conn->query($sql) === TRUE) {
    echo "Review submitted successfully!";
    header("Location: home.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
