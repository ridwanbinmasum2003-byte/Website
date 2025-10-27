<?php
session_start();
require_once 'DBconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch places in the wishlist
$sql = "SELECT p.place_id, p.place_name FROM Wishlist w 
        JOIN Place p ON w.place_id = p.place_id 
        WHERE w.user_id = $user_id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Delius&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>TravelTrack</title>
</head>

<body class="home">
    <header>
        <nav>
            <div class="nav_buttons">
                <a href="cost_summary.php" class="view-cost-summary-btn">View Cost Summary</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </nav>
    </header>
    <main>
        <div class="user-info">
            <h3><?php echo $_SESSION['name']; ?>'s wishlist!</h3>
        </div>
        <div class="wishlist-container">
            <?php if ($result->num_rows > 0) { 
                while ($row = $result->fetch_assoc()) {
                    $place_id = $row['place_id'];
                    $place_name = $row['place_name'];

                    // Fetch transportation options
                    $transport_sql = "SELECT t.type, t.cost FROM Transportation t 
                                    JOIN Wishlist w ON t.transport_id = w.transport_id 
                                    WHERE w.place_id = $place_id AND w.user_id = $user_id";
                    $transport_result = $conn->query($transport_sql);

                    // Fetch hotel options
                    $hotel_sql = "SELECT h.hotel_name, h.avg_price FROM Hotel h 
                                JOIN Wishlist w ON h.hotel_id = w.hotel_id 
                                WHERE w.place_id = $place_id AND w.user_id = $user_id";
                    $hotel_result = $conn->query($hotel_sql);

                    // Fetch historical places
                    $historical_sql = "SELECT hp.name, hp.ticket_price FROM HistoricalPlace hp 
                                    WHERE FIND_IN_SET(hp.historical_id, 
                                    (SELECT w.historical_ids FROM Wishlist w 
                                        WHERE w.place_id = $place_id AND w.user_id = $user_id))";
                    $historical_result = $conn->query($historical_sql);
            ?>

            <div class="place-wishlist">
                <h3><?php echo $place_name; ?></h3>
                <hr>
                <br>
                <!-- Transportation details -->
                <p><strong>Transportation:</strong>
                <?php if ($transport_result->num_rows > 0) {
                    while ($transport = $transport_result->fetch_assoc()) {
                        echo $transport['type'] . " - " . $transport['cost'] . " BDT<br>";
                    }
                } else {
                    echo "None selected.";
                }
                ?>
                </p>

                <!-- Hotel details -->
                <p><strong>Hotel:</strong>
                <?php if ($hotel_result->num_rows > 0) {
                    while ($hotel = $hotel_result->fetch_assoc()) {
                        echo $hotel['hotel_name'] . " - " . $hotel['avg_price'] . " BDT<br>";
                    }
                } else {
                    echo "None selected.";
                }
                ?>
                </p>

                <!-- Historical Places -->
                <p><strong>Historical Places:</strong>
                <br>
                <?php if ($historical_result && $historical_result->num_rows > 0) {
                    while ($historical = $historical_result->fetch_assoc()) {
                        echo $historical['name'] . " - " . $historical['ticket_price'] . " BDT<br>";
                    }
                } else {
                    echo "None selected.";
                }
                ?>
                </p>
                <br>
                <!-- Update and delete options -->
                <a href="update_wishlist.php?place_id=<?php echo $place_id; ?>" class="update-btn-wish">Update Wishlist</a>
                <a href="delete_from_wishlist.php?place_id=<?php echo $place_id; ?>" class="delete-btn-wish" onclick="return confirm('Are you sure you want to remove this place from your wishlist?');">Delete from Wishlist</a>
            </div>

            <?php 
                }
            } else {
                echo "<p class='empty-wishlist-message'>Your wishlist is empty.</p>";
            }

            $conn->close();
            ?>
        </div>
    </main>
</body>
</html>