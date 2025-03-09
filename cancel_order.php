<?php
session_start();
include 'db.php';

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    die("Error: User not logged in.");
}

// Get the order ID from the URL
if (isset($_GET['id'])) {
    $order_id = intval($_GET['id']); // Sanitize input
    $username = $_SESSION['username'];

    // Update the order status to "Cance"
    $stmt = $conn->prepare("UPDATE orders SET status = 'Cancel' WHERE id = ? AND username = ?");
    $stmt->bind_param("is", $order_id, $username);

    if ($stmt->execute()) {
        echo "<script>alert('Order status updated to Cance!'); window.location.href='order_management.php';</script>";
    } else {
        echo "<script>alert('Error updating order status!'); window.location.href='order_management.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='order_management.php';</script>";
}
?>
