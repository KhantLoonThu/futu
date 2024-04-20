<?php

namespace Admin\Controller\Product;

use Admin\Model\Product\Product;

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

    public function getProductValid($name, $subid)
    {
        return $this->product->getProductValid($name, $subid);
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
