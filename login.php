<?php
session_start();   //keeps me logged in
require_once('DBconnect.php');

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']); //sanitizes special chars
    $password = mysqli_real_escape_string($conn, $_POST['password']);  
    
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";    
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['FirstName'];
        header("Location: home.php");
        exit();
    } else {
        echo "Wrong username or password.";
    }
}
?>