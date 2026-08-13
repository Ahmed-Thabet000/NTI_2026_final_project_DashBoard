<?php

include('../shared/connect.php');

$message = "";

if (isset($_POST['add_product'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $cat_id = $_POST['cat_id'];
    $brand_id = !empty($_POST['brand_id']) ? $_POST['brand_id'] : NULL;

    // Image
    $image = NULL;

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

            move_uploaded_file(
                $imageTmp,
                $uploadFolder . $newImageName
            );

            $image = $newImageName;
        }
    }

    $query = "INSERT INTO products 
              (name, description, image, price, quantity, cat_id, brand_id)
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "sssdiii",
        $name,
        $description,
        $image,
        $price,
        $quantity,
        $cat_id,
        $brand_id
    );

    if (mysqli_stmt_execute($stmt)) {
        $message = "Product added successfully!";
      
            header("Location: ./list_products.php");
            // exit;
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

$categoriesQuery = "SELECT * FROM categories";
$categories = mysqli_query($conn, $categoriesQuery);

$brandsQuery = "SELECT * FROM brands";
$brands = mysqli_query($conn, $brandsQuery);

include('../shared/header.php');
include('../shared/nav.php');

?>

<div class="container" style="margin-top: 120px; min-height: 140vh;">

    <h1 class="text-center fw-bold mb-5">
        Add Product
    </h1>

    <?php if ($message != ""): ?>

        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>

    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <!-- Product Name -->
        <div class="mb-3">
            <label class="form-label fw-bold">
                Product Name
            </label>

            <input
                type="text"
                name="name"
                class="form-control"
                maxlength="20"
                required
            >
        </div>


        <!-- Description -->
        <div class="mb-3">

            <label class="form-label fw-bold">
                Description
            </label>

            <textarea
                name="description"
                class="form-control"
                rows="4"
            ></textarea>

        </div>


        <!-- Image -->
        <div class="mb-3">

            <label class="form-label fw-bold">
                Product Image
            </label>

            <input
                type="file"
                name="image"
                class="form-control"
                accept="image/*"
            >

        </div>


        <!-- Price -->
        <div class="mb-3">

            <label class="form-label fw-bold">
                Price
            </label>

            <input
                type="number"
                name="price"
                class="form-control"
                step="0.01"
                min="0"
                required
            >

        </div>


        <!-- Quantity -->
        <div class="mb-3">

            <label class="form-label fw-bold">
                Quantity
            </label>

            <input
                type="number"
                name="quantity"
                class="form-control"
                min="0"
                required
            >

        </div>


        <!-- Category -->
        <div class="mb-3">

            <label class="form-label fw-bold">
                Category
            </label>

            <select
                name="cat_id"
                class="form-select"
                required
            >

                <option value="">
                    Select Category
                </option>

                <?php while ($category = mysqli_fetch_assoc($categories)): ?>

                    <option value="<?php echo $category['id']; ?>">
                        <?php echo $category['name']; ?>
                    </option>

                <?php endwhile; ?>

            </select>

        </div>


        <!-- Brand -->
        <div class="mb-3">

            <label class="form-label fw-bold">
                Brand
            </label>

            <select
                name="brand_id"
                class="form-select"
            >

                <option value="">
                    Select Brand
                </option>

                <?php while ($brand = mysqli_fetch_assoc($brands)): ?>

                    <option value="<?php echo $brand['id']; ?>">
                        <?php echo $brand['name']; ?>
                    </option>

                <?php endwhile; ?>

            </select>

        </div>


        <!-- Button -->
        <div class="mb-5">

            <button
                type="submit"
                name="add_product"
                class="add-btn btn text-white px-4"
            >
                Add Product
            </button>

            <a
                href="list_products.php"
                class="btn btn-secondary px-4"
            >
                Products List
            </a>

        </div>

    </form>

</div>

<?php

include('../shared/footer.php');

?>