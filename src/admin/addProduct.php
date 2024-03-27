<?php

include_once "../controllers/categoryController.php";
$category_controller = new CategoryController();

if (isset($_POST['add'])) {
    $error = false;

    // name
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $error = true;
        $name_error = "You must fill product name";
    }

    // price
    if (!empty($_POST['price'])) {
        $price = $_POST['price'];
    } else {
        $error = true;
        $price_error = "You must fill price";
    }

    $description = $_POST['description'];

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
                    if (move_uploaded_file($filetmp, "../../public/images/" . $fname)) {
                        echo "Success";
                    }
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

    // category
    if (!empty($_POST['category'])) {
        $category = $_POST['category'];
    } else {
        $error = true;
        $category_error = "You must fill category";
    }

    // subcategory
    if (!empty($_POST['subcategory'])) {
        $subcategory = $_POST['subcategory'];
    } else {
        $error = true;
        $subcategory_error = "You must fill subcategory";
    }

    if (!$error) {
        $categoryData = $category_controller->getCategory($category);
        $categoryId = $categoryData[0]['id'];
        $subcategoryData = $category_controller->getSubCategory($subcategory);
        $subcategoryId = $subcategoryData[0]['id'];

        $valid = $category_controller->getProduct($name);

        if ($valid['total'] == 0) {
            $category_controller->putProduct($name, $price, $description, $fname, $categoryId, $subcategoryId);
        }
    }
}
echo "<pre>";
print_r($_FILES);
echo "</pre>";
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
        <?php //include_once "../layouts/sidebar.php";
        ?>

        <section class="w-[calc(100%-256px)] ms-auto">
            <!-- navbar -->
            <?php include_once "../layouts/navbar.php"; ?>

            <!-- main -->
            <div class="max-w-screen-xl mt-8 p-8 mx-auto bg-white rounded-2xl">
                <h2 class="text-4xl font-semibold text-rose-700">Categories</h2>
                <form method="post" enctype="multipart/form-data" class="flex justify-between mt-5">
                    <div class="w-1/2">
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
                    <div class="w-1/2">
                        <div class="mt-5">
                            <label for="description" class="label">Add Description</label>
                            <textarea class="input input-hover input-focus effect-3 w-full" name="description" id="description" cols="30" rows="4"></textarea>
                        </div>
                        <div class="mt-5">
                            <label for="category" class="label">Add Category</label>
                            <select class="input input-focus input-hover effect-3 w-full" name="category" id="category">
                                <option value=""></option>
                                <option value="drinks">Drinks</option>
                            </select>
                            <span class="text-red-700 text-lg mt-3"><?php if (isset($category_error)) echo $category_error ?></span>
                        </div>
                        <div class="mt-5">
                            <label for="subcategory" class="label">Add SubCategory</label>
                            <select class="input input-focus input-hover effect-3 w-full" name="subcategory" id="subcategory">
                                <option value=""></option>
                                <option value="soft">Soft</option>
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
    <script src="../../public/script.js"></script>
</body>

</html>