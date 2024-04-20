<?php

use Admin\Controller\Category as CategoryController;

require_once  '../../controllers/categoryController.php';

$category_controller = new CategoryController\CategoryController();

if (isset($_POST['add'])) {

    $error = false;

    // category
    if (!empty($_POST['category'])) {
        $category = trim(strtolower($_POST['category']));
    } else {
        $error = true;
        $category_error = "You must fill category";
    }

    if (!$error) {
        $categoryValid = $category_controller->getCategoryValid($category);

        if (($categoryValid['total'] == 0)) {
            $category_controller->putCategory($category);
            $category = '';
            echo "<script> alert('Successfully added category') </script>";
        } else {
            echo "<script> alert('category already existed') </script>";
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


    <main class="flex w-full h-screen overflow-y-auto bg-gray-300">
        <!-- sidebar -->
        <?php include_once "../../layouts/admin/sidebar.php";
        ?>

        <section class="lg:w-[calc(100%-256px)] md:w-[calc(100%-192px)] sm:w-full ms-auto">
            <!-- navbar -->
            <?php include_once "../../layouts/admin/navbar.php"; ?>

            <!-- main -->
            <div class="mt-10 p-8 lg:ms-5 lg:me-3 lg:mt-3 md:ms-5 md:me-3 md:mt-3 sm:mt-3 sm:mx-3 sm:m-0 bg-white">
                <h2 class="text-4xl font-semibold text-rose-700">Categories</h2>
                <form method="post" class="mt-5">
                    <div class="mt-5">
                        <label for="category" class="label">Add Category</label>
                        <input type="text" name="category" value="<?php if (isset($category)) echo $category ?>" id="category" class="input input-hover input-focus effect-3 w-full">
                        <span class="text-red-700 text-lg mt-3"><?php if (isset($category_error)) echo $category_error ?></span>
                    </div>
                    <div class="mt-8 mb-10">
                        <button name="add" class="btn-reverse btn-reverse-hover btn-focus effect-3">Add</button>
                    </div>
                </form>
            </div>

            <div class="mt-10 p-8 lg:ms-5 lg:me-3 lg:mt-3 md:ms-5 md:me-3 md:mt-3 sm:mt-3 sm:mx-3 sm:m-0 bg-white">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Category Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        <?php foreach ($categories as $cate) : ?>
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap"><?= $cate['id'] ?></td>
                                <td class="px-4 py-2 whitespace-nowrap"><?= $cate['name'] ?></td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <button class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>


            </div>

        </section>

    </main>

    <!-- need to add add features -->
    <script src="../../../public/script.js"></script>
</body>

</html>