<?php
session_start();
include('../shared/connect.php');

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM brands WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $_SESSION['message'] = "Brand Deleted Successfully!";
}

header("Location: list.php");
exit();