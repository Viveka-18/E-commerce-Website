<?php

include 'db.php';
$categories = mysqli_query($conn, "SELECT * FROM tblcategory");
?>
<nav class="navbar navbar-expand-lg second-navbar mt-2">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categoryNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="categoryNav">
        <ul class="navbar-nav">
            <?php while ($row = mysqli_fetch_assoc($categories)) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="category.php?catid=<?= htmlentities($row['id']) ?>">
                        <?= htmlentities($row['CategoryName']) ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
