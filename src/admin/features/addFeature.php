<?php

include_once "../../controllers/featureController.php";
$feature_controller = new FeatureController();

if (isset($_POST['add'])) {

    $error = false;

    // feature
    if (!empty($_POST['feature'])) {
        $feature = trim(strtolower($_POST['feature']));
    } else {
        $error = true;
        $feature_error = "You must fill feature";
    }

    if (!$error) {
        $featureValid = $feature_controller->getfeatureValid($feature);

        if (($featureValid['total'] == 0)) {
            $feature_controller->putfeature($feature);
            $feature = '';
            echo "<script> alert('feature added successfully') </script>";
        } else {
            echo "<script> alert('feature already existed') </script>";
        }
    }
}

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
            <div class="mt-10 lg:ms-5 lg:me-3 lg:mt-3 md:ms-5 md:me-3 md:mt-3 sm:mx-3 sm:mt-3 sm:m-0 p-8 bg-white rounded-2xl">
                <h2 class="text-4xl font-semibold text-rose-700">Features</h2>
                <form method="post" class="mt-5">
                    <div class="mt-5">
                        <label for="feature" class="label">Add Feature Title</label>
                        <input type="text" name="feature" value="<?php if (isset($feature)) echo $feature ?>" id="feature" class="input input-hover input-focus effect-3 w-full">
                        <span class="text-red-700 text-lg mt-3"><?php if (isset($feature_error)) echo $feature_error ?></span>
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