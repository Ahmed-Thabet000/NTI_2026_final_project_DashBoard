<?php

include('../shared/connect.php');

if (!isset($_GET['id'])) {
    header("Location: list_products.php");
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM products WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    header("Location: list_products.php");
    exit;
}

$message = "";

if (isset($_POST['update_product'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $cat_id = $_POST['cat_id'];
    $brand_id = !empty($_POST['brand_id']) ? $_POST['brand_id'] : NULL;

    $query = "UPDATE products
              SET name = ?,
                  description = ?,
                  price = ?,
                  quantity = ?,
                  cat_id = ?,
                  brand_id = ?
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "ssddiii",
        $name,
        $description,
        $price,
        $quantity,
        $cat_id,
        $brand_id,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {

        $message = "Product updated successfully!";

        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $product = mysqli_fetch_assoc($result);
    }
}

include('../shared/header.php');
include('../shared/nav.php');

?>

<div class="container" style="margin-top: 120px;">

    <h1 class="text-center fw-bold mb-5">
        Edit Product
    </h1>

    <?php if ($message != ""): ?>

        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">

            <label class="form-label fw-bold">
                Product Name
            </label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="<?php echo htmlspecialchars($product['name']); ?>"
                maxlength="20"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Description
            </label>

            <textarea
                name="description"
                class="form-control"
                rows="4"
            ><?php echo htmlspecialchars($product['description']); ?></textarea>

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Price
            </label>

            <input
                type="number"
                name="price"
                class="form-control"
                step="0.01"
                value="<?php echo $product['price']; ?>"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Quantity
            </label>

            <input
                type="number"
                name="quantity"
                class="form-control"
                value="<?php echo $product['quantity']; ?>"
                min="0"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Category ID
            </label>

            <input
                type="number"
                name="cat_id"
                class="form-control"
                value="<?php echo $product['cat_id']; ?>"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Brand ID
            </label>

            <input
                type="number"
                name="brand_id"
                class="form-control"
                value="<?php echo $product['brand_id']; ?>"
            >

        </div>

        <button
            type="submit"
            name="update_product"
            class="btn btn-primary"
        >
            Update Product
        </button>

        <a
            href="list_products.php"
            class="btn btn-secondary"
        >
            Back
        </a>

    </form>

</div>

<?php

include('../shared/footer.php');

?>