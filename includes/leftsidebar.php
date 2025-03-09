<!-- Include Bootstrap JavaScript and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>

                <li class="has_sub">
                    <a href="dashboard.php" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="add-category.php">Add Category</a></li>
                        <li><a href="manage-categories.php">Manage Category</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> Products </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="add-post.php">Add Products</a></li>
                        <li><a href="manage-posts.php">Manage Products</a></li>
                        <li><a href="trash-posts.php">Trashed Products</a></li>
                    </ul>
                </li>  

              

                <!-- Order Management Section -->
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i> <span> Order Management </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="admin_orders.php">Manage Orders</a></li>
                    </ul>
                </li>  

            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

        <div class="help-box">
            <h5 class="text-muted m-t-0">For Help ?</h5>
            <p class=""><span class="text-custom">Email:</span> <br/> viveka2004@gmail.com</p>
        </div>

    </div>
    <!-- Sidebar -left -->

</div>