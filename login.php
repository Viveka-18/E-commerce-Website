<?php
session_start();
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Login successful'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Invalid password'); window.location.href = 'login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-commerce</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: whitesmoke;
        }

        .container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 400px;
        }

        .form-container {
            text-align: center;
        }

        .form-toggle {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .form-toggle button {
            background: none;
            border: none;
            font-size: 1rem;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        .form-toggle button:hover {
            background-color:#124391;
            color: #fff;
        }

        .form {
            display: none;
            text-align: left;
        }

        .form.active {
            display: block;
        }

        .form h2 {
            text-align: center;
            margin-bottom: 1rem;
            color: #333;
        }

        label {
            display: block;
            margin: 0.5rem 0 0.2rem;
            font-size: 0.9rem;
            color: #555;
        }

        input {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 0.8rem;
            background-color:#1855b7;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background:#1855b7;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <div class="form-toggle">
                <button id="login-btn">Login</button>
                <button id="register-btn">Register</button>
            </div>
            <div class="form-content">
                <form id="login-form" class="form active" action="login.php" method="post">
                    <h2>Login</h2>
                    <label for="login-email">Username</label>
                    <input type="text" id="login-email" required name="username">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" required name="password">
                    <button type="submit" class="btn btn-primary" name="login" id="login-btn">Login</button>
                </form>

                <form id="register-form" class="form" action="register.php" method="post">
                    <h2>Register</h2>
                    <label for="register-name">User Name</label>
                    <input type="text" id="register-name" required name="username">
                    <label for="register-password">Password</label>
                    <input type="password" id="register-password" required name="password">
                    <label for="register-confirm-password">Confirm Password</label>
                    <input type="password" id="register-confirm-password" required name="cpassword">
                    <button type="submit" name="register" id="register-btn" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const loginBtn = document.getElementById('login-btn');
        const registerBtn = document.getElementById('register-btn');
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');

        loginBtn.addEventListener('click', () => {
            loginForm.classList.add('active');
            registerForm.classList.remove('active');
        });

        registerBtn.addEventListener('click', () => {
            registerForm.classList.add('active');
            loginForm.classList.remove('active');
        });
        
    </script>
</body>
</html>

