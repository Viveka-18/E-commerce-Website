<?php
session_start();

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]); // Remove the item from the cart
    }
}

// Redirect back to the cart page
header("Location: cart.php");
exit();
?>
