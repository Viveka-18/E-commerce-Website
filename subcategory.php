<?php
session_start();
include 'db.php';
$categories = mysqli_query($conn, "SELECT * FROM tblcategory");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flipstore</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Flipstore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
            <div class="search-bar">
                <input type="text" class="form-control" placeholder="Search for products...">
                <button class="btn search-btn"><i class="fas fa-search"></i></button>
            </div>
            <ul class="navbar-nav d-flex align-items-center ml-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin2/index.php">Admin</a></li>

                <?php if(isset($_SESSION['username'])) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                            <span class="user-icon"><?php echo strtoupper($_SESSION['username'][0]); ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="logout.php">Logout</a>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Categories Menu -->
<nav class="navbar navbar-expand-lg second-navbar mt-2">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categoryNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="categoryNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link filter-category" href="#" data-subcatid="0">All</a>
            </li>
            <?php while ($row = mysqli_fetch_assoc($categories)) { 
                $catId = $row['id'];
                $subcategories = mysqli_query($conn, "SELECT * FROM tblsubcategory WHERE CategoryID = $catId");
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown<?= $row['id'] ?>" role="button" data-toggle="dropdown">
                        <?= htmlentities($row['CategoryName']) ?>
                    </a>
                    <div class="dropdown-menu">
                        <?php while ($sub = mysqli_fetch_assoc($subcategories)) { ?>
                            <a class="dropdown-item filter-category" href="#" data-subcatid="<?= htmlentities($sub['SubCategoryId']) ?>">
                                <?= htmlentities($sub['Subcategory']) ?>
                            </a>
                        <?php } ?>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>

<!-- Products Section -->
<div class="container mt-4">
    <div class="row" id="product-list">
        <?php 
        $sql = "SELECT * FROM tblposts";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-3 mb-4 product-card">
                <div class="card">
                    <img src="postimages/<?= htmlspecialchars($row['PostImage'], ENT_QUOTES, 'UTF-8') ?>" alt="Product Image" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['PostTitle']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['PostDetails']) ?></p>
                        <h6 class="text-danger">$<?= htmlspecialchars($row['Price']) ?></h6>
                        <a href="product_details.php?postid=<?= $row['id'] ?>" class="btn mt-2" style="background-color:rgb(36, 84, 135); color: white;">Know More</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php include("footer.php"); ?>

<script>
$(document).ready(function() {
    $(".filter-category").click(function(e) {
        e.preventDefault();
        var subcatid = $(this).data("subcatid");

        $.ajax({
            url: "fetch_products.php",
            type: "POST",
            data: { subcatid: subcatid },
            success: function(response) {
                $("#product-list").html(response);
            }
        });
    });
});
</script>

</body>
</html>
