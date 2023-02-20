<?php
include('head.php');
?>

<body>
    <?php
    include('header.php');
    ?>

    <div class="container-fluid">

        <div class="container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs account-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#history">Lịch sử đặt hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#account">Thông tin tài khoản</a>
                </li>
                <?php
                if ($customer['password'] !== null) :
                ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#change-password">Đổi mật khẩu</a>
                    </li>
                <?php
                endif;
                ?>
            </ul>
        </div>


        <div class="tab-content account-tabs">
            <!-- history list  -->
            <div id="history" class="tab-pane active"><br>
                <div class="container">
                    <div class="history">
                        <h1 class="text-center">LỊCH SỬ ĐẶT HÀNG</h1>
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Tổng tiền (VNĐ)
                                    </th>
                                    <th>
                                        Giá giảm (VNĐ)
                                    </th>
                                    <th>
                                        Thanh toán (VNĐ)
                                    </th>
                                    <th>
                                        Thời gian đặt
                                    </th>
                                    <th>
                                        Trạng thái
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stt = 0;
                                foreach ($bills as $bill) :
                                    $stt++;
                                ?>
                                    <tr>
                                        <td>
                                            <?= $stt ?>
                                        </td>
                                        <td>
                                            <?= number_format($bill['total_price']) ?>
                                        </td>
                                        <td>
                                            <?= number_format($bill['discount_price']) ?>
                                        </td>
                                        <td>
                                            <?= number_format($bill['price_to_pay']) ?>
                                        </td>
                                        <td>
                                            <?= $bill['created_at'] ?>
                                        </td>
                                        <td>
                                            <?php
                                            $status = $bill['status'];
                                            if ($status == 'pending') {
                                                echo 'Đang xử lý';
                                            } elseif ($status == 'in_transit') {
                                                echo 'Đang giao';
                                            } elseif ($status == 'delivered') {
                                                echo 'Đã giao';
                                            } elseif ($status == 'cancelled') {
                                                echo 'Đã hủy';
                                            }
                                            ?>
                                            <br>

                                            <?php
                                            $payment_status = $bill['payment_status'];
                                            if ($payment_status == 'paid') {
                                                echo 'Đã thanh toán';
                                            } else {
                                                echo 'Chưa thanh toán';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <button class="menu-item-action animate-btn bill-detail" title="Chi tiết" data-bill_id="<?= $bill['bill_ID'] ?>">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <a href="?act=order-cancel&bill_ID=<?= $bill['bill_ID'] ?>" title="Hủy đặt hàng">
                                                    <button class="menu-item-action animate-btn" <?php echo ($status == 'pending') ? '' : 'disabled' ?>>
                                                        <i class="fa fa-close"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <!-- end history list  -->

            <!-- bill detail  -->
            <div class="modal fade" id="bill-detail">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalCenterTitle">CHI TIẾT ĐƠN HÀNG</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <address>
                                Mã đơn hàng: <span id="bill-bill_ID"></span>
                                <br>
                                Số điện thoại: <span id="bill-phone_number"></span>
                                <br>
                                Địa chỉ: <span class="text-capitalize" id="bill-address"></span>
                                <br>
                                Hình thức: <span id="bill-payments"></span>
                                <br>
                                Trạng thái: <span id="bill-status"></span>
                                <br>
                                Mã khuyến mãi: <span id="bill-promotion_name"></span>
                                <br>
                                Đặt lúc: <span id="bill-created_at"></span>

                            </address>


                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá (VNĐ)</th>
                                        <th>Thành tiền (VNĐ)</th>
                                    </tr>
                                </thead>
                                <tbody id="bill-tbody">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"><b>Tổng</b></td>
                                        <td>
                                            <b id="bill-total_price"></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b>Giảm</b></td>
                                        <td>
                                            <b id="bill-discount_price"></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b>Thanh toán</b></td>
                                        <td>
                                            <b id="bill-price_to_pay"></b>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end bill detail  -->


            <!-- account information  -->
            <div id="account" class="tab-pane fade"><br>
                <div class="account-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <div class="account">
                                    <h1 class="text-center">THÔNG TIN TÀI KHOẢN</h1>

                                    <form action="?act=update-info" method="POST">

                                        <div class="form-group">
                                            <label for="username">Username:</label>
                                            <input type="text" name="username" value="<?= $customer['username'] ?>" id="username" class="form-control rounded-0" readonly>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="last_name">Họ:</label>
                                                <input type="text" name="last_name" value="<?= $customer['last_name'] ?>" id="last_name" class="form-control rounded-0">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="first_name">Tên</label>
                                                <input type="text" name="first_name" value="<?= $customer['first_name'] ?>" id="first_name" class="form-control rounded-0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="email">Email:</label>
                                                <input type="text" name="email" value="<?= $customer['email'] ?>" id="email" class="form-control rounded-0" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="phone_number">Phone number</label>
                                                <input type="text" name="phone_number" value="<?= $customer['phone_number'] ?>" id="phone_number" class="form-control rounded-0">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" class="form-control rounded-0"><?= $customer['address'] ?></textarea>
                                        </div>

                                        <div align="center">
                                            <button class="btn" type="submit" name="update">CẬP NHẬT</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end account information  -->

            <?php
            if ($customer['password'] !== null) :
            ?>

                <!-- change password  -->
                <div id="change-password" class=" tab-pane fade"><br>
                    <div class="account-bg">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="account">
                                        <h1 class="text-center">ĐỔI MẬT KHẨU</h1>

                                        <form action="?act=update-password" method="POST">

                                            <div class="form-group">
                                                <label for="old_password">Mật khẩu cũ:</label>
                                                <input type="password" name="old_password" id="old_password" class="form-control rounded-0" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password">Mật khẩu mới:</label>
                                                <input type="password" name="new_password" id="new_password" class="form-control rounded-0" required>
                                                <p class="text-danger" id="new_password-error"></p>
                                            </div>
                                            <div class="form-group">
                                                <label for="re_new_password">Nhập lại mật khẩu mới:</label>
                                                <input type="password" name="re_new_password" id="re_new_password" class="form-control rounded-0" required>
                                                <p class="text-danger" id="re_new_password-error"></p>

                                            </div>


                                            <div align="center">
                                                <button class="btn" type="submit" name="change_password" id="btn_update_password">CẬP NHẬT</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>

                        </div>
                    </div>



                </div>
                <!-- end change password  -->
            <?php
            endif;
            ?>
            <?php
            include('footer.php')
            ?>

            <script>
                // password validate
                $('#new_password').keyup(function() {
                    var new_password = $("#new_password").val();
                    var re_new_password = $("#re_new_password").val();
                    if (re_new_password.length) {
                        if (new_password == re_new_password) {
                            $("#new_password").css('border-color', '');
                            $("#new_password-error").text('');
                            $("#re_new_password").css('border-color', '');
                            $("#re_new_password-error").text('');
                            $('#btn_update_password').attr('disabled', false);
                        } else {
                            $("#new_password").css('border-color', 'red');
                            $("#new_password-error").text('Mật khẩu mới không giống nhau!');
                            $("#re_new_password").css('border-color', 'red');
                            $("#re_new_password-error").text('Mật khẩu mới không giống nhau!');
                            $('#btn_update_password').attr('disabled', true);
                        }
                    }

                })
                $('#re_new_password').keyup(function() {
                    var new_password = $("#new_password").val();
                    var re_new_password = $("#re_new_password").val();
                    if (new_password.length) {
                        if (new_password == re_new_password) {
                            $("#new_password").css('border-color', '');
                            $("#new_password-error").text('');
                            $("#re_new_password").css('border-color', '');
                            $("#re_new_password-error").text('');
                            $('#btn_update_password').attr('disabled', false);
                        } else {
                            $("#new_password").css('border-color', 'red');
                            $("#new_password-error").text('Mật khẩu mới không giống nhau!');
                            $("#re_new_password").css('border-color', 'red');
                            $("#re_new_password-error").text('Mật khẩu mới không giống nhau!');
                            $('#btn_update_password').attr('disabled', true);
                        }
                    }
                })
            </script>

            <script>
                $('.bill-detail').click(function() {
                    var bill_ID = $(this).data('bill_id');
                    console.log(bill_ID);

                    $.ajax({
                        url: '?act=bill-detail',
                        type: 'POST',
                        cache: false,
                        data: {
                            bill_ID: bill_ID,
                        },

                        success: function(data) {
                            // console.log(data.promotion_noti);
                            data = JSON.parse(data);
                            console.log(data);


                            $('#bill-bill_ID').text(data.bill_ID);
                            $('#bill-phone_number').text(data.phone_number);
                            $('#bill-address').text(data.address);
                            $('#bill-payments').text(data.payments);
                            $('#bill-status').text(data.status);
                            $('#bill-promotion_name').text(data.promotion_name);
                            $('#bill-created_at').text(data.created_at);

                            var tbody = '';
                            var product = data.detail;
                            console.log(product[0]);
                            for (var i = 0; i < data.detail.length; i++) {
                                tbody += `
                                <tr>
                                    <td>${i+1}</td>
                                    <td>${product[i].name}</td>
                                    <td>${product[i].quantity}</td>
                                    <td>${product[i].price}</td>
                                    <td>${product[i].unit_price}</td>
                                </tr>
                                `


                            }
                            $('#bill-tbody').html(tbody);
                            $('#bill-total_price').text(data.total_price);
                            $('#bill-discount_price').text(data.discount_price);
                            $('#bill-price_to_pay').text(data.price_to_pay);



                            $('#bill-detail').modal('show');
                        },
                        error: function(jqXHR, textStatus, err) {
                            alert('text status ' + textStatus + ', err ' + err)
                        }
                    })


                })
            </script>

            <script>
                $("#table").DataTable();
                // $(function() {
                //     $("#table").DataTable()

                // });
            </script>
</body>

</html>