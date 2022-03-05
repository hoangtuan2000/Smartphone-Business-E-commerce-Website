<?php
session_start();
include 'function/function_connect_db.php';
include 'function/function_show_database.php';
include 'function/function_find_database.php';
include 'function/function_money_format.php';

if (isset($_COOKIE['email_kh']) && !empty($_COOKIE['email_kh'])) {
    $email_kh = $_COOKIE['email_kh'];
}

if (isset($_COOKIE['password_kh']) && !empty($_COOKIE['password_kh'])) {
    $password_kh = $_COOKIE['password_kh'];
}

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điều Khoản Và Chính sách - HT Shop</title>

    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="javascript/javascript-ajax-login.js"></script>

    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">

    <link rel="stylesheet" href="styles/style-base.css" type="text/css">
    <link rel="stylesheet" href="styles/style-terms-policies.css" type="text/css">
    <link href="vendor/aos-master/dist/aos.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- navbar header -->
    <?php
    include 'nav_header.php';
    ?>

    <!-- modal login -->
    <?php
    include 'modal_login.php';
    ?>

    <!-- modal notification -->
    <?php
    include 'modal_notification.php';
    ?>

    <!-- navbar menu (chức năng) -->
    <?php
    include 'nav_menu.php';
    ?>

    <!-- Breadcrumb -->
    <?php
    include 'breadcrumb.php';
    ?>


    <!-- điều khoản và chính sách -->
    <div class="container mb-2" data-aos="fade-up-right" data-aos-delay="500" data-aos-duration="800"
        data-aos-offset="30" data-aos-easing="linear">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-2 pr-4 rounded">
                    <div class="mb-1 text-center font-weight-bold text-header-terms-policies">Điều Khoản Và Chính Sách
                        Của HT SHOP</div>
                    <p class="text-normal">*Áp dụng từ: 1/1/2017</p>
                    <ol class="list-terms-policies list-1">
                        <!-- nguyên tắc chung -->
                        <li>
                            <p class="text-content-terms-policies">Nguyên Tắc Chung</p>
                            <p class="text-content">
                                Website thương mại điện tử htshop.com do công ty Cổ Phần HT SHOP (“Công ty”)
                                thực hiện hoạt động và vận hành. Đối tượng phục vụ là tất cả khách hàng trên 63
                                tỉnh thành Việt Nam có nhu cầu mua hàng nhưng không có thời gian đến siêu thị hoặc đặt
                                trước để khi đến siêu thị là đảm bảo có hàng
                            </p>
                            <p class="text-content">
                                Sản phẩm được kinh doanh tại www.htshop.com phải đáp ứng đầy
                                đủ các quy định của pháp luật, không bán hàng nhái, hàng không rõ nguồn gốc, hàng xách
                                tay.
                            </p>
                            <p class="text-content">
                                Hoạt động mua bán tại htshop.com phải được thực hiện công khai,
                                minh bạch, đảm bảo quyền lợi của người tiêu dùng.
                            </p>
                        </li>
                        <!-- quy định chung -->
                        <li>
                            <p class="text-content-terms-policies">Quy Định Chung</p>
                            <ol class="list-2">
                                <li>
                                    <p class="text-content-header">Tên Miền website Thương mại Điện tử:</p>
                                    <p class="text-content">
                                        Website thương mại điện tử htshop.com do Công ty Cổ phần HT SHOP
                                        phát triển với tên miền giao dịch là: www.htshop.com (sau đây gọi tắt là:
                                        “Website TMĐT htshop.com”)
                                    </p>
                                </li>
                                <li>
                                    <p class="text-content-header">Định nghĩa chung:</p>
                                    <p class="text-content">
                                        <b>Người bán</b> là công ty cổ phần HT SHOP.
                                    </p>
                                    <p class="text-content">
                                        <b>Người mua</b> là công dân Việt Nam trên khắp 63 tỉnh thành. Người mua có
                                        quyền đăng ký tài khoản hoặc không cần đăng ký để thực hiện giao dịch.
                                    </p>
                                    <p class="text-content">
                                        <b>Thành viên</b> là bao gồm cả người mua và người tham khảo thông tin, thảo
                                        luận tại website.
                                    </p>
                                    <p class="text-content">
                                        Nội dung bản Quy chế này tuân thủ theo các quy định hiện hành của Việt Nam.
                                        Thành viên khi tham gia website TMĐT htshop.com phải tự tìm hiểu trách
                                        nhiệm pháp lý của mình đối với luật pháp hiện hành của Việt Nam và cam kết thực
                                        hiện đúng những nội dung trong Quy chế này.
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <!-- quy định thanh toán -->
                        <li>
                            <p class="text-content-terms-policies">
                                Quy Trình Thanh Toán
                            </p>
                            <p class="text-normal">
                                Người mua và bên bán có thể tham khảo các phương thức thanh toán sau đây và lựa chọn áp
                                dụng phương thức phù hợp:
                            </p>
                            <ol class="list-2">
                                <li>
                                    <p class="text-content-header">Thanh toán trực tiếp (người mua nhận hàng tại địa chỉ
                                        bên bán):</p>
                                    <p class="text-content">
                                        Bước 1: Người mua tìm hiểu thông tin về sản phẩm, dịch vụ được đăng tin.
                                    </p>
                                    <p class="text-content">
                                        Bước 2: Người mua đến địa chỉ bán hàng là các siêu thị bán hàng của
                                        www.htshop.com.
                                    </p>
                                    <p class="text-content">
                                        Bước 3: Người mua thanh toán bằng tiền mặt, thẻ ATM nội địa hoặc thẻ tín dụng và
                                        nhận hàng.
                                    </p>
                                </li>
                                <li>
                                    <p class="text-content-header">Thanh toán sau (COD – giao hàng và thu tiền tận nơi):
                                    </p>
                                    <p class="text-content">
                                        Bước 1: Người mua tìm hiểu thông tin về sản phẩm, dịch vụ được đăng tin.
                                    </p>
                                    <p class="text-content">
                                        Bước 2: Người mua xác thực đơn hàng (điện thoại, tin nhắn, email).
                                    </p>
                                    <p class="text-content">
                                        Bước 3: Người bán xác nhận thông tin Người mua.
                                    </p>
                                    <p class="text-content">
                                        Bước 4: Người bán chuyển hàng.
                                    </p>
                                    <p class="text-content">
                                        Bước 5: Người mua nhận hàng và thanh toán bằng tiền mặt, thẻ ATM nội địa hoặc
                                        thẻ tín dụng.
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <!-- đảm bảo an toàn giao dịch -->
                        <li>
                            <p class="text-content-terms-policies">
                                Đảm Bảo An Toàn Giao Dịch
                            </p>
                            <p class="text-content">
                                Ban quản lý đã sử dụng các dịch vụ để bảo vệ thông tin về nội dung mà người bán đăng sản
                                phẩm trên htshop.com. Để đảm bảo các giao dịch được tiến hành thành công, hạn chế
                                tối đa rủi ro có thể phát sinh.
                            </p>
                            <p class="text-content">
                                Người mua nên cung cấp thông tin đầy đủ (tên, địa chỉ, số điện thoại, email) khi tham
                                gia mua hàng của htshop.com để htshop.com có thể liên hệ nhanh lại với
                                người mua trong trường hợp xảy ra lỗi.
                            </p>
                            <p class="text-content">
                                Trong trường hợp giao dịch nhận hàng tại nhà của người mua, thì người mua chỉ nên thanh
                                toán sau khi đã kiểm tra hàng hoá chi tiết và hài lòng với sản phẩm.
                            </p>
                            <p class="text-content">
                                Trong trường lỗi xảy ra trong quá trình thanh toán trực tuyến, htshop.com sẽ là
                                đơn vị giải quyết cho khách hàng trong vòng 1 giờ làm việc từ khi tiếp nhận thông tin từ
                                người thực hiện giao dịch.
                            </p>
                        </li>
                        <!-- Bảo Vệ Thông Tin Cá Nhân Khách Hàng -->
                        <li>
                            <p class="text-content-terms-policies">
                                Bảo Vệ Thông Tin Cá Nhân Khách Hàng
                            </p>
                            <p class="text-normal">
                                htshop.com thu thập và sử dụng thông tin cá nhân bạn với mục đích phù hợp và hoàn
                                toàn tuân thủ nội dung của “Chính sách bảo mật” này.
                            </p>
                            <p class="text-normal">Cụ thể:</p>
                            <p class="text-content">
                                Xử lý đơn hàng: gọi điện/tin nhắn xác nhận việc đặt hàng, thông báo về trạng thái đơn
                                hàng & thời gian giao hàng, xác nhận việc huỷ đơn hàng (nếu có).
                            </p>
                            <p class="text-content">
                                Gởi thư ngỏ/thư cảm ơn, giới thiệu sản phẩm mới, dịch vụ mới hoặc các chương trình
                                khuyến mãi của htshop.com.
                            </p>
                            <p class="text-content">
                                Gởi thông tin về bảo hành sản phẩm.
                            </p>
                            <p class="text-content">
                                Giải quyết khiếu nại của khách hàng.
                            </p>
                            <p class="text-content">
                                Thông tin trao thưởng (của htshop.com hoặc của hãng).
                            </p>
                            <p class="text-content">
                                Gởi thông tin cho công ty tài chính để tiếp nhận, thẩm định & duyệt hồ sơ trả góp.
                            </p>
                            <p class="text-content">
                                Các khảo sát để chăm sóc khách hàng tốt hơn.
                            </p>
                            <p class="text-content">
                                Xác nhận các thông tin về kỹ thuật & bảo mật thông tin khách hàng.
                            </p>
                            <p class="text-content">
                                Các trường hợp có sự yêu cầu của cơ quan nhà nước có thẩm quyền, theo đúng quy định của
                                pháp luật.
                            </p>
                        </li>
                        <!-- Trách Nhiệm Trong Trường Hợp Phát Sinh Lỗi Kỹ Thuật -->
                        <li>
                            <p class="text-content-terms-policies">
                                Trách Nhiệm Trong Trường Hợp Phát Sinh Lỗi Kỹ Thuật
                            </p>
                            <p class="text-content">
                                Website TMĐT htshop.com cam kết nỗ lực đảm bảo sự an toàn và ổn định của toàn
                                bộ hệ thống kỹ thuật. Tuy nhiên, trong trường hợp xảy ra sự cố do lỗi của
                                htshop.com, htshop.com sẽ ngay lập tức áp dụng các biện pháp để đảm bảo
                                quyền lợi cho người mua hàng.
                            </p>
                            <p class="text-content">
                                Khi thực hiện các giao dịch trên Sàn, bắt buộc các thành viên phải thực hiện đúng theo
                                các quy trình hướng dẫn.
                            </p>
                            <p class="text-content">
                                Tuy nhiên, Ban quản lý website TMĐT htshop.com sẽ không chịu trách nhiệm giải
                                quyết trong trường hợp thông báo của các thành viên không đến được Ban quản lý, phát
                                sinh từ lỗi kỹ thuật, lỗi đường truyền, phần mềm hoặc các lỗi khác không do Ban quản lý
                                gây ra.
                            </p>
                        </li>
                        <!-- Quy Trình Tiếp Nhận & Giải Quyết Khiếu Nại -->
                        <li>
                            <p class="text-content-terms-policies">
                                Quy Trình Tiếp Nhận & Giải Quyết Khiếu Nại
                            </p>
                            <p class="text-normal">
                                Bước 1: người mua hàng có thể gửi khiếu nại của mình đến HT SHOP qua các phương
                                tiện sau:
                            </p>
                            <ul style="list-style-type:disc" class="text-normal">
                                <li>Tại website liên hệ, bình luận khách hàng</li>
                                <li>Qua tổng đài giải quyết khiếu nại: 18001062</li>
                                <li>Qua email: cskh@htshop.com</li>
                                <li>Trực tiếp tại các siêu thị HT SHOP/Điện máy XANH toàn quốc</li>
                            </ul>
                            <p class="text-normal">
                                Bước 2: HT SHOP sẽ liên lạc với khách hàng để tìm hiểu nguyên nhân để thoả
                                thuận đền bù (khi cần).
                            </p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


     <!-- footer -->
     <?php
    include 'footer.php';
    ?>


    <!-- script AOS -->
    <script src="vendor/aos-master/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>