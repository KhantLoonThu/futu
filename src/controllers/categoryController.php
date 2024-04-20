<?php

namespace Admin\Controller\Category;

include_once "../../models/category.php";

use Admin\Model\Category as CategoryModel;

class CategoryController
{
    private $category;

    public function __construct()
    {
        $this->category = new CategoryModel\Category();
    }

    # for category
    public function getAllCategory()
    {
        return $this->category->getAllCategory();
    }

    public function getCategory($category)
    {
        return $this->category->getCategory($category);
    }

    // put category
    public function putCategory($category)
    {
        return $this->category->putCategory($category);
    }

    // is category valid
    public function getCategoryValid($category)
    {
        return $this->category->getCategoryValid($category);
    }

    # for subcategory
    public function getSubCategory($subcategory)
    {
        return $this->category->getSubCategory($subcategory);
    }

    // put subcategory
    public function putSubCategory($subcategory, $category_id)
    {
        return $this->category->putSubCategory($subcategory, $category_id);
    }

    // is subcategory valid
    public function getSubCategoryValid($subcategory)
    {
        return $this->category->getSubCategoryValid($subcategory);
    }

    // get all subcategory
    public function getAllSubCategory()
    {
        return $this->category->getAllSubCategory();
    }

    // joining two tables
    public function getSubcategoriesByCategory($id)
    {
        return $this->category->getSubcategoriesByCategory($id);
    }

    // For Table
    public function getAllSubCategoryAndCategory()
    {
        return $this->category->getAllSubCategoryAndCategory();
    }
}
