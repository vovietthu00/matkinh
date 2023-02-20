<?php
include('head.php');
?>

<body>
    <?php
    include('header.php');
    ?>

    <div class="cart">
        <div class="container">
            <h1 class="text-center ">CART</h1>
            <div class="cart-table">
                <?php
                if (isset($_COOKIE['cart']) && count($cart_data) > 0) :

                ?>
                    <table class="table table-striped" width="100%">
                        <tr>
                            <th>
                                STT
                            </th>
                            <th>
                                Tên
                            </th>
                            <th>
                                Số lượng
                            </th>
                            <th>
                                Đơn giá (VNĐ)
                            </th>
                            <th class="text-right">
                                Thành tiền (VNĐ)
                            </th>

                            <th></th>
                        </tr>
                        <?php


                        foreach ($cart_data as $key => $value) :
                            $cart_count += $value['quantity'];
                            $total_price += $value['quantity'] * $value['price'];
                        ?>
                            <tr>

                                <td><?= $stt++ ?></td>
                                <td><?= $value['name'] ?></td>
                                <td width="100px">
                                    <form action="?act=update-cart" method="post">
                                        <input type="number" class="form-control quantity rounded-0" name="quantity" value="<?= $value['quantity'] ?>" onchange="this.form.submit()" min="1">
                                        <input type="hidden" name="product_ID" value="<?= $value['product_ID'] ?>">

                                    </form>
                                </td>
                                <td><?= number_format($value['price']) ?></td>

                                <td class="text-right"><?= number_format($value['quantity'] * $value['price']) ?></td>
                                <td class="text-right" width="10%">

                                    <a href="?act=delete-cart&product_ID=<?= $value['product_ID'] ?>">
                                        <i class="fa fa-trash-o" style="font-size: 25px;"></i>
                                    </a>
                                </td>

                            </tr>


                        <?php
                        endforeach;
                        ?>


                        <tr>
                            <td colspan="4">
                                <h3>TỔNG</h3>
                            </td>
                            <td class="text-right">
                                <h3 id="total_price" data-total_price="<?= $total_price ?>"><?= number_format($total_price) ?> VNĐ</h3>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <h3>GIẢM</h3>
                            </td>
                            <td class="text-right">
                                <h3 id="discount_price"><?= number_format($discount_price) ?> VNĐ</h3>
                            </td>
                            <td>
                            </td>
                        </tr>

                        <?php $price_to_pay = $total_price - $discount_price; ?>
                        <tr>
                            <td colspan="4">
                                <h2>THANH TOÁN</h2>
                            </td>
                            <td class="text-right">
                                <h2 id="price_to_pay"><?= number_format($price_to_pay) ?> VNĐ</h2>
                            </td>
                            <td>
                            </td>
                        </tr>

                    </table>
                    <div class="row" style="padding-top: 20px;">

                        <div class="col-sm-12">
                            <p class="text-danger text-right" id="promotion_noti"></p>

                        </div>

                        <div class="col-sm-3 offset-sm-9">
                            <div class="">

                                <input type="text" id="promotion_name" name="promotion_name" width="100%" class="form-control rounded-0" placeholder="MÃ KHUYẾN MÃI" value="<?php echo (isset($promotion_name)) ? $promotion_name : ''; ?>">

                                <!-- <button class="btn promotion-code" type="button"> ĐỔI MÃ KHUYẾN MÃI</button> -->

                                <button class="btn promotion-code" id="promotion_submit" type="button"> ÁP DỤNG</button>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3 offset-sm-9">
                            <div class="cart-checkout">
                                <form action="?act=checkout-cart" method="post">
                                    <input type="hidden" name="total_price_checkout" id="total_price_checkout" value="<?= $total_price ?>">
                                    <input type="hidden" name="discount_price_checkout" id="discount_price_checkout" value="<?= $discount_price ?>">
                                    <input type="hidden" name="promotion_name_checkout" id="promotion_name_checkout" value="">
                                    <button type="submit" class="btn ">THANH TOÁN</button>
                                </form>
                            </div>

                        </div>
                    </div>

                <?php
                else :
                ?>
                    <table class="table table-striped">
                        <tr>
                            <th>
                                STT
                            </th>
                            <th>
                                Tên
                            </th>
                            <th>
                                Số lượng
                            </th>
                            <th>
                                Đơn giá
                            </th>
                            <th>
                                Tổng
                            </th>

                            <th></th>
                        </tr>
                    </table>

                <?php
                endif;
                ?>
            </div>


        </div>


    </div>
    <?php
    include('footer.php')
    ?>

    <script>
        // var cart_count = $('#cart_count').val();

        $('#promotion_submit').click(function() {
            var promotion_name = $('#promotion_name').val();
            var total_price = parseFloat($('#total_price').data('total_price'));

            $.ajax({
                url: '?act=promotion-cart',
                type: 'POST',
                cache: false,
                data: {
                    promotion_name: promotion_name,
                    total_price: total_price,
                },

                success: function(data) {
                    console.log(data);
                    // console.log(data.promotion_noti);
                    data = JSON.parse(data);
                    var promotion_noti = data.promotion_noti;
                    var discount_price = Number((data.discount_price));
                    var price_to_pay = total_price - discount_price;
                    $('#discount_price_checkout').val(discount_price);

                    price_to_pay = new Intl.NumberFormat('en-US').format(price_to_pay);
                    discount_price = new Intl.NumberFormat('en-US').format(discount_price);
                    $('#price_to_pay').text(price_to_pay + ' VNĐ');
                    $('#promotion_noti').text(promotion_noti);
                    $('#discount_price').text(discount_price + ' VNĐ');
                    if (discount_price == 0) {
                        $('#promotion_name_checkout').val('');

                    } else {
                        $('#promotion_name_checkout').val(promotion_name);

                    }
                },
                error: function(jqXHR, textStatus, err) {
                    alert('text status ' + textStatus + ', err ' + err)
                }
            })

        });
    </script>
</body>

</html>