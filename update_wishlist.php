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
    $transport_id = isset($_POST['transport_id']) ? $_POST['transport_id'] : null;
    $hotel_id = isset($_POST['hotel_id']) ? $_POST['hotel_id'] : null;
    $historical_ids = isset($_POST['historical_ids']) ? implode(',', $_POST['historical_ids']) : null;

    // Build the SQL query dynamically based on provided fields
    $update_fields = [];
    if ($transport_id !== null) {
        $update_fields[] = "transport_id = '$transport_id'";
    }
    if ($hotel_id !== null) {
        $update_fields[] = "hotel_id = '$hotel_id'";
    }
    if ($historical_ids !== null) {
        $update_fields[] = "historical_ids = '$historical_ids'";
    }

    if (!empty($update_fields)) {
        $sql = "UPDATE Wishlist SET " . implode(', ', $update_fields) . " WHERE user_id = $user_id AND place_id = $place_id";

        if ($conn->query($sql)) {
            header("Location: wishlist.php");
            exit();
        } else {
            echo "Error updating Wishlist: " . $conn->error;
        }
    } else {
        echo "No fields to update.";
    }
    exit();
}

if (!isset($_GET['place_id'])) {
    echo "Invalid place selected.";
    exit();
}

$place_id = $_GET['place_id'];
$user_id = $_SESSION['user_id'];

// Fetch the place details
$sql = "SELECT place_name FROM Place WHERE place_id = $place_id";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    echo "Place not found.";
    exit();
}
$place = $result->fetch_assoc();
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
    <main>
        <div class="user-info">
            <h3>Update Wishlist for <?php echo $place['place_name']; ?></h3>
        </div>

        <div class="wishlist-container">
            <form action="" method="POST">
                <input type="hidden" name="place_id" value="<?php echo $place_id; ?>">

                <!-- Transportation options -->
                <h3>Choose Transportation:</h3>
                
                <div class="description-box-update">
                    <?php
                    $transport_sql = "SELECT transport_id, type, cost FROM Transportation WHERE place_id = $place_id";
                    $transport_result = $conn->query($transport_sql);
                    while ($transport = $transport_result->fetch_assoc()) {
                        echo "<label><input type='radio' name='transport_id' value='{$transport['transport_id']}'> {$transport['type']} - {$transport['cost']} BDT</label><br>";
                    }
                    ?>
                </div>

                <!-- Hotel options -->
                <h3>Choose Hotel:</h3>
                <div class="description-box-update">
                    <?php
                    $hotel_sql = "SELECT hotel_id, hotel_name, avg_price FROM Hotel WHERE place_id = $place_id";
                    $hotel_result = $conn->query($hotel_sql);
                    while ($hotel = $hotel_result->fetch_assoc()) {
                        echo "<label><input type='radio' name='hotel_id' value='{$hotel['hotel_id']}'> {$hotel['hotel_name']} - {$hotel['avg_price']} BDT</label><br>";
                    }
                    ?>
                </div>
                

                <!-- Historical places options -->
                <h3>Choose Historical Places:</h3>
                <div class="description-box-update">
                    <?php
                    $historical_sql = "SELECT historical_id, name, ticket_price FROM HistoricalPlace WHERE place_id = $place_id";
                    $historical_result = $conn->query($historical_sql);
                    while ($historical = $historical_result->fetch_assoc()) {
                        echo "<label><input type='checkbox' name='historical_ids[]' value='{$historical['historical_id']}'> {$historical['name']} - {$historical['ticket_price']} BDT</label><br>";
                    }
                    ?>
                </div>

                <br>
                <div class="submit-btn-container">
                    <button type="submit" class="submit-btn">Save Updates</button>
                </div>
            </form>
        </div>

    </main>
</body>
</html>







