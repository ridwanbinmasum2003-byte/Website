<?php
session_start();
require_once 'DBconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$place_id = $_GET['place_id']; // Get the place_id to delete

// Delete the place from the wishlist
$sql = "DELETE FROM Wishlist WHERE user_id = $user_id AND place_id = $place_id";
if ($conn->query($sql) === TRUE) {
    echo "Place removed from Wishlist successfully!";
    header("Location: wishlist.php"); // Redirect back to the wishlist page after deletion
} else {
    echo "Error removing place from Wishlist: " . $conn->error;
}

$conn->close();
?>
