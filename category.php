<?php
include 'db.php';

// Check if category ID is set in the URL
if (isset($_GET['catid']) && is_numeric($_GET['catid'])) {
    $catid = intval($_GET['catid']);
    
    // Fetch category name
    $categoryQuery = mysqli_query($conn, "SELECT CategoryName FROM tblcategory WHERE id = $catid");
    $category = mysqli_fetch_assoc($categoryQuery);
    
    if (!$category) {
        echo "<h2>Category not found</h2>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            padding: 10px;
            background: #f8f9fa;
        }
        .btn{
            background-color:rgb(11, 61, 113);
        }
        .products-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .text-center{
            color:rgb(11, 61, 113);
        }
    </style>
</head>
<body>
    
<?php include ('navbar.php'); ?>
<?php include ("navbar2.php"); ?>
    <div class="container mt-4">
        <div class="row justify-content-center products-container">
            <?php 
            $sql = "SELECT * FROM tblposts WHERE CategoryId=$catid";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-md-3 mb-4">
                        <div class="card product-card">
                            <img src="admin2/postimages/<?= htmlspecialchars($row['PostImage'], ENT_QUOTES, 'UTF-8') ?>" 
                                 alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['PostTitle']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($row['PostDetails']) ?></p>
                                <h6 class="text-danger">$<?= htmlspecialchars($row['Price']) ?></h6>
                                <a href="product_details.php?postid=<?= $row['id'] ?>" class="btn btn-primary">Know More</a>
                            </div>
                        </div>
                    </div>
                <?php } 
            } else { ?>
                <div class="col-12 text-center">
                    <h2>No products available</h2>
                </div>
            <?php } ?>
        </div>
    </div>
    
   
</body>
</html>
