<?php
include('./shared/connect.php');

$countQuery = "SELECT count(*) as total_cat FROM categories";
$countCat = mysqli_query($conn, $countQuery);

if (mysqli_num_rows($countCat) > 0) {
    $row = mysqli_fetch_assoc($countCat);
    $countCategories = $row['total_cat'];
}
$countQuery = "SELECT count(*) as total_Pro FROM products";
$countPro = mysqli_query($conn, $countQuery);

if (mysqli_num_rows($countPro) > 0) {
    $row = mysqli_fetch_assoc($countPro);
    $countProducts = $row['total_Pro'];
}
$countQuery = "SELECT count(*) as total_Cli FROM clients";
$countCli = mysqli_query($conn, $countQuery);

if (mysqli_num_rows($countCli) > 0) {
    $row = mysqli_fetch_assoc($countCli);
    $countClients = $row['total_Cli'];
}
$countQuery = "SELECT count(*) as total_Part FROM partners";
$countPart = mysqli_query($conn, $countQuery);

if (mysqli_num_rows($countPart) > 0) {
    $row = mysqli_fetch_assoc($countPart);
    $countPartners = $row['total_Part'];
}
$countQuery = "SELECT count(*) as total_Bra FROM brands";
$countBra = mysqli_query($conn, $countQuery);

if (mysqli_num_rows($countBra) > 0) {
    $row = mysqli_fetch_assoc($countBra);
    $countBrands = $row['total_Bra'];
}
$countQuery = "SELECT count(*) as total_Emp FROM employees";
$countEmp = mysqli_query($conn, $countQuery);

if (mysqli_num_rows($countEmp) > 0) {
    $row = mysqli_fetch_assoc($countEmp);
    $countEmployees = $row['total_Emp'];
}

include('./shared/header.php');
include('./shared/nav.php');
?>

<h1 class="text-center fw-bold  py-3 title" style="margin-top: 100px; ">Welcome to the DashBoard</h1>
<div class="container pt-5 ">
    <div class="row ">
        <div class="col-lg-4 col=md-6 col-sm-12 d-flex justify-content-center mb-5">
            <div class="card bg-primary  shadow-lg home-card" style="width: 18rem;">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="bi bi-bag-plus-fill text-white fs-1 py-4"></i>
                    <h5 class="card-title text-white fs-3 py-3">Categories</h5>
                    <div class="text-white fw-bold fs-2 pb-4"><?php echo $countCategories ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col=md-6 col-sm-12 d-flex justify-content-center  mb-5">
            <div class="card bg-primary  shadow-lg home-card" style="width: 18rem;">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="bi bi-collection-fill text-white fs-1 py-4"></i>
                    <h5 class="card-title text-white fs-3 py-3">Brands</h5>
                    <div class="text-white fw-bold fs-2 pb-4"><?php echo $countBrands ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col=md-6 col-sm-12 d-flex justify-content-center  mb-5">
            <div class="card bg-primary  shadow-lg home-card" style="width: 18rem;">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="bi bi-cart-plus-fill text-white fs-1 py-4"></i>
                    <h5 class="card-title text-white fs-3 py-3">Products</h5>
                    <div class="text-white fw-bold fs-2 pb-4"><?php echo $countProducts ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col=md-6 col-sm-12 d-flex justify-content-center  mb-5">
            <div class="card bg-primary  shadow-lg home-card" style="width: 18rem;">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="bi bi-person-fill text-white fs-1 py-4"></i>
                    <h5 class="card-title text-white fs-3 py-3">Clients</h5>
                    <div class="text-white fw-bold fs-2 pb-4"><?php echo $countClients ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col=md-6 col-sm-12 d-flex justify-content-center  mb-5">
            <div class="card bg-primary  shadow-lg home-card" style="width: 18rem;">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="bi bi-headset text-white fs-1 py-4"></i>
                    <h5 class="card-title text-white fs-3 py-3">Employees</h5>
                    <div class="text-white fw-bold fs-2 pb-4"><?php echo $countEmployees ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col=md-6 col-sm-12 d-flex justify-content-center  mb-5">
            <div class="card bg-primary  shadow-lg home-card" style="width: 18rem;">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="bi bi-buildings-fill text-white fs-1 py-4"></i>
                    <h5 class="card-title text-white fs-3 py-3">Partners</h5>
                    <div class="text-white fw-bold fs-2 pb-4"><?php echo $countPartners ?></div>
                </div>
            </div>
        </div>

        
    </div>
</div>


<?php
include('./shared/footer.php');
?>