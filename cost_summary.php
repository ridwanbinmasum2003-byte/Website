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
    <title>Cost Summary</title>
</head>
<body class="home">
    <header>
        <nav>
            <div class="logout-btn-container">
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </nav>
    </header>
    <main>
        <div class="user-info">
            <h3><?php echo $_SESSION['name']; ?>'s Cost Summary</h3>
        </div>
        <div class="wishlist-container">

            <?php if ($result->num_rows > 0) { 
                while ($row = $result->fetch_assoc()) {
                    $place_id = $row['place_id'];
                    $place_name = $row['place_name'];
                    $total_transport_cost = 0;
                    $total_hotel_cost = 0;
                    $total_historical_cost = 0;

                    echo "<div class='cost-summary-box'>";
                    echo "<h3><strong>$place_name</strong></h3>";

                    // Fetch transportation details for this place
                    $transport_sql = "SELECT t.type, t.cost FROM Transportation t 
                                      JOIN Wishlist w ON t.transport_id = w.transport_id 
                                      WHERE w.place_id = $place_id AND w.user_id = $user_id";
                    $transport_result = $conn->query($transport_sql);
                    if ($transport_result->num_rows > 0) {
                        echo "<p><strong>Transportation:</strong><br>";
                        while ($transport = $transport_result->fetch_assoc()) {
                            echo $transport['type'] . " - " . $transport['cost'] . " BDT<br>";
                            $total_transport_cost += $transport['cost'];
                        }
                        echo "</p>";
                    } else {
                        echo "<p><strong>Transportation:</strong> None selected.</p>";
                    }

                    // Fetch hotel details for this place
                    $hotel_sql = "SELECT h.hotel_name, h.avg_price FROM Hotel h 
                                  JOIN Wishlist w ON h.hotel_id = w.hotel_id 
                                  WHERE w.place_id = $place_id AND w.user_id = $user_id";
                    $hotel_result = $conn->query($hotel_sql);
                    if ($hotel_result->num_rows > 0) {
                        echo "<p><strong>Hotel:</strong><br>";
                        while ($hotel = $hotel_result->fetch_assoc()) {
                            echo $hotel['hotel_name'] . " - " . $hotel['avg_price'] . " BDT<br>";
                            $total_hotel_cost += $hotel['avg_price'];
                        }
                        echo "</p>";
                    } else {
                        echo "<p><strong>Hotel:</strong> None selected.</p>";
                    }

                    // Fetch historical places for this place
                    $historical_sql = "SELECT hp.name, hp.ticket_price FROM HistoricalPlace hp 
                                       JOIN Wishlist w ON FIND_IN_SET(hp.historical_id, w.historical_ids) > 0
                                       WHERE w.place_id = $place_id AND w.user_id = $user_id";
                    $historical_result = $conn->query($historical_sql);
                    if ($historical_result->num_rows > 0) {
                        echo "<p><strong>Historical Places:</strong><br>";
                        while ($historical = $historical_result->fetch_assoc()) {
                            echo $historical['name'] . " - " . $historical['ticket_price'] . " BDT<br>";
                            $total_historical_cost += $historical['ticket_price'];
                        }
                        echo "</p>";
                    } else {
                        echo "<p><strong>Historical Places:</strong> None selected.</p>";
                    }

                    // Calculate total cost for the current place
                    $total_place_cost = $total_transport_cost + $total_hotel_cost + $total_historical_cost;
                    echo "<h4><strong>Total Cost for $place_name: " . $total_place_cost . " BDT</strong></h4>";
                    echo "</div>";
                }
            } else {
                echo "<p class='cost-summary-message'>No places to check the cost of.</p>";
            }

            $conn->close();
            ?>
        </div>
    </main>
</body>
</html>












