<?php
session_start();
include 'db.php';

// Check if postid is set in the URL
if (isset($_GET['postid'])) {
    $postid = intval($_GET['postid']); // Convert to integer for security

    // Fetch product details from the database
    $query = "SELECT * FROM tblposts WHERE id = $postid";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $title = htmlspecialchars($row['PostTitle']);
        $details = nl2br(htmlspecialchars($row['PostDetails']));
        $price = htmlspecialchars($row['Price']);
        $category = htmlspecialchars($row['CategoryId']);
        $description = nl2br(htmlspecialchars($row['PostDetails1']));

        // Fetch multiple images
        $images = [];
        if (!empty($row['PostImage'])) $images[] = htmlspecialchars($row['PostImage']);
        if (!empty($row['PostImage1'])) $images[] = htmlspecialchars($row['PostImage1']);
        if (!empty($row['PostImage2'])) $images[] = htmlspecialchars($row['PostImage2']);
    } else {
        echo "<script>alert('Product not found!'); window.location='index.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request!'); window.location='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Flipstore</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css">

    <style>
        .product-container {
            width:max-content;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        /* Image Gallery */
        .image-gallery {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .main-image img {
    width: 400px;
    height: 350px;
    object-fit: contain; /* Ensure the full image is shown */
    border-radius: 10px;
    background: #f8f9fa;
    padding: 10px;
}
        .side-images {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .side-images img {
    width: 80px;
    height: 80px;
    object-fit: contain; /* Show the full image without cropping */
    border-radius: 10px;
    background: #f8f9fa;
    padding: 5px;
    cursor: pointer;
    transition: transform 0.2s, border 0.2s;
    border: 2px solid transparent;
}

        .side-images img:hover, .side-images img.active {
            transform: scale(1.1);
            border: 2px solid #124391;
        }

        /* Product Details */
        .product-info {
            max-width: 400px;
        }

        .product-title {
            font-size: 24px;
            font-weight: bold;
        }

        .product-price {
            font-size: 22px;
            font-weight: bold;
            color: red;
        }

        .btn {
            background-color: #124391;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .btn:hover {
            background-color: #0d356f;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
                text-align: center;
            }

            .image-gallery {
                flex-direction: column;
            }

            .side-images {
                flex-direction: row;
                justify-content: center;
            }
        }
    </style>

    <script>
        function changeMainImage(src) {
            document.getElementById('mainImage').src = src;

            // Remove 'active' class from all thumbnails
            document.querySelectorAll('.side-images img').forEach(img => img.classList.remove('active'));

            // Add 'active' class to clicked thumbnail
            event.target.classList.add('active');
        }
    </script>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="product-container">
                <!-- Image Gallery -->
                <div class="image-gallery">
                    <div class="side-images">
                        <?php foreach ($images as $index => $image) { ?>
                            <img src="admin2/postimages/<?= $image ?>" onclick="changeMainImage(this.src)" alt="<?= $title ?>" class="<?= $index === 0 ? 'active' : '' ?>">
                        <?php } ?>
                    </div>
                    <div class="main-image">
                        <img id="mainImage" src="admin2/postimages/<?= $images[0] ?>" alt="<?= $title ?>">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    <h2 class="product-title"><?= $title ?></h2>
                    <h4 class="product-price">₹ <?= $price ?></h4>
                    <p><?= $details ?></p>
                    <p><?= $description ?></p>
                    <button class="btn add-to-cart btn-primary"
                            data-id="<?= $postid ?>"
                            data-title="<?= $title ?>"
                            data-price="<?= $price ?>"
                            data-image="admin2/postimages/<?= $images[0] ?>">
                        Add to Cart
                    </button>
</form>

                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Products Section -->
<div class="container mt-4">
    <div class="row">
        <header style="font-size:30px; font-weight:bolder; margin-bottom:15px; color:rgb(15, 50, 87);">Related Products</header>
        <?php 
        $sql = "SELECT * FROM tblposts WHERE CategoryId=$category";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-3 mb-4">
                <div class="card product-card">
                    <img src="admin2/postimages/<?= htmlspecialchars($row['PostImage'], ENT_QUOTES, 'UTF-8') ?>" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['PostTitle']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['PostDetails']) ?></p>
                        <h6 class="text-danger">RS <?= htmlspecialchars($row['Price']) ?></h6>
                        <a href="product_details.php?postid=<?= $row['id'] ?>" class="btn btn-primary">Know More</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script>
$(document).ready(function() {
    $(".add-to-cart").click(function() {
        var button = $(this); // Store reference to the button

        // Check if user is logged in via AJAX
        $.ajax({
            url: "check_login.php",
            method: "GET",
            success: function(response) {
                if (response.trim() === "logged_in") {
                    // User is logged in, proceed with adding to cart
                    var product_id = button.data("id");
                    var title = button.data("title");
                    var price = button.data("price");
                    var image = button.data("image");

                    $.ajax({
                        url: "add_to_cart.php",
                        method: "POST",
                        data: {
                            product_id: product_id,
                            title: title,
                            price: price,
                            image: image
                        },
                        success: function(response) {
                            alert("Product successfully added to cart!");
                        },
                        error: function() {
                            alert("Failed to add product to cart!");
                        }
                    });
                    
                } else {
                    // User is not logged in, show alert and redirect to login page
                    alert("Please log in to add products to the cart.");
                    window.location.href = "login.php"; // Redirect to login page
                }
            }
        });
    });
});

</script>
<?php include("footer.php"); ?>

</body>
</html>
