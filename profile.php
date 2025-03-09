<?php
session_start();
include 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch user details from database
// Fetch user details from database
$query = mysqli_query($conn, "SELECT * FROM userprofile WHERE username='$username'");
$userData = mysqli_fetch_assoc($query); // Fetch user data

// Prevent undefined key errors
$email = $userData['email'] ?? ''; 
$mobile = $userData['mobile'] ?? ''; 
$address = $userData['address'] ?? ''; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Flipstore</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin-top: 30px;
        }
        .profile-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .nav-tabs .nav-link {
            color: #555;
            font-weight: bold;
        }
        .nav-tabs .nav-link.active {
            background-color: #1855b7;
            color: white;
        }
        .profile-header {
            display: flex;
            align-items: center;
        }
        .profile-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #1855b7;
            color: white;
            font-size: 30px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        .btn-save {
            background-color: #1855b7;
            color: white;
        }
        .btn-save:hover {
            background-color: #124391;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-icon">
                <?php echo strtoupper($username[0]); ?>
            </div>
            <h3>Welcome, <?php echo ucfirst($username); ?></h3>
        </div>

        <ul class="nav nav-tabs mt-3" id="profileTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#account">Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#orders">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#cart">Cart</a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <!-- Account Section -->
            <div id="account" class="tab-pane fade show active">
                <form action="update_profile.php" method="POST">
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" class="form-control" value="<?php echo $userData['username']; ?>" disabled>
                    </div>
                    <div class="form-group">
                    <label>Email (Optional):</label>
    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Enter your email (Optional)">

                    </div>
                    <div class="form-group">
                    <label>Mobile Number:</label>
    <input type="text" class="form-control" name="mobile" value="<?= htmlspecialchars($mobile) ?>" placeholder="Enter your mobile number">

                    </div>
                    <div class="form-group">
                    <label>Address:</label>
                    <textarea class="form-control" name="address" placeholder="Enter your address"><?= htmlspecialchars($address) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-save btn-block">Save Changes</button>
                </form>

                <hr>

               <!-- <a href="change_password.php" class="btn btn-primary btn-block" data-toggle="modal" data-target="#changePasswordModal">Change Password </a>-->
            </div>

            <!-- Orders Section -->
            <div id="orders" class="tab-pane fade">
                
                <a href="order_management.php" class="btn btn-primary">Your Order Details</a>
            </div>

            <!-- Cart Section -->
            <div id="cart" class="tab-pane fade">
                <a href="cart.php" class="btn btn-primary">View Cart Items</a>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="change_password.php" method="POST">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" class="form-control" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-save btn-block">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Ensure Bootstrap tabs work properly
    $(document).ready(function() {
        $('.nav-tabs a').click(function() {
            $(this).tab('show');
        });
    });
</script>

</body>
</html>
