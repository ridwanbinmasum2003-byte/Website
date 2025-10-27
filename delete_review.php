<?php
session_start();
require_once 'DBconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Check if review_id is provided
if (!isset($_GET['review_id'])) {
    echo "Review ID is required.";
    exit();
}

$review_id = $_GET['review_id'];

// Delete the review if it belongs to the logged-in user
$sql = "DELETE FROM Review WHERE review_id = $review_id AND user_id = {$_SESSION['user_id']}";
if ($conn->query($sql)) {
    header ("Location: home.php");
} else {
    echo "Error deleting review: " . $conn->error;
}

$conn->close();
?>

