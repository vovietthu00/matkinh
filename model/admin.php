 <?php

require_once 'database.php';

class Admin
{
    public function login($username, $password)
    {
        $db = new connect();
        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $r = $db->getInstance($sql);
        return $r;
    }
    public function countProduct()
    {
        $db = new connect();
        $sql = "SELECT COUNT(product_ID) AS num FROM products";
        $r = $db->getInstance($sql);
        return $r;
    }
    public function countCustomer()
    {
        $db = new connect();
        $sql = "SELECT COUNT(customer_ID) AS num FROM customers";
        $r = $db->getInstance($sql);
        return $r;
    }
    public function countBill()
    {
        $db = new connect();
        $sql = "SELECT COUNT(bill_ID) AS num FROM bills";
        $r = $db->getInstance($sql);
        return $r;
    }
    public function sumBill()
    {
        $db = new connect();
        $sql = "SELECT SUM(price_to_pay) AS revenue FROM bills WHERE payment_status='paid'";
        $r = $db->getInstance($sql);
        return $r;
    }
    public function getListRevenue($month, $year)
    {
        $db = new connect();
        $sql = "SELECT CAST(created_at AS DATE) AS order_date, SUM(price_to_pay) AS revenue 
        FROM bills 
        WHERE created_at>= '$year-$month-01 00:00:00' 
        AND payment_status='paid'
        GROUP BY CAST(created_at AS DATE)";
        $r = $db->getList($sql);
        return $r;
    }

    public function getListRevenueByDatePicker($start_date, $end_date)
    {
        $db = new connect();
        $sql = "SELECT CAST(created_at AS DATE) AS order_date, SUM(price_to_pay) AS revenue 
        FROM bills 
        WHERE created_at >='$start_date 00:00:00'
        AND created_at <='$end_date 23:59:59' 
        AND payment_status='paid'        
        GROUP BY CAST(created_at AS DATE)";

        $r = $db->getList($sql);
        return $r;
    }

    public function getListFeatureProduct()
    {
        $db = new connect();
        $sql = "SELECT SUM(b_p.quantity) AS quantity, p.name 
        FROM bill_product b_p 
        INNER JOIN products p ON b_p.product_ID=p.product_ID 
        GROUP by b_p.product_ID 
        ORDER BY quantity DESC
        LIMIT 5";

        $r = $db->getList($sql);
        return $r;
    }

    public function getListFeatureProductByDatePicker($start_date, $end_date)
    {
        $db = new connect();
        $sql = "SELECT SUM(b_p.quantity) AS quantity, p.name 
        FROM bill_product b_p 
        INNER JOIN products p ON b_p.product_ID=p.product_ID  
        WHERE b_p.created_at >='$start_date 00:00:00'
        AND b_p.created_at <='$end_date 23:59:59'        
        GROUP by b_p.product_ID 
        ORDER BY quantity DESC
        LIMIT 5";

        $r = $db->getList($sql);
        return $r;
    }

    public function getListTopCustomer()
    {
        $db = new connect();
        $sql = "SELECT SUM(b.price_to_pay) AS price_to_pay, c.username 
        FROM bills b 
        INNER JOIN customers c ON b.customer_ID=c.customer_ID 
        WHERE b.payment_status='paid'        
        GROUP by b.customer_ID 
        ORDER BY price_to_pay DESC
        LIMIT 5";

        $r = $db->getList($sql);
        return $r;
    }

    public function getListTopCustomerByDatePicker($start_date, $end_date)
    {
        $db = new connect();
        $sql = "SELECT SUM(b.price_to_pay) AS price_to_pay, c.username 
        FROM bills b 
        INNER JOIN customers c ON b.customer_ID=c.customer_ID 
        WHERE b.payment_status='paid'
        AND b.created_at >='$start_date 00:00:00'
        AND b.created_at <='$end_date 23:59:59'         
        GROUP by b.customer_ID 
        ORDER BY price_to_pay DESC
        LIMIT 5";

        $r = $db->getList($sql);
        return $r;
    }




    public function getListBillProduct()
    {
        $db = new connect();
        $sql = "SELECT SUM(b_p.quantity) AS quantity, COUNT(b_p.bill_ID) AS bill_num, p.name AS product_name, p.image, p.price, c.name AS category_name 
        FROM products p 
        INNER JOIN bill_product b_p ON p.product_ID=b_p.product_ID
        INNER JOIN categories c ON p.category_ID=c.category_ID          
        GROUP by b_p.product_ID";

        $r = $db->getList($sql);
        return $r;
    }
    // public function getAdminList()
    // {
    //     $db = new connect();
    //     $sql = 'SELECT * FROM admin';
    //     $r = $db->getList($sql);
    //     return $r;
    // }

    // public function getAdminById($admin_ID)
    // {
    //     $db = new connect();
    //     $sql = "SELECT * FROM admin WHERE admin_ID=$admin_ID";
    //     $r = $db->getInstance($sql);
    //     return $r;
    // }
    // public function insertAdmin($username,$password)
    // {
    //     $db = new connect();
    //     $sql = "INSERT INTO admin (username,  password) 
    //     VALUES ('$username', '$password')";
    //     $r = $db->exec($sql);
    //     return $r;
    // }

    // public function updateAdmin($admin_ID, $username)
    // {
    //     $db = new connect();
    //     $sql = "UPDATE admin 
    //     SET username='$username', 
        
    //     WHERE admin_ID='$admin_ID'";
    //     $r = $db->exec($sql);
    //     return $r;
    // }
    // public function deleteAdmin($admin_ID)
    // {
    //     $db = new connect();
    //     $sql = "DELETE FROM admin WHERE admin_ID='$admin_ID'";
    //     $r = $db->exec($sql);
    //     return $r;
    // }




} 
