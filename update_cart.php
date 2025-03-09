<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $id => $new_quantity) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] = max(1, intval($new_quantity)); // Ensure at least 1
        }
    }
}

header("Location: cart.php"); // Redirect back to cart
exit();
