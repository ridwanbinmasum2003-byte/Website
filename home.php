<?php
session_start();
require 'DBconnect.php';

// Check if the user is logged in, else redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all places from the database
$sql = "SELECT * FROM Place";
$result = $conn->query($sql);

// Fetch user details
$user_id = $_SESSION['user_id'];

// Handle search functionality
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM Place WHERE place_name LIKE '%$search%'";
    $result = $conn->query($sql);
}
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
                    <a href="logout.php" class="logout-btn">Logout</a>
                    <a href="wishlist.php" class="wishlist-btn">Show Wishlist</a>
                </div>
            </nav>
        </header>
        
        <main>
            <div class="welcome_box">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
            </div>

            <!-- Search Bar -->
            <div class="search-bar-container">
                <form action="home.php" method="GET">
                    <input type="text" class="search-bar" name="search" placeholder="Search places..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="search-btn">Search</button>
                </form>
            </div>

            <div class="welcome_box">
                <h2>Available Places</h2>
            </div>

            <div class="places-container">
                <?php while ($place = $result->fetch_assoc()) {
                    // Fetch transportation options for the place
                    $transport_sql = "SELECT * FROM Transportation WHERE place_id = " . $place['place_id'];
                    $transport_result = $conn->query($transport_sql);

                    // Fetch hotel options for the place
                    $hotel_sql = "SELECT * FROM Hotel WHERE place_id = " . $place['place_id'];
                    $hotel_result = $conn->query($hotel_sql);

                    // Fetch historical places for the place
                    $historical_sql = "SELECT * FROM HistoricalPlace WHERE place_id = " . $place['place_id'];
                    $historical_result = $conn->query($historical_sql);

                    // Fetch reviews for the place
                    $review_sql = "SELECT * FROM Review r, User u WHERE r.user_id = u.user_id AND r.place_id = " . $place['place_id'];
                    $review_result = $conn->query($review_sql);
                ?>

                <div class="place">
                    <img src="<?php echo htmlspecialchars($place['place_pic']); ?>" alt="<?php echo htmlspecialchars($place['place_name']); ?>" onclick="togglePlaceInfo(<?php echo $place['place_id']; ?>)">
                    <h2><?php echo htmlspecialchars($place['place_name']); ?></h2>
                    <p><strong>Best Season: </strong><?php echo htmlspecialchars($place['best_season']); ?></p>

                    <div id="place_info_<?php echo $place['place_id']; ?>" style="display: none;">  <!-- Start of the information about the place hidden revealed on click -->
                        <h3>Historical Places:</h3>
                        <?php while ($historical = $historical_result->fetch_assoc()) { ?>     <!-- loop for the display of historical places F -->
                            <div class="description-box">
                                <input type="checkbox" name="historical_ids[]" value="<?php echo $historical['historical_id']; ?>" data-price="<?php echo $historical['ticket_price']; ?>" onclick="updateCost(<?php echo $place['place_id']; ?>)">
                                <h4><?php echo htmlspecialchars($historical['name']); ?></h4>
                                <p><?php echo htmlspecialchars($historical['description']); ?></p>     <!-- name,descrip,picture,map  -->
                                <?php
                                if ($historical["picture"] != null) {  
                                    if ($historical["map"] != null) {   
                                        echo "<a href='{$historical['map']}'><img src='{$historical['picture']}' alt='{$historical['name']}' class='historical-img'></a>";
                                    } else {
                                        echo "<img src='{$historical['picture']}' alt='{$historical['name']}' class='historical-img'>";
                                    }
                                }
                                ?>
                                <p><strong>Ticket Price: </strong>BDT <?php echo htmlspecialchars($historical['ticket_price']); ?></p>
                            </div>
                        <?php } ?>

                        <h3>Transportation Options:</h3>                    <!-- Transportation F  -->
                        <div class="description-box">
                            <?php while ($transport = $transport_result->fetch_assoc()) { ?>
                                <li>
                                    <input type="radio" name="transport_<?php echo $place['place_id']; ?>" value="<?php echo $transport['cost']; ?>" data-id="<?php echo $transport['transport_id']; ?>" onclick="updateCost(<?php echo $place['place_id']; ?>)">
                                    <?php echo htmlspecialchars($transport['type']) . ' - ' . htmlspecialchars($transport['cost']) . ' BDT'; ?>
                                </li>
                            <?php } ?>
                        </div>

                        <h3>Hotels:</h3>                                      <!-- Hotels F  -->
                        <div class="description-box">
                            <?php while ($hotel = $hotel_result->fetch_assoc()) { ?>
                                <li>
                                    <input type="radio" name="hotel_<?php echo $place['place_id']; ?>" value="<?php echo $hotel['avg_price']; ?>" data-id="<?php echo $hotel['hotel_id']; ?>" onclick="updateCost(<?php echo $place['place_id']; ?>)">
                                    <?php echo htmlspecialchars($hotel['hotel_name']) . ' - ' . htmlspecialchars($hotel['stars']) . ' Star - BDT ' . htmlspecialchars($hotel['avg_price']); ?>
                                </li>
                            <?php } ?>
                        </div>

                        <p><strong>Total Cost: </strong><span id="total_cost_<?php echo $place['place_id']; ?>">0</span> BDT</p>
                        <br>
                        <form action="add_to_wishlist.php" method="POST" onsubmit="updateCost(<?php echo $place['place_id']; ?>)">
                            <input type="hidden" name="place_id" value="<?php echo $place['place_id']; ?>">
                            <input type="hidden" id="transport_id_<?php echo $place['place_id']; ?>" name="transport_id" value="">
                            <input type="hidden" id="hotel_id_<?php echo $place['place_id']; ?>" name="hotel_id" value="">
                            <input type="hidden" id="historical_ids_<?php echo $place['place_id']; ?>" name="historical_ids" value="">
                            <div class="submit-btn-container">
                                <button type="submit" class="wishlist-add-btn">Add to Wishlist</button>
                            </div>
                        </form>
                    </div>

                    <div class="review-box">
                        <h4>Leave a Review</h4>
                        <form action="submit_review.php" method="POST">
                            <input type="hidden" name="place_id" value="<?php echo $place['place_id']; ?>">
                            
                            <textarea class='comment-box' name="comment" placeholder="Write your review here" required></textarea><br>
                            <div class='rating'>
                                <label class='rating-name' for="rating">Rating: </label>
                                <select class='rating-box' name="rating" id="rating">
                                    <option value="1">1 Star</option>
                                    <option value="2">2 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="5">5 Stars</option>
                                </select>
                            </div>

                            <br>
                            <div class="submit-btn-container">
                                <button type="submit" class="submit-btn">Submit Review</button>
                            </div>
                        </form>
                        <br>
                        <h5>Previous Reviews:</h5>
                        <div class="reviews">
                            <?php while ($review = $review_result->fetch_assoc()) { ?>
                            <p><strong><?php echo htmlspecialchars($review['FirstName']); ?> (<?php echo htmlspecialchars($review['rating']); ?> Stars): </strong><?php echo htmlspecialchars($review['comment']); ?>
                                <?php if ($review['user_id'] == $user_id) { ?>
                                    <form action="edit_review.php" method="GET" style="display: inline;">
                                        <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                                        <button type="submit" class="edit-btn">Edit</button>
                                    </form> |
                                    <form action="delete_review.php" method="GET" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                <?php } ?>
                            </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </main>

        <script>
            function togglePlaceInfo(placeId) {
                var placeInfo = document.getElementById('place_info_' + placeId);
                if (placeInfo.style.display === 'none') {
                    placeInfo.style.display = 'block';
                } else {
                    placeInfo.style.display = 'none';
                }
            }

            function updateCost(placeId) {
                let totalCost = 0;
                let selectedIds = {
                    transport_id: null,
                    hotel_id: null,
                    historical_ids: []
                };

                // Calculate transport cost
                const transport = document.querySelector(`input[name="transport_${placeId}"]:checked`);
                if (transport) {
                    totalCost += parseInt(transport.value);
                    selectedIds.transport_id = transport.getAttribute('data-id');
                }

                // Calculate hotel cost
                const hotel = document.querySelector(`input[name="hotel_${placeId}"]:checked`);
                if (hotel) {
                    totalCost += parseInt(hotel.value);
                    selectedIds.hotel_id = hotel.getAttribute('data-id');
                }

                // Calculate historical places cost
                const historical = document.querySelectorAll(`input[name="historical_ids[]"]:checked`);
                historical.forEach((item) => {
                    totalCost += parseInt(item.getAttribute('data-price'));
                    selectedIds.historical_ids.push(item.value);
                });

                document.getElementById(`total_cost_${placeId}`).textContent = totalCost;

                // Store the selected IDs in hidden inputs
                document.getElementById(`transport_id_${placeId}`).value = selectedIds.transport_id;
                document.getElementById(`hotel_id_${placeId}`).value = selectedIds.hotel_id;
                document.getElementById(`historical_ids_${placeId}`).value = selectedIds.historical_ids.join(',');

                // Log the selected IDs for debugging purposes
                console.log('Selected IDs:', selectedIds);
            }

        </script>
    </body>
</html>