<?php

include_once "../../includes/db.php";

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

    // get all subcategory
    public function getAllSubCategory()
    {
        $this->con = Database::connect();
        $sql = "SELECT * FROM sub_categories";
        $this->statement = $this->con->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

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

    // get subcategory by category
    public function getSubcategoriesByCategory($id)
    {
        $this->con = Database::connect();
        $sql = "SELECT * FROM sub_categories WHERE category_id IN 
                (SELECT id FROM categories WHERE id = :id)";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":id", $id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    // For Table
    public function getAllSubCategoryAndCategory()
    {
        $this->con = Database::connect();
        $sql = "SELECT sub_categories.*, categories.name as category_name FROM sub_categories JOIN categories
        ON sub_categories.category_id = categories.id";
        $this->statement = $this->con->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }
}
