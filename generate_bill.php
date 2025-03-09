<?php
session_start();
include 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    die("Error: User not logged in.");
}

// Check if order_id is passed in the URL
if (!isset($_GET['order_id'])) {
    die("Error: Order ID not provided.");
}

$order_id = intval($_GET['order_id']); // Get order ID from URL
$user_id = $_SESSION['username']; // Get user ID from session

// Fetch order details along with product information for the specific order
$sql = "
    SELECT o.id, o.username, o.address, o.pincode, o.phone, o.created_at, 
           p.PostTitle, p.Price, o.status
    FROM orders o
    JOIN order_items oi ON o.id = oi.order_id
    JOIN tblposts p ON oi.product_id = p.id
    WHERE o.username = ? AND o.id = ?
    ORDER BY o.created_at DESC
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("si", $user_id, $order_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if any records exist for this order
if ($result->num_rows == 0) {
    die("Error: No orders found for this user.");
}

// Fetch order details
$order = $result->fetch_assoc();
$customer_name = htmlspecialchars($order['username']);
$address = htmlspecialchars($order['address']);
$pincode = htmlspecialchars($order['pincode']);
$phone = htmlspecialchars($order['phone']);
$order_date = htmlspecialchars($order['created_at']);
$delivery_date = date('Y-m-d', strtotime($order_date . ' +7 days'));

$total_price = 0;
$products = [];

// Reset result pointer and fetch all products for this specific order
$result->data_seek(0);
while ($row = $result->fetch_assoc()) {
    $products[] = [
        'name' => htmlspecialchars($row['PostTitle']),
        'price' => $row['Price']
    ];
    $total_price += $row['Price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Order #<?= htmlspecialchars($order_id) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .invoice-box {
            max-width: 700px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            background: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-title {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            color: #333;
        }
        .invoice-header, .invoice-footer {
            text-align: center;
            margin-bottom: 15px;
        }
        .invoice-footer {
            font-size: 14px;
            color: #555;
        }
        .table th, .table td {
            text-align: center;
        }
        .close-btn {
            display: block;
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
        }
        .close-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <div class="invoice-header">
        <h2>🛍️ Thank You for Shopping with Us! 🛍️</h2>
        <p>"Bringing Happiness to Your Doorstep! 🚀"</p>
    </div>

    <h3 class="invoice-title">Invoice</h3>
    <p><strong>Order ID:</strong> #<?= htmlspecialchars($order_id) ?></p>
    <p><strong>Order Date:</strong> <?= $order_date ?></p>
    <p><strong>Delivery Date:</strong> <?= $delivery_date ?> (Expected within 7 days)</p>

    <hr>

    <h4>Customer Details:</h4>
    <p><strong>Name:</strong> <?= $customer_name ?></p>
    <p><strong>Address:</strong> <?= $address ?></p>
    <p><strong>Pincode:</strong> <?= $pincode ?></p>
    <p><strong>Phone:</strong> <?= $phone ?></p>

    <hr>

    <h4>Order Summary:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price (₹)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) { ?>
            <tr>
                <td><?= $product['name'] ?></td>
                <td>₹<?= number_format($product['price'], 2) ?></td>
            </tr>
            <?php } ?>
            <tr>
                <th colspan="1">Total Amount</th>
                <th>₹<?= number_format($total_price, 2) ?></th>
            </tr>
        </tbody>
    </table>

    <hr>

    <div class="invoice-footer">
        <p>💖 "Shop More, Save More! See You Again!" 💖</p>
        <p>📦 Your happiness is just a package away! 🚚</p>
    </div>

    <!-- Close Button -->
    <a href="Order_management.php" class="close-btn">Close</a>
</div>

</body>
</html>
