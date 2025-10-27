<?php
session_start();
require_once 'DBconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$place_id = $_POST['place_id'];
$transport_id = isset($_POST['transport_id']) ? $_POST['transport_id'] : null;
$hotel_id = isset($_POST['hotel_id']) ? $_POST['hotel_id'] : null;
$historical_ids = isset($_POST['historical_ids']) ? $_POST['historical_ids'] : '';

// Convert historical IDs array to a comma-separated string
if (is_array($historical_ids)) {
    $historical_ids = implode(',', $historical_ids);
}

// Check if the place is already in the wishlist
$sql = "SELECT * FROM Wishlist WHERE user_id = $user_id AND place_id = $place_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Place already exists in the wishlist, don't add it again
    echo "This place is already in your Wishlist!";
} else {
    // Insert into Wishlist table if not already added
    $sql = "INSERT INTO Wishlist (user_id, place_id, transport_id, hotel_id, historical_ids) 
            VALUES ($user_id, $place_id, '$transport_id', '$hotel_id', '$historical_ids')";
    if ($conn->query($sql) === TRUE) {
        echo "Place added to Wishlist successfully!";
        header("Location: wishlist.php"); // Redirect to wishlist page after adding
        exit();
    } else {
        echo "Error adding to Wishlist: " . $conn->error;
    }
}
?>