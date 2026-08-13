<?php
session_start();
include '../shared/db.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: list.php"); exit(); }

$stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$id]);
$cat = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$cat) { header("Location: list.php"); exit(); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $update = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
    $update->execute([$name, $id]);
    
    $_SESSION['message'] = "Successfully Updated!";
    header("Location: list.php");
    exit();
}

include '../shared/header.php';
?>

<div style="max-width: 500px; margin: 60px auto; background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 5px 25px rgba(0,0,0,0.06); border: 1px solid #eaeaea;">
    <h2 style="margin-bottom: 25px; color: #0b132b; font-weight: 600; border-left: 4px solid #0b132b; padding-left: 12px;">Edit Category</h2>
    <form method="POST">
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 500; margin-bottom: 6px; color: #444; font-size: 14px;">Category Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($cat['name']) ?>" required style="width: 100%; padding: 12px 14px; border: 1px solid #dce1e6; border-radius: 6px; font-size: 15px; outline: none; background: #fafbfc;">
        </div>
        <button type="submit" style="width: 100%; padding: 14px; background: #0b132b; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer; transition: 0.2s;">Update Category</button>
    </form>
</div>

<?php include '../shared/footer.php'; ?>