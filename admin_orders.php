<?php
session_start();
include 'includes/config.php';

// Fetch all orders
$sql = "
    SELECT o.id AS order_id, o.username, o.address, o.pincode, o.phone, o.status, 
           GROUP_CONCAT(p.PostTitle SEPARATOR ', ') AS products, 
           SUM(p.Price) AS total_price
    FROM orders o
    JOIN order_items oi ON o.id = oi.order_id
    JOIN tblposts p ON oi.product_id = p.id
    GROUP BY o.id
    ORDER BY o.created_at DESC
";
$result = $con->query($sql);

// Update status if admin submits the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    $con->query("UPDATE orders SET status = '$new_status' WHERE id = $order_id");

    echo "<script>alert('Order status updated!'); window.location='admin_orders.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlipStore |  OrderManagement</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <!-- Include Bootstrap JavaScript and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div id="wrapper">
        <?php include('includes/topheader.php'); ?>
        <?php include('includes/leftsidebar.php'); ?>
</div>
<div class="container mt-5" style="margin-top: 80px; width: 1000px;">
    <h2 class="text-center">Manage Orders</h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Username</th>
                <th>Address</th>
                <th>Pincode</th>
                <th>Phone</th>
                <th>Products Ordered</th>
                <th>Total Price (₹)</th>
                <th>Status</th>
                <th>Change Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row['order_id']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['address']) ?></td>
                <td><?= htmlspecialchars($row['pincode']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['products']) ?></td>
                    <td>₹<?= number_format($row['total_price'], 2) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td>
    <?php if ($row['status'] === 'Cancel' || $row['status'] === 'Delivered') { ?>
        <button class="btn btn-secondary btn-sm" disabled><?= htmlspecialchars($row['status']) ?></button>
    <?php } else { ?>
        <form method="POST">
            <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
            <select name="status" class="form-select" <?= ($row['status'] === 'Cancel' || $row['status'] === 'Delivered') ? 'disabled' : '' ?>>
                <option value="Order Confirmed" <?= $row['status'] == 'Order Confirmed' ? 'selected' : '' ?>>Order Confirmed</option>
                <option value="Shipped" <?= $row['status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                <option value="Delivered" <?= $row['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm mt-1" <?= ($row['status'] === 'Cancel' || $row['status'] === 'Delivered') ? 'disabled' : '' ?>>Update</button>
        </form>
    <?php } ?>
</td>

            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
