<?php

require_once 'database.php';

class Product
{

    public function insertProduct($name, $image, $short_des, $des_content_title, $des_content, $price, $status, $category_ID)
    {
        $db = new connect();
        $sql = "INSERT INTO products(name, image, short_des, des_content_title, des_content, price, status, category_ID) 
        VALUES ('$name', '$image', '$short_des', '$des_content_title', '$des_content', '$price', '$status', '$category_ID')";
        $r = $db->exec($sql);
        return $r;
    }
    public function getProductList()
    {
        $db = new connect();
        $sql = "SELECT p.*, c.name as category_name FROM products p INNER JOIN categories c ON p.category_ID=c.category_ID";
        $r = $db->getList($sql);
        return $r;
    }

    public function getProductByName($name)
    {
        $db = new connect();
        $sql = "SELECT * FROM products WHERE name='$name'";
        $r = $db->getInstance($sql);
        return $r;
    }
    public function getProductById($product_ID)
    {
        $db = new connect();
        $sql = "SELECT * FROM products WHERE product_ID=$product_ID";
        $r = $db->getInstance($sql);
        return $r;
    }

    public function updateProduct($product_ID, $name, $image, $short_des, $des_content_title, $des_content, $price, $status, $category_ID)
    {
        $db = new connect();
        $sql = "UPDATE products SET name='$name', image='$image', short_des='$short_des', des_content_title='$des_content_title',
        des_content='$des_content', price='$price', status='$status', category_ID='$category_ID' WHERE product_ID='$product_ID'";
        $r = $db->exec($sql);
        return $r;
    }
    public function deleteProduct($product_ID)
    {
        $db = new connect();
        $sql = "DELETE FROM products WHERE product_ID='$product_ID'";
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
}
