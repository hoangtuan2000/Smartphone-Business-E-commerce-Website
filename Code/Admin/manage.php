<?php
session_start();
include 'function/function_connect_db.php';
include 'function/function_show_database.php';
include 'function/function_find_database.php';
include('function/function_money_format.php');

$user = $_SESSION['current_user'];
?>


<?php
if (isset($_SESSION['current_user']) && !empty($_SESSION['current_user'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quản Lý - HT SHOP</title>

        <script src="vendor/jquery/jquery.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/chart/chart.js"></script>
        <script src="vendor/chart/chart_loader.js"></script>

        <script src="javascript/javascript-manage.js"></script>
        <script src="javascript/javascript-ajax-database-management.js"></script>
        <script src="javascript/javascript-ajax-choose-address.js"></script>
        <!-- <script src="javascript/javascript-ajax-delete-product.js"></script> -->
        <script src="javascript/javascript-ajax-order-management.js"></script>


        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">

        <link rel="stylesheet" href="style/style-base.css" type="text/css">
        <link rel="stylesheet" href="style/style-manage.css" type="text/css">
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-dark background-blue mb-2">
            <a class="navbar-brand text-logo" href="">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                HT SHOP
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse">
                <ul class="nav nav-pills" role="tablist" id="tab-header">
                    <!-- nut nhan quan ly san pham -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link show active text-white pills-header" id="pills-product-tab" data-toggle="pill" href="#pills-product" data-tab="pills-product" role="tab" aria-controls="pills-product" aria-selected="true">
                            Quản Lý Sản Phẩm
                        </a>
                    </li>

                    <!-- nut nhan quan ly san pham -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-white pills-header" id="pills-order-tab" data-toggle="pill" href="#pills-order" data-tab="pills-order" role="tab" aria-controls="pills-order" aria-selected="false">
                            Quản Lý Đơn Hàng
                        </a>
                    </li>

                    <!-- nut nhan quan ly database -->
                    <?php
                    if ($_SESSION['current_user']['id_cv'] == "QT" || $_SESSION['current_user']['id_cv'] == "AD") {
                    ?>
                        <?php
                        if ($_SESSION['current_user']['id_cv'] == "AD") {
                        ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white pills-header" id="pills-database-tab" data-toggle="pill" href="#pills-database" data-tab="pills-database" role="tab" aria-controls="pills-database" aria-selected="false">
                                    Quản Lý Cơ Sở Dữ Liệu
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-white pills-header" id="pills-staff-tab" data-toggle="pill" href="#pills-staff" data-tab="pills-staff" role="tab" aria-controls="pills-staff" aria-selected="false">
                                Quản Lý Nhân Viên
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-white pills-header" id="pills-statistics-tab" data-toggle="pill" href="#pills-statistics" data-tab="pills-statistics" role="tab" aria-controls="pills-statistics" aria-selected="false">
                                Thống Kê
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>


                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle text-btn-menu" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <?php
                                echo $_SESSION['current_user']['ten_nv'];
                                ?>
                            </button>
                            <div class="dropdown-menu text-btn-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="account.php?account_staff=<?php echo $user['id_nv'] ?>">Tài Khoản</a>
                                <a class="dropdown-item" href="function/function_logout.php" id="btn-logout">Đăng Xuất</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- khung hien thi nội dung -->
        <div class="container-fluid tab-content">
            <!-- hien thi san pham -->
            <?php
            include 'show_product.php';
            ?>

            <!-- hien thi đơn hàng -->
            <?php
            include 'show_order.php';
            ?>

            <!-- hien thi databasa -->
            <?php
            include 'show_database.php';
            ?>

            <!-- hien thi nhân viên -->
            <?php
            include 'show_staff.php';
            ?>

            <!-- hien thi thống kê-->
            <?php
            include 'show_statistics.php';
            ?>
        </div>


        <!-- modal thông báo -->
        <?php
        include 'modal_notification.php';
        ?>

    </body>

    </html>
<?php
} else {
    header('Location: index.php');
}
?>