<style>
    .poppins-regular {
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    .poppins-semibold {
        font-family: "Poppins", sans-serif;
        font-weight: 600;
        font-style: normal;
    }
    .source-sans-3-600 {
        font-family: "Source Sans 3", sans-serif;
        font-optical-sizing: auto;
        font-weight: 600;
        font-style: normal;
    }

    .source-sans-3-700 {
        font-family: "Source Sans 3", sans-serif;
        font-optical-sizing: auto;
        font-weight: 700;
        font-style: normal;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-white poppins-regular">
    <div class="container-fluid">
        <a class="navbar-brand source-sans-3-700" href="#">StyleSetter</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav w-100 ms-5">
                <li class="nav-item d-lg-flex">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link poppins-regular ms-4" aria-current="page" href="../user/index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link poppins-regular ms-4" href="../user/kategori.php">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link poppins-regular ms-4" href="../user/produk.php">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link poppins-regular ms-4" href="../user/filter_form.php">Filter</a>
                        </li>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') : ?>
                            <li class="nav-item">
                                <a class="nav-link poppins-regular ms-4" href="../admin/index.php">Admin</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <li class="nav-item ms-lg-auto">
                    <form class="d-flex mt-3 mt-lg-0 ms-4">
                        <a class="btn btn-outline-light me-2" href="../controller/check_profile.php">
                            <i class="fa-solid fa-user text-muted"></i>
                        </a>
                        <a class="btn btn-outline-light me-2" href="shopping_cart.php">
                            <i class="fa-solid fa-cart-shopping text-muted"></i>
                        </a>
                        <a class="btn btn-outline-light me-2" href="user_orders.php">
                            <i class="fa-solid fa-box-archive text-muted"></i>
                        </a>
                        <?php if (isset($_SESSION['id_user'])) : ?>
                            <a class="btn btn-outline-light me-2" href="../controller/logout.php">
                                <i class="fa-solid fa-sign-out-alt text-muted"></i>
                            </a>
                        <?php endif; ?>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>