<?php

include('../shared/connect.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "DELETE FROM partners WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);
}

header("Location: list_partner.php");
exit;
