<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .btn {
            background-color: rgb(13, 53, 118);
            color: white;
        }
        input[type="number"] {
            width: 60px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2>Your Shopping Cart</h2>

    <?php
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<p>Your cart is empty.</p>";
    } else {
        echo '<form action="update_cart.php" method="POST">';
        echo '<table class="table table-bordered">';
        echo '<tr><th>Image</th><th>Title</th><th>Price</th><th>Quantity</th><th>Total Price</th><th>Remove</th></tr>';
        
        $totalAmount = 0;
        
        foreach ($_SESSION['cart'] as $id => $product) {
            $subtotal = $product['price'] * $product['quantity'];
            $totalAmount += $subtotal;
            
            echo '<tr>';
            echo '<td><img src="' . htmlspecialchars($product['image']) . '" width="50"></td>';
            echo '<td>' . htmlspecialchars($product['title']) . '</td>';
            echo '<td>$' . htmlspecialchars($product['price']) . '</td>';
            echo '<td><input type="number" name="quantity[' . $id . ']" value="' . htmlspecialchars($product['quantity']) . '" min="1"></td>';
            echo '<td>$' . number_format($subtotal, 2) . '</td>';
            echo '<td><a href="remove_from_cart.php?product_id=' . $id . '" class="btn btn-danger btn-sm">Remove</a></td>';
            echo '</tr>';
        }

        echo '<tr><td colspan="4" class="text-right"><strong>Total Amount:</strong></td>';
        echo '<td><strong>$' . number_format($totalAmount, 2) . '</strong></td>';
        echo '<td></td></tr>';
        
        echo '</table>';
        echo '<button type="submit" class="btn btn-primary">Update Cart</button>';
        echo '</form>';
    }
    ?>
    
    <a href="index.php" class="btn btn-secondary">Continue Shopping</a>
    <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
</div>

</body>
</html>
