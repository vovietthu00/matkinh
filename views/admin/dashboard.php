<?php
include('head.php');

?>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php
    include('header.php');
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">THỐNG KÊ</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <!-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v3</li>
                        </ol> -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- total revenue -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    <?= number_format($revenue) ?> đ
                                </h3>

                                <p>Tổng doanh thu</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-donate"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- bill num -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $bill_num ?></h3>

                                <p>Đơn hàng</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-list-alt"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- customer num -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $customer_num ?></h3>

                                <p>Khách hàng</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- product num -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= $product_num ?></h3>

                                <p>Sản phẩm</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-coffee"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <!-- chart revenue  -->
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Doanh thu</h5>
                            <div class="card-tools">
                                <input type="text" name="" id="revenue-date-picker" class="date-picker">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body" id="revenue">


                    </div>
                </div>
                <!-- end chart revenue  -->

                <!-- chart top customer  -->
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Khách hàng mua nhiều nhất</h5>
                            <!-- <p class="card-category">Từ ngày <?= date('01-m-Y') ?> đến <?= date('d-m-Y') ?></p> -->
                            <div class="card-tools">
                                <input type="text" name="" id="topCustomer-date-picker" value="Tất cả" class="date-picker">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="topCustomer">


                    </div>
                </div>
                <!-- end chart top customer  -->

                <!-- chart feature product  -->
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Bán chạy</h5>
                            <!-- <p class="card-category">Từ ngày <?= date('01-m-Y') ?> đến <?= date('d-m-Y') ?></p> -->
                            <div class="card-tools">
                                <input type="text" name="" id="featureProduct-date-picker" value="Tất cả" class="date-picker">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="featureProduct">
                        <!-- <canvas id="chart-featureProduct" width="" height="100px"></canvas> -->

                    </div>
                </div>
                <!-- end chart feature product  -->


                <!-- bill product list  -->
                <?php
                if ($bill_product) :
                ?>
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Thống kê sản phẩm</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body ">
                            <table id="table" class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Sản phẩm</th>
                                        <th>Loại</th>
                                        <th>Giá (VNĐ)</th>
                                        <th>Số lượng bán</th>
                                        <th>Số đơn hàng</th>
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
                                                <img src="../uploads/products/<?= $b_p['image'] ?>" alt="<?= $b_p['product_name'] ?>" class="img-circle img-size-32 mr-2">
                                                <?= $b_p['product_name'] ?>
                                            </td>
                                            <td>
                                                <?= $b_p['category_name'] ?>
                                            </td>
                                            <td>
                                                <?= number_format($b_p['price']) ?>
                                            </td>
                                            <td>
                                                <?= $b_p['quantity'] ?>
                                            </td>
                                            <td>
                                                <?= $b_p['bill_num'] ?>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end bill product list  -->

                <?php
                endif;
                ?>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php
    include('footer.php');
    ?>

    <script>
        // $(document).ready(function() {
        //     showChartRevenue();
        //     showChartFeatureProduct();
        //     showChartTopCustomer();
        // });

        // chart revenue 
        function showChartRevenue() {
            {
                $('#revenue').html('<canvas id="chart-revenue" width="" height="100px"></canvas>');
                $.post("?act=chart-revenue",
                    function(data) {
                        console.log(data);
                        var revenue = [];
                        var order_date = [];
                        var bill_ID = [];
                        // var order_date;
                        for (var i in data) {

                            revenue.push(data[i].revenue);
                            order_date.push('Ngày ' + data[i].order_date);
                            // bill_ID.push(data[i].bill_ID);

                        }

                        var chartdata = {
                            labels: order_date,
                            datasets: [{
                                label: 'Doanh thu (VNĐ)',
                                backgroundColor: '#17a2b8bd',
                                borderColor: '#17a2b8e1',
                                hoverBackgroundColor: '#17a2b8e1',
                                data: revenue,
                                fill: false,
                            }]
                        };

                        var graphTarget = $("#chart-revenue");

                        var lineGraph = new Chart(graphTarget, {
                            type: 'line',
                            data: chartdata,

                            options: {
                                responsive: true,
                                scales: {
                                    xAxes: [{
                                        gridLines: {
                                            display: true,
                                            drawBorder: true,
                                            drawOnChartArea: false,
                                        }
                                    }],
                                    yAxes: [{
                                        gridLines: {
                                            display: true,
                                            drawBorder: true,
                                            drawOnChartArea: false,
                                        },

                                    }]
                                }
                            }

                        });
                    });
            }
        }
        // end chart revenue 

        // chart top customer 
        function showChartTopCustomer() {
            {
                $('#topCustomer').html('<canvas id="chart-topCustomer" width="" height="100px"></canvas>');
                $.post("?act=chart-topCustomer",
                    function(data) {
                        console.log(data);
                        var username = [];
                        var price_to_pay = [];
                        // var order_date;
                        for (var i in data) {
                            username.push(data[i].username);
                            price_to_pay.push(data[i].price_to_pay);

                        }

                        var chartdata = {
                            labels: username,
                            datasets: [{
                                label: 'Tổng tiền (VNĐ)',
                                backgroundColor: '#ffc107bd',
                                borderColor: '#ffc107e1',
                                hoverBackgroundColor: '#ffc107e1',

                                barPercentage: 0.2,
                                data: price_to_pay,

                            }]


                        };

                        var graphTarget = $("#chart-topCustomer");

                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: chartdata,


                        });
                    });
            }
        }
        // end chart top customer 

        // chart feature product 
        function showChartFeatureProduct() {
            {
                $('#featureProduct').html('<canvas id="chart-featureProduct" width="" height="100px"></canvas>');

                $.post("?act=chart-featureProduct",
                    function(data) {
                        console.log(data);
                        var name = [];
                        var quantity = [];
                        // var order_date;
                        for (var i in data) {
                            name.push(data[i].name);
                            quantity.push(data[i].quantity);

                        }

                        var chartdata = {
                            labels: name,
                            datasets: [{
                                label: 'Số lượng',
                                backgroundColor: '#dc3545bd',
                                borderColor: '#dc3545e1',
                                hoverBackgroundColor: '#dc3545e1',

                                barPercentage: 0.2,
                                data: quantity,

                            }]


                        };

                        var graphTarget = $("#chart-featureProduct");

                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: chartdata,


                        });
                    });
            }
        }
        // end chart feature product 



        $(function() {

            // chart revenue date picker 
            $('input[id="revenue-date-picker"]').daterangepicker({
                opens: 'right',
                startDate: '<?= date('01/m/Y') ?>',
                endDate: '<?= date('d/m/Y') ?>',
                locale: {
                    cancelLabel: 'Xóa'
                }
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                var start_date = start.format('YYYY-MM-DD');
                var end_date = end.format('YYYY-MM-DD');

                $.ajax({
                    url: '?act=chart-revenueByDatePicker',
                    type: 'POST',
                    cache: false,
                    data: {
                        start_date: start_date,
                        end_date: end_date,
                    },

                    success: function(data) {
                        console.log(data);
                        var revenue_DatePicker = [];
                        var order_date_DatePicker = [];
                        // var order_date;
                        data = JSON.parse(data);
                        console.log(data);

                        if (data.length > 0) {
                            $('#revenue').html('<canvas id="chart-revenue" width="" height="100px"></canvas>');

                            for (var i in data) {

                                revenue_DatePicker.push(data[i].revenue);
                                order_date_DatePicker.push('Ngày ' + data[i].order_date);
                                // bill_ID.push(data[i].bill_ID);

                            }

                            var chartdataDatePicker = {
                                labels: order_date_DatePicker,
                                datasets: [{
                                    label: 'Doanh thu (VNĐ)',
                                    backgroundColor: '#17a2b8bd',
                                    borderColor: '#17a2b8e1',
                                    hoverBackgroundColor: '#17a2b8e1',
                                    data: revenue_DatePicker,
                                    fill: false,
                                }]
                            };

                            var graphTarget = $("#chart-revenue");

                            var lineGraph = new Chart(graphTarget, {
                                type: 'line',
                                data: chartdataDatePicker
                            });
                        } else {
                            $("#revenue").html('<div class="text-center">Không có dữ liệu</div>');

                        }





                    },
                    error: function(jqXHR, textStatus, err) {
                        alert('text status ' + textStatus + ', err ' + err)
                    }
                })


            });

            $('input[id="revenue-date-picker"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('<?= date('01/m/Y') ?> - <?= date('d/m/Y') ?>');
                showChartRevenue();

            });
            // chart end revenue date picker 

            // top customer date picker 
            $('input[id="topCustomer-date-picker"]').daterangepicker({
                opens: 'right',
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Xóa'
                }
            }, function(start, end, label) {
                var start_date = start.format('YYYY-MM-DD');
                var end_date = end.format('YYYY-MM-DD');

                console.log(start_date);
                console.log(end_date);
                $.ajax({
                    url: '?act=chart-topCustomerByDatePicker',
                    type: 'POST',
                    cache: false,
                    data: {
                        start_date: start_date,
                        end_date: end_date,
                    },

                    success: function(data) {

                        var username_DatePicker = [];
                        var price_to_pay_DatePicker = [];
                        // var order_date;
                        data = JSON.parse(data);
                        console.log(data);
                        if (data.length > 0) {
                            $('#topCustomer').html('<canvas id="chart-topCustomer" width="" height="100px"></canvas>');

                            for (var i in data) {
                                username_DatePicker.push(data[i].username);
                                price_to_pay_DatePicker.push(data[i].price_to_pay);

                            }

                            var chartdataDatePicker = {
                                labels: username_DatePicker,
                                datasets: [{
                                    label: 'Tổng tiền (VNĐ)',
                                    backgroundColor: '#ffc107bd',
                                    borderColor: '#ffc107e1',
                                    hoverBackgroundColor: '#ffc107e1',

                                    barPercentage: 0.2,
                                    data: price_to_pay_DatePicker,

                                }]


                            };

                            var graphTarget = $("#chart-topCustomer");

                            var barGraph = new Chart(graphTarget, {
                                type: 'bar',
                                data: chartdataDatePicker,

                            });
                        } else {
                            $("#topCustomer").html('<div class="text-center">Không có dữ liệu</div>');

                        }





                    },
                    error: function(jqXHR, textStatus, err) {
                        alert('text status ' + textStatus + ', err ' + err)
                    }
                })


            });

            $('input[id="topCustomer-date-picker"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            $('input[id="topCustomer-date-picker"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('Tất cả');
                showChartTopCustomer();

            });
            // top customer date picker 


            // feature product date picker 
            $('input[id="featureProduct-date-picker"]').daterangepicker({
                opens: 'right',
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Xóa'
                }
            }, function(start, end, label) {
                var start_date = start.format('YYYY-MM-DD');
                var end_date = end.format('YYYY-MM-DD');


                $.ajax({
                    url: '?act=chart-featureProductByDatePicker',
                    type: 'POST',
                    cache: false,
                    data: {
                        start_date: start_date,
                        end_date: end_date,
                    },

                    success: function(data) {

                        var name_DatePicker = [];
                        var quantity_DatePicker = [];
                        data = JSON.parse(data);
                        console.log(data);

                        if (data.length > 0) {
                            $('#featureProduct').html('<canvas id="chart-featureProduct" width="" height="100px"></canvas>');

                            for (var i in data) {
                                name_DatePicker.push(data[i].name);
                                quantity_DatePicker.push(data[i].quantity);

                            }

                            var chartdataDatePicker = {
                                labels: name_DatePicker,
                                datasets: [{
                                    label: 'Số lượng',
                                    backgroundColor: '#dc3545bd',
                                    borderColor: '#dc3545e1',
                                    hoverBackgroundColor: '#dc3545e1',
                                    barPercentage: 0.2,
                                    data: quantity_DatePicker,

                                }]


                            };

                            var graphTarget = $("#chart-featureProduct");

                            var barGraph = new Chart(graphTarget, {
                                type: 'bar',
                                data: chartdataDatePicker,

                            });
                        } else {
                            $("#featureProduct").html('<div class="text-center">Không có dữ liệu</div>');
                        }

                    },
                    error: function(jqXHR, textStatus, err) {
                        alert('text status ' + textStatus + ', err ' + err)
                    }
                })


            });

            $('input[id="featureProduct-date-picker"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            $('input[id="featureProduct-date-picker"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('Tất cả');
                showChartFeatureProduct();

            });
            // end feature product date picker 

        });


        $(function() {
            $("#table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');



            showChartRevenue();
            showChartFeatureProduct();
            showChartTopCustomer();

        });
    </script>
</body>

</html>