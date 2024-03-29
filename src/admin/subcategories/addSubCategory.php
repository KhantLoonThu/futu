<?php

include_once "../../controllers/categoryController.php";
$category_controller = new CategoryController();

if (isset($_POST['add'])) {

    $error = false;

    // category
    if (!empty($_POST['category'])) {
        $categoryId = ($_POST['category']);
    } else {
        $error = true;
        $category_error = "You must choose category";
    }

    // subcategory
    if (!empty($_POST['subcategory'])) {
        $subcategory = trim(strtolower($_POST['subcategory']));
    } else {
        $error = true;
        $subcategory_error = "You must fill subcategory";
    }

    if (!$error) {
        $subcategoryValid = $category_controller->getSubCategoryValid($subcategory);

        if (($subcategoryValid['total'] == 0)) {
            $category_controller->putSubCategory($subcategory, $categoryId);
            $category = '';
            $subcategory = '';
            echo "<script> alert('Subcategory added succesfully') </script>";
        } else {
            echo "<script> alert('Subcategory already exist') </script>";
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
    <link rel="shortcut icon" href="../../../public/images/duck.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../../fontawesome/css/all.css">
    <link rel="stylesheet" href="../../../public/style.css">
</head>

<body>


    <main class="flex w-full h-screen bg-gray-300">
        <!-- sidebar -->
        <?php include_once "../../layouts/admin/sidebar.php";
        ?>

        <section class="lg:w-[calc(100%-256px)] md:w-[calc(100%-192px)] sm:w-full ms-auto">
            <!-- navbar -->
            <?php include_once "../../layouts/admin/navbar.php"; ?>

            <!-- main -->
            <div class="mt-10 p-8 lg:ms-5 lg:me-3 lg:mt-3 md:ms-5 md:me-3 md:mt-3 sm:mt-3 sm:mx-3 sm:m-0 bg-white rounded-2xl">
                <h2 class="text-4xl font-semibold text-rose-700">Subcategories</h2>
                <form method="post" class="mt-5">
                    <div class="mt-5">
                        <label for="category" class="label">Choose a Category</label>
                        <select class="input input-focus input-hover effect-3 w-full" name="category" id="category">
                            <option value=""></option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach ?>
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
    <script src="../../../public/script.js"></script>
</body>

</html>