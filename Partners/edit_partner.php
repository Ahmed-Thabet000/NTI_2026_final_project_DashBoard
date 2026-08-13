```php
<?php
session_start();
include('../shared/connect.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: list_partner.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM partners WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$partner = $result->fetch_assoc();

if (!$partner) {
    header("Location: list_partner.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = trim($_POST['name']);
    $collab_date = !empty($_POST['collab_date']) ? $_POST['collab_date'] : NULL;

    if (strlen($name) < 3) {

        $error = "Partner name must be at least 3 characters.";

    } elseif (strlen($name) > 30) {

        $error = "Partner name must be at most 30 characters.";

    } else {

        $check = $conn->prepare("SELECT id FROM partners WHERE name = ? AND id != ?");
        $check->bind_param("si", $name, $id);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {

            $error = "This partner name already exists!";

        } else {

            $image = $partner['image'];

            if (!empty($_FILES['image']['name'])) {

                $imageName = $_FILES['image']['name'];
                $imageTmp = $_FILES['image']['tmp_name'];
                $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($imageExtension, $allowedExtensions)) {

                    $newImageName = time() . '_' . $imageName;
                    $uploadFolder = '../uploads/partners/';

                    if (!is_dir($uploadFolder)) {
                        mkdir($uploadFolder, 0777, true);
                    }

                    if (move_uploaded_file($imageTmp, $uploadFolder . $newImageName)) {

                        if (!empty($partner['image']) && file_exists($uploadFolder . $partner['image'])) {
                            unlink($uploadFolder . $partner['image']);
                        }

                        $image = $newImageName;
                    }

                } else {

                    $error = "Invalid image type.";

                }
            }

            if (empty($error)) {

                $update = $conn->prepare("UPDATE partners SET name = ?, image = ?, collab_date = ? WHERE id = ?");
                $update->bind_param("sssi", $name, $image, $collab_date, $id);
                $update->execute();

                $_SESSION['message'] = "Partner Updated Successfully!";
                header("Location: list_partner.php");
                exit();
            }
        }
    }
}

include '../shared/header.php';
include '../shared/nav.php';
?>

<div style="max-width: 500px; margin: 120px auto 40px auto; padding: 40px; background: #fff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #eaeaea;">

    <h2 style="color: rgb(8, 8, 87); border-left: 4px solid rgb(8, 8, 87); padding-left: 12px; margin-bottom: 25px; font-weight: 600;">
        Edit Partner
    </h2>

    <?php if (!empty($error)): ?>
        <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 20px; text-align: center; font-size: 14px;">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">
                Partner Name
            </label>

            <input
                type="text"
                name="name"
                value="<?= htmlspecialchars($partner['name']) ?>"
                required
                maxlength="30"
                style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; outline: none; font-size: 14px;"
            >
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">
                Collaboration Date
            </label>

            <input
                type="date"
                name="collab_date"
                value="<?= htmlspecialchars($partner['collab_date'] ?? '') ?>"
                style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; outline: none; font-size: 14px;"
            >
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">
                Partner Image
            </label>

            <?php if (!empty($partner['image'])): ?>

                <div style="margin-bottom: 10px;">
                    <img
                        src="../uploads/partners/<?= htmlspecialchars($partner['image']) ?>"
                        width="100"
                        height="100"
                        style="object-fit: cover; border-radius: 8px;"
                    >
                </div>

            <?php endif; ?>

            <input
                type="file"
                name="image"
                accept="image/*"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;"
            >
        </div>

        <button
            type="submit"
            class="add-btn"
            style="width: 100%; padding: 14px; background: rgb(8, 8, 87); color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer;"
        >
            Update Partner
        </button>

    </form>
</div>

<?php include '../shared/footer.php'; ?>
```
