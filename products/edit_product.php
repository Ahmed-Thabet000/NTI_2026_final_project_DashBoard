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

    $image = $product['image'];

    if (!empty($_FILES['image']['name'])) {

        $imageName = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];

        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($imageExtension, $allowedExtensions)) {

            $newImageName = time() . '_' . $imageName;

            $uploadFolder = '../uploads/products/';

            if (!is_dir($uploadFolder)) {
                mkdir($uploadFolder, 0777, true);
            }

            if (move_uploaded_file($imageTmp, $uploadFolder . $newImageName)) {

                if (!empty($product['image']) && file_exists($uploadFolder . $product['image'])) {
                    unlink($uploadFolder . $product['image']);
                }

                $image = $newImageName;
            }
        }
    }

    $query = "UPDATE products
              SET name = ?,
                  description = ?,
                  image = ?,
                  price = ?,
                  quantity = ?,
                  cat_id = ?,
                  brand_id = ?
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "sssddiii",
        $name,
        $description,
        $image,
        $price,
        $quantity,
        $cat_id,
        $brand_id,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: list_products.php");
        exit;
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

    <form method="POST" enctype="multipart/form-data">

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
                required>

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Description
            </label>

            <textarea
                name="description"
                class="form-control"
                rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Current Image
            </label>

            <div class="mb-2">

                <?php if (!empty($product['image'])): ?>

                    <img
                        src="../uploads/products/<?php echo htmlspecialchars($product['image']); ?>"
                        width="120"
                        height="120"
                        style="object-fit: cover; border-radius: 8px;">

                <?php else: ?>

                    No Image

                <?php endif; ?>

            </div>

            <label class="form-label fw-bold">
                Update Image
            </label>

            <input
                type="file"
                name="image"
                class="form-control"
                accept="image/*">

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
                required>

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
                required>

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Category
            </label>

            <select
                name="cat_id"
                class="form-select"
                required>

                <option value="">
                    Select Category
                </option>

                <?php

                $categoriesQuery = "SELECT * FROM categories";
                $categories = mysqli_query($conn, $categoriesQuery);

                while ($category = mysqli_fetch_assoc($categories)):

                ?>

                    <option
                        value="<?php echo $category['id']; ?>"
                        <?php echo ($category['id'] == $product['cat_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>

                <?php endwhile; ?>

            </select>

        </div>


        <div class="mb-3">

            <label class="form-label fw-bold">
                Brand
            </label>

            <select
                name="brand_id"
                class="form-select">

                <option value="">
                    Select Brand
                </option>

                <?php

                $brandsQuery = "SELECT * FROM brands";
                $brands = mysqli_query($conn, $brandsQuery);

                while ($brand = mysqli_fetch_assoc($brands)):

                ?>

                    <option
                        value="<?php echo $brand['id']; ?>"
                        <?php echo ($brand['id'] == $product['brand_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($brand['name']); ?>
                    </option>

                <?php endwhile; ?>

            </select>

        </div>

        <button
            type="submit"
            name="update_product"
            class="btn btn-primary">
            Update Product
        </button>

        <a
            href="list_products.php"
            class="btn btn-secondary">
            Back
        </a>

    </form>

</div>

<?php

include('../shared/footer.php');

?>