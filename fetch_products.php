<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <style>
        .card-img-top {
    width: 100%; /* Ensures the image stretches to full width */
    height: 200px; /* Adjust this to match the dashboard size */
    object-fit: cover; /* Ensures the image maintains aspect ratio and fills the space */
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

        </style>
</head>
<body>
    

<?php
include 'db.php';

$subcatid = isset($_POST['subcatid']) ? intval($_POST['subcatid']) : 0;

if ($subcatid > 0) {
    $query = "SELECT * FROM tblposts WHERE SubCategoryID = $subcatid";
} else {
    $query = "SELECT * FROM tblposts"; // If 'All' is selected, fetch all products
}

$result = mysqli_query($conn, $query);
$output = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
            <div class="col-md-3 mb-4 product-card">
                <div class="card">
                    <img src="postimages/' . htmlspecialchars($row['PostImage'], ENT_QUOTES, 'UTF-8') . '" 
     alt="Product Image" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($row['PostTitle']) . '</h5>
                        <p class="card-text">' . htmlspecialchars($row['PostDetails']) . '</p>
                        <h6 class="text-danger">$' . htmlspecialchars($row['Price']) . '</h6>
                        <a href="product_details.php?postid=' . $row['id'] . '" 
                           style="background-color: rgb(36, 84, 135); color: white; padding: 8px 15px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 10px;">
                           Know More
                        </a>
                    </div>
                </div>
            </div>
        ';
    }
} else {
    // Display "No products available" in grey color
    $output .= '<p class="text-center w-100 text-secondary font-weight-bold">No products available.</p>';
}

echo $output;
?>
</body>
</html>
