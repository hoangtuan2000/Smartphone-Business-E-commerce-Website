<?php
include("./function/function_login.php");
login();
$login_error = $_SESSION['loi'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - HT SHOP</title>

    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">

    <link rel="stylesheet" href="style/style-base.css" type="text/css">

</head>

<body class="background-image">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 margin-10">
                <div class="mx-auto width-600 background-black-opacity">
                    <p class="text-header text-center">
                        Trang Quản Lý HT SHOP
                    </p>
                    <form action="" method="POST">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary">
                                        <i class="fa fa-envelope-o text-white"></i>
                                    </span>
                                </div>
                                <input id="input-login" name="login-email" type="text" class="form-control input-login" placeholder="Email" value="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary">
                                        <i class="fa fa-key text-white"></i>
                                    </span>
                                </div>
                                <input name="login-password" type="password" class="form-control input-login" placeholder="Password">
                            </div>
                        </div>

                        <?php
                        if ($login_error != "") {
                            echo '    <div class="alert alert-warning" role="alert">';
                            echo $login_error;
                            echo '  </div>';
                        }
                        ?>


                        <div class="text-center">
                            <button name="btn-login" type="submit" class="btn btn-primary w-100 text-btn">Đăng Nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>