<?php
include('../shared/connect.php');

$error = '';
$result = '';
$conn = mysqli_connect($host, $username, $password, $dataBase);

// Add a Category
if (isset($_POST['btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $age = $_POST['age'];
    $role = $_POST['role'];
    $image = $_FILES['image'];
    $imageName = $image['name'];
    move_uploaded_file($image['tmp_name'], '../uploads/employees/' . $imageName);


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
            $addQuery = "INSERT INTO employees VALUES (null , '$name' , '$age' , '$imageName' , '$email' ,'$pass' , '$role' , '$phone')";
            $result = mysqli_query($conn, $addQuery);
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}




?>


<?php
include('../shared/header.php');
include('../shared/nav.php');
?>

<?php
if (strlen($error) > 0) {
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:100px">
        <?php echo $error ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<?php
if ($result) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:100px">
        Employee Added Successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<h1 class="text-center fw-bold pb-5 title">Add an Employee</h1>

<div class="container w-50 add-con" style="border: 5px solid rgb(8, 8, 87);">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-9 col-md-12 col-sm-12">
            <form class="d-flex flex-wrap justify-content-center" method="POST" enctype="multipart/form-data">

                <div class="my-2 w-100 text-center">
                    <label for="name" class="form-label text-start w-75 me-2 fw-bold" style="color: rgb(8, 8, 87);">Name</label>
                    <input type="text" placeholder="Name" name="name" id="name" class="w-75">
                </div>
                <div class="my-2 w-100 text-center">
                    <label for="image" class="form-label text-start w-75 me-2 fw-bold" style="color: rgb(8, 8, 87);">Image</label>
                    <input type="file" name="image" id="image" class="w-75">
                </div>
                <div class="my-2 w-100 text-center">
                    <label for="phone" class="form-label text-start w-75  me-2 fw-bold" style="color: rgb(8, 8, 87);">Phone</label>
                    <input type="text" placeholder="Phone" name="phone" id="phone" class="w-75">
                </div>
                <div class="my-2 w-100 text-center">
                    <label for="age" class="form-label text-start w-75  me-2 fw-bold" style="color: rgb(8, 8, 87);">Age</label>
                    <input type="number" min="0" max="200" placeholder="Age" name="age" id="age" class="w-75">
                </div>
                <div class="my-2 w-100 text-center">
                    <label for="role" class="form-label text-start w-75 me-2 fw-bold" style="color: rgb(8, 8, 87);">Role</label>
                    <select name="role" id="role" class="w-75">
                        <option value="">Choose the role</option>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="staff">Staff</option>
                        <option value="intern">Intern</option>
                    </select>
                </div>
                <div class="my-2 w-100 text-center">
                    <label for="email" class="form-label text-start w-75 me-2 fw-bold" style="color: rgb(8, 8, 87);">Email</label>
                    <input type="email" placeholder="Email" name="email" id="email" class="w-75">
                </div>
                <div class="my-2 w-100 text-center">
                    <label for="pass" class="form-label text-start w-75 me-2 fw-bold" style="color: rgb(8, 8, 87);">Password</label>
                    <input type="password" placeholder="Password" name="pass" id="pass" class="w-75">
                </div>


                
                <button type="submit" class="fs-3 mt-4 w-50 text-white rounded-pill mb-4 add-btn" name="btn"><i class="bi bi-plus-circle"></i> ADD</button>
            </form>
        </div>
    </div>
</div>

<?php
include('../shared/footer.php')
?>