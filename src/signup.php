<?php
session_start();
include_once "./user_controllers/customerController.php";
$customer_controller = new CustomerController();

// Form Validating
if (isset($_POST['register'])) {

    $error = false;

    // username 
    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $error = true;
        $name_error = "Please fill your full name";
    }
    // email 
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $error = true;
        $email_error = "Please fill your email";
    }
    // password 
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $error = true;
        $password_error = "Please fill your password";
    }
    // confirm password 
    if (!empty($_POST['c_password'])) {
        $c_password = $_POST['c_password'];
    } else {
        $error = true;
        $c_password_error = "Please fill your confirm password";
    }
    // address
    if (!empty($_POST['address'])) {
        $address = trim(strtolower($_POST['address']));
    } else {
        $error = true;
        $address_error = "Please enter your address";
    }
    // birthdate
    if (!empty($_POST['birthdate'])) {
        $birthdate = trim(strtolower($_POST['birthdate']));
    } else {
        $error = true;
        $birthdate_error = "Please enter your birthdate";
    }

    // profile picture
    if (!empty($_FILES['profilepicture'])) {
        print_r($_FILES);
        $filename = $_FILES['profilepicture']['name'];
        $filetmp = $_FILES['profilepicture']['tmp_name'];
        $ferror = $_FILES['profilepicture']['error'];
        $fsize = $_FILES['profilepicture']['size'];

        $types = ['jpeg', 'jpg', 'svg', 'png', 'docs', 'webp'];
        $ext = explode(".", $filename);
        $extension = end($ext);
        $fname = time() . $filename;

        if ($ferror == 0) {
            if (in_array($extension, $types)) {
                if ($fsize < 2000000) {
                    move_uploaded_file($filetmp, "../public/images/users/" . $fname);
                }
            }
        }
    }

    if (!$error) {
        if (!($password == $c_password)) {
            $unmatchPassword = "Unmatch Password! Please enter the password again!";
        } else {
            $unmatchPassword = '';
            // $alreadyExist = $usercontroller->getUserValid($email);
            $valid = $customer_controller->getCustomerValid($email);
            if ($valid['total'] > 0) {
                echo "<script> alert('user already exist') </script>";
            } else {
                // $usercontroller->putUser($username, $email, $password);
                $_SESSION['email'] = $email;
                $customer_controller->putCustomer($username, $email, $password, $address, $fname, $birthdate);
                header('location:user/index.php');
                exit();
            }
        }
    }

    // to clear alert box
    if (isset($unmatchPassword)) {
        $password = "";
        $c_password = "";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futu - Signup Page</title>
    <link rel="shortcut icon" href="../public/images/duck.svg" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../public/style.css">
</head>

<body class="bg-gray-100">

    <section class="flex justify-center items-center  w-full h-screen my-12">
        <div class="w-[calc(100%-40%)]  mx-auto border border-emerald-700 rounded-2xl px-12 py-12 shadow-zinc-400 shadow-lg bg-white">
            <div class="login-header flex justify-between items-center border-b border-gray-400 pb-8">
                <div class="flex items-center">
                    <img src="../public/images/duck.svg" class="w-10" alt="duck_kitkit">
                    <span class="ms-3 text-emerald-700 text-2xl font-bold hidden md:block lg:block">FUTU</span>
                </div>
                <p class="text-lg hidden md:block lg:block">Please create an account to continue!</p>
                <span class="ms-3 text-emerald-700 text-2xl font-bold md:hidden lg:hidden sm:block">FUTU</span>
            </div>

            <!-- form body -->

            <?php if (isset($unmatchPassword)) : ?>
                <div class="bg-rose-700 text-white">
                    <?= $unmatchPassword ?>
                </div>
            <?php endif ?>

            <div class="login-body mt-8">
                <form method="post" class="mb-3" enctype="multipart/form-data">
                    <div class="flex gap-5">
                        <div class="w-full">
                            <div class="my-3">
                                <label for="name" class="label">Enter Username *</label>
                                <input class="input input-focus effect-3 w-full" type="text" name="username" id="name" value="<?php if (isset($username)) echo $username ?>">
                                <span class="text-red-600 mt-3 text-lg font-semibold">
                                    <?php if (isset($name_error)) echo $name_error ?>
                                </span>
                            </div>
                            <div class="my-3">
                                <label for="email" class="label">Enter email *</label>
                                <input class="input input-focus effect-3 w-full" type="email" name="email" id="email" value="<?php if (isset($email)) echo $email ?>">
                                <span class="text-red-600 mt-3 text-lg font-semibold">
                                    <?php if (isset($email_error)) echo $email_error ?>
                                </span>
                            </div>
                            <div class="my-3">
                                <label for="password" class="label">Enter Password *</label>
                                <input class="input input-focus effect-3 w-full" type="password" name="password" id="password" value="<?php if (isset($password)) echo $password ?>">
                                <span class="text-red-600 mt-3 text-lg font-semibold">
                                    <?php if (isset($password_error)) echo $password_error ?>
                                </span>
                            </div>
                            <div class="my-3">
                                <label for="c_password" class="label">Confirm Password *</label>
                                <input class="input input-focus effect-3 w-full" type="password" name="c_password" id="c_password" value="<?php if (isset($c_password)) echo $c_password ?>">
                                <span class="text-red-600 mt-3 text-lg font-semibold">
                                    <?php if (isset($c_password_error)) echo $c_password_error ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="my-3">
                                <label for="address" class="label">Enter Address *</label>
                                <input class="input input-focus effect-3 w-full" type="text" name="address" id="address" value="<?php if (isset($address)) echo $address ?>">
                                <span class="text-red-600 mt-3 text-lg font-semibold">
                                    <?php if (isset($address_error)) echo $address_error ?>
                                </span>
                            </div>
                            <div class="my-3">
                                <label for="birthdate" class="label">Your Birthdate *</label>
                                <input class="input input-focus effect-3 w-full" type="date" name="birthdate" id="birthdate">
                                <span class=" text-red-600 mt-3 text-lg font-semibold">
                                    <?php if (isset($birthdate_error)) echo $birthdate_error ?>
                                </span>
                            </div>
                            <div class="my-3">
                                <label for="profilepicture" class="label">Your Profile Picture *</label>
                                <input class="input input-focus effect-3 w-full" type="file" name="profilepicture" id="profilepicture">
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 flex lg:flex-row md:flex-row sm:flex-col justify-between items-center">
                        <span class="label">
                            Already have an account? <a href="./signup.php" class="text-emerald-700 underline underline-offset-4">LOGIN</a>
                        </span>
                        <button name="register" class="btn btn-hover btn-focus effect-3 shadow-inner lg:mt-0 md:mt-0 sm:mt-5">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="../fontawesome/js/fontawesome.min.js"></script>
</body>

</html>