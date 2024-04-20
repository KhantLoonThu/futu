<?php

use User\Controller\Customer\CustomerController;

session_start();

include_once __DIR__ . "/user_controllers/customerController.php";

// include_once ._DIR_. "./user_controllers/customerController.php";
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

<!-- <h2 class="text-4xl">
        Welcome <?php // echo $currentUser['name'] 
                ?>
    </h2> -->
<!-- <form action="" method="post">
        <button name="logout" class="btn btn-hover btn-focus effect-3">

            logout

        </button>
    </form> -->

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

<body class="dark">



    <!-- header page -->
    <header class="w-full h-screen relative overflow-x-hidden bg-white text-black dark:bg-primary dark:text-white">
        <!-- navbar -->
        <nav class="z-40 w-full h-[calc(100vh-90vh)] px-20 bg-slate-700 flex justify-between items-center pb-2 mx-auto text-white">
            <!-- navbar brand -->
            <a href="./" class="flex items-center">
                <span class="ms-5 text-4xl font-semibold text-white">FUTU</span>
            </a>

            <!-- navbar links -->
            <ul class="flex items-center">
                <li class="relative px-12"><a class="text-lg" href="./">Home</a><span class="absolute -bottom-3 left-0 w-0 h-1 bg-blue-400 transition-all mx-auto duration-500"></span></li>
                <li class="relative px-12"><a class="text-lg" href="#features">Features</a><span class="absolute -bottom-3 left-0 w-0 h-1 bg-blue-400 transition-all mx-auto duration-500"></span></li>
                <li class="relative px-12"><a class="text-lg" href="./products.php">Products</a><span class="absolute -bottom-3 left-0 w-0 h-1 bg-blue-400 transition-all mx-auto duration-500"></span></li>
                <li class="relative px-12"><a class="text-lg" href="#about-us">About Us</a><span class="absolute -bottom-3 left-0 w-0 h-1 bg-blue-400 transition-all mx-auto duration-500"></span></li>
            </ul>

            <button class="cart cursor-pointer flex justify-center items-center text-white  effect-3 rounded-full w-16 h-16 p-2">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </button>
        </nav>

        <div class="">
            <div class="">
                <!-- <spline-viewer class="" url="https://prod.spline.design/eOPmYsyAYnOn63wH/scene.splinecode"></spline-viewer> -->
                <spline-viewer class="h-[calc(100vh-10vh)]" url="https://prod.spline.design/eOPmYsyAYnOn63wH/scene.splinecode"></spline-viewer>
            </div>
            <!-- Discount -->
            <div></div>
        </div>

        <!-- cart -->
        <div class="sidebar-cart h-screen w-1/3 p-0 z-40 bg-gray-200 text-black absolute top-0 right-hide transition-all ease-in-out duration-1000">
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
            <div class="cart-body flex justify-center items-center w-full h-[calc(100%-18%)]">
                <h2 class="text-lg">No products in the cart</h2>
            </div>

            <!-- footer part -->
            <div class="px-6 mb-10">
                <button class="w-full !py-4 user-btn bg-blue-400 text-black">Continue Shopping</button>
            </div>
        </div>
    </header>

    <!-- Kit Kit Write Here -->
    <section id="features" class="feature-page">


        <!-- Favouites -->
        <div></div>


        <!-- Flash Sales -->
        <div></div>


        <!-- Just For You -->
        <div></div>


    </section>
    <!-- End of Kit Kit -->

    <!-- about us page -->
    <section id="about-us" class="about max-w-screen-xl mx-auto py-6">
        <h2 class="text-center font-bold text-2xl my-5">What you can know about us!</h2>
        <div class="flex flex-col items-center h-full">
            <div class="w-full flex justify-between items-center gap-16">
                <div data-aos="fade-right" data-aos-duration="500" class="w-1/3 object-cover">
                    <img src="../public/about.png" alt="about us image">
                </div>
                <div data-aos="fade-left" data-aos-duration="500" class="w-2/3 text-black py-16">
                    <div>
                        <h3 class="text-blue-600 text-xl font-semibold">Cultivating Excellence in E-commerce</h3>
                        <p class="mt-1 text-lg font-semibold">
                            At <span class="text-lg text-blue-400 font-semibold">FUTU</span>, we're dedicated to providing unparalleled service and exceptional products to our valued customers.
                        </p>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-blue-600 text-xl font-semibold">Our Journey</h3>
                        <p class="mt-1 text-lg font-semibold">
                            Founded with a vision to revolutionize the online shopping experience, <span class="text-lg text-blue-400 font-semibold">FUTU</span> has embarked on a journey driven by innovation, customer satisfaction, and a passion for excellence.
                        </p>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-blue-600 text-xl font-semibold">Our Mission</h3>
                        <p class="mt-1 text-lg font-semibold">
                            Our mission is to exceed customer expectations by offering a diverse selection of high-quality products, seamless shopping experiences, and personalized support, ensuring every interaction with us is nothing short of extraordinary.
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-between items-center gap-16 mt-2">
                <div data-aos="fade-right" data-aos-duration="500" class="w-2/3 text-black py-16">
                    <div>
                        <h3 class="text-blue-600 text-xl font-semibold">Commitment to Quality</h3>
                        <p class="mt-1 text-lg font-semibold">
                            We take pride in curating only the finest products from trusted brands and artisans, prioritizing quality, sustainability, and ethical practices every step of the way.
                        </p>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-blue-600 text-xl font-semibold">Customer-Centric Approach</h3>
                        <p class="mt-1 text-lg font-semibold">
                            At the heart of our business is a commitment to putting our customers first. We strive to build lasting relationships by actively listening to feedback, anticipating needs, and delivering solutions that enrich lives.
                        </p>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-blue-600 text-xl font-semibold">Join Us</h3>
                        <p class="mt-1 text-lg font-semibold">
                            Join us on our journey as we continue to innovate, inspire, and elevate the e-commerce landscape, one exceptional experience at a time.
                        </p>
                    </div>
                </div>
                <div data-aos="fade-left" data-aos-duration="500" class="w-1/3 object-cover">
                    <img src="../public/about-2.png" alt="about us image">
                </div>
            </div>
        </div>
    </section>

    <!-- comment page -->
    <section class="comment max-w-screen-xl mx-auto py-6 mb-6">
        <h2 class="text-center font-bold text-2xl mb-16">Write A Feedback!</h2>
        <div class="flex justify-between items-center">
            <div class="w-5/6">

                <div>
                    <form action="" class="w-full flex flex-col">
                        <div class="flex mb-5">
                            <div class="flex-1 mr-2">
                                <input class="py-3 px-4 border-2 border-gray-300 focus:ring-4 focus:ring-gray-400 focus:outline-none focus:border-none effect-3 w-full" type="text" name="username" id="username" placeholder="Name">
                            </div>
                            <div class="flex-1 ml-2">
                                <input class="py-3 px-4 border-2 border-gray-300 focus:ring-4 focus:ring-gray-400 focus:outline-none focus:border-none effect-3 w-full" type="email" name="email" id="email" placeholder="Email">
                            </div>
                        </div>
                        <textarea class="py-3 px-4 border-2 border-gray-300 focus:ring-4 focus:ring-gray-400 focus:outline-none focus:border-none effect-3 w-full" name="feedback" id="feedback" cols="40" rows="10" placeholder="Enter your feedback here..."></textarea>
                        <div class="mt-4">
                            <button class="py-4 px-6 bg-blue-600 text-white" name="send">Send Feedback</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-1/6 flex flex-col justify-center items-center mb-8">
                <h2 class="text-center mb-10">Share</h2>
                <div class="flex justify-center items-center rounded-full cursor-pointer w-16 h-16 shadow-2xl mb-3 hover:scale-110">
                    <i class="fa-brands text-xl fa-facebook-f" style="color: #1877F2"></i>
                </div>
                <div class="flex justify-center items-center rounded-full cursor-pointer w-16 h-16 shadow-2xl mb-3 hover:scale-110">
                    <i class="fa-brands text-xl fa-twitter" style="color: #1DA1F2"></i>
                </div>
                <div class="flex justify-center items-center rounded-full cursor-pointer w-16 h-16 shadow-2xl mb-3 hover:scale-110">
                    <i class=" fa-brands text-xl fa-instagram instagram"></i>
                </div>
                <div class="flex justify-center items-center rounded-full cursor-pointer w-16 h-16 shadow-2xl mb-3 hover:scale-110">
                    <i class="fa-brands text-xl fa-linkedin" style="color: #000"></i>
                </div>
            </div>
        </div>
    </section>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.0.91/build/spline-viewer.js"></script>
    <script type="module" src="spline.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../public/user.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>