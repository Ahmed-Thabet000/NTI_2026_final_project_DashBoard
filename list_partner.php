<?php

include('../shared/connect.php');

$query = "SELECT * FROM partners ORDER BY id ASC";
$result = mysqli_query($conn, $query);

include('../shared/header.php');
include('../shared/nav.php');

?>

<div class="container" style="margin-top: 120px;">

    <h1 class="text-center fw-bold mb-5">
        Partners List
    </h1>

    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle text-center">

            <thead class="table-secondary">

                <tr>
                    <th>ID</th>
                    <th>Partner</th>
                    <th>Collaboration Date</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>

                <?php while ($partner = mysqli_fetch_assoc($result)): ?>

                    <tr>

                        <td>
                            <?php echo $partner['id']; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($partner['name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($partner['collab_date']); ?>
                        </td>

                        <td>
                <a
                    href="edit_partner.php?id=<?php echo $partner['id']; ?>"
                    class="btn btn-info btn-sm"
                    title="Edit Partner"
                >
                    <i class="bi bi-pencil-square"></i>
                </a>

                <a
                    href="delete_partner.php?id=<?php echo $partner['id']; ?>"
                    class="btn btn-danger btn-sm"
                    title="Delete Partner"
                    onclick="return confirm('you are about to delete a partner are you sure?');"
                >
                    <i class="bi bi-trash-fill"></i>
                </a>
                        </td>

                    </tr>

                <?php endwhile; ?>

            </tbody>

        </table>

    </div>

    <div class="mb-5 text-center">

        <a
            href="add_partner.php"
            class="btn btn-success"
        >
            + Add Partner
        </a>

    </div>

</div>

<?php

include('../shared/footer.php');

?>
