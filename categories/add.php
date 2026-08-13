<?php
session_start();
include '../shared/connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
   if (strlen($name) < 3) {
    $error = "Category name must be at least 3 characters.";
} else if (strlen($name) > 30) {
    $error = "Category name must be at most 30 characters.";
} else {
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();

    $_SESSION['message'] = "Successfully Added!";
    header("Location: list.php");
    exit();
}
}

include '../shared/header.php';
include('../shared/nav.php');

?>

<div style="max-width: 480px; margin: 160px auto; background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 5px 25px rgba(0,0,0,0.06); border: 1px solid #eaeaea;">
    <!-- لون كحلي متناسق مع الـ Index -->
    <h2 style="margin-bottom: 25px; color: rgb(8, 8, 87); font-weight: 600; border-left: 4px solid rgb(8, 8, 87); padding-left: 12px;">Add New Category</h2>
    
<?php if (!empty($error)): ?>
    <div class="alert alert-danger">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

    <form method="POST">
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 500; margin-bottom: 6px; color: #444; font-size: 14px;">Category Name</label>
            <input type="text" name="name" required style="width: 100%; padding: 12px 14px; border: 1px solid #dce1e6; border-radius: 6px; font-size: 15px; outline: none; background: #fafbfc;">
        </div>
        
        <button class="add-btn" type="submit" style="width: 100%; padding: 14px; background: rgb(8, 8, 87); color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer;">Submit Category</button>
    </form>
</div>

<?php include '../shared/footer.php'; ?>