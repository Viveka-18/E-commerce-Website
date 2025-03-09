$(document).ready(function () {
    function fetchProducts(categoryId = 0) {
        $.ajax({
            url: 'includes/fetch_products.php',
            type: 'GET',
            data: { catid: categoryId },
            dataType: 'json',
            success: function (data) {
                let output = "";
                if (data.length > 0) {
                    data.forEach(product => {
                        output += `
                            <div class="col-md-3 mb-4">
                                <div class="card">
                                    <img src="postimages/${product.PostImage}" class="card-img-top" alt="Product Image">
                                    <div class="card-body">
                                        <h5 class="card-title">${product.PostTitle}</h5>
                                        <p class="card-text">${product.PostDetails}</p>
                                        <h6 class="text-danger">$${product.Price}</h6>
                                        <a href="product_details.php?postid=${product.id}" class="btn btn-primary">Know More</a>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    output = '<p class="text-center w-100 text-secondary font-weight-bold">No products available.</p>';
                }
                $("#product-list").html(output);
            }
        });
    }

    // Fetch all products initially
    fetchProducts();

    // Category click event
    $(".category-link").click(function (e) {
        e.preventDefault();
        let categoryId = $(this).data("id");
        fetchProducts(categoryId);
    });
});
