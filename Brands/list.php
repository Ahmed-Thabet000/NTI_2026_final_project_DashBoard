```php
<?php
session_start();
include('../shared/connect.php');
include '../shared/header.php';
include '../shared/nav.php';

$success_message = "";
if (isset($_SESSION['message'])) {
    $success_message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$result = $conn->query("SELECT * FROM brands");
$brands = $result->fetch_all(MYSQLI_ASSOC);
?>

<div style="max-width: 1000px; margin: 120px auto 40px auto; padding: 0 20px;">

    <?php if (!empty($success_message)): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
            ✅ <?= htmlspecialchars($success_message); ?>
        </div>
    <?php endif; ?>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h2 style="color: rgb(8, 8, 87); font-weight: 600;">Brands List</h2>

        <a
            class="add-btn"
            href="add.php"
            style="background: rgb(8, 8, 87); color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none;"
        >
            + Add New
        </a>
    </div>

    <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden;">

        <tr style="background-color: rgb(8, 8, 87); color: white; text-align: left;">

            <th style="padding: 15px;">ID</th>

            <th style="padding: 15px;">Image</th>

            <th style="padding: 15px;">Brand Name</th>

            <th style="padding: 15px;">Collaboration Date</th>

            <th style="padding: 15px; text-align: center;">Action</th>

        </tr>

        <?php foreach($brands as $brand): ?>

        <tr style="border-bottom: 1px solid #e2e8f0;">

            <td style="padding: 15px;">
                <?= $brand['id'] ?>
            </td>

            <td style="padding: 15px;">

                <?php if (!empty($brand['image'])): ?>

                    <img
                        src="../uploads/brands/<?= htmlspecialchars($brand['image']) ?>"
                        width="80"
                        height="80"
                        style="object-fit: cover; border-radius: 8px;"
                    >

                <?php else: ?>

                    No Image

                <?php endif; ?>

            </td>

            <td style="padding: 15px;">
                <?= htmlspecialchars($brand['name']) ?>
            </td>

            <td style="padding: 15px;">

                <?php if (!empty($brand['collab_date'])): ?>

                    <?= htmlspecialchars($brand['collab_date']) ?>

                <?php else: ?>

                    Not Set

                <?php endif; ?>

            </td>

            <td style="padding: 15px; text-align: center;">

                <a
                    href="edit.php?id=<?= $brand['id'] ?>"
                    title="Edit"
                    style="color: #2563eb; font-size: 18px; margin-right: 15px; text-decoration: none;"
                >
                    <i class="bi bi-pencil-square"></i>
                </a>

                <a
                    href="delete.php?id=<?= $brand['id'] ?>"
                    title="Delete"
                    style="color: #dc2626; font-size: 18px; text-decoration: none;"
                    onclick="return confirm('Are you sure you want to delete this brand?');"
                >
                    <i class="bi bi-trash-fill"></i>
                </a>

            </td>

        </tr>

        <?php endforeach; ?>

    </table>

</div>

<?php include '../shared/footer.php'; ?>
```
