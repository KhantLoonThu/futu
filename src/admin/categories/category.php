<?php

use Admin\Controller\Category as CategoryController;

$controller = new CategoryController\CategoryController();
$categories = $controller->getAllCategory();
$categoryArray = [];

if (isset($_POST['submit'])) {
    $error = false;
    foreach ($categories as $category) {
        $new_name = str_replace(" ", "_", $category['name']);
        if (isset($_POST[$new_name])) {
            $categoryArray[] = $_POST[$new_name];
        }
    }

    if (isset($categoryArray)) {
        echo "<pre>";
        print_r($categoryArray);
        echo "</pre>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="post">
        <?php foreach ($categories as $category) : ?>
            <?php
            $new_name = str_replace(" ", "_", $category['name']);
            ?>
            <label for="<?= $new_name ?>"><?= $category['name'] ?></label>
            <input type="checkbox" name="<?= $new_name ?>" value="<?= $category['id'] ?>">
            <br>
        <?php endforeach ?>
        <button name="submit">submit</button>
    </form>

</body>

</html>