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

// Fetch the review details
$sql = "SELECT * FROM Review WHERE review_id = $review_id AND user_id = {$_SESSION['user_id']}";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "No review found or you do not have permission to edit this review.";
    exit();
}

$review = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = $conn->real_escape_string($_POST['comment']);
    $rating = intval($_POST['rating']);

    // Update the review
    $update_sql = "UPDATE Review SET comment = '$comment', rating = $rating WHERE review_id = $review_id";
    if ($conn->query($update_sql)) {
        header("Location: home.php");
    } else {
        echo "Error updating review: " . $conn->error;
    }
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
    <title>Edit Review</title>
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
        <div class="edit-review-box">
            <h4>Edit Your Review</h4>
            <br>
            <form action="edit_review.php?review_id=<?php echo $review_id; ?>" method="POST">
                <textarea class="comment-box" name="comment" required><?php echo htmlspecialchars($review['comment']); ?></textarea><br>
                <div class="rating">
                    <label class="rating-name" for="rating">Rating: </label>
                    <select class="rating-box" name="rating" id="rating">
                        <option value="1" <?php if ($review['rating'] == 1) echo 'selected'; ?>>1 Star</option>
                        <option value="2" <?php if ($review['rating'] == 2) echo 'selected'; ?>>2 Stars</option>
                        <option value="3" <?php if ($review['rating'] == 3) echo 'selected'; ?>>3 Stars</option>
                        <option value="4" <?php if ($review['rating'] == 4) echo 'selected'; ?>>4 Stars</option>
                        <option value="5" <?php if ($review['rating'] == 5) echo 'selected'; ?>>5 Stars</option>
                    </select>
                </div>
                <br>
                <div class="submit-btn-container">
                    <button type="submit" class="submit-btn">Update Review</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>

