<?php

include('../shared/connect.php');

$message = "";

if (isset($_POST['add_partner'])) {

    $name = trim($_POST['name']);
    $collab_date = trim($_POST['collab_date']);

    $query = "INSERT INTO partners 
              (name, collab_date)
              VALUES (?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "ss",
        $name,
        $collab_date
    );

    if (mysqli_stmt_execute($stmt)) {
        $message = "Partner added successfully!";
        header("Location: ../index.php");
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

include('../shared/header.php');
include('../shared/nav.php');

?>

<div class="container" style="margin-top: 120px;">

    <h1 class="text-center text-primary fw-bold mb-5">
        Add Partner
    </h1>

    <?php if ($message != ""): ?>

        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <!-- Partner Name -->
        <div class="mb-4">
            <label class="form-label fw-bold" style="color: #080857; font-size: 0.95rem;">
                Partner Name
            </label>

            <input
                type="text"
                name="name"
                class="form-control"
                maxlength="100"
                required
                style="border-radius: 1px; border: 1px solid #dee2e6; padding: 10px 12px; max-width: 600px;"
            >
        </div>


       
        <div class="mb-5 ">

            <button
                type="submit"
                name="add_partner"
                class="btn btn-success px-4"
            >
                Add Partner
            </button>

            <a
                href="list_partner.php"
                class="btn btn-dark px-4"
            >
                Partners List
            </a>

        </div>

    </form>

</div>

<?php

include('../shared/footer.php');

?>
