<?php
require_once('DBconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $favword = mysqli_real_escape_string($conn, $_POST['favword']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);

    // Verify the username and favorite word
    $sql = "SELECT * FROM User WHERE username = '$username' AND favword = '$favword'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Update the password
        $update_sql = "UPDATE User SET password = '$new_password' WHERE username = '$username'";
        if (mysqli_query($conn, $update_sql)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error updating password: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid username or favorite word.";
    }
}

mysqli_close($conn);
?>