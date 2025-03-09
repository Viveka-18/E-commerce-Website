<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $title = $_POST["title"];
    $price = $_POST["price"];
    $image = $_POST["image"];

    // If cart is not set, initialize it
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    // Check if product already exists in cart
    if (isset($_SESSION["cart"][$product_id])) {
        // If product exists, increase quantity
        $_SESSION["cart"][$product_id]["quantity"] += 1;
    } else {
        // If product is new, add to cart
        $_SESSION["cart"][$product_id] = [
            "title" => $title,
            "price" => $price,
            "image" => $image,
            "quantity" => 1
        ];
    }

    echo "Product added to cart successfully!";
} else {
    echo "Invalid request!";
}
?>
