<?php
include('head.php');

// var_dump($_SESSION);

?>

<body>
    <?php
    include('header.php');
    ?>
    <?php
    // ob_flush();
    ?>


    <div class="container-fluid slide">
        <div id="slide" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#slide" data-slide-to="0" class="active"></li>
                <li data-target="#slide" data-slide-to="1"></li>
                <li data-target="#slide" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active" >
                    <img src="assets/user/images/slider1.png" style="height:700px">
                </div>
                <div class="carousel-item" >
                    <img src="assets/user/images/slider2.png" style="height:700px">
                </div>
                <div class="carousel-item">
                    <img src="assets/user/images/slider3.png" style="height:700px">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#slide" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#slide" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>

    </div>

    <?php
    if (isset($promotion)) :
    ?>
        <div class="container-fluid">
            <div class="home-promotion">
                <div class="container ">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h2 class="section-heading line-after-heading">
                                KHUYẾN MÃI
                            </h2>
                        </div>
                    </div>

                    <div class="row">
                        <?php
                        foreach ($promotion as $p) :
                        ?>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="home-promotion-list">
                                    <div class="promotion-item">
                                        <div class="name-promotion-item"><?= $p['name'] ?></div>
                                        <div class="promotion-item-info">
                                            <p>
                                                <b> Chi tiết:</b>
                                                <?= $p['detail'] ?>
                                            </p>
                                            <p>
                                                <b>Bắt đầu:</b>
                                                <?= $p['start_date'] ?>
                                            </p>
                                            <p>
                                                <b>Kết thúc:</b>
                                                <?= $p['end_date'] ?>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>

                </div>

            </div>
        </div>
    <?php
    endif;
    ?>

    <?php
    if (isset($product)) :
    ?>
        <div class="container-fluid">
            <div class="home-product">
                <div class="container">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                            <h3 class="section-heading product-title line-after-heading">
                                Mới nhất
                            </h3>
                        </div>
                    </div>

                    <div class="row">

                        <?php
                        foreach ($product as $pro) :
                        ?>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="menu-item mb-5">
                                    <div class="menu-item-image">
                                        <a href="?act=product-detail&product_ID=<?= $pro['product_ID'] ?>">
                                            <img src="uploads/products/<?= $pro['image'] ?>" width="100%">
                                        </a>
                                    </div>
                                    <div class="menu-item-info">
                                        <h3>
                                            <a href="?act=product-detail&product_ID=<?= $pro['product_ID'] ?>">
                                                <?= $pro['name'] ?>
                                            </a>
                                        </h3>
                                        <div class="price-product-item"><?= number_format($pro['price']) ?> đ</div>
                                        <button class="menu-item-action animate-btn add-to-cart" data-product_id="<?= $pro['product_ID'] ?>">THÊM VÀO GIỎ HÀNG</button>
                                        <a href="?act=product-detail&product_ID=<?= $pro['product_ID'] ?>" class="menu-item-action-view animate-btn">CHI TIẾT</a>
                                    </div>
                                </div>
                            </div>

                        <?php
                        endforeach;
                        ?>


                    </div>

                </div>
            </div>
        </div>
    <?php
    endif;
    ?>
    


    <?php
    include('footer.php')
    ?>
</body>

</html>