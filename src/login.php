<?php
session_start();

include_once "./user_controllers/customerController.php";
$customer_controller = new CustomerController();

if (isset($_POST['login'])) {
    $error = false;
    // email
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $error = true;
        $email_error = "Please Enter Your Email";
    }

    // password
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $error = true;
        $password_error = "Please Enter Your Password";
    }

    if ($error == false) {
        $currentUser = $customer_controller->getCustomer($email);
        if ($currentUser['password'] !== $password or $currentUser['email'] !== $email) {
            $password_error = "Incorrect Password or Email";
        } else {
            $_SESSION['email'] = $email;
            $password_error = "";
            header("location:index.php");
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futu - Login Page</title>
    <link rel="shortcut icon" href="../public/images/duck.svg" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../public/style.css">
</head>

<body>

    <section class="flex justify-center items-center w-full h-screen bg-gray-100">
        <div class="mt-16 max-w-xl w-full mx-auto border border-emerald-700 rounded-2xl px-12 py-12 shadow-zinc-400 shadow-lg bg-white">
            <div class="login-header flex justify-between items-center border-b border-gray-400 pb-8">
                <div class="flex items-center">
                    <img src="../public/images/duck.svg" class="w-10" alt="duck_kitkit">
                    <span class="ms-3 text-emerald-700 text-2xl font-bold hidden md:block lg:block">FUTU</span>
                </div>
                <p class="text-lg hidden md:block lg:block">Please log in to continue!</p>
                <span class="ms-3 text-emerald-700 text-2xl font-bold md:hidden lg:hidden sm:block">FUTU</span>
            </div>

            <!-- form body -->
            <div class="login-body mt-8">
                <div class="my-10 rounded-lg w-full bg-red-400">
                    <span>
                        <?php
                        if (isset($password_error) and $password_error == "Incorrect Password or Email") {
                            echo $password_error;
                        }
                        ?>
                    </span>
                </div>
                <form action="" class="mb-3" method="post">
                    <div class="my-3">
                        <label for="name" class="label">Enter Email</label>
                        <input class="input input-focus effect-3 w-full" type="text" name="email" id="name">
                        <span class="text-red-700 py-3 mt-3 text-lg">
                            <?php if (isset($email_error)) echo $email_error ?>
                        </span>
                    </div>
                    <div class="my-3">
                        <label for="password" class="label">Enter Password</label>
                        <input class="input input-focus effect-3 w-full" type="password" name="password" id="password">
                        <span class="text-red-700 py-3 mt-3 text-lg">
                            <?php if (isset($password_error) and $password_error == "Please Enter Your Password") echo $password_error ?>
                        </span>
                    </div>
                    <div class="mt-8 flex lg:flex-row md:flex-row sm:flex-col justify-between items-center">
                        <span class="label">
                            Don't have an account? <a href="./signup.php" class="text-emerald-700 underline underline-offset-4">SIGNUP</a>
                        </span>
                        <button name="login" class="btn btn-hover btn-focus effect-3 shadow-inner lg:mt-0 md:mt-0 sm:mt-5">
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="../fontawesome/js/fontawesome.min.js"></script>
</body>

</html>