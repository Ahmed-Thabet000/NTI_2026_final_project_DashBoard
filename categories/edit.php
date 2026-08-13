<?php
session_start();
include '../shared/connect.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $update = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
    $update->bind_param("si", $name, $id);
    $update->execute();
    $_SESSION['message'] = "Category Updated Successfully!";
    header("Location: list.php"); 
    exit();
}

include '../shared/header.php';
include '../shared/nav.php'; 
?>

<div style="max-width: 500px; margin: 120px auto 40px auto; padding: 40px; background: #fff; border-radius: 12px; box-shadow: 0 4px 6px rgb(8, 8, 87)rgba(0,0,0,0.05); border: 1px solid #eaeaea;">
    <h2 style="color: #0b132b; border-left: 4px solid #0b132b; padding-left: 12px; margin-bottom: 25px; font-weight: 600;">Edit Category</h2>
    
    <form method="POST">
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">Category Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; outline: none; font-size: 14px;">
        </div>
        
        <button type="submit" style="width: 100%; padding: 14px; background: #0b132b; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer;">Update Category</button>
    </form>
</div>

<?php include '../shared/footer.php'; ?>