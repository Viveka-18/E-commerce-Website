<?php 
session_start();
include('includes/config.php');
error_reporting(0);

if(strlen($_SESSION['login']) == 0) { 
    header('location:index.php');
} else {

// For adding post  
if(isset($_POST['submit'])) {
    $posttitle = mysqli_real_escape_string($con, $_POST['posttitle']);
    $catid = intval($_POST['category']);
    $postdetails = mysqli_real_escape_string($con, $_POST['postdescription']);
    $postdetails1 = mysqli_real_escape_string($con, $_POST['postdescription1']);
    $price = floatval($_POST['price']);

    // Generate SEO-friendly URL
    $url = strtolower(str_replace(" ", "-", $posttitle));

    // Image upload directory
    $targetDir = "admin2/postimages/";
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");

    // Function to handle image upload
    function uploadImage($fileInputName, $targetDir, $allowed_extensions) {
        if(isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['name'] != '') {
            $imgfile = $_FILES[$fileInputName]["name"];
            $imgtemp = $_FILES[$fileInputName]["tmp_name"];
            $extension = strtolower(pathinfo($imgfile, PATHINFO_EXTENSION));

            // Validate file extension
            if(!in_array($extension, $allowed_extensions)) {
                return "Invalid image format! Only JPG, JPEG, PNG, GIF allowed.";
            }
            // Validate MIME type
            elseif(!in_array($_FILES[$fileInputName]["type"], array("image/jpeg", "image/png", "image/gif"))) {
                return "Invalid image format based on file type!";
            }
            // Validate actual image
            elseif(!getimagesize($_FILES[$fileInputName]["tmp_name"])) {
                return "Uploaded file is not a valid image!";
            }
            else {
                // Save with original filename and prevent overwrites
                $originalFileName = basename($imgfile);
                $targetFilePath = $targetDir . $originalFileName;

                // Check if file exists and rename if needed
                $counter = 1;
                while (file_exists($targetFilePath)) {
                    $fileExt = pathinfo($originalFileName, PATHINFO_EXTENSION);
                    $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
                    $newFileName = $fileNameOnly . "_$counter." . $fileExt;
                    $targetFilePath = $targetDir . $newFileName;
                    $counter++;
                }

                move_uploaded_file($imgtemp, $targetFilePath);
                return basename($targetFilePath);
            }
        }
        return NULL; // Return NULL if no file uploaded
    }

    // Upload multiple images
    $postImage = uploadImage("postimage", $targetDir, $allowed_extensions);
    $postImage1 = uploadImage("postimage1", $targetDir, $allowed_extensions);
    $postImage2 = uploadImage("postimage2", $targetDir, $allowed_extensions);

    // Check if there was an error in image upload
    if(is_string($postImage) && str_contains($postImage, "Invalid")) {
        $error = $postImage;
    } elseif(is_string($postImage1) && str_contains($postImage1, "Invalid")) {
        $error = $postImage1;
    } elseif(is_string($postImage2) && str_contains($postImage2, "Invalid")) {
        $error = $postImage2;
    } else {
        // Insert into database
        $status = 1;
        $query = mysqli_query($con, "INSERT INTO tblposts (PostTitle, CategoryId, PostDetails, PostDetails1, PostUrl, Is_Active, PostImage, PostImage1, PostImage2, Price) 
            VALUES ('$posttitle', $catid, '$postdetails', '$postdetails1', '$url', $status, '$postImage', '$postImage1', '$postImage2', $price)");

        if($query) {
            $msg = "Product successfully added!";
        } else {
            $error = "Something went wrong. Please try again.";    
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlipStore | Add Products</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="wrapper">
        <?php include('includes/topheader.php'); ?>
        <?php include('includes/leftsidebar.php'); ?>
        
        <div class="content-page">
            <div class="content">
                <div class="container">
                    <h4 class="page-title">Add Products</h4>

                    <?php if(isset($msg)) { ?>
                        <div class="alert alert-success"><?php echo htmlentities($msg); ?></div>
                    <?php } ?>
                    
                    <?php if(isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo htmlentities($error); ?></div>
                    <?php } ?>

                    <form name="addpost" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Post Title</label>
                            <input type="text" class="form-control" name="posttitle" required>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category" required>
                                <option value="">Select Category</option>
                                <?php
                                $ret = mysqli_query($con, "SELECT id, CategoryName FROM tblcategory WHERE Is_Active=1");
                                while($result = mysqli_fetch_array($ret)) {    
                                ?>
                                <option value="<?php echo htmlentities($result['id']); ?>">
                                    <?php echo htmlentities($result['CategoryName']); ?>
                                </option>
                                <?php } ?>
                            </select> 
                        </div>
                        <div class="form-group">
                            <label>Post Short Details</label>
                            <textarea class="form-control" name="postdescription" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Post Long Details</label>
                            <textarea class="form-control" name="postdescription1" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" name="price" required>
                        </div>

                        <div class="form-group">
                            <label>Feature Image1</label>
                            <input type="file" class="form-control" name="postimage" required>
                        </div>
                        <div class="form-group">
                            <label>Feature Image2</label>
                            <input type="file" class="form-control" name="postimage1" required>
                        </div>
                        <div class="form-group">
                            <label>Feature Image3</label>
                            <input type="file" class="form-control" name="postimage2" required>
                        </div>

                        <button type="submit" name="submit" class="btn btn-success">Save and Post</button>
                        <button type="reset" class="btn btn-danger">Discard</button>
                    </form>
                </div>
            </div>
            <?php include('includes/footer.php'); ?>
        </div>
    </div>
</body>
</html>

<?php } ?>
