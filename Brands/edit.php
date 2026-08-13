```php
<?php
session_start();
include('../shared/connect.php');

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: list.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM brands WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

if (!$row) {
    header("Location: list.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = trim($_POST['name']);
    $collab_date = !empty($_POST['collab_date']) ? $_POST['collab_date'] : NULL;
    $image = $row['image'];

    if (strlen($name) < 3) {
        $error = "Brand name must be at least 3 characters.";
    } elseif (strlen($name) > 30) {
        $error = "Brand name must be at most 30 characters.";
    } else {

        $check = $conn->prepare("SELECT id FROM brands WHERE name = ? AND id != ?");
        $check->bind_param("si", $name, $id);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {

            $error = "This brand name already exists!";
        } else {

            if (!empty($_FILES['image']['name'])) {

                $imageName = $_FILES['image']['name'];
                $imageTmp = $_FILES['image']['tmp_name'];
                $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($imageExtension, $allowedExtensions)) {

                    $newImageName = time() . '_' . $imageName;
                    $uploadFolder = '../uploads/brands/';

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

            $update = $conn->prepare("UPDATE brands SET name = ?, collab_date = ?, image = ? WHERE id = ?");
            $update->bind_param("sssi", $name, $collab_date, $image, $id);
            $update->execute();

            $_SESSION['message'] = "Brand Updated Successfully!";
            header("Location: list.php");
            exit();
        }
    }
}

include '../shared/header.php';
include '../shared/nav.php';
?>

<div style="max-width: 500px; margin: 120px auto 40px auto; padding: 40px; background: #fff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #eaeaea;">

    <h2 style="color: rgb(8, 8, 87); border-left: 4px solid rgb(8, 8, 87); padding-left: 12px; margin-bottom: 25px; font-weight: 600;">
        Edit Brand
    </h2>

    <?php if (!empty($error)): ?>
        <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 20px; text-align: center; font-size: 14px;">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">
                Brand Name
            </label>

            <input
                type="text"
                name="name"
                value="<?= htmlspecialchars($row['name']) ?>"
                required
                maxlength="30"
                style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; outline: none; font-size: 14px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">
                Collaboration Date
            </label>

            <input
                type="date"
                name="collab_date"
                value="<?= htmlspecialchars($row['collab_date'] ?? '') ?>"
                style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; outline: none; font-size: 14px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">
                Brand Image
            </label>

            <?php if (!empty($row['image'])): ?>

                <div style="margin-bottom: 10px;">
                    <img
                        src="../uploads/brands/<?= htmlspecialchars($row['image']) ?>"
                        width="100"
                        height="100"
                        style="object-fit: cover; border-radius: 8px;">
                </div>

            <?php endif; ?>

            <input
                type="file"
                name="image"
                accept="image/*"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
        </div>

        <button
            type="submit"
            style="width: 100%; padding: 14px; background: #0b132b; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer;">
            Update Brand
        </button>

    </form>
</div>

<?php include '../shared/footer.php'; ?>
```