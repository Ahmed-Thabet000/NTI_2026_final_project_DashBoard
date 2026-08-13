<?php

include('../shared/connect.php');

$query = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $query);

include('../shared/header.php');
include('../shared/nav.php');

?>

<div class="container" style="margin-top: 120px;">

    <h1 class="text-center fw-bold mb-5">
        Products List
    </h1>

    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle text-center">

            <thead class="table-primary">

                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category ID</th>
                    <th>Brand ID</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>

                <?php while ($product = mysqli_fetch_assoc($result)): ?>

                    <tr>

                        <td>
                            <?php echo $product['id']; ?>
                        </td>

                        <td>

                            <?php if (!empty($product['image'])): ?>

                                                            <img
                                    src="../uploads/products/<?php echo $product['image']; ?>"
                                    width="100"
                                    height="100"
                                    style="object-fit: cover; border-radius: 8px;"
                                                              >
                            <?php else: ?>

                                No Image

                            <?php endif; ?>

                        </td>

                        <td>
                            <?php echo htmlspecialchars($product['name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($product['description']); ?>
                        </td>

                        <td>
                            <?php echo $product['price']; ?>
                        </td>

                        <td>
                            <?php echo $product['quantity']; ?>
                        </td>

                        <td>
                            <?php echo $product['cat_id']; ?>
                        </td>

                        <td>
                            <?php echo $product['brand_id']; ?>
                        </td>

                        <td>
                <a
                    href="edit_product.php?id=<?php echo $product['id']; ?>"
                    class="btn btn-primary btn-sm"
                    title="Edit Product"
                >
                    <i class="bi bi-pencil-square"></i>
                </a>

                <a
                    href="delete_product.php?id=<?php echo $product['id']; ?>"
                    class="btn btn-danger btn-sm"
                    title="Delete Product"
                    onclick="return confirm('Are you sure you want to delete this product?');"
                >
                    <i class="bi bi-trash-fill"></i>
                </a>
                                        </td>

                    </tr>

                <?php endwhile; ?>

            </tbody>

        </table>

    </div>

    <div class="mb-5">

        <a
            href="add_product.php"
            class="btn add-btn text-white"
        >
            + Add Product
        </a>

    </div>

</div>

<?php

include('../shared/footer.php');

?>