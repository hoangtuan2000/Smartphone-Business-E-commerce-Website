<?php

include 'function/function_connect_db.php';

/*************************************************************************************************************************/
//hiện breadcrumd trong chi tiết sản phẩm
if (isset($_GET['id_product']) && !empty($_GET['id_product'])) {
    $id_sp = $_GET['id_product'];
    $result_product = get_sanpham($id_sp);
?>
    <nav class="container" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php" class="active text-dark">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a class="active text-dark">
                    <?php echo $result_product['ten_sp'] ?>
                </a>
            </li>
        </ol>
    </nav>
<?php
}

/*************************************************************************************************************************/
//hiện breadcrumd đăng ký
if (isset($_GET['register'])) {
?>
    <nav class="container mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php" class="active text-dark">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="active text-dark">
                    Đăng Ký Tài Khoản
                </span>
            </li>
        </ol>
    </nav>
<?php
}


/*************************************************************************************************************************/
//breadcrumd giỏ hàng
$page = $_SERVER['PHP_SELF'];
if (strpos($page, "cart.php") != false) {
?>
    <nav class="container mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php" class="active text-dark">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="active text-dark">
                    Giỏ Hàng
                </span>
            </li>
        </ol>
    </nav>
<?php
}

/*************************************************************************************************************************/
//breadcrumd đặt hàng
$page = $_SERVER['PHP_SELF'];
if (strpos($page, "order.php") != false) {
?>
    <nav class="container mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php" class="active text-dark">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="active text-dark">
                    Đặt Hàng
                </span>
            </li>
        </ol>
    </nav>
<?php
}
/*************************************************************************************************************************/
//breadcrumd tài khoản
$page = $_SERVER['PHP_SELF'];
if (strpos($page, "account.php") != false) {
?>
    <nav class="container mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php" class="active text-dark">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="active text-dark">
                    Thông Tin Tài Khoản
                </span>
            </li>
        </ol>
    </nav>
<?php
}
/*************************************************************************************************************************/
//breadcrumd chi tiet đơn hàng
$page = $_SERVER['PHP_SELF'];
if (strpos($page, "order_detail.php") != false) {
?>
    <nav class="container mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php" class="active text-dark">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="active text-dark">
                    Chi Tiết Đơn Hàng
                </span>
            </li>
        </ol>
    </nav>
<?php
}
/*************************************************************************************************************************/
//breadcrumd Điện thoại
$page = $_SERVER['PHP_SELF'];
if (strpos($page, "smartphone.php") != false) {
?>
    <nav class="container mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php" class="active text-dark">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="active text-dark">
                    Điện Thoại
                </span>
            </li>
        </ol>
    </nav>
<?php
}
/*************************************************************************************************************************/
//breadcrumd Tai Nghe
$page = $_SERVER['PHP_SELF'];
if (strpos($page, "headphone.php") != false) {
?>
    <nav class="container mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php" class="active text-dark">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="active text-dark">
                    Tai Nghe
                </span>
            </li>
        </ol>
    </nav>
<?php
}
/*************************************************************************************************************************/
//breadcrumd ốp lưng
$page = $_SERVER['PHP_SELF'];
if (strpos($page, "phonecase.php") != false) {
?>
    <nav class="container mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php" class="active text-dark">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="active text-dark">
                    Ốp Lưng
                </span>
            </li>
        </ol>
    </nav>
<?php
}
/*************************************************************************************************************************/
//breadcrumd chính sách và điều khoản
$page = $_SERVER['PHP_SELF'];
if (strpos($page, "terms_policies.php") != false) {
?>
    <nav class="container mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php" class="active text-dark">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="active text-dark">
                    Điều Khoản Và Chính Sách
                </span>
            </li>
        </ol>
    </nav>
<?php
}
/*************************************************************************************************************************/
//breadcrumd tìm kiếm sản phẩm
$page = $_SERVER['PHP_SELF'];
if (strpos($page, "search_results.php") != false && !isset($_GET['sql'])) {
?>
    <nav class="container mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php" class="active text-dark">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="active text-dark">
                    Tìm Kiếm Sản Phẩm
                </span>
            </li>
        </ol>
    </nav>
<?php
}
//breadcrumd lọc sản phẩm
if (isset($_GET['sql'])) {
?>
    <nav class="container mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php" class="active text-dark">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="active text-dark">
                    Lọc Sản Phẩm
                </span>
            </li>
        </ol>
    </nav>
<?php
}
