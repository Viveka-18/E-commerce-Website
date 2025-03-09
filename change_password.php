
<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $password = $_POST['password'];

    $updateQuery = "UPDATE userprofile SET password='$password' WHERE username='$username'";
    $update = "UPDATE users SET password='$password' WHERE username='$username'";
    
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Password updated successfully!'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Error updating Password');</script>";
    }
}
?>