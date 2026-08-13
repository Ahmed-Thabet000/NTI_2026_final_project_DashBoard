<?php

include('../shared/connect.php');

$error = '';
$result = '';
$conn = mysqli_connect($host, $username, '', $dataBase);


// Search for clients
$search = '';

if (isset($_GET['search']) && !empty($_GET['search'])) {

    $search = $_GET['search'];

    $show = "SELECT * FROM clients 
             WHERE name LIKE '%$search%'";

} else {

    $show = "SELECT * FROM clients";

}

$result = mysqli_query($conn, $show);


// Delete Client
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    $deleteQuery = "DELETE FROM clients WHERE id = $id";

    $resultDelete = mysqli_query($conn, $deleteQuery);

    if ($resultDelete) {

        header("location:./list.php");
        exit;

    }

}

?>


<?php

include('../shared/header.php');
include('../shared/nav.php');

?>


<h1 class="text-center fw-bold py-5 title">
    List Clients
</h1>


<!-- Search Clients -->

<div class="container mb-4">

    <form method="GET" action="./list.php">

        <div class="input-group">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search client by name..."
                value="<?php echo $search; ?>">

            <button class="btn btn-primary" type="submit">

                <i class="bi bi-search"></i>
                Search

            </button>

            <a href="./list.php" class="btn btn-secondary">

                Reset

            </a>

        </div>

    </form>

</div>


<!-- Clients List -->

<div class="container">

    <div class="row">

        <?php foreach ($result as $item) { ?>

            <div class="col-lg-4 col-md-6 col-sm-12 mb-5">

                <div class="card shadow-sm h-100 border-0 employee-card">

                    <!-- Image -->

                    <div class="text-center pt-4">

                        <img
                            src="../uploads/clients/<?php echo $item['image']; ?>"
                            alt="<?php echo $item['name']; ?>"
                            class="rounded-circle employee-image img-fluid">

                    </div>


                    <div class="card-body">


                        <!-- Name -->

                        <div class="text-center mb-3">

                            <h4 class="fw-bold mb-1">

                                <?php echo $item['name']; ?>

                            </h4>

                        </div>


                        <hr>


                        <!-- Client Information -->

                        <div class="employee-info">


                            <div class="d-flex justify-content-between mb-2">

                                <strong>ID:</strong>

                                <span>

                                    <?php echo $item['id']; ?>

                                </span>

                            </div>


                            <div class="d-flex justify-content-between mb-2">

                                <strong>Phone:</strong>

                                <span>

                                    <?php echo $item['phone']; ?>

                                </span>

                            </div>


                            <div class="d-flex justify-content-between mb-2">

                                <strong>Email:</strong>

                                <span>

                                    <?php echo $item['email']; ?>

                                </span>

                            </div>


                            <div class="d-flex justify-content-between mb-2">

                                <strong>Password:</strong>

                                <span>

                                    <?php echo $item['pass']; ?>

                                </span>

                            </div>


                            <div class="d-flex justify-content-between">

                                <strong>Age:</strong>

                                <span>

                                    <?php echo $item['age']; ?>

                                </span>

                            </div>


                        </div>


                        <hr>


                        <!-- Actions -->

                        <div class="d-flex justify-content-center gap-3">


                            <a
                                class="btn btn-outline-danger"
                                href="./list.php?delete=<?php echo $item['id']; ?>">

                                <i class="bi bi-trash3"></i>

                                Delete

                            </a>


                            <a
                                class="btn btn-outline-primary"
                                href="./update.php?id=<?php echo $item['id']; ?>">

                                <i class="bi bi-pencil-square"></i>

                                Update

                            </a>


                        </div>


                    </div>

                </div>

            </div>

        <?php } ?>

    </div>

</div>


<?php

include('../shared/footer.php');

?>
