<?php

include_once "../includes/db.php";

class Category
{
    private $con, $statement;

    # category

    // get all category 
    public function getAllCategory()
    {
        $this->con = Database::connect();
        $sql = "SELECT * FROM categories";
        $this->statement = $this->con->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    // put category into database
    public function putCategory($category)
    {
        $this->con = Database::connect();
        $sql = "INSERT INTO categories(name) VALUE(:category)";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":category", $category);
        return $this->statement->execute();
    }

    // for checking already exist
    public function getCategoryValid($category)
    {
        $this->con = Database::connect();
        $sql = "SELECT count(*) as total FROM categories WHERE name = :category";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":category", $category);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    // for individual category
    public function getCategory($category)
    {
        $this->con = Database::connect();
        $sql = "SELECT * FROM categories WHERE name = :category";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":category", $category);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    # Subcategory  

    // put subcategory into database
    public function putSubCategory($subcategory, $category_id)
    {
        $this->con = Database::connect();
        $sql = "INSERT INTO sub_categories(name, category_id) VALUES(:subcategory, :id)";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":subcategory", $subcategory);
        $this->statement->bindParam(":id", $category_id);
        return $this->statement->execute();
    }

    // for checking already exist
    public function getSubCategoryValid($subcategory)
    {
        $this->con = Database::connect();
        $sql = "SELECT count(*) as total FROM sub_categories WHERE name = :subcategory";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":subcategory", $subcategory);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    // for individual subcategory
    public function getSubCategory($subcategory)
    {
        $this->con = Database::connect();
        $sql = "SELECT * FROM sub_categories WHERE name = :subcategory";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":subcategory", $subcategory);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }
}
