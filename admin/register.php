<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        .rounded-left {
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }
    </style>
</head>

<body class="d-flex align-items-center" style="background-color: #4a89be;">
    <div class="container my-5 poppins-semibold">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-11 col-12">
                <div class="card card-custom">
                    <div class="row">
                        <div class="col-md-5 d-none d-lg-block">
                            <img class="rounded-left" src="../assets/img/foto-auth.jpg" alt="" style="width: 100%; height: fit-content;">
                        </div>
                        <div class="col-lg-7 col-12 d-flex align-items-center">
                            <div class="card-body px-5">
                                <h3 class="card-title text-center my-4"><strong>Register</strong></h3>
                                <?php if (isset($_GET['error'])) { ?>
                                    <div class="alert alert-danger">
                                        Username atau email sudah digunakan.
                                    </div>
                                <?php } ?>
                                <form action="aksi_register.php" method="post">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Insert Username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Insert Email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Insert Password" required>
                                    </div>
                                    <input type="hidden" name="role" value="user">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn rounded-3 mt-4 text-white" style="background-color: #81c4fc;"><strong>Register</strong></button>
                                    </div>
                                </form>
                                <div class="mt-4 text-center mb-4">
                                    <p>Have an account ?<a href="../admin/login.php" class="fw-bold text-dark"> Login</a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
