<?php
session_start();
include 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    die("Error: User not logged in.");
}

$user_id = $_SESSION['username']; // Get user ID from session

// Fetch user orders along with product names and total price
$sql = "
    SELECT o.id, o.username, o.address, o.pincode, o.phone, o.status, o.created_at,
           GROUP_CONCAT(p.PostTitle SEPARATOR ', ') AS products, 
           SUM(oi.price * oi.quantity) AS total_price
    FROM orders o
    JOIN order_items oi ON o.id = oi.order_id
    JOIN tblposts p ON oi.product_id = p.id
    WHERE o.username = ?
    GROUP BY o.id
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">My Orders</h2>

    <?php if ($result->num_rows === 0): ?>
        <p class="text-center text-muted">You have no orders.</p>
    <?php else: ?>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Username</th>
                    <th>Products</th>
                    <th>Total Price</th>
                    <th>Address</th>
                    <th>Pincode</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Placed On</th>
                    <th>Invoice</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td> 
                    <td><?= htmlspecialchars($row['products']) ?></td>
                    <td>₹<?= number_format($row['total_price'], 2) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['pincode']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                    <td>
                        <!-- Invoice Link -->
                        <?php if ($row['status'] === 'Cancel') { ?>
                            <button class="btn btn-primary" disabled>Invoice</button>
                        <?php } elseif ($row['status'] === 'Delivered' ) { ?>
                            <button class="btn btn-primary" disabled>Invoice</button>
                        <?php }
                        else{?>
                             
                             <a href="generate_bill.php?order_id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-primary">View Invoice</a>
<?php }?>
                            
                    </td>
                    <td>
                        <?php if ($row['status'] === 'Cancel') { ?>
                            <button class="btn btn-secondary btn-sm" disabled>Cancelled</button>
                        <?php } elseif ($row['status'] === 'Delivered' ) { ?>
                            <button class="btn btn-secondary btn-sm" disabled>Delivered</button>
                        <?php } elseif ($row['status'] === 'Shipped' ) { ?>
                            <button class="btn btn-secondary btn-sm" disabled>Shipped</button>
                        <?php } else { ?>
                            <a href="cancel_order.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Cancel</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
