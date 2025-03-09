<?php
session_start();
include 'db.php'; // Ensure database connection

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>alert('Your cart is empty!'); window.location='index.php';</script>";
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username']; // Assuming user is logged in
    $address = htmlspecialchars($_POST['address']);
    $pincode = htmlspecialchars($_POST['pincode']);
    $phone = htmlspecialchars($_POST['phone']);
    $alt_phone = htmlspecialchars($_POST['alt_phone']);

    // Basic validation
    if (empty($address) || empty($pincode) || empty($phone)) {
        echo "<script>alert('Please fill in all required fields!'); window.location='checkout.php';</script>";
        exit();
    }

    if (!is_numeric($pincode) || strlen($pincode) != 6) {
        echo "<script>alert('Invalid Pincode!'); window.location='checkout.php';</script>";
        exit();
    }

    if (!is_numeric($phone) || strlen($phone) != 10) {
        echo "<script>alert('Invalid Phone Number!'); window.location='checkout.php';</script>";
        exit();
    }

    if (!empty($alt_phone) && (!is_numeric($alt_phone) || strlen($alt_phone) != 10)) {
        echo "<script>alert('Invalid Alternative Phone Number!'); window.location='checkout.php';</script>";
        exit();
    }

    // Insert order into database with default status 'Order Confirmed'
    $stmt = $conn->prepare("INSERT INTO orders (username, address, pincode, phone, alt_phone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $address, $pincode, $phone, $alt_phone);
    $stmt->execute();

    $order_id = $conn->insert_id; // Get the last inserted order ID
    $stmt->close();

    // Insert each cart item into order_items table
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $order_id, $product_id, $product['quantity'], $product['price']);
        $stmt->execute();
        $stmt->close();
    }

    // Clear the cart
    unset($_SESSION['cart']);

    echo "<script>alert('Your order has been placed successfully!'); window.location='order_management.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #124391;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Checkout</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="address" class="form-label">Delivery Address:</label>
            <textarea class="form-control" name="address" id="address" required></textarea>
        </div>

        <div class="mb-3">
            <label for="pincode" class="form-label">Pincode:</label>
            <input type="text" class="form-control" name="pincode" id="pincode" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number:</label>
            <input type="text" class="form-control" name="phone" id="phone" required>
        </div>

        <div class="mb-3">
            <label for="alt_phone" class="form-label">Alternative Mobile Number (Optional):</label>
            <input type="text" class="form-control" name="alt_phone" id="alt_phone">
        </div>

        <button type="submit" class="btn btn-primary w-100">Confirm Order</button>
    </form>
</div>

</body>
</html>
