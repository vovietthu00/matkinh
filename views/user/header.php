<nav class="navbar navbar-expand-sm bg-dark ">
    <div class="container">
        <a class="navbar-brand" href="?act=home">
            <img src="assets/user/images/meo.png" alt="" height="100px" width="165px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">

            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="?act=brand-story">CÂU CHUYỆN THƯƠNG HIỆU</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?act=matkinh-story">CHUYỆN MẮT KÍNH</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?act=product">SẢN PHẨM</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">TÀI KHOẢN</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <?php
                            if (!isset($_SESSION['customer'])) :

                            ?>
                                <a class="dropdown-item" href="#" onclick="document.getElementById('login-form').style.display='block'">ĐĂNG NHẬP</a>
                                <a class="dropdown-item" href="#" onclick="document.getElementById('register-form').style.display='block'">ĐĂNG KÝ</a>

                            <?php
                            else :
                            ?>
                                <a class="dropdown-item" href="?act=account"><?= $_SESSION['customer'] ?></a>
                                <a class="dropdown-item" href="?act=logout">ĐĂNG XUẤT</a>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="cart-icon-container">
                        <a class="nav-link" href="?act=cart">
                            <i class="fa fa-shopping-cart"></i>
                            <?php
                            $cart_count = 0;
                            if (isset($_COOKIE['cart']) && isset($_SESSION['customer_ID'])) :
                                $cookie_data = $_COOKIE['cart'];
                                $cart_data = json_decode($cookie_data, true);
                                foreach ($cart_data as $key => $value) {
                                    $cart_count += $value['quantity'];
                                }

                            ?>
                                <span id="cart-count"><?= $cart_count ?></span>
                                <input type="hidden" id="cart_count" value="<?= $cart_count ?>">
                            <?php
                            else :
                            ?>
                                <span id="cart-count"></span>
                                <input type="hidden" id="cart_count" value="0">

                            <?php
                            endif;
                            ?>

                        </a>
                    </div>

                </li>
                <li class="nav-item">

                    <div class="input-group">
                        <input class="form-control search" type="text" autocomplete="off" id="search-input">
                        <i class="fa fa-search search-icon" aria-hidden="true"></i>
                    </div>

                    <div id="search">
                    <!-- <a href="product-detail.php?product_ID=2" class="menu-item-action-view animate-btn">Cà phê sữa</a> -->
                    </div>

                </li>

            </ul>
        </div>
    </div>

</nav>

<!-- <div class="icon-bar">
    <a href="https://www.facebook.com/" target="_blank" class="facebook">
        <i class="fa fa-facebook"></i>
    </a>
    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
    <a href="#" class="google"><i class="fa fa-google"></i></a>

</div> -->

<!-- login -->
<?php
include 'login.php'
?>

<!-- register -->
<?php
include 'register.php'
?>