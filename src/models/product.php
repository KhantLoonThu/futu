<?php

namespace Admin\Model\Product;

use Include\Database\Database;

require_once __DIR__ . "../../includes/db.php";

class Product
{
    private $con, $statement;

    # product

    // for getting all products
    public function getAllProducts()
    {
        $this->con = Database::connect();
        $sql = "SELECT * FROM products";
        $this->statement = $this->con->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(\PDO::FETCH_ASSOC);
            return $results;
        }
    }

    // for individual product
    public function getProduct($product)
    {
        $this->con = Database::connect();
        $sql = "SELECT * FROM products WHERE name = :product";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":product", $product);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(\PDO::FETCH_ASSOC);
            return $results;
        }
    }

    // for checking already exist
    public function getProductValid($product, $subcategoryId)
    {
        $this->con = Database::connect();
        $sql = "SELECT count(*) as total FROM products WHERE name = :product AND subcategory_id = :subid";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":product", $product);
        $this->statement->bindParam(":subid", $subcategoryId);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(\PDO::FETCH_ASSOC);
            return $results;
        }
    }

    // for putting product into database
    public function putProduct($name, $price, $fname, $description, $categoryId, $subcategoryId)
    {
        $this->con = Database::connect();
        $sql = "INSERT INTO products(name, price, thumb, description, category_id, subcategory_id) 
        VALUES(:name, :price, :thumb, :description, :category_id, :subcategory_id)";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":name", $name);
        $this->statement->bindParam(":price", $price);
        $this->statement->bindParam(":thumb", $fname);
        $this->statement->bindParam(":description", $description);
        $this->statement->bindParam(":category_id", $categoryId);
        $this->statement->bindParam(":subcategory_id", $subcategoryId);
        return $this->statement->execute();
    }
}
