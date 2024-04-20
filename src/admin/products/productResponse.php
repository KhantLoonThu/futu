<?php

session_start();

use Admin\Controller\Category\CategoryController;

include_once "../../controllers/categoryController.php";

$category_controller = new CategoryController();

$selected = $_POST['category'];
$category = $selected;

$_SESSION['subcategories'] = $category_controller->getSubcategoriesByCategory($category);
$subcategories = trim((json_encode($_SESSION['subcategories'])));

echo $subcategories;
