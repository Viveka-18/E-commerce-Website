<?php

$conn = mysqli_connect("localhost", "root", "", "flipstore_db");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch data from the database
        $sql = "SELECT * FROM tblposts";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo "not";
        }
        else{
            echo "selected";
        }

        while ($row = mysqli_fetch_assoc($result)) { 

$baseURL = "https://webhook.site/391232fb-79a3-4182-8a6e-cd6a764fa605/"; // Change this to match your site URL
$imagePath = $baseURL . "postimages/" . htmlspecialchars($row['PostImage'], ENT_QUOTES, 'UTF-8');
        }
?>
