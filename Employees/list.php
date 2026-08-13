<?php
include('../shared/connect.php');

$error = '';
$result = '';
$conn = mysqli_connect($host, $username, '', $dataBase);
$show = "SELECT * FROM employees";
$result = mysqli_query($conn, $show);



// Add a Category
// if (isset($_POST['btn'])) {
//     $name = $_POST['name'];

//     try {
//         if (strlen($name) < 4) {
//             $error = 'The name should at least 4 characters';
//         } else if (strlen($name) > 20) {
//             $error = 'The name should at most 20 characters';
//         } else {
//             $addQuery = "INSERT INTO categories VALUES (null , '$name')";
//             $result = mysqli_query($conn, $addQuery);
//         }
//     } catch (Exception $e) {
//         $error = $e->getMessage();
//     }
// }



// Delete a Category
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteQuery = "DELETE FROM employees WHERE id = $id";
    $resultDelete = mysqli_query($conn, $deleteQuery);

    if ($resultDelete)
        header("location:./list.php");
}




?>


<?php
include('../shared/header.php');
include('../shared/nav.php');
?>

<h1 class="text-center fw-bold py-5 title">List Employees</h1>

<div class="container">
    <div class="row ">
        <?php foreach ($result as $item) { ?>

            <div class="col-lg-4 col-md-6 col-sm-12 mb-5">

                <div class="card shadow-sm h-100 border-0 employee-card ">

                    <!-- Image -->
                    <div class="text-center pt-4">
                        <img
                            src="../uploads/employees/<?php echo $item['image']; ?>"
                            alt=""
                            class="rounded-circle employee-image">
                    </div>

                    <div class="card-body">

                        <!-- Name + Role -->
                        <div class="text-center mb-3">
                            <h4 class="fw-bold mb-1">
                                <?php echo $item['name']; ?>
                            </h4>

                            <span class="badge bg-primary">
                                <?php echo $item['role']; ?>
                            </span>
                        </div>

                        <hr>

                        <!-- Employee Information -->

                        <div class="employee-info">

                            <div class="d-flex justify-content-between mb-2">
                                <strong>ID:</strong>
                                <span><?php echo $item['id']; ?></span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <strong>Phone:</strong>
                                <span><?php echo $item['phone']; ?></span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <strong>Email:</strong>
                                <span><?php echo $item['email']; ?></span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <strong>Password:</strong>
                                <span><?php echo $item['pass']; ?></span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <strong>Age:</strong>
                                <span><?php echo $item['age']; ?></span>
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
include('../shared/footer.php')
?>