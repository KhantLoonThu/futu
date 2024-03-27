<?php

include_once "./controllers/userController.php";

// $usercontroller = new UserController();

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

    if (!$error) {
        if (!($password == $c_password)) {
            $unmatchPassword = "Unmatch Password! Please enter the password again!";
        } else {
            $unmatchPassword = '';
            $alreadyExist = $usercontroller->getUserValid($email);
            if ($alreadyExist['total'] > 0) {
                echo "<script> alert('user already exist') </script>";
            } else {
                $usercontroller->putUser($username, $email, $password);
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

    <section class="flex justify-center items-center w-full h-screen mb-16">
        <div class="mt-16 max-w-xl w-full mx-auto border border-emerald-700 rounded-2xl px-12 py-12 shadow-zinc-400 shadow-lg bg-white">
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
                <form method="post" class="mb-3">
                    <div class="my-3">
                        <label for="name" class="label">Enter Username *</label>
                        <input class="input input-focus effect-3" type="text" name="username" id="name" value="<?php if (isset($username)) echo $username ?>">
                        <span class="text-red-600 mt-3 text-lg font-semibold">
                            <?php if (isset($name_error)) echo $name_error ?>
                        </span>
                    </div>
                    <div class="my-3">
                        <label for="email" class="label">Enter email *</label>
                        <input class="input input-focus effect-3" type="email" name="email" id="email" value="<?php if (isset($email)) echo $email ?>">
                        <span class="text-red-600 mt-3 text-lg font-semibold">
                            <?php if (isset($email_error)) echo $email_error ?>
                        </span>
                    </div>
                    <div class="my-3">
                        <label for="password" class="label">Enter Password *</label>
                        <input class="input input-focus effect-3" type="password" name="password" id="password" value="<?php if (isset($password)) echo $password ?>">
                        <span class="text-red-600 mt-3 text-lg font-semibold">
                            <?php if (isset($password_error)) echo $password_error ?>
                        </span>
                    </div>
                    <div class="my-3">
                        <label for="c_password" class="label">Confirm Password *</label>
                        <input class="input input-focus effect-3" type="password" name="c_password" id="c_password" value="<?php if (isset($c_password)) echo $c_password ?>">
                        <span class="text-red-600 mt-3 text-lg font-semibold">
                            <?php if (isset($c_password_error)) echo $c_password_error ?>
                        </span>
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