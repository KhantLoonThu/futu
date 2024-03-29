<?php

include_once "../../models/product.php";

class ProductController
{
    private $product;
    public function __construct()
    {
        $this->product = new Product();
    }

    public function getAllProducts()
    {
        return $this->product->getAllProducts();
    }

    public function getProductValid($name)
    {
        return $this->product->getProductValid($name);
    }

    public function getProduct($name)
    {
        return $this->product->getProduct($name);
    }

    public function putProduct($name, $price, $fname, $description, $categoryId, $subcategoryId)
    {
        return $this->product->putProduct($name, $price, $fname, $description, $categoryId, $subcategoryId);
    }
}
