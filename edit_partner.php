<?php

include('../shared/connect.php');

if (!isset($_GET['id'])) {
    header("Location: list_partner.php");
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM partners WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$partner = mysqli_fetch_assoc($result);

if (!$partner) {
    header("Location: list_partner.php");
    exit;
}

$message = "";

if (isset($_POST['update_partner'])) {

    $name = trim($_POST['name']);
    $collab_date = trim($_POST['collab_date']);

    $query = "UPDATE partners
              SET name = ?,
                  collab_date = ?
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "ssi",
        $name,
        $collab_date,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {

        $message = "Partner updated successfully!";

        $query = "SELECT * FROM partners WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $partner = mysqli_fetch_assoc($result);
    }
}

include('../shared/header.php');
include('../shared/nav.php');

?>

<div class="container" style="margin-top: 120px;">

    <h1 class="text-center fw-bold mb-5">
        Edit Partner
    </h1>

    <?php if ($message != ""): ?>

        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">

            <label class="form-label fw-bold">
                Partner
            </label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="<?php echo htmlspecialchars($partner['name']); ?>"
                maxlength="100"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Collaboration Date
            </label>

            <input
                type="date"
                name="collab_date"
                class="form-control"
                value="<?php echo htmlspecialchars($partner['collab_date']); ?>"
                required
            >

        </div>

        <button
            type="submit"
            name="update_partner"
            class="btn btn-primary"
        >
            Update Partner
        </button>

        <a
            href="list_partner.php"
            class="btn btn-secondary"
        >
            Back
        </a>

    </form>

</div>

<?php

include('../shared/footer.php');

?>
