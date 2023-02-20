<?php
session_start();

require 'model/user.php';

if (isset($_GET['act']))
    $action = $_GET['act'];
else if (isset($_POST['act']))
    $action = $_POST['act'];
else
    $action = 'home';


switch ($action) {
    case 'home':
        $user = new User();
        $promotion = $user->getPromotionList();
        $product = $user->getProductNew();
        include 'views/user/home.php';
        break;
    case 'about':
        include 'views/user/about.php';
        break;
    case 'brand-story':
        include 'views/user/brand-story.php';
        break;
    case 'matkinh-story':
        include 'views/user/matkinh-story.php';
        break;
    case 'product':
        // setcookie('cart', '', time() -  3600 * 24 * 30 * 12);

        $user = new User();
        $categories = $user->getCategoryList();
        // $products = $user->getProductList();
        $product_num = $user->countProduct();
        // echo($product_num);

        if (isset($_GET['category_ID'])) {
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $category_ID = $_GET['category_ID'];
            $cate = $user->getCategoryById($category_ID);
            $products = $user->getProductByCategory($category_ID, $page);
        } else {
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $products = $user->getProductList($page);
        }

        // var_dump($_COOKIE['cart']);
        include 'views/user/product.php';
        // var_dump($cate);


        break;
    case 'product-detail':
        if (isset($_GET['product_ID'])) {
            $user = new User();
            $product_ID = $_GET['product_ID'];
            $product = $user->getProductById($product_ID);
            $category_ID = $product['category_ID'];
            $product_relate = $user->getProductRelate($category_ID);
            include 'views/user/product.php';
        } else {
            header('location: index.php?act=product');
        }

        break;
    case 'term':
        include 'views/user/term.php';
        break;
    case 'privacy':
        include 'views/user/privacy.php';
        break;

    case 'register':
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        $status = $_POST['status'];

        $user = new User();
        $results = $user->register(
            $username,
            $password,
            $email,
            $status
        );
        if ($results) {
            $_SESSION['success'] = 'Đăng ký tài khoản thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Đăng ký tài khoản thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php');
        break;

    case 'login':
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $user = new User();
        $results = $user->login(
            $username,
            $password
        );
        if ($results) {
            if ($results['status'] == 0) {
                $_SESSION['error'] = 'Tài khoản đã bị vô hiệu hóa!';
                unset($_SESSION['success']);
            } else {
                $_SESSION['success'] = 'Đăng nhập thành công!';
                $_SESSION['customer'] = $username;
                $_SESSION['customer_ID'] = $results['customer_ID'];
                unset($_SESSION['error']);
            }
        } else {
            $_SESSION['error'] = 'Thông tin đăng nhập không chính xác!';
            unset($_SESSION['success']);
        }
        header('location: index.php');

        break;

    case 'login-with-google':

        $username = $_POST['email'];
        $email = $_POST['email'];

        $user = new User();
        $results = $user->loginWithGoogle(
            $username,
            $email
        );
        if ($results == 1) {
            $_SESSION['success'] = 'Đăng ký tài khoản thành công!';
            unset($_SESSION['error']);
            $data = 'success';
        } elseif ($results == 0) {
            $_SESSION['error'] = 'Đăng ký tài khoản thất bại!';
            unset($_SESSION['success']);
        } else {
            if ($results['status'] == 0) {
                $_SESSION['error'] = 'Tài khoản đã bị vô hiệu hóa!';
                unset($_SESSION['success']);
            } else {
                $_SESSION['success'] = 'Đăng nhập thành công!';
                $_SESSION['customer'] = $username;
                $_SESSION['customer_ID'] = $results['customer_ID'];
                unset($_SESSION['error']);
                $data = 'success';
            }
        }

        echo 'ok';
        break;

    case 'account':
        if (isset($_SESSION['customer_ID'])) {
            $customer_ID = $_SESSION['customer_ID'];
            $user = new User();
            $customer = $user->getCustomerById($customer_ID);
            $bills = $user->getListBillByCustomerId($customer_ID);

            if ($customer && $bills) {

                include 'views/user/account.php';
            } else {
                $_SESSION['error'] = 'Tài khoản không tồn tại!';
                unset($_SESSION['success']);
                header('location: index.php');
            }
        } else {
            $_SESSION['login'] = 'login';
            unset($_SESSION['success']);
            header('location: index.php');
        }
        break;

    case 'bill-detail':
        $user = new User();
        $bill_ID = $_POST['bill_ID'];
        $bill = $user->getBillById($bill_ID);
        $bill_product = $user->getListBillProductByBillId($bill_ID);
        $data = array();
        if ($bill && $bill_product) {
            $stt = 0;
            if ($bill['promotion_ID'] != 0) {
                $promotion = $user->getPromotionById($bill['promotion_ID']);
                $promotion_name = $promotion['name'];
            } else {
                $promotion_name = '';
            }
            if ($bill['payments'] == 'online') {
                $payments = 'Thanh toán online';
            } else {
                $payments = 'Thanh toán khi nhận hàng';
            }

            if ($bill['status'] == 'pending') {
                $status = 'Đang xử lý';
            } elseif ($bill['status'] == 'in_transit') {
                $status = 'Đang giao';
            } elseif ($bill['status'] == 'delivered') {
                $status = 'Đã giao';
            } elseif ($bill['status'] == 'cancelled') {
                $status = 'Đã hủy';
            }


            if ($bill['payment_status'] == 'paid') {
                $payment_status = 'Đã thanh toán';
            } else {
                $payment_status = 'Chưa thanh toán';
            }

            foreach ($bill_product as $b_p) {
                $stt++;
                $bill_product_array = [
                    'stt' => $stt,
                    'name' => $b_p['name'],
                    'quantity' => $b_p['quantity'],
                    'price' => number_format($b_p['price']),
                    'unit_price' => number_format($b_p['price'] * $b_p['quantity'])
                ];

                $bill_product_data[] = $bill_product_array;
            }
            $data = [
                'bill_ID' => $bill_ID,
                'total_price' => number_format($bill['total_price']),
                'discount_price' => number_format($bill['discount_price']),
                'price_to_pay' => number_format($bill['price_to_pay']),
                'phone_number' => $bill['phone_number'],
                'address' => $bill['address'],
                'payments' => $payments,
                'promotion_name' => $promotion_name,
                'status' => $status . ', ' . $payment_status,
                'created_at' => $bill['created_at'],
                'detail' => $bill_product_data
            ];
        }

        echo json_encode($data);
        // echo json_encode($bill_product_array);

        break;

    case 'logout':
        unset($_SESSION['customer']);
        unset($_SESSION['customer_ID']);
        $_SESSION['success'] = 'Đăng xuất thành công!';
        unset($_SESSION['error']);
        header('location: index.php');
        break;

    case 'update-info':
        if (isset($_SESSION['customer_ID'])) {
            $customer_ID = $_SESSION['customer_ID'];
            $username = $_POST['username'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $address = $_POST['address'];
            $user = new User();
            $results = $user->updateInfo(
                $customer_ID,
                $username,
                $first_name,
                $last_name,
                $email,
                $phone_number,
                $address
            );
            if ($results) {
                $_SESSION['success'] = 'Cập nhật thành công!';
                unset($_SESSION['error']);
            } else {
                $_SESSION['error'] = 'Cập nhật thất bại!';
                unset($_SESSION['success']);
            }
            header('location: index.php?act=account');
        } else {
            $_SESSION['error'] = 'Vui lòng đăng nhập tài khoản!';
            unset($_SESSION['success']);
            header('location: index.php');
        }
        break;

    case 'update-password':
        if (isset($_SESSION['customer_ID'])) {
            $customer_ID = $_SESSION['customer_ID'];
            $old_password = md5($_POST['old_password']);
            $new_password = md5($_POST['new_password']);

            $user = new User();
            $select_result = $user->getCustomerById($customer_ID);
            if ($old_password == $select_result['password']) {
                $results = $user->updatePassword(
                    $customer_ID,
                    $new_password
                );
                if ($results) {
                    $_SESSION['success'] = 'Cập nhật thành công!';
                    unset($_SESSION['error']);
                } else {
                    $_SESSION['error'] = 'Cập nhật thất bại!';
                    unset($_SESSION['success']);
                }
            } else {
                $_SESSION['error'] = 'Mật khẩu cũ không chính xác!';
                unset($_SESSION['success']);
            }

            header('location: index.php?act=account');
        } else {
            $_SESSION['error'] = 'Vui lòng đăng nhập tài khoản!';
            unset($_SESSION['success']);
            header('location: index.php');
        }
        break;

    case 'cart':
        if (isset($_SESSION['customer_ID'])) {
            $customer_ID = $_SESSION['customer_ID'];

            // if (isset($_COOKIE['cart']) || (isset($_COOKIE['cart_cus']) && isset($_SESSION['customer']))) {
            //  $cookie_data = stripslashes($_COOKIE['cart']);
            if (isset($_COOKIE['cart'])) {
                $cookie_data = $_COOKIE['cart'];
                $cart_data = json_decode($cookie_data, true);
            }
            // var_dump($_COOKIE['cart']);
            $cart_count = 0;
            $total_price = 0;
            $discount_price = 0;
            $stt = 1;
            // var_dump(count($cart_data));
            include 'views/user/cart.php';
        } else {
            $_SESSION['login'] = 'login';
            unset($_SESSION['success']);
            header('location: index.php');
        }

        break;

    case 'add-to-cart':
        if (isset($_SESSION['customer_ID'])) {
            $customer_ID = $_SESSION['customer_ID'];
            if (isset($_POST['product_ID'])) {
                $user = new User();
                $product_ID = $_POST['product_ID'];
                $p = $user->getProductById($product_ID);
                if ($p) {
                    $name = $p['name'];
                    $image = $p['image'];
                    $price = $p['price'];
                    if (isset($_COOKIE['cart'])) {
                        $cookie_data = $_COOKIE['cart'];
                        $cart_data = json_decode($cookie_data, true);
                    } else {
                        $cart_data = array();
                    }
                    $product_ID_list = array_column($cart_data, 'product_ID');

                    if (in_array($product_ID, $product_ID_list)) {
                        foreach ($cart_data as $key => $value) {
                            if ($cart_data[$key]['product_ID'] == $product_ID) {
                                $cart_data[$key]['quantity'] = $cart_data[$key]['quantity'] + 1;
                            }
                        }
                    } else {
                        $product_array = array(
                            'product_ID' => $product_ID,
                            'name' => $name,
                            'price' => $price,
                            'quantity' => 1,
                            'image' => $image
                        );
                        $cart_data[] = $product_array;
                    }

                    $product_data = json_encode($cart_data);
                    setcookie('cart', $product_data, time() +  3600 * 24 * 30 * 12);


                    // if (isset($_COOKIE['cart'])) {
                    //     $cookie_data = $_COOKIE['cart'];
                    //     $cart_count = 0;

                    //     $cart_data = json_decode($cookie_data, true);
                    //     foreach ($cart_data as $key => $value) {
                    //         $cart_count += $value['quantity'];
                    //     }
                    // }

                    echo 'success';
                } else {
                    echo 'error';
                }
            } else {
                echo 'error';
            }
        } else {
            echo 'login';
        }

        break;

    case 'update-cart':
        if (isset($_SESSION['customer_ID'])) {
            if (isset($_POST['product_ID']) && isset($_POST['quantity'])) {
                $user = new User();
                $product_ID = $_POST['product_ID'];
                $quantity = $_POST['quantity'];
                if ($quantity > 0) {

                    $p = $user->getProductById($product_ID);
                    if ($p) {
                        $name = $p['name'];
                        $image = $p['image'];
                        $price = $p['price'];

                        if (isset($_COOKIE['cart'])) {
                            $cookie_data = $_COOKIE['cart'];
                            $cart_data = json_decode($cookie_data, true);
                        } else {
                            $cart_data = array();
                        }

                        $product_ID_list = array_column($cart_data, 'product_ID');

                        if (in_array($product_ID, $product_ID_list)) {
                            foreach ($cart_data as $key => $value) {
                                if ($cart_data[$key]['product_ID'] == $product_ID) {
                                    $cart_data[$key]['quantity'] =  $quantity;
                                }
                            }
                        } else {
                            $product_array = array(
                                'product_ID' => $product_ID,
                                'name' => $name,
                                'price' => $price,
                                'quantity' => $quantity,
                                'image' => $image
                            );
                            $cart_data[] = $product_array;
                        }

                        $product_data = json_encode($cart_data);
                        setcookie('cart', $product_data, time() + 3600 * 24 * 30 * 12);
                    }
                }
            }
        }
        header('location: ?act=cart');


        break;

    case 'delete-cart':
        if (isset($_GET['product_ID'])) {
            if (isset($_COOKIE['cart'])) {
                $cookie_data = $_COOKIE['cart'];
            }
            $cart_data = json_decode($cookie_data, true);
            foreach ($cart_data as $key => $value) {
                if ($cart_data[$key]['product_ID'] == $_GET['product_ID']) {
                    unset($cart_data[$key]);
                    $product_data = json_encode($cart_data);

                    setcookie("cart", $product_data, time() +  3600 * 24 * 30 * 12);
                }
            }
        }
        header('location: ?act=cart');
        break;

    case 'promotion-cart':
        //   echo 'promotion';
        $promotion_name = $_POST['promotion_name'];
        $total_price = $_POST['total_price'];
        $user = new User();
        $promotion = $user->getPromotionByName($promotion_name);
        if ($promotion) {
            $start_date = $promotion['start_date'];
            $end_date = $promotion['end_date'];
            $promotion_type = $promotion['promotion_type'];
            $discount = $promotion['discount'];
            $condition_discount = $promotion['condition_discount'];
            $date = date('Y-m-d');
            if ($date >= $start_date &&  $date <= $end_date) {
                if ($total_price >= $condition_discount) {
                    if ($promotion_type == 'price') {
                        $discount_price = $discount;
                    } else if ($promotion_type == 'percent') {
                        $discount_price = ($discount / 100) * $total_price;
                    } else {
                        $discount_price = 0;
                    }
                    $promotion_noti = 'Đã áp dụng mã khuyến mãi!';
                } else {
                    $promotion_noti = 'Bạn không đủ điều kiện để áp dụng mã khuyến mãi này!';
                    $discount_price = 0;
                }
            } else if ($date < $start_date) {
                $promotion_noti = 'Mã của bạn chưa đến thời gian áp dụng!';
                $discount_price = 0;
            } else if ($date > $end_date) {
                $promotion_noti = 'Mã của bạn đã hết hạn!';
                $discount_price = 0;
            } else {
                $promotion_noti = 'Mã của bạn không tồn tại!';
                $discount_price = 0;
            }
        } else {
            $promotion_noti = 'Mã của bạn không tồn tại!';
            $discount_price = 0;
        }
        $results = [
            'promotion_noti' => $promotion_noti,
            'discount_price' => $discount_price,
        ];
        echo json_encode($results);
        break;


    case 'checkout-cart':
        if (isset($_SESSION['customer_ID'])) {
            $total_price = $_POST['total_price_checkout'];
            $discount_price = $_POST['discount_price_checkout'];
            $price_to_pay = $total_price - $discount_price;
            $promotion_name = $_POST['promotion_name_checkout'];


            $cookie_data = $_COOKIE['cart'];
            $cart_data = json_decode($cookie_data, true);

            $user = new User();
            $customer = $user->getCustomerById($_SESSION['customer_ID']);
            $first_name = $customer['first_name'];
            $last_name = $customer['last_name'];
            $email = $customer['email'];
            $phone_number = $customer['phone_number'];
            $address = $customer['address'];

            include 'views/user/checkout.php';
        } else {
            $_SESSION['login'] = 'login';
            unset($_SESSION['success']);
            header('location: index.php');
        }

        break;

    case 'order':
        if (isset($_SESSION['customer_ID'])) {
            $user = new User();

            $cookie_data = $_COOKIE['cart'];
            $cart_data = json_decode($cookie_data, true);

            $customer_ID = $_SESSION['customer_ID'];
            $total_price = $_POST['total_price'];
            $discount_price = $_POST['discount_price'];
            $promotion_name = $_POST['promotion_name'];
            $price_to_pay = $total_price - $discount_price;
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $address = $_POST['address'];
            $payments = $_POST['payments'];

            if ($promotion_name == '') {
                $promotion_ID = 'null';
                // echo $promotion_ID;
            } else {
                $promotion = $user->getPromotionByName($promotion_name);
                $promotion_ID = $promotion['promotion_ID'];
            }


            if ($payments == 'online') {
                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

                // config.php 
                $vnp_TmnCode = "A3BYDUVO"; //Mã website tại VNPAY
                $vnp_HashSecret = "YJKXKKTASLXECDDRVVSWNGNXNWBFFOSU"; //Chuỗi bí mật
                $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = "http://localhost/php2_asm/index.php?act=payment-online-return&total_price=$total_price&discount_price=$discount_price&promotion_ID=$promotion_ID&first_name=$first_name&last_name=$last_name&email=$email&phone_number=$phone_number&address=$address&price_to_pay=$price_to_pay";


                // end config.php

                $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
                $vnp_OrderInfo = 'Thanh toán đơn hàng Lecheesse Coffee';
                $vnp_OrderType = 'billpayment';
                $vnp_Amount = $price_to_pay * 100;
                $vnp_Locale = 'vn';
                $vnp_BankCode = 'NCB';
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];


                $inputData = array(
                    "vnp_Version" => "2.0.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef,

                );

                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . $key . "=" . $value;
                    } else {
                        $hashdata .= $key . "=" . $value;
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                    $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                    $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
                }

                header("location: $vnp_Url");
            } else {
                $status = 'pending';
                $payment_status = 'unpaid';
                $insert_bill = $user->insertBill(
                    $total_price,
                    $discount_price,
                    $price_to_pay,
                    $payments,
                    $phone_number,
                    $address,
                    $status,
                    $payment_status,
                    $customer_ID,
                    $promotion_ID
                );

                // var_dump($insert_bill);
                if ($insert_bill) {
                    $bill_ID = $user->getLastBillId();

                    foreach ($cart_data as $key => $value) {
                        $product_ID = $value['product_ID'];
                        $quantity = $value['quantity'];
                        $price = $value['price'];
                        $insert_bill_product = $user->insertBillProduct(
                            $bill_ID,
                            $product_ID,
                            $quantity,
                            $price
                        );

                        // header('location: ?act=account');
                    }


                    // echo '<br>';
                    // echo 'hihi';
                    $bills = $user->getBillById($bill_ID);
                    $total_price = number_format($bills['total_price']);
                    $discount_price = number_format($bills['discount_price']);
                    $price_to_pay = number_format($bills['price_to_pay']);
                    $created_at = $bills['created_at'];
                    $bill_product = $user->getListBillProductByBillId($bill_ID);
                    $stt = 0;

                    $username = $_SESSION['customer'];
                    $to = $email;
                    $subject = "#$bill_ID MEO STORE";
                    $message = "
                        <html>
            
                            <head>
                                <title></title>
            
                                <style>
                                    th,
                                    td {
                                        padding: 5px 10px;
                                    }
            
                                    .text-capitalize {
                                        text-transform: capitalize;
                                    }
                                </style>
                            </head>
            
                            <body>
            
                                <p>Xin chào $last_name $first_name! Bạn đã đặt hàng thành công!</p>
                                <h2>Chi tiết đơn hàng</h2>
                                <address>
                                    Mã đơn hàng: $bill_ID
                                    <br>
                                    Username: <span class='text-capitalize'>$username</span>
                                    <br>
                                    Tên: <span class='text-capitalize'>$last_name $first_name</span>
                                    <br>
                                    Email: $email
                                    <br>
                                    Số điện thoại: $phone_number
                                    <br>
                                    Địa chỉ: <span class='text-capitalize'>$address</span>
                                    <br>
            
                                    Hình thức: Thanh toán khi nhận hàng
                                    <br>
                                    Trạng thái: Chưa thanh toán
                                    <br>
                                    Mã khuyến mãi: $promotion_name
            
                                </address>
                                <br>
                                <table>
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
                    ";

                    if ($insert_bill_product) {

                        // $message1 = "";
                        foreach ($bill_product as $b_p) {
                            $stt++;
                            $name = $b_p['name'];
                            $quantity = $b_p['quantity'];
                            $price = number_format($b_p['price']);
                            $unit_price = number_format($b_p['price'] * $b_p['quantity']);

                            $message .= "
                                            <tr>
                                                <td>
                                                    $stt
                                                </td>
                                                <td>
                                                    $name
                                                </td>
                                                <td>
                                                    $quantity
                                                </td>
                                                <td>
                                                    $price
                                                </td>
                                                <td>
                                                    $unit_price
                                                </td>
                                            </tr>
                            ";
                        }

                        $message .= "
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan='4'><b>Tổng</b></td>
                                                <td>
                                                    <b>$total_price</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan='4'><b>Giảm</b></td>
                                                <td>
                                                    <b>$discount_price</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan='4'><b>Thanh toán</b></td>
                                                <td>
                                                    <b>$price_to_pay</b>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </body>
                            </html>
                        ";

                        // echo $message;

                        $send_email = $user->sendEmail($to, $subject, $message);

                        // if ($send_email) {
                        setcookie("cart_cus", "", time() -  3600 * 24 * 30 * 12);
                        if (isset($_COOKIE['cart'])) {
                            setcookie("cart", "", time() -  3600 * 24 * 30 * 12);
                        }
                        $_SESSION['success'] = 'Đặt hàng thành công!';
                        unset($_SESSION['error']);
                        // } else {
                        //     $_SESSION['error'] = 'Đặt hàng thất bại!';
                        //     unset($_SESSION['success']);
                        // }
                        header('location: ?act=product');
                    } else {
                        $_SESSION['error'] = 'Đặt hàng thất bại!';
                        unset($_SESSION['success']);
                    }
                    header('location: ?act=product');
                } else {
                    $_SESSION['error'] = 'Đặt hàng thất bại!';
                    unset($_SESSION['success']);
                }
                header('location: ?act=product');
            }
        } else {
            $_SESSION['login'] = 'login';
            unset($_SESSION['success']);
            header('location: index.php');
        }

        break;



    case 'payment-online-return':
        $user = new User();
        if (isset($_SESSION['customer_ID'])) {
            $cookie_data = $_COOKIE['cart'];
            $cart_data = json_decode($cookie_data, true);

            $vnp_ResponseCode = $_GET['vnp_ResponseCode'];
            $total_price = $_GET['total_price'];
            $discount_price = $_GET['discount_price'];
            $price_to_pay = $_GET['price_to_pay'];
            $first_name = $_GET['first_name'];
            $last_name = $_GET['last_name'];
            $email = $_GET['email'];
            $phone_number = $_GET['phone_number'];
            $address = $_GET['address'];
            $promotion_ID = $_GET['promotion_ID'];

            $payments = 'online';
            $payment_status = 'paid';
            $status = 'pending';

            $customer_ID = $_SESSION['customer_ID'];

            if ($vnp_ResponseCode == 00) {
                $insert_bill = $user->insertBill(
                    $total_price,
                    $discount_price,
                    $price_to_pay,
                    $payments,
                    $phone_number,
                    $address,
                    $status,
                    $payment_status,
                    $customer_ID,
                    $promotion_ID
                );

                if ($insert_bill) {

                    $bill_ID = $user->getLastBillId();
                    foreach ($cart_data as $key => $value) {
                        $product_ID = $value['product_ID'];
                        $quantity = $value['quantity'];
                        $price = $value['price'];
                        $insert_bill_product = $user->insertBillProduct(
                            $bill_ID,
                            $product_ID,
                            $quantity,
                            $price
                        );
                    }

                    $bills = $user->getBillById($bill_ID);
                    $total_price = number_format($bills['total_price']);
                    $discount_price = number_format($bills['discount_price']);
                    $price_to_pay = number_format($bills['price_to_pay']);
                    $created_at = $bills['created_at'];
                    $bill_product = $user->getListBillProductByBillId($bill_ID);
                    $stt = 0;

                    $username = $_SESSION['customer'];
                    $to = $email;
                    $subject = "#$bill_ID MEO STORE";
                    $message = "
                                <html>
                    
                                    <head>
                                        <title></title>
                    
                                        <style>
                                            th,
                                            td {
                                                padding: 5px 10px;
                                            }
                    
                                            .text-capitalize {
                                                text-transform: capitalize;
                                            }
                                        </style>
                                    </head>
                    
                                    <body>
                    
                                        <p>Xin chào $last_name $first_name! Bạn đã đặt hàng thành công!</p>
                                        <h2>Chi tiết đơn hàng</h2>
                                        <address>
                                            Mã đơn hàng: $bill_ID
                                            <br>
                                            Username: <span class='text-capitalize'>$username</span>
                                            <br>
                                            Tên: <span class='text-capitalize'>$last_name $first_name</span>
                                            <br>
                                            Email: $email
                                            <br>
                                            Số điện thoại: $phone_number
                                            <br>
                                            Địa chỉ: <span class='text-capitalize'>$address</span>
                                            <br>
                    
                                            Hình thức: Thanh toán online
                                            <br>
                                            Trạng thái: Đã thanh toán
                                            <br>
                                            Mã khuyến mãi: $promotion_name
                    
                                        </address>
                                        <br>
                                        <table>
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
                            ";

                    if ($insert_bill_product) {

                        foreach ($bill_product as $b_p) {
                            $stt++;
                            $name = $b_p['name'];
                            $quantity = $b_p['quantity'];
                            $price = number_format($b_p['price']);
                            $unit_price = number_format($b_p['price'] * $b_p['quantity']);

                            $message .= "
                                                <tr>
                                                    <td>
                                                        $stt
                                                    </td>
                                                    <td>
                                                        $name
                                                    </td>
                                                    <td>
                                                        $quantity
                                                    </td>
                                                    <td>
                                                        $price
                                                    </td>
                                                    <td>
                                                        $unit_price
                                                    </td>
                                                </tr>
                            ";
                        }

                        $message .= "
                                            </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan='4'><b>Tổng</b></td>
                                                        <td>
                                                            <b>$total_price</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='4'><b>Giảm</b></td>
                                                        <td>
                                                            <b>$discount_price</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='4'><b>Thanh toán</b></td>
                                                        <td>
                                                            <b>$price_to_pay</b>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                        </table>
                                    </body>
                                </html>
                            ";

                        $send_email = $user->sendEmail($to, $subject, $message);

                        // if ($send_email) {

                        setcookie("cart_cus", "", time() -  3600 * 24 * 30 * 12);
                        if (isset($_COOKIE['cart'])) {
                            setcookie("cart", "", time() -  3600 * 24 * 30 * 12);
                        }
                        $_SESSION['success'] = 'Đặt hàng thành công!';
                        unset($_SESSION['error']);
                        // } else {
                        //     $_SESSION['error'] = 'Đặt hàng thất bại!';
                        //     unset($_SESSION['success']);
                        // }
                        header('location: ?act=product');
                    } else {
                        $_SESSION['error'] = 'Đặt hàng thất bại!';
                        unset($_SESSION['success']);
                    }
                    header('location: ?act=product');
                } else {
                    $_SESSION['error'] = 'Đặt hàng thất bại!';
                    unset($_SESSION['success']);
                }
                header('location: ?act=product');
            } else {
                $_SESSION['error'] = 'Đặt hàng thất bại!';
                unset($_SESSION['success']);
            }
            header('location: ?act=product');
        } else {
            $_SESSION['login'] = 'login';
            unset($_SESSION['success']);
            header('location: index.php');
        }

        break;



    case 'order-cancel':
        $user = new User();
        if (isset($_GET['bill_ID'])) {
            $bill_ID = $_GET['bill_ID'];
            $status = 'cancelled';
            $results = $user->updateBillStatus($bill_ID, $status);
            if ($results) {
                $_SESSION['success'] = 'Cập nhật thành công!';
                unset($_SESSION['error']);
            } else {
                $_SESSION['error'] = 'Cập nhật thất bại!';
                unset($_SESSION['success']);
            }
            header('location: index.php?act=account');
        }
        break;

    case 'search':
        $user = new User();
        $value = $_POST['value'];
        $products = $user->searchProduct($value);

        $data = array();
        if ($products) {
            foreach ($products as $p) {
                $data_results = array(
                    'product_ID' => $p['product_ID'],
                    'name' => $p['name'],

                );
                $data[] = $data_results;
            }
        }
        echo json_encode($data);



        break;
}
