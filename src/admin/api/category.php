<?php

use Admin\Controller\Category\CategoryController;

include_once "../../controllers/categoryController.php";

$category_controller = new CategoryController();
$caetgories = json_encode($category_controller->getAllCategory());

echo $caetgories;
