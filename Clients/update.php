<?php
include('../shared/connect.php');

$error = '';
$updateResult = '';
$name = '';
$phone = '';
$email = '';
$pass = '';
$age = '';
$id = '';
$image = '';
$updateResult = '';
$conn = mysqli_connect($host, $username, $password, $dataBase);


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $selectQUery = "SELECT * FROM clients WHERE id = $id";
    $selectResult = mysqli_query($conn, $selectQUery);

    if (mysqli_num_rows($selectResult) > 0) {
        $row = mysqli_fetch_assoc($selectResult);
        $name = $row['name'];
        $phone = $row['phone'];
        $email = $row['email'];
        $pass = $row['pass'];
        $age = $row['age'];
        $image = $row['image'];
    }
}


if (isset($_POST['btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $age = $_POST['age'];
    $imageNew = $_FILES['image'];

    if ($imageNew['error'] == 0) {
        $imageName = $imageNew['name'];

        move_uploaded_file(
            $imageNew['tmp_name'],
            '../uploads/clients/' . $imageName
        );

        $image = $imageName;
    }


    try {
        if (strlen($name) < 4) {
            $error = 'The name should be at least 4 characters';
        } else if (strlen($name) > 20) {
            $error = 'The name should be at most 20 characters';
        } else if ($age <= 0) {
            $error = 'The Age should be greater than 0';
        } else if (strlen($phone) != 11) {
            $error = 'The Phone should be 11 numbers';
        } else if (strlen($pass) < 5) {
            $error = 'The Password should be at least 5 characters';
        } else {
            $updateQuery = "UPDATE clients SET name = '$name' , phone = '$phone', email = '$email' , pass = '$pass' , age = '$age' , image = '$image' WHERE id = '$id'";
            $updateResult = mysqli_query($conn, $updateQuery);
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>

<?php
if (strlen($error) > 0) {
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $error ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<?php
if ($updateResult) {
    header("location:./list.php");
}
?>

<?php
include('../shared/header.php');
include('../shared/nav.php');
?>



<h1 class="text-center fw-bold pb-5 title">Update a Client</h1>

<div class="container w-50 add-con" style="border: 5px solid rgb(8, 8, 87);">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-9 col-md-12 col-sm-12">
            <form class="d-flex flex-wrap justify-content-center" method="POST" enctype="multipart/form-data">

                <div class="my-2 w-100 text-center">
                    <label for="name" class="form-label text-start w-75 me-2 fw-bold" style="color: rgb(8, 8, 87);">Name</label>
                    <input type="text" placeholder="Name" name="name" id="name" value="<?php echo $name ?>" class="w-75">
                </div>
                <div class="my-2 w-100 text-center">
                    <label for="image" class="form-label text-start w-75 me-2 fw-bold" style="color: rgb(8, 8, 87);">Image</label>
                    <div class="mb-3">
                        <img
                            src="../uploads/employees/<?php echo $image; ?>"
                            alt="Current Image"
                            width="80"
                            height="80"
                            class="rounded-circle"
                            style="object-fit: cover;">
                    </div>
                    <input type="file" name="image" id="image" class="w-75">
                </div>
                <div class="my-2 w-100 text-center">
                    <label for="phone" class="form-label text-start w-75  me-2 fw-bold" style="color: rgb(8, 8, 87);">Phone</label>
                    <input type="text" placeholder="Phone" name="phone" id="phone" value="<?php echo $phone ?>" class="w-75">
                </div>
                <div class="my-2 w-100 text-center">
                    <label for="age" class="form-label text-start w-75  me-2 fw-bold" style="color: rgb(8, 8, 87);">Age</label>
                    <input type="number" min="0" max="200" placeholder="Age" name="age" id="age" value="<?php echo $age ?>" class="w-75">
                </div>
                <div class="my-2 w-100 text-center">
                    <label for="email" class="form-label text-start w-75 me-2 fw-bold" style="color: rgb(8, 8, 87);">Email</label>
                    <input type="email" placeholder="Email" name="email" id="email" value="<?php echo $email ?>" class="w-75">
                </div>
                <div class="my-2 w-100 text-center">
                    <label for="pass" class="form-label text-start w-75 me-2 fw-bold" style="color: rgb(8, 8, 87);">Password</label>
                    <input type="password" placeholder="Password" name="pass" id="pass" value="<?php echo $pass ?>" class="w-75">
                </div>



                <button type="submit" class="fs-3 mt-4 w-50 text-white rounded-pill mb-4 add-btn" name="btn"><i class="bi bi-plus-circle"></i> UPDATE</button>
            </form>
        </div>
    </div>
</div>

<?php
include('../shared/footer.php')
?>