<?php
session_start();
include '../shared/connect.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    
    if (!empty($name)) {
        $check = $conn->prepare("SELECT id FROM brands WHERE name = ?");
        $check->bind_param("s", $name);
        $check->execute();
        $check->store_result();
        
        if ($check->num_rows > 0) {
            $error = "This brand name already exists!";
        } else {
            $stmt = $conn->prepare("INSERT INTO brands (name) VALUES (?)");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            
            $_SESSION['message'] = "Brand Added Successfully!";
            header("Location: list.php");
            exit();
        }
    }
}

include '../shared/header.php';
include '../shared/nav.php';
?>

<div style="max-width: 500px; margin: 120px auto 40px auto; padding: 40px; background: #fff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #eaeaea;">
    <h2 style="color: rgb(8, 8, 87)#0b132b; border-left: 4px solid #0b132b; padding-left: 12px; margin-bottom: 25px; font-weight: 600;">Add New Brand</h2>
    
    <?php if (!empty($error)): ?>
        <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 20px; text-align: center; font-size: 14px;"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">Brand Name</label>
            <input type="text" name="name" required placeholder="Enter brand name" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; outline: none; font-size: 14px;">
        </div>
        
        <button type="submit" style="width: 100%; padding: 14px; background: #0b132b; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer;">Submit Brand</button>
    </form>
</div>

<?php include '../shared/footer.php'; ?>