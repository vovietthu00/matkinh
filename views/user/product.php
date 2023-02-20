<?php
include('head.php');
?>

<body>
    <?php
    include('header.php');
    ?>
    <?php
    // ob_flush();
    ?>

    <?php
    if ($action == 'product') :
    ?>
        <div class="container-fluid">
            <!-- <div class="menu-cover"></div> -->
            <div class="menu">
                <div class="container">

                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 ">

                            <div class="menu-sidebar sticky-top">
                                <ul>
                                    <li>
                                        <a href="?act=product">Tất cả</a>
                                    </li>
                                    <?php
                                    foreach ($categories as $c) :
                                    ?>
                                        <li>
                                            <a href="?act=product&category_ID=<?= $c['category_ID'] ?>"><?= $c['name'] ?></a>
                                        </li>
                                    <?php
                                    endforeach;
                                    ?>
                                </ul>
                            </div>
                        </div>


                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 border-right-before">


                            <div class="menu-item-block" id="">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <h2 class="section-heading line-after-heading">
                                            <?php
                                            if (isset($category_ID)) {
                                                echo $cate['name'];
                                            } else {
                                                echo 'Tất cả sản phẩm';
                                            }

                                            ?>

                                        </h2>
                                    </div>
                                </div>
                                <div class="row">

                                    <?php
                                    foreach ($products as $pro) :
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
                </div>

                <div class="product-pagination">
                    <nav>
                        <ul class="pagination">
                            <?php
                            if (isset($category_ID)) :
                            ?>
                                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?act=product&category_ID=<?= $category_ID ?>&page=<?= $page - 1 ?>" tabindex="-1">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                </li>

                                <?php
                                for ($i = 1; $i <= ceil($product_num / 9); $i++) :
                                ?>
                                    <li class="page-item <?php echo ($page == $i) ? 'active' : '' ?> ">
                                        <a class="page-link " href="?act=product&category_ID=<?= $category_ID ?>&page=<?= $i ?>"><?= $i ?></a>
                                    </li>

                                <?php
                                endfor;
                                ?>
                                <li class="page-item <?php echo ($page >= ceil($product_num / 9)) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?act=product&category_ID=<?= $category_ID ?>&page=<?= $page + 1 ?>">
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>

                            <?php
                            else :
                            ?>
                                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?act=product&page=<?= $page - 1 ?>" tabindex="-1">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                </li>

                                <?php
                                for ($i = 1; $i <= ceil($product_num / 9); $i++) :
                                ?>
                                    <li class="page-item <?php echo ($page == $i) ? 'active' : '' ?> ">
                                        <a class="page-link " href="?act=product&page=<?= $i ?>"><?= $i ?></a>
                                    </li>

                                <?php
                                endfor;
                                ?>
                                <li class="page-item <?php echo ($page >= ceil($product_num / 9)) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?act=product&page=<?= $page + 1 ?>">
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                            <?php
                            endif;
                            ?>


                        </ul>
                    </nav>
                </div>

            </div>



        </div>

    <?php
    endif;
    ?>


    <?php
    if ($action == 'product-detail') :
    ?>

        <div class="container-fluid">
            <div class="product">
                <div class="container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="?act=product">SẢN PHẨM</a></li>
                            <li class="breadcrumb-item"><a href="?act=product&category_ID=<?= $product['category_ID'] ?>"><?= $product['category_name'] ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $product['name'] ?></li>
                        </ol>
                    </nav>




                    <div class="row">

                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <img src="uploads/products/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" title="<?= $product['name'] ?>" width="100%">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="product-info">
                                <h1 class="product-info-title line-after-heading">
                                    <?= $product['name'] ?>
                                </h1>

                                <p style="white-space: pre-line">
                                    <?= $product['short_des'] ?>
                                </p>
                                <div class="product-price"><?= number_format($product['price']) ?> Đ</div>
                                <br> <br>
                                <!-- <button class="btn">MUA NGAY</button> -->
                                <button class="menu-item-action animate-btn add-to-cart" data-product_id="<?= $product['product_ID'] ?>">THÊM VÀO GIỎ HÀNG</button>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="product-description">
                <div class="product-description-content text-center">
                    <h3 class="section-heading product-description-content-title line-after-heading">
                        <?= $product['des_content_title'] ?>
                    </h3>
                    <p>
                        <b style="color: #EA8025;">
                        </b>
                    </p>
                    <br>
                    <p style="white-space: pre-line">
                        <?= $product['des_content'] ?>
                    </p>
                    <br>
                    <p>
                        <b style="color: #EA8025;">
                        </b>
                    </p>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="product-related">
                <div class="container">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                            <h3 class="section-heading product-related-title line-after-heading">
                                Có thể bạn thích
                            </h3>
                        </div>
                    </div>

                    <div class="row">

                        <?php
                        foreach ($product_relate as $pro) :
                        ?>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="menu-item">
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

        <!-- <div class="container-fluid product-comment">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <h3 class="section-heading product-comment-title line-after-heading">
                            Bình luận
                        </h3>
                    </div>
                </div>
                <div class="fb-comments" data-href="https://chithlpc00459.000webhostapp.com/product-detail.php" data-numposts="5" data-width="100%"></div>
            </div>
        </div> -->


    <?php
    endif;
    ?>

    <?php
    include('footer.php')
    ?>

</body>

</html>