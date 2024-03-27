<?php

include_once "../controllers/categoryController.php";
$category_controller = new CategoryController();

if (isset($_POST['add'])) {

    $error = false;

    // category
    if (!empty($_POST['category'])) {
        $category = trim(strtolower($_POST['category']));
    } else {
        $error = true;
        $category_error = "You must fill category";
    }

    // subcategory
    if (!empty($_POST['subcategory'])) {
        $subcategory = trim(strtolower($_POST['subcategory']));
    } else {
        $error = true;
        $subcategory_error = "You must fill subcategory";
    }

    if (!$error) {
        $categoryData = $category_controller->getCategory($category);
        $categoryId = $categoryData[0]['id'];

        $subcategoryValid = $category_controller->getSubCategoryValid($category);

        if (($subcategoryValid['total'] == 0)) {
            $category_controller->putSubCategory($subcategory, $categoryId);
            $category = '';
            $subcategory = '';
        }
    }
}

$categories = $category_controller->getAllCategory();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futu Admin Dashbord</title>
    <link rel="shortcut icon" href="../../public/images/duck.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../fontawesome/css/all.css">
    <link rel="stylesheet" href="../../public/style.css">
</head>

<body>


    <main class="flex w-full h-screen bg-gray-200">
        <!-- sidebar -->
        <?php include_once "../layouts/admin/sidebar.php";
        ?>

        <section class="w-[calc(100%-256px)] ms-auto">
            <!-- navbar -->
            <?php include_once "../layouts/admin/navbar.php"; ?>

            <!-- main -->
            <div class="w-1/3 ms-20 mt-10 p-8 mx-auto bg-white rounded-2xl">
                <h2 class="text-4xl font-semibold text-rose-700">Categories</h2>
                <form method="post" class="mt-5">
                    <div class="mt-5">
                        <label for="category" class="label">Add Category</label>
                        <select class="input input-focus input-hover effect-3 w-full" name="category" id="category">
                            <option value="" class="option"></option>
                            <option value="drinks" class="option">Drinks</option>
                        </select>
                        <span class="text-red-700 text-lg mt-3"><?php if (isset($category_error)) echo $category_error ?></span>
                    </div>
                    <div class="mt-5">
                        <label for="subcategory" class="label">Add SubCategory</label>
                        <input type="text" name="subcategory" value="<?php if (isset($subcategory)) echo $subcategory ?>" id="subcategory" class="input input-hover input-focus effect-3 w-full">
                        <span class="text-red-700 text-lg mt-3"><?php if (isset($subcategory_error)) echo $subcategory_error ?></span>
                    </div>
                    <div class="mt-8 mb-10">
                        <button name="add" class="btn-reverse btn-reverse-hover btn-focus effect-3">Add</button>
                    </div>
                </form>
            </div>
        </section>

    </main>

    <!-- need to add add features -->
    <script src="../../public/script.js"></script>
</body>

</html>