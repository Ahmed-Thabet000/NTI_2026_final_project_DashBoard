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
                    trusted brands, and a seamless shopping experience to make finding what you love easier. Our goal is to offer quality, variety, and a simple way to discover the latest trends — all in one place.
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
        class="text-center fw-bolder my-5 pt-5 fs-1"
        style="color: rgb(8, 8, 87);">
        Dashboard Overview
    </h2>

    <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-5">

            <a
                href="./categories/list.php"
                class="text-decoration-none stat-card-link">

                <div class="stat-card">
                    <div class="circle-top"></div>
                    <div class="circle-bottom"></div>
                    <div class="top-card">
                        <div class="icon-card">
                            <i class="bi fs-2 text-white bi-grid-fill"></i>
                        </div>
                        <div class="arrow-card">
                            <i class="bi fs-5 text-white bi-arrow-up-right"></i>
                        </div>
                    </div>

                    <div class="card-content">
                        <h6 class="text-white opacity-75" style="margin-bottom: -1px;">Categories</h6>
                        <span class="text-white fs-1 fw-bold"><?php echo $countCategories; ?></span>
                        <p class="text-white opacity-50 " style="font-size: 14px;">Total Categories</p>
                    </div>
                </div>
            </a>

        </div>






        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-5">

            <a
                href="./Brands/list.php"
                class="text-decoration-none stat-card-link">

                <div class="stat-card">
                    <div class="circle-top"></div>
                    <div class="circle-bottom"></div>
                    <div class="top-card">
                        <div class="icon-card">
                            <i class="bi fs-2 text-white bi-tags-fill"></i>
                        </div>
                        <div class="arrow-card">
                            <i class="bi fs-5 text-white bi-arrow-up-right"></i>
                        </div>
                    </div>

                    <div class="card-content">
                        <h6 class="text-white opacity-75" style="margin-bottom: -1px;">Brands</h6>
                        <span class="text-white fs-1 fw-bold"><?php echo $countBrands; ?></span>
                        <p class="text-white opacity-50 " style="font-size: 14px;">Total Brands</p>
                    </div>
                </div>
            </a>

        </div>







        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-5">

            <a
                href="./products/list_products.php"
                class="text-decoration-none stat-card-link">

                <div class="stat-card">
                    <div class="circle-top"></div>
                    <div class="circle-bottom"></div>
                    <div class="top-card">
                        <div class="icon-card">
                            <i class="bi fs-2 text-white bi-bag-plus-fill"></i>
                        </div>
                        <div class="arrow-card">
                            <i class="bi fs-5 text-white bi-arrow-up-right"></i>
                        </div>
                    </div>

                    <div class="card-content">
                        <h6 class="text-white opacity-75" style="margin-bottom: -1px;">Products</h6>
                        <span class="text-white fs-1 fw-bold"><?php echo $countProducts; ?></span>
                        <p class="text-white opacity-50 " style="font-size: 14px;">Total Products</p>
                    </div>
                </div>
            </a>

        </div>






        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-5">

            <a
                href="./Employees/list.php"
                class="text-decoration-none stat-card-link">

                <div class="stat-card">
                    <div class="circle-top"></div>
                    <div class="circle-bottom"></div>
                    <div class="top-card">
                        <div class="icon-card">
                            <i class="bi fs-2 text-white bi-people-fill"></i>
                        </div>
                        <div class="arrow-card">
                            <i class="bi fs-5 text-white bi-arrow-up-right"></i>
                        </div>
                    </div>

                    <div class="card-content">
                        <h6 class="text-white opacity-75" style="margin-bottom: -1px;">Employees</h6>
                        <span class="text-white fs-1 fw-bold"><?php echo $countEmployees; ?></span>
                        <p class="text-white opacity-50 " style="font-size: 14px;">Total Employees</p>
                    </div>
                </div>
            </a>

        </div>






        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-5">

            <a
                href="./Partners/list_partner.php"
                class="text-decoration-none stat-card-link">

                <div class="stat-card">
                    <div class="circle-top"></div>
                    <div class="circle-bottom"></div>
                    <div class="top-card">
                        <div class="icon-card">
                            <i class="bi fs-2 text-white bi-buildings-fill"></i>
                        </div>
                        <div class="arrow-card">
                            <i class="bi fs-5 text-white bi-arrow-up-right"></i>
                        </div>
                    </div>

                    <div class="card-content">
                        <h6 class="text-white opacity-75" style="margin-bottom: -1px;">Partners</h6>
                        <span class="text-white fs-1 fw-bold"><?php echo $countPartners; ?></span>
                        <p class="text-white opacity-50 " style="font-size: 14px;">Total Partners</p>
                    </div>
                </div>
            </a>

        </div>






        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-5">

            <a
                href="./Clients/list.php"
                class="text-decoration-none stat-card-link">

                <div class="stat-card">
                    <div class="circle-top"></div>
                    <div class="circle-bottom"></div>
                    <div class="top-card">
                        <div class="icon-card">
                            <i class="bi fs-2 text-white bi-person-fill"></i>
                        </div>
                        <div class="arrow-card">
                            <i class="bi fs-5 text-white bi-arrow-up-right"></i>
                        </div>
                    </div>

                    <div class="card-content">
                        <h6 class="text-white opacity-75" style="margin-bottom: -1px;">Clients</h6>
                        <span class="text-white fs-1 fw-bold"><?php echo $countClients; ?></span>
                        <p class="text-white opacity-50 " style="font-size: 14px;">Total Clients</p>
                    </div>
                </div>
            </a>

        </div>


    </div>

</div>

<?php
include('./shared/footer.php');
?>