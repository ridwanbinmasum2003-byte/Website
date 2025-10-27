<?php
session_start();
require_once('DBconnect.php');

if (isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['favword'])) {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $favword = $_POST['favword'];

    $sql1 = "SELECT * FROM user WHERE email = '$email'";
    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) > 0) {
        echo "Account already exists. Please sign in.";
    } else if (mysqli_num_rows($result1) == 0) {
        if ($lastname == "") {
            $sql = "INSERT INTO User (firstname, email, password, username, favword, lastname) VALUES ('$firstname', '$email', '$password', '$username', '$favword', NULL)";
        } else {
            $sql = "INSERT INTO User (firstname, email, password, username, favword, lastname) VALUES ('$firstname', '$email', '$password', '$username', '$favword', '$lastname')";
        }

        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: index.php");
        } else {
            echo "Insertion Failed: " . mysqli_error($conn);
        }
    } else {
        echo "Insertion Failed";
    }
}

mysqli_close($conn);
?>