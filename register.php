<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword=$_POST['cpassword'];
    if ($password === $cpassword) {
        $sql="select username,password from users where username='$username'";
        $result=$conn->query($sql);
        if($result->num_rows > 0){
            echo "<script>alert('Username already exists!');
            window.location.href = 'login.php';</script>";
        }   
        else{
    mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
    mysqli_query($conn, "INSERT INTO userprofile(username,password) values ('$username','$password')");
    mysqli_query($conn, "INSERT INTO orders (username) VALUES ('$username')");
     echo "<script>alert('Successfully Registered! you can Login Now');
    window.location.href='login.php';</script>";
        }
}
else{
    echo "<script>alert('Password does not match! Please Try Again');
    window.location.href = 'login.php';</script>";
}
}
?>
