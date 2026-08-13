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

<div class="container" style="margin-top: 110px;">

    <div
        class="row align-items-stretch mb-5 overflow-hidden shadow-lg"
        style="min-height: 390px; border-radius: 25px; background-color: rgb(8, 8, 87);">

        <div
            class="col-lg-5 col-md-12 d-flex align-items-center "
            style="padding: 55px;">

            <div class="text-white">

                <p
                    class="fw-bold mb-3 fs-1"
                    style="color: white; letter-spacing: 3px;">
                    ANALGIA
                </p>



                <p
                    class="mb-4 fw-normal"
                    style="font-size: 1.05rem; color: #e0e0e0; line-height: 2.0;">
                    Welcome to ANALGIA, your modern destination for fashion and style. We bring together carefully selected products, 
                    trusted brands, and a seamless shopping experience to make finding what you love easier. Our goal is to offer quality, 
                    variety, and a simple way to discover the latest trends — all in one place.
            </div>

        </div>

        <div
            class="col-lg-7 col-md-12 p-0"
            style="min-height: 390px;">

            <img
                src="./uploads/products/unsplash_4gOl0SnoTvw.png"
                alt="Fashion"
                class="w-100 h-100"
                style="object-fit: cover; min-height: 390px;">

        </div>

    </div>

    <h2
        class="text-center fw-bold mb-5"
        style="color: rgb(8, 8, 87);">
        Dashboard Overview
    </h2>

    <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-5">

            <a
                href="./categories/list.php"
                class="text-decoration-none">

                <div
                    class="card shadow-lg home-card"
                    style="width: 18rem; border: none; background-color: rgb(8, 8, 87);">

                    <div class="card-body d-flex flex-column align-items-center">

                        <i class="bi bi-bag-plus-fill text-white fs-1 py-4"></i>

                        <h5 class="card-title text-white fs-3 py-3">
                            Categories
                        </h5>

                        <div class="text-white fw-bold fs-2 pb-4">
                            <?php echo $countCategories; ?>
                        </div>

                    </div>

                </div>

            </a>

        </div>


        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-5">

            <a
                href="Brands/list.php"
                class="text-decoration-none">

                <div
                    class="card shadow-lg home-card"
                    style="width: 18rem; border: none; background-color: rgb(8, 8, 87);">

                    <div class="card-body d-flex flex-column align-items-center">

                        <i class="bi bi-collection-fill text-white fs-1 py-4"></i>

                        <h5 class="card-title text-white fs-3 py-3">
                            Brands
                        </h5>

                        <div class="text-white fw-bold fs-2 pb-4">
                            <?php echo $countBrands; ?>
                        </div>

                    </div>

                </div>

            </a>

        </div>


        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-5">

            <a
                href="./products/list_products.php"
                class="text-decoration-none">

                <div
                    class="card shadow-lg home-card"
                    style="width: 18rem; border: none; background-color: rgb(8, 8, 87);">

                    <div class="card-body d-flex flex-column align-items-center">

                        <i class="bi bi-cart-plus-fill text-white fs-1 py-4"></i>

                        <h5 class="card-title text-white fs-3 py-3">
                            Products
                        </h5>

                        <div class="text-white fw-bold fs-2 pb-4">
                            <?php echo $countProducts; ?>
                        </div>

                    </div>

                </div>

            </a>

        </div>


        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-5">

            <a
                href="Clients/list.php"
                class="text-decoration-none">

                <div
                    class="card shadow-lg home-card"
                    style="width: 18rem; border: none; background-color: rgb(8, 8, 87);">

                    <div class="card-body d-flex flex-column align-items-center">

                        <i class="bi bi-person-fill text-white fs-1 py-4"></i>

                        <h5 class="card-title text-white fs-3 py-3">
                            Clients
                        </h5>

                        <div class="text-white fw-bold fs-2 pb-4">
                            <?php echo $countClients; ?>
                        </div>

                    </div>

                </div>

            </a>

        </div>


        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-5">

            <a
                href="Employees/list.php"
                class="text-decoration-none">

                <div
                    class="card shadow-lg home-card"
                    style="width: 18rem; border: none; background-color: rgb(8, 8, 87);">

                    <div class="card-body d-flex flex-column align-items-center">

                        <i class="bi bi-headset text-white fs-1 py-4"></i>

                        <h5 class="card-title text-white fs-3 py-3">
                            Employees
                        </h5>

                        <div class="text-white fw-bold fs-2 pb-4">
                            <?php echo $countEmployees; ?>
                        </div>

                    </div>

                </div>

            </a>

        </div>


        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-5">

            <a
                href="Partners/list_partner.php"
                class="text-decoration-none">

                <div
                    class="card shadow-lg home-card"
                    style="width: 18rem; border: none; background-color: rgb(8, 8, 87);">

                    <div class="card-body d-flex flex-column align-items-center">

                        <i class="bi bi-buildings-fill text-white fs-1 py-4"></i>

                        <h5 class="card-title text-white fs-3 py-3">
                            Partners
                        </h5>

                        <div class="text-white fw-bold fs-2 pb-4">
                            <?php echo $countPartners; ?>
                        </div>

                    </div>

                </div>

            </a>

        </div>

    </div>

</div>

<?php
include('./shared/footer.php');
?>