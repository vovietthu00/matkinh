<?php
session_start();


$URI = "$_SERVER[REQUEST_URI]";

if (preg_match("/product/", $URI)) {
    if (isset($_SESSION['admin'])) {
        require 'ProductController.php';
    } else {
        header('location: index.php');
    }
} elseif (preg_match("/category/", $URI)) {
    if (isset($_SESSION['admin'])) {
        require 'CategoryController.php';
    } else {
        header('location: index.php');
    }
} elseif (preg_match("/promotion/", $URI)) {
    if (isset($_SESSION['admin'])) {
        require 'PromotionController.php';
    } else {
        header('location: index.php');
    }
} elseif (preg_match("/bill/", $URI)) {
    if (isset($_SESSION['admin'])) {
        require 'BillController.php';
    } else {
        header('location: index.php');
    }
} elseif (preg_match("/customer/", $URI)) {
    if (isset($_SESSION['admin'])) {
        require 'CustomerController.php';
    } else {
        header('location: index.php');
    }
} else {
    require '../model/admin.php';


    if (isset($_GET['act']))
        $action = $_GET['act'];
    else if (isset($_POST['act']))
        $action = $_POST['act'];
    else
        $action = 'login-form';

    switch ($action) {
        case 'login-form':
            if (isset($_SESSION['admin'])) {
                header('location: index.php?act=dashboard');
            } else {
                include '../views/admin/login.php';
            }
            break;
        case 'login':
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $admin = new Admin();
            $results = $admin->login(
                $username,
                $password
            );

            if ($results) {
                $_SESSION['success'] = 'Đăng nhập thành công!';
                $_SESSION['admin'] = $username;
                unset($_SESSION['error']);
                header('location: index.php?act=dashboard');
            } else {
                $_SESSION['error'] = 'Thông tin đăng nhập không chính xác!';
                unset($_SESSION['success']);
                header('location: index.php');
            }
            // var_dump($results);
            break;

        case 'logout':
            unset($_SESSION['admin']);
            header('location: index.php');
        
        case 'dashboard':
            if (isset($_SESSION['admin'])) {
                $admin = new Admin();
                $product_num = $admin->countProduct()['num'];
                $customer_num = $admin->countCustomer()['num'];
                $bill_num = $admin->countBill()['num'];
                $revenue = $admin->sumBill()['revenue'];
                $bill_product = $admin->getListBillProduct();
                // var_dump($product_num);
                include '../views/admin/dashboard.php';
            } else {
                header('location: index.php');
            }
            break;

        case 'chart-revenue':
            $admin = new Admin();

            header('Content-Type: application/json');
            $data = array();
            // $date = date('Y-m-d');
            $month = date('m');
            $year = date('Y');
            $results = $admin->getListRevenue($month, $year);

            foreach ($results as $r) {
                $date = new DateTime($r['order_date']);
                $order_date = date_format($date, 'd');

                $data_results = array(
                    'revenue' => $r['revenue'],
                    // 'order_date' => $r['order_date'],
                    'order_date' => $order_date,

                );
                $data[] = $data_results;
            }

            echo json_encode($data);
            break;

        case 'chart-revenueByDatePicker':
            $admin = new Admin();
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $data = array();
            $results = $admin->getListRevenueByDatePicker($start_date, $end_date);
            if ($results) {
                foreach ($results as $r) {
                    $date = new DateTime($r['order_date']);
                    $order_date = date_format($date, 'd');

                    $data_results = array(
                        'revenue' => $r['revenue'],
                        'order_date' => $order_date,

                    );
                    $data[] = $data_results;
                }
            }

            echo json_encode($data);


            break;

        case 'chart-topCustomer':
            $admin = new Admin();

            header('Content-Type: application/json');
            $data = array();
            $results = $admin->getListTopCustomer();

            foreach ($results as $r) {
                $data_results = array(
                    'username' => $r['username'],
                    'price_to_pay' => $r['price_to_pay'],

                );
                $data[] = $data_results;
            }
            echo json_encode($data);

            break;

        case 'chart-topCustomerByDatePicker':
            $admin = new Admin();
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $results = $admin->getListTopCustomerByDatePicker($start_date, $end_date);
            $data = array();
            if ($results) {
                foreach ($results as $r) {
                    $data_results = array(
                        'username' => $r['username'],
                        'price_to_pay' => $r['price_to_pay'],

                    );
                    $data[] = $data_results;
                }
            }

            echo json_encode($data);


            break;

        case 'chart-featureProduct':
            $admin = new Admin();

            header('Content-Type: application/json');
            $data = array();
            $results = $admin->getListFeatureProduct();

            foreach ($results as $r) {
                $data_results = array(
                    'name' => $r['name'],
                    'quantity' => $r['quantity'],

                );
                $data[] = $data_results;
            }
            echo json_encode($data);

            break;

        case 'chart-featureProductByDatePicker':
            $admin = new Admin();
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $results = $admin->getListFeatureProductByDatePicker($start_date, $end_date);
            $data = array();
            if ($results) {
                foreach ($results as $r) {
                    $data_results = array(
                        'name' => $r['name'],
                        'quantity' => $r['quantity'],

                    );
                    $data[] = $data_results;
                }
            }

            echo json_encode($data);


            break;
    }
}
