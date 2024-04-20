<?php

use Admin\Controller\Category\CategoryController;

include_once "../../controllers/categoryController.php";

$category_controller = new CategoryController();
$subcaetgories = json_encode($category_controller->getAllSubCategory());

echo $subcaetgories;
