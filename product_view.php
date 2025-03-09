<?php 
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
        }
        .product-card img {
            width: 100%; /* Make images fill the container */
            height: 200px; /* Set a fixed height */
            object-fit: contain; /* Ensures the full image is visible without cropping */
            padding: 10px; /* Adds space around the image */
            background: #f8f9fa; /* Light background to handle transparent images */
        }
        .row header{
            font-size:30px;
            font-weight:bolder;
            margin-bottom:15px;
            color:rgb(15, 50, 87);
        }
        .btn{
            background-color:rgb(11, 61, 113);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        
        <div class="row">
            <header>Explore our products </header>
            <?php 
            $sql = "SELECT * FROM tblposts WHERE Is_Active=1";
           
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) { 
                $category= $row ['CategoryId']?>
                <div class="col-md-3 mb-4">
                    <div class="card product-card">
                        <img src="admin2/postimages/<?= htmlspecialchars($row['PostImage'], ENT_QUOTES, 'UTF-8') ?>" 
                             alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['PostTitle']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($row['PostDetails']) ?></p>
                            <h6 class="text-danger">₹<?= htmlspecialchars($row['Price']) ?></h6>
                            <a href="product_details.php?postid=<?= $row['id'] ?>" class="btn btn-primary">Know More</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
