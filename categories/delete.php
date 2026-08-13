<?php
session_start();
include '../shared/connect.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
    if ($stmt->execute([$id])) {
        $_SESSION['message'] = "Successfully Deleted!";
    } else {
        $_SESSION['message'] = "Error Deleting Category ❌";
    }
}
header("Location: list.php");
exit();


?>