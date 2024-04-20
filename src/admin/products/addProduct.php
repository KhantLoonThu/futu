<?php
session_start();

use Admin\Controller\Category as CategoryController;
use Admin\Controller\Product as ProductController;

include_once "../../controllers/categoryController.php";
include_once "../../controllers/productController.php";

$category_controller = new CategoryController\CategoryController();
$product_controller = new ProductController\ProductController();

if (isset($_POST['add'])) {
    $error = false;

    // name
    if (!empty($_POST['name'])) {
        $name = trim(strtolower($_POST['name']));
    } else {
        $error = true;
        $name_error = "You must fill product name";
    }

    // price
    if (!empty($_POST['price'])) {
        $price = trim(strtolower($_POST['price']));
    } else {
        $error = true;
        $price_error = "You must fill price";
    }

    $description = $_POST['description'];



    // category
    if (!empty($_POST['category'])) {
        $category = ($_POST['category']);
    } else {
        $error = true;
        $category_error = "You must fill category";
    }

    // subcategory
    if (!empty($_POST['subcategory'])) {
        $subcategory = ($_POST['subcategory']);
    } else {
        $error = true;
        $subcategory_error = "You must fill subcategory";
    }

    if (!$error) {

        // image
        if (!empty($_FILES['image'])) {
            $filename = $_FILES['image']['name'];
            $filetypename = $_FILES['image']['type'];
            $filetmp = $_FILES['image']['tmp_name'];
            $fileerror = $_FILES['image']['error'];
            $filesize = $_FILES['image']['size'];
            $filetypes = ['jpeg', 'jpg', 'png', 'webp', 'svg', 'docs'];
            $fileExtArray = (explode(".", $filename));
            $fileExt = end($fileExtArray);
            $fname = time() . $filename;

            if ($fileerror == 0) {
                if (in_array($fileExt, $filetypes)) {
                    if ($filesize < 2000000) {
                        $fname = uniqid() . "." . $fileExt;
                        move_uploaded_file($filetmp, "../../../public/images/" . $fname);
                    } else {
                        echo "Your file is too big";
                    }
                } else {
                    echo "Your file extension is not allowed";
                }
            } else {
                "You got an error";
            }
        } else {
            $error = true;
            $image_error = "Please fill image";
        }

        $valid = $product_controller->getProductValid($name, $subcategory);

        if ($valid['total'] == 0) {
            $product_controller->putProduct($name, $price, $fname, $description, $category, $subcategory);
            $name = "";
            $price = "";
            echo "<script> alert('product successfully added') </script>";
        } else {
            echo "<script> alert('product already exist') </script>";
        }
    }
}

$categories_array = $category_controller->getAllCategory();
$subcategories_array = $category_controller->getAllSubCategory();


## I dont remember this code is important or not

// if (isset($_SESSION['subcategories'])) {
//     $subcategoriesByCategory = $_SESSION['subcategories'];
//     // echo "Category data received and stored successfully.";
// } else {
//     http_response_code(400);
//     echo "Error: Category data not received.";
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futu Admin Dashbord</title>
    <link rel="shortcut icon" href="../../../public/images/duck.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../../fontawesome/css/all.css">
    <link rel="stylesheet" href="../../../public/style.css">
</head>

<body>


    <main class="flex w-full h-screen overflow-y-auto bg-gray-200">
        <!-- sidebar -->
        <?php include_once "../../layouts/admin/sidebar.php";
        ?>

        <section class="lg:w-[calc(100%-256px)] md:w-[calc(100%-192px)] sm:w-full ms-auto">
            <!-- navbar -->
            <?php include_once "../../layouts/admin/navbar.php";
            ?>

            <!-- main -->
            <div class="mt-10 p-8 lg:ms-5 lg:me-3 lg:mt-3 md:ms-5 md:me-3 md:mt-3 sm:mt-3 sm:mx-3 sm:m-0 bg-white">
                <h2 class="text-4xl font-semibold text-rose-700">Add Product</h2>
                <form method="post" enctype="multipart/form-data" class="flex justify-between mt-5">
                    <div class="w-1/2 me-5">
                        <div class="mt-5">
                            <label for="name" class="label">Product Name</label>
                            <input type="text" value="<?php if (isset($name)) echo $name ?>" name="name" id="name" class="input input-hover input-focus effect-3 w-full">
                            <span class="text-lg text-rose-700 mt-3">
                                <?php if (isset($name_error)) echo $name_error ?>
                            </span>
                        </div>
                        <div class="mt-5">
                            <label for="price" class="label">Price</label>
                            <input type="number" value="<?php if (isset($price)) echo $price ?>" name="price" id="price" class="input input-hover input-focus effect-3 w-full">
                            <span class="text-lg text-rose-700 mt-3">
                                <?php if (isset($price_error)) echo $price_error ?>
                            </span>
                        </div>
                        <div class="mt-5">
                            <label for="image" class="label">Image</label>
                            <input type="file" name="image" id="image" class="input input-hover input-focus effect-3 w-full">
                            <span class="text-lg text-rose-700 mt-3">
                                <?php if (isset($image_error)) echo $image_error ?>
                            </span>
                        </div>
                    </div>
                    <div class="w-1/2 ms-5">
                        <div class="mt-5">
                            <label for="description" class="label">Add Description</label>
                            <textarea class="input input-hover input-focus effect-3 w-full" name="description" id="description" cols="30" rows="4"></textarea>
                        </div>
                        <div class="mt-5">
                            <label for="category" class="label">Add Category</label>
                            <select class="input input-focus input-hover effect-3 w-full category_select" name="category" id="category">
                                <option value=""></option>
                                <?php foreach ($categories_array as $cate) : ?>
                                    <option class="capitalize" value="<?= $cate['id'] ?>"><?= $cate['name'] ?></option>
                                <?php endforeach ?>

                            </select>
                            <span class="text-red-700 text-lg mt-3"><?php if (isset($category_error)) echo $category_error ?></span>
                        </div>
                        <div class="mt-5">
                            <label for="subcategory" class="label">Add SubCategory</label>
                            <select class="input input-focus input-hover effect-3 w-full subcategory_select" name="subcategory" id="subcategory">
                                <option value="">Please Choose Category First</option>
                            </select>
                            <span class="text-red-700 text-lg mt-3"><?php if (isset($subcategory_error)) echo $subcategory_error ?></span>
                        </div>
                        <div class="mt-8 mb-10">
                            <button name="add" class="btn-reverse btn-reverse-hover btn-focus effect-3">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </main>

    <!-- need to add add features -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../../public/script.js"></script>
    <script src="./product.js"></script>
</body>

</html>