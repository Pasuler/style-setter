

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Source+Sans+3:wght@200..900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
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

        .card-custom {
            border-radius: 20px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        }
    </style>
    <title>Profile User</title>
</head>

<body>
    <?php 
    session_start();
    require "../components/navbar_home.php";
    require "../koneksi.php";
    $id_user = $_SESSION['id_user'];
    $user_query = $con->query("SELECT * FROM user WHERE id_user = '$id_user'");
    $user_data = $user_query->fetch_assoc();

    $pelanggan_query = $con->query("SELECT * FROM pelanggan WHERE id_user = '$id_user'");
    $pelanggan_data = $pelanggan_query->fetch_assoc();

    $username = $_SESSION['username'];

    $user_nama = $con->query("SELECT user.id_user, pelanggan.nama FROM user 
    JOIN pelanggan ON pelanggan.id_user=user.id_user WHERE username = '$username'");
    $user = $user_nama->fetch_array();
    ?>  

    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <h1 class="text-start source-sans-3-700">Profile <?php echo $user['nama'];?></h1>
            </div>
        </div>
        <div class="row mt-2 mb-4">
            <div class="col-lg-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body">
                        <img class="mt-1 mb-1" src="../assets/img/<?php echo $pelanggan_data['gambar']; ?>" alt="" style="width: 100%; border-radius: 18px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-8 poppins-semibold mb-4">
                <div class="card card-custom">
                    <div class="card-body">
                        <form action="save_profile.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                            <div class="ms-1 row mb-3 mt-1">
                                <div class="col-3">
                                    <label for="username" class="col-form-label">Username</label>
                                </div>
                                <div class="col-9 pe-4">
                                    <input type="text" readonly class="form-control-plaintext" id="username" value="<?php echo $user_data['username']; ?>">
                                </div>
                            </div>
                            <div class="ms-1 row mb-3">
                                <div class="col-3">
                                    <label for="password" class="col-form-label">Password</label>
                                </div>
                                <div class="col-9 pe-4">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Insert Password" value="<?php echo $user_data['password']; ?>" required>
                                </div>
                            </div>
                            <div class="ms-1 row mb-3">
                                <div class="col-3">
                                    <label for="email" class="col-form-label">Email</label>
                                </div>
                                <div class="col-9 pe-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Insert Email" value="<?php echo $user_data['email']; ?>" required>
                                </div>
                            </div>
                            <div class="ms-1 row mb-3">
                                <div class="col-3">
                                    <label for="nama" class="col-form-label">Nama</label>
                                </div>
                                <div class="col-9 pe-4">
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Insert Nama" value="<?php echo $pelanggan_data['nama']; ?>" required>
                                </div>
                            </div>
                            <div class="ms-1 row mb-3">
                                <div class="col-3">
                                    <label for="jenis_kelamin" class="col-form-label">Gender</label>
                                </div>
                                <div class="col-9 pe-4">
                                    <input type="text" name="jenis_kelamin" class="form-control" id="jenis_kelamin" placeholder="Insert Gender" value="<?php echo $pelanggan_data['jenis_kelamin']; ?>" required>
                                </div>
                            </div>
                            <div class="ms-1 row mb-3">
                                <div class="col-3">
                                    <label for="telp" class="col-form-label">Phone Number</label>
                                </div>
                                <div class="col-9 pe-4">
                                    <input type="text" name="telp" class="form-control" id="telp" placeholder="Insert Phone Number" value="<?php echo $pelanggan_data['telp']; ?>" required>
                                </div>
                            </div>
                            <div class="ms-1 row mb-3">
                                <div class="col-3">
                                    <label for="alamat" class="col-form-label">Address</label>
                                </div>
                                <div class="col-9 pe-4">
                                    <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Insert Address" value="<?php echo $pelanggan_data['alamat']; ?>" required>
                                </div>
                            </div>
                            <div class="ms-1 row mb-3">
                                <div class="col-3">
                                    <label for="formFile" class="col-form-label mb-2">Photo</label>
                                </div>
                                <div class="col-9 pe-4">
                                    <input class="form-control" type="file" id="formFile" name="fileToUpload">
                                </div>
                            </div>
                            <div class="ms-1 row mb-3">
                                <div class="col-3 d-grid gap-2">
                                    <a class="btn btn-danger" href="../user/index.php" role="button">Back</a>
                                </div>
                                <div class="col-9 d-grid gap-2 pe-4">
                                    <button class="btn btn-primary" type="submit">Save Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
    require "../components/footer_home.php";
    ?>


</body>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/js/all.min.js"></script>

</html>