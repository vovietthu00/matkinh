<?php

require_once 'database.php';


class User
{

    public function register($username, $password, $email, $status)
    {
        $db = new connect();
        $sql = "INSERT INTO customers (username, password, email, status) VALUES ('$username', '$password', '$email', '$status')";
        $r = $db->exec($sql);
        return $r;
    }
    public function login($username, $password)
    {
        $db = new connect();
        $sql = "SELECT * FROM customers WHERE username='$username' AND password='$password'";
        $r = $db->getInstance($sql);
        // var_dump($r);
        // var_dump($sql);
        return $r;
    }
    public function loginWithGoogle($username, $email)
    {
        $db = new connect();


        $sql_select = "SELECT * FROM customers WHERE username='$username' AND email='$email'";
        $r_select = $db->getInstance($sql_select);
        if ($r_select) {
            return $r_select;
        } else {
            $sql_insert = "INSERT INTO customers (username, email, status) VALUES ('$username', '$email', '1')";
            $r_insert = $db->exec($sql_insert);
            return $r_insert;
        }
    }
    public function getCustomerList()
    {
        $db = new connect();
        $sql = 'SELECT * FROM customers';
        $r = $db->getList($sql);
        return $r;
    }

    public function getCustomerById($customer_ID)
    {
        $db = new connect();
        $sql = "SELECT * FROM customers WHERE customer_ID=$customer_ID";
        $r = $db->getInstance($sql);
        return $r;
    }

    public function updateInfo($customer_ID, $username, $first_name, $last_name, $email, $phone_number, $address)
    {
        $db = new connect();
        $sql = "UPDATE customers 
        SET username='$username', 
        first_name='$first_name', 
        last_name='$last_name', 
        email='$email', 
        phone_number='$phone_number', 
        address='$address'
        WHERE customer_ID='$customer_ID'";
        $r = $db->exec($sql);
        return $r;
    }
    public function updatePassword($customer_ID, $password)
    {
        $db = new connect();
        $sql = "UPDATE customers 
        SET password='$password'
        WHERE customer_ID='$customer_ID'";
        $r = $db->exec($sql);
        return $r;
    }
    public function deleteCustomer($customer_ID)
    {
        $db = new connect();
        $sql = "DELETE FROM customers WHERE customer_ID='$customer_ID'";
        $r = $db->exec($sql);
        return $r;
    }

    public function getCategoryList()
    {
        $db = new connect();
        $sql = 'SELECT * FROM categories WHERE status=1 ORDER BY name';
        $r = $db->getList($sql);
        return $r;
    }
    public function getCategoryById($category_ID)
    {
        $db = new connect();
        $sql = "SELECT * FROM categories WHERE category_ID=$category_ID";
        $r = $db->getInstance($sql);
        return $r;
    }

    public function getProductNew()
    {
        $db = new connect();
        $sql = "SELECT * FROM products WHERE status=1 ORDER BY created_at DESC LIMIT 6";
        $r = $db->getList($sql);
        return $r;
    }
    public function getProductList($page)
    {
        $start_row = ($page - 1) * 9;
        $db = new connect();
        $sql = "SELECT * FROM products WHERE status=1 ORDER BY RAND() LIMIT $start_row, 9";
        $r = $db->getList($sql);
        return $r;
    }
    public function countProduct()
    {

        $db = new connect();
        $sql = "SELECT COUNT(product_ID) AS num FROM products WHERE status=1";
        $r = $db->getInstance($sql);
        return $r['num'];
    }

    public function getProductByCategory($category_ID, $page)
    {
        $start_row = ($page - 1) * 9;
        $db = new connect();
        $sql = "SELECT * FROM products WHERE category_ID='$category_ID'  AND status=1 ORDER BY RAND() LIMIT $start_row, 9";
        $r = $db->getList($sql);
        return $r;
    }
    public function getProductById($product_ID)
    {
        $db = new connect();
        $sql = "SELECT p.*, c.name as category_name FROM products p INNER JOIN categories c ON p.category_ID=c.category_ID WHERE product_ID=$product_ID";
        $r = $db->getInstance($sql);
        return $r;
    }

    public function getProductRelate($category_ID)
    {
        $db = new connect();
        $sql = "SELECT * FROM products WHERE category_ID='$category_ID' AND status=1 ORDER BY RAND() LIMIT 0, 3";
        $r = $db->getList($sql);
        return $r;
    }

    public function getPromotionList()
    {
        $db = new connect();
        $sql = "SELECT * FROM promotions WHERE status=1 ORDER BY created_at DESC";
        $r = $db->getList($sql);
        return $r;
    }

    public function getPromotionByName($name)
    {
        $db = new connect();
        $sql = "SELECT * FROM promotions WHERE name='$name' AND status=1";
        $r = $db->getInstance($sql);
        return $r;
    }

    public function getPromotionById($promotion_ID)
    {
        $db = new connect();
        $sql = "SELECT * FROM promotions WHERE promotion_ID='$promotion_ID'";
        $r = $db->getInstance($sql);
        return $r;
    }

    public function insertBill($total_price, $discount_price, $price_to_pay, $payments, $phone_number, $address, $status, $payment_status, $customer_ID, $promotion_ID)
    {
        $db = new connect();
        $sql = "INSERT INTO bills (total_price, discount_price, price_to_pay, payments, phone_number, address, status, payment_status, customer_ID, promotion_ID) 
        VALUES ('$total_price', '$discount_price', '$price_to_pay', '$payments', '$phone_number', '$address', '$status', '$payment_status', '$customer_ID', $promotion_ID)";
        $r = $db->exec($sql);
        return $r;
        // return $sql;
    }

    public function getLastBillId()
    {
        $db = new connect();
        $sql = "SELECT MAX(bill_ID) FROM bills";
        $r = $db->getInstance($sql);
        return $r[0];
    }
    public function getBillById($bill_ID)
    {
        $db = new connect();
        $sql = "SELECT * FROM bills WHERE bill_ID='$bill_ID'";
        $r = $db->getInstance($sql);
        return $r;
    }
    public function insertBillProduct($bill_ID, $product_ID, $quantity, $price)
    {
        $db = new connect();
        $sql = "INSERT INTO bill_product (bill_ID, product_ID, quantity, price) 
        VALUES ('$bill_ID', '$product_ID', '$quantity', '$price')";
        $r = $db->exec($sql);
        return $r;
    }

    public function getListBillByCustomerId($customer_ID)
    {
        $db = new connect();
        $sql = "SELECT * FROM bills WHERE customer_ID='$customer_ID'";
        $r = $db->getList($sql);
        return $r;
    }

    public function getListBillProductByBillId($bill_ID)
    {
        $db = new connect();
        $sql = "SELECT b_p.*,p.name FROM bill_product b_p INNER JOIN products p 
        ON b_p.product_ID=p.product_ID  
        WHERE bill_ID='$bill_ID'";
        $r = $db->getList($sql);
        return $r;
    }

    public function updateBillStatus($bill_ID, $status)
    {
        $db = new connect();
        $sql = "UPDATE bills 
        SET status='$status'
        WHERE bill_ID='$bill_ID'";
        $r = $db->exec($sql);
        return $r;
    }

    public function sendEmail($to, $subject, $message)
    {
        $headers = "Content-type:text/html;charset=UTF-8";
        $result = mail($to, $subject, $message, $headers);
        return $result;
    }

    public function searchProduct($value)
    {
        $db = new connect();

        $sql = "SELECT * FROM products WHERE name LIKE '%$value%' LIMIT 6";
        $r = $db->getList($sql);
        return $r;
    }
    public function searchCategory($value)
    {
        $db = new connect();

        $sql = "SELECT * FROM categories WHERE name LIKE '%$value%'";
        $r = $db->getList($sql);
        return $r;
    }
}
