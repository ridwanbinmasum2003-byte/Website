<?php
session_start();
require_once 'DBconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $place_id = $_POST['place_id'];
    $transport_id = $_POST['transport_id'];
    $hotel_id = $_POST['hotel_id'];
    $historical_ids = isset($_POST['historical_ids']) ? implode(',', $_POST['historical_ids']) : '';

    // Update Wishlist
    $sql = "UPDATE Wishlist SET 
            transport_id = '$transport_id', 
            hotel_id = '$hotel_id', 
            historical_ids = '$historical_ids' 
            WHERE user_id = $user_id AND place_id = $place_id";

    if ($conn->query($sql)) {
        header("Location: wishlist.php");
        exit();
    } else {
        echo "Error updating Wishlist: " . $conn->error;
    }
}
?>
