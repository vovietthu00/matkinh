<?php
include('head.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php
    include('header.php');
    ?>

    <!-- list  -->
    <?php
    if ($action == 'bill-list') :
    ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ HÓA ĐƠN</h1>
                        </div>
                        <div class="col-sm-6 action">
                            <div class="float-sm-right">
                                <!-- <a href="?act=bill-create-form" class="btn btn-outline-info btn-flat">
                                    <i class="fas fa-plus"></i>
                                </a> -->

                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Danh sách hóa đơn</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Khách hàng</th>
                                                <th>Thanh toán (VNĐ)</th>
                                                <th>Hình thức</th>
                                                <th>Trạng thái</th>
                                                <th>TG đặt</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($results as $r) :
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?= $r['bill_ID'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['username'] ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($r['price_to_pay']) ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo ($r['payments'] == 'online') ? 'Thanh toán online' : 'Thanh toán khi nhận hàng';
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $status = $r['status'];
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
                                                        $payment_status = $r['payment_status'];
                                                        if ($payment_status == 'paid') {
                                                            echo 'Đã thanh toán';
                                                        } else {
                                                            echo 'Chưa thanh toán';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['created_at'] ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="btn-group">
                                                            <a href="?act=bill-edit-form&bill_ID=<?= $r['bill_ID'] ?>" class="btn btn-outline-dark btn-flat">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <!-- <a href="?act=bill-delete&bill_ID=<?= $r['bill_ID'] ?>" class="btn btn-outline-danger btn-flat">
                                                                <i class="fas fa-trash"></i>
                                                            </a> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach;
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


    <?php
    endif;
    ?>
    <!-- end list  -->


    <!-- edit form  -->
    <?php
    if ($action == 'bill-edit-form') :
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ HÓA ĐƠN</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="?bill">Danh sách hóa đơn</a></li>
                                <li class="breadcrumb-item active">Sửa hóa đơn</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Chi tiết hóa đơn</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                Username: <span class="text-capitalize"><?= $b['username'] ?></span>
                                                <br>
                                                Tên: <span class="text-capitalize"><?= $b['last_name'] ?> <?= $b['first_name'] ?></span>
                                                <br>
                                                Email: <?= $b['email'] ?>
                                                <br>
                                                Số điện thoại: <?= $b['phone_number'] ?>
                                                <br>
                                                Địa chỉ: <span class="text-capitalize"><?= $b['address'] ?></span>
                                            </address>
                                        </div>
                                        <div class="col-md-6">
                                            <address>
                                                Mã hóa đơn: <?= $b['bill_ID'] ?>
                                                <br>
                                                Hình thức: <?php
                                                            echo ($b['payments'] == 'online') ? 'Thanh toán online' : 'Thanh toán khi nhận hàng';
                                                            ?>
                                                <br>
                                                Trạng thái:
                                                <?php
                                                $status = $b['status'];
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
                                                ,
                                                <?php
                                                $payment_status = $b['payment_status'];
                                                if ($payment_status == 'paid') {
                                                    echo 'Đã thanh toán';
                                                } else {
                                                    echo 'Chưa thanh toán';
                                                }
                                                ?>
                                                <br>
                                                Mã khuyến mãi: <?= $promotion['name'] ?>
                                                <br>
                                                Đặt lúc: <?= $b['created_at'] ?>

                                            </address>
                                        </div>
                                    </div>

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá (VNĐ)</th>
                                                <th>Thành tiền (VNĐ)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stt = 0;
                                            foreach ($bill_product as $b_p) :
                                                $stt++;
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?= $stt ?>
                                                    </td>
                                                    <td>
                                                        <?= $b_p['name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $b_p['quantity'] ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($b_p['price']) ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($b_p['price'] * $b_p['quantity']) ?>
                                                    </td>

                                                </tr>
                                            <?php
                                            endforeach;
                                            ?>



                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4"><b>Tổng</b></td>
                                                <td>
                                                    <b><?= number_format($b['total_price']) ?></b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><b>Giảm</b></td>
                                                <td>
                                                    <b><?= number_format($b['discount_price']) ?></b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><b>Thanh toán</b></td>
                                                <td>
                                                    <b><?= number_format($b['price_to_pay']) ?></b>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>


                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <!-- general form elements -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Cập nhật đơn hàng</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <form action="?act=bill-edit" method="post">
                                        <input type="hidden" name="bill_ID" value="<?= $b['bill_ID'] ?>">

                                        <div class="form-group">
                                            <label for="status">Trạng thái đơn hàng</label>
                                            <select name="status" id="status" class="form-control rounded-0" required>
                                                <option value="" selected disabled>Chọn..</option>
                                                <option value="pending" <?php
                                                                        echo ($b['status'] == 'pending') ? 'selected' : '';
                                                                        ?>>Đang xử lý</option>
                                                <option value="in_transit" <?php
                                                                            echo ($b['status'] == 'in_transit') ? 'selected' : '';
                                                                            ?>>Đang giao</option>
                                                <option value="delivered" <?php
                                                                            echo ($b['status'] == 'delivered') ? 'selected' : '';
                                                                            ?>>Đã giao</option>
                                                <option value="cancelled" <?php
                                                                            echo ($b['status'] == 'cancelled') ? 'selected' : '';
                                                                            ?>>Đã hủy</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_status">Trạng thái thanh toán</label>
                                            <select name="payment_status" id="payment_status" class="form-control rounded-0" required>
                                                <option value="" selected disabled>Chọn..</option>
                                                <option value="paid" <?php
                                                                        echo ($b['payment_status'] == 'paid') ? 'selected' : '';
                                                                        ?>>Đã thanh toán</option>
                                                <option value="unpaid" <?php
                                                                        echo ($b['payment_status'] == 'unpaid') ? 'selected' : '';
                                                                        ?>>Chưa thanh toán</option>

                                            </select>
                                        </div>

                                        <br><br>

                                        <button type="submit" class="btn btn-block btn-dark rounded-0">LƯU</button>

                                    </form>


                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                </div>
            </section>
        </div>

    <?php
    endif;
    ?>
    <!-- end edit form  -->

    <?php

    include 'footer.php';

    ?>

    <script>
        $(function() {
            $("#table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');

        });
    </script>

</body>

</html>