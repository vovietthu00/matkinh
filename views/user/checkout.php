<?php
include('head.php');
?>

<body>
    <?php
    include('header.php');
    ?>

    <div class="container checkout">
        <h1 class="text-center ">XÁC NHẬN THANH TOÁN</h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="checkout-bill">
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
                                Đơn giá (VNĐ)
                            </th>
                        </tr>

                        <?php
                        $stt = 0;
                        foreach ($cart_data as $key => $value) :
                            $stt++;
                        ?>
                            <tr>
                                <td>
                                    <?= $stt ?>
                                </td>
                                <td>
                                    <?= $value['name'] ?>
                                </td>
                                <td>
                                    <?= $value['quantity'] ?>
                                </td>
                                <td>
                                    <?= number_format($value['price']) ?>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                        <tr>
                            <td colspan="3">
                                <h3>TỔNG:</h3>
                            </td>
                            <td>
                                <h3>
                                    <?= number_format($total_price)  ?> VNĐ
                                </h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <h3>GIẢM:</h3>
                            </td>
                            <td>
                                <h3>
                                    <?= number_format($discount_price)  ?> VNĐ
                                </h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <h2>THANH TOÁN:</h2>
                            </td>
                            <td>
                                <h2>
                                    <?= number_format($price_to_pay)  ?> VNĐ
                                </h2>
                            </td>
                        </tr>



                    </table>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="checkout-info">

                    <form action="?act=order" method="post">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="last_name">Họ:</label>
                                    <input type="text" name="last_name" value="<?= $last_name ?>" id="last_name" class="form-control rounded-0" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="first_name">Tên:</label>
                                    <input type="text" name="first_name" value="<?= $first_name ?>" id="first_name" class="form-control rounded-0" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Số điện thoại:</label>
                            <input type="text" name="phone_number" value="<?= $phone_number ?>" id="phone_number" class="form-control rounded-0" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Địa chỉ:</label>
                            <textarea name="address" id="address" class="form-control rounded-0" required><?= $address ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="payments">Hình thức thanh toán:</label>
                            <select name="payments" id="payments" class="form-control rounded-0" required>
                                <option value="" selected disabled>Chọn..</option>
                                <!-- <option value="online">Thanh toán online</option> -->
                                <option value="cod">Thanh toán khi nhận hàng</option>
                            </select>
                        </div>


                        <input type="hidden" name="email" value="<?= $email ?>">
                        <input type="hidden" name="total_price" value="<?= $total_price ?>">
                        <input type="hidden" name="discount_price" value="<?= $discount_price ?>">
                        <input type="hidden" name="price_to_pay" value="<?= $price_to_pay ?>">
                        <?php
                        if (isset($promotion_name)) :
                        ?>
                            <input type="hidden" name="promotion_name" value="<?= $promotion_name ?>">
                        <?php
                        endif;
                        ?> <input type="hidden" name="status" value="0">
                        <button type="submit" class="btn ">ĐẶT HÀNG</button>
                    </form>

                </div>
            </div>

        </div>


    </div>
    <?php include('footer.php') ?>

</body>

</html>