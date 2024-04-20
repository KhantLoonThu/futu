<?php
session_start();

use User\Controller\Customer\CustomerController;

// include_once "../../user_controllers/customerController.php";
include_once "./user_controllers/customerController.php";

$customer_controller = new CustomerController();
// $userEmail = $_SESSION['email'];

// $currentUser = $customer_controller->getCustomer($userEmail);

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location:login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futu Admin Dashbord</title>
    <link rel="shortcut icon" href="../public/images/duck.svg" type="image/x-icon">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../public/style.css">
</head>

<body class="dark overflow-x-hidden bg-gray-200">

    <!-- header page -->
    <!-- <div class="w-full  bg-white text-black dark:bg-primary dark:text-white"> -->
    <!-- navbar -->
    <nav class="w-full px-20 flex justify-between items-center pb-2 bg-slate-700 text-white mx-auto relative">
        <!-- navbar brand -->
        <a href="./" class="flex items-center">
            <span class="ms-5 text-4xl font-semibold">FUTU</span>
        </a>

        <!-- navbar links -->
        <ul class="flex items-center">
            <li class="relative px-12"><a class="text-lg" href="./">Home</a><span class="absolute -bottom-3 left-0 w-0 h-1 bg-blue-400 transition-all mx-auto duration-500"></span></li>
            <li class="relative px-12"><a class="text-lg" href="./#features">Features</a><span class="absolute -bottom-3 left-0 w-0 h-1 bg-blue-400 transition-all mx-auto duration-500"></span></li>
            <li class="relative px-12"><a class="text-lg" href="./products.php">Products</a><span class="absolute -bottom-3 left-0 w-0 h-1 bg-blue-400 transition-all mx-auto duration-500"></span></li>
            <li class="relative px-12"><a class="text-lg" href="./#about-us">About Us</a><span class="absolute -bottom-3 left-0 w-0 h-1 bg-blue-400 transition-all mx-auto duration-500"></span></li>
        </ul>

        <button class="cart relative cursor-pointer flex justify-center items-center  effect-3 rounded-full w-16 h-16 p-2">
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
            <span class="totalCartItem">
                0
            </span>
        </button>
    </nav>
    <!-- cart -->
    <div class="overlay min-w-full h-screen bg-gray-400 z-40 absolute top-0 left-0 bg-opacity-60 hidden"></div>

    <div class="sidebar-cart w-1/3 h-screen p-0 z-50 bg-gray-50 shadow-2xl text-black absolute top-0 right-hide transition-all ease-in-out duration-1000">
        <!-- header part -->
        <div class="px-6 py-3 border-b border-white flex justify-between items-center">
            <h2 class="text-xl font-semibold">Shopping Cart</h2>
            <div class="close cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
        </div>

        <!-- body part -->
        <div class="cart-body w-full h-[calc(100%-40%)]">
            <h2 class="text-lg">No products in the cart</h2>
        </div>

        <!-- footer part -->
        <div class="cart-footer px-6 mb-10">
            <button class="continue-shopping-btn w-full !py-4 user-btn bg-blue-400 text-black">Continue Shopping</button>
        </div>
    </div>


    <!-- Product Page -->
    <main class="w-full px-12 mx-10 products flex justify-between mt-16">
        <section class="category-section w-1/4">

            <div class="my-3 flex ">
                <input type="text" placeholder="Search products..." class="search-input py-2 px-3 border border-gray-400 focus:outline-none focus:border-gray-700">
                <button class="search-btn py-2 px-4 effect-3 bg-blue-600 text-white border-2 border-blue-600 text-lg font-semibold hover:bg-white hover:border-2 hover:border-blue-600 hover:text-blue-600">Search</button>
            </div>

            <h2 class="text-gray-500 text-3xl font-semibold">Categories</h2>

            <ul class="category-list mt-5">

            </ul>

        </section>
        <section class="products-section w-3/4 border-l-2 border-l-gray-300 mx-10 px-10">
            <h2 class="text-gray-500 mt-5"><a href="./index.php">Home</a> / <span class="currentLocation"></span></h2>

            <div class="product-list">

            </div>

        </section>
    </main>


    <!-- </div> -->



    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../public/user.js"></script>
    <script src="./products.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>