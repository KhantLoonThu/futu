<?php

use Admin\Controller\Product\ProductController;

include_once "../../controllers/productController.php";

$product_controller = new ProductController();

$products = json_encode($product_controller->getAllProducts());

echo $products;
