<?php
session_start();
include '../shared/connect.php';
include '../shared/header.php';
include '../shared/nav.php';

$success_message = "";
if (isset($_SESSION['message'])) {
    $success_message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$result = $conn->query("SELECT * FROM categories");
$categories = $result->fetch_all(MYSQLI_ASSOC);
?>

<div style="max-width: 1000px; margin: 120px auto 40px auto; padding: 0 20px;">
    <?php if (!empty($success_message)): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">✅ <?= htmlspecialchars($success_message); ?></div>
    <?php endif; ?>
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h2 style="color: #0b132b; font-weight: 600;">Categories List</h2>
        <a href="add.php" style="background: rgb(8, 8, 87)#0b132b; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none;">+ Add New</a>
    </div>
    
    <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden;">
        <tr style="background-color: #0b132b; color: white; text-align: left;">
            <th style="padding: 15px;">ID</th>
            <th style="padding: 15px;">Category Name</th>
            <th style="padding: 15px; text-align: center;">Actions</th>
        </tr>
        <?php foreach($categories as $category): ?>
        <tr style="border-bottom: 1px solid #e2e8f0;">
            <td style="padding: 15px;"><?= $category['id'] ?></td>
            <td style="padding: 15px;"><?= htmlspecialchars($category['name']) ?></td>
            <td style="padding: 15px; text-align: center;">
                <a href="edit.php?id=<?= $category['id'] ?>" title="Edit" style="color: #2563eb; font-size: 18px; margin-right: 15px; text-decoration: none;">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <a href="delete.php?id=<?= $category['id'] ?>" title="Delete" style="color: #dc2626; font-size: 18px; text-decoration: none;" onclick="return confirm('Are you sure you want to delete this category?');">
                    <i class="bi bi-trash-fill"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include '../shared/footer.php'; ?>