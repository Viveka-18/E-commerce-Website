<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $email = !empty($_POST['email']) ? $_POST['email'] : NULL;

    $updateQuery = "UPDATE userprofile SET mobile='$mobile', address='$address', email=" . ($email ? "'$email'" : "NULL") . " WHERE username='$username'";
    
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile');</script>";
    }
}
?>
