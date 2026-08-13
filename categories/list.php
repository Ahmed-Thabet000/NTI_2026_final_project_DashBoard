<?php
session_start();
include '../shared/connect.php';
include '../shared/header.php';
include('../shared/nav.php');

$success_message = "";
if (isset($_SESSION['message'])) {
    $success_message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$show = "SELECT * FROM categories";
$result = mysqli_query($conn, $show);

?>

<div style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
    
    <?php if (!empty($success_message)): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px 20px; border-radius: 8px; border: 1px solid #c3e6cb; margin-bottom: 20px; text-align: center; font-weight: 600; font-size: 16px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
            ✅ <?= htmlspecialchars($success_message); ?>
        </div>
    <?php endif; ?>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
        <h2 style="color: rgb(8, 8, 87);; font-weight: 600; margin: 100px auto 0px auto;">Categories List</h2>
        <a href="add.php" class="add-btn" style="background: rgb(8, 8, 87);; margin: 100px auto 0px auto; color: white; padding: 10px 20px; border-radius: 6px; font-weight: 500; transition: 0.2s; text-decoration: none;">+ Add New</a>
    </div>

    <div style="background: white; border-radius: 12px; border: 1px solid #d0e0f0; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; min-width: 400px; background-color: #f8fafc;">
                <thead>
                    <tr style="background-color: rgb(8, 8, 87);; border-bottom: 2px solid #020617;">
                        <th style="padding: 15px 20px; text-align: left; color: #ffffff; font-weight: 700;">ID</th>
                        <th style="padding: 15px 20px; text-align: left; color: #ffffff; font-weight: 700;">Name</th>
                        <th style="padding: 15px 20px; text-align: center; color: #ffffff; font-weight: 700;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $cat): ?>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 12px 20px; color: #1e293b; font-weight: 500;"><?= $cat['id'] ?></td>
                        <td style="padding: 12px 20px; color: #1e293b; font-weight: 500;"><?= htmlspecialchars($cat['name']) ?></td>
                        <td style="padding: 12px 20px; text-align: center;">
                            <a href="edit.php?id=<?= $cat['id'] ?>" style="color: #2563eb; font-size: 18px; margin-right: 15px; text-decoration: none;" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="delete.php?id=<?= $cat['id'] ?>" style="color: #dc2626; font-size: 18px; text-decoration: none;" onclick="return confirm('Are you sure you want to delete this item?');" title="Delete">
                                <i class="bi bi-trash3"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>