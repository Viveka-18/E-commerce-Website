<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['order_id'])) {
    header("Location: index.php");
    exit();
}

$order_id = intval($_GET['order_id']);
$query = "SELECT * FROM orders WHERE id = $order_id AND user_id = " . $_SESSION['user_id'];
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
?>
    <h2>Order Confirmation</h2>
    <p>Order ID: <?= $row['id'] ?></p>
    <p>Product: <?= htmlspecialchars($row['title']) ?></p>
    <p>Price: ₹<?= $row['price'] ?></p>
    <p>Status: <?= $row['status'] ?></p>
    <img src="<?= htmlspecialchars($row['image']) ?>" width="150">
<?php
} else {
    echo "<p>Order not found.</p>";
}
?>
