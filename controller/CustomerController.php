<?php
require '../model/customer.php';

if (isset($_GET['act']))
    $action = $_GET['act'];
else if (isset($_POST['act']))
    $action = $_POST['act'];
else
    $action = 'customer-list';


switch ($action) {
    case 'customer-list':
        $customer = new Customer();
        $results = $customer->getCustomerList();
        include '../views/admin/customer.php';
        break;
    case 'customer-create-form':
        $customer = new Customer();
        $results = $customer->getCustomerList();
        include '../views/admin/customer.php';
        break;

    case 'customer-edit-form':
        $customer_ID = $_GET['customer_ID'];

        $customer = new Customer();
        $r = $customer->getCustomerById($customer_ID);
        // $r=$results->fetch_assoc();
        include '../views/admin/customer.php';
        break;
    case 'customer-create':
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $status = $_POST['status'];

        $customer = new Customer();
        $results = $customer->insertCustomer(
            $username,
            $password,
            $first_name, 
            $last_name, 
            $email, 
            $phone_number, 
            $address, 
            $status
        );
        if ($results) {
            $_SESSION['success'] = 'Thêm tài khoản thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Thêm tài khoản thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?customer');
        break;

    case 'customer-edit':
        $customer_ID = $_POST['customer_ID'];
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $status = $_POST['status'];

        $customer = new Customer();
        $results = $customer->updateCustomer(
            $customer_ID,
            $username,
            $first_name,
            $last_name,
            $email,
            $phone_number,
            $address,
            $status
        );
        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?customer');
        break;

    case 'customer-delete':
        $customer_ID = $_GET['customer_ID'];
        $customer = new Customer();
        $results = $customer->deleteCustomer($customer_ID);
        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?customer');
        break;
}
