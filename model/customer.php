<?php

require_once 'database.php';

class Customer
{

    // public function insertCustomer($username, $status)
    // {
    //     $db = new connect();
    //     $sql = "INSERT INTO customers (name, status) VALUES ('$name', '$status')";
    //     $r = $db->exec($sql);
    //     return $r;
    // }
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
    public function insertCustomer($username,$password, $first_name, $last_name, $email, $phone_number, $address, $status)
    {
        $db = new connect();
        $sql = "INSERT INTO customers (username,  password,first_name,last_name, email,phone_number,address, status) 
        VALUES ('$username', '$password', '$first_name', '$last_name', '$email', '$phone_number', '$address', '$status')";
        $r = $db->exec($sql);
        return $r;
    }

    public function updateCustomer($customer_ID, $username, $first_name, $last_name, $email, $phone_number, $address, $status)
    {
        $db = new connect();
        $sql = "UPDATE customers 
        SET username='$username', 
        first_name='$first_name', 
        last_name='$last_name', 
        email='$email', 
        phone_number='$phone_number', 
        address='$address', 
        status='$status' 
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
}
