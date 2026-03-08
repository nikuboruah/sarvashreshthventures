<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= PROJECT_NAME ?></title>

    <!-- ========== Favicon ========== -->
    <link rel="shortcut icon" href="<?= base_url('') ?>assets/images/favicon.png" type="image/x-icon" />

    <!-- ========== Google Fonts ========== -->
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&amp;display=swap"
        rel="stylesheet" />

    <!-- ========== Huge Icons CSS ========== -->
    <link rel="stylesheet" href="<?= base_url('') ?>assets/css/vendor/hugeicons/hgi-stroke-rounded.css" />

    <!-- ========== Slick CSS ========== -->
    <link rel="stylesheet" href="<?= base_url('') ?>assets/css/vendor/slick.min.css" />

    <!-- ========== Nice Select CSS ========== -->
    <link rel="stylesheet" href="<?= base_url('') ?>assets/css/vendor/nice-select.css" />

    <!-- ========== Animate CSS ========== -->
    <link rel="stylesheet" href="<?= base_url('') ?>assets/css/vendor/animate.min.css" />

    <!-- ========== Custom CSS ========== -->
    <link rel="stylesheet" href="<?= base_url('') ?>assets/css/style.css" />
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader" class="preloader">
        <div class="pxl-loader-spinner">
            <div class="pxl-loader-bounce1"></div>
            <div class="pxl-loader-bounce2"></div>
            <div class="pxl-loader-bounce3"></div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Overlay Start -->
    <div data-overlay-for class="modal-overlay hidden w-full h-screen fixed top-0 left-0 bg-[#161C247A] z-90"></div>
    <!-- Overlay End -->

    <!-- Scroll To Top Button Start -->
    <button
        class="scroll-to-top hide btn btn-primary size-10 rounded-[50px] z-50 inline-flex items-center justify-center fixed md:right-8 md:bottom-8 right-[15px] bottom-[85px] transition-all duration-400 ease-in-out">
        <i class="hgi hgi-stroke hgi-arrow-up-01 leading-6 text-2xl"></i>
    </button>
    <!-- Scroll To Top Button End -->

    <!-- SIDEBAR START -->
    <div class="fixed top-0 left-0 w-[350px] bg-white h-full z-91 px-4 py-6 flex flex-col justify-between gap-y-6 overflow-y-auto shadow-dark-z-24 transition-all duration-250 ease-[cubic-bezier(0.645,0.045,0.355,1)] data-[state=open]:translate-x-0 data-[state=open]:opacity-100 data-[state=open]:visible data-[state=close]:-translate-x-[200px] data-[state=close]:opacity-0 data-[state=close]:invisible"
        id="sidebar" data-state="close">
        <div>
            <div class="relative pb-6">
                <img src="<?= base_url('') ?>assets/images/logo.png" alt="Logo" style="height: 50px;" />
                <button
                    class="size-7 inline-flex items-center justify-center absolute top-0 right-0 rounded-full bg-[rgba(145,158,171,0.08)]"
                    id="side-bar-menu-close">
                    <i class="hgi hgi-stroke hgi-multiplication-sign text-xl leading-5"></i>
                </button>
            </div>

            <div class="flex flex-col gap-y-6">
                <nav class="mobile-menu">
                    <ul>
                        <li>
                            <a class="<?= $PAGE == 'Home' ? 'active' : '' ?>" href="<?= base_url("/") ?>">Home</a>
                        </li>
                        <li>
                            <a class="<?= $PAGE == 'About' ? 'active' : '' ?>" href="<?= base_url("about") ?>">About
                                Us</a>
                        </li>
                        <li>
                            <a class="<?= $PAGE == 'Products' ? 'active' : '' ?>"
                                href="<?= base_url("products") ?>">Products</a>
                        </li>
                        <li>
                            <a class="<?= $PAGE == 'Franchise' ? 'active' : '' ?>"
                                href="<?= base_url("/") ?>">Franchise</a>
                        </li>
                        <li>
                            <a class="<?= $PAGE == 'Gallery' ? 'active' : '' ?>"
                                href="<?= base_url("gallery") ?>">Gallery</a>
                        </li>
                        <li>
                            <a class="<?= $PAGE == 'Documents' ? 'active' : '' ?>"
                                href="<?= base_url("documemts") ?>">Documents</a>
                        </li>
                        <li><a class="<?= $PAGE == 'Contact' ? 'active' : '' ?>"
                                href="<?= base_url("contact") ?>">Contact</a></li>
                    </ul>
                </nav>
                <div class="border border-gray-500/24 p-5 rounded-2xl">
                    <div class="flex flex-col gap-y-3">
                        <a href="<?=  base_url('user') ?>" class="flex items-center gap-x-2">
                            <span class="inline-flex items-center justify-center bg-warning size-8 rounded-full"><i
                                    class="hgi hgi-stroke hgi-lock-sync-01 text-base text-light-primary-text"></i>
                            </span>
                            log in
                        </a>

                        <a href="<?=  base_url('registration') ?>" class="flex items-center gap-x-2">
                            <span class="inline-flex items-center justify-center bg-warning size-8 rounded-full"><i
                                    class="hgi hgi-stroke hgi-registered text-base text-light-primary-text"></i>
                            </span>
                            Sign Up
                        </a>

                        <a href="tel:+919101145172" class="flex items-center gap-x-2">
                            <span class="inline-flex items-center justify-center bg-warning size-8 rounded-full">
                                <i class="hgi hgi-stroke hgi-call text-base text-light-primary-text"></i>
                            </span>
                            +91 910-114-5172
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="mb-3">Follow us</h4>
                    <ul class="flex items-center gap-x-4">
                        <li>
                            <a href="#" class="inline-flex items-center justify-center gap-x-2"><span
                                    class="size-8 bg-primary-dark inline-flex items-center justify-center rounded-full"><i
                                        class="hgi hgi-stroke hgi-facebook-01 text-base text-white"></i></span></a>
                        </li>
                        <li>
                            <a href="#" class="inline-flex items-center justify-center gap-x-2"><span
                                    class="size-8 bg-primary-dark inline-flex items-center justify-center rounded-full">
                                    <i class="hgi hgi-stroke hgi-instagram text-base text-white"></i> </span></a>
                        </li>
                        <li>
                            <a href="#"
                                class="inline-flex items-center justify-center gap-x-2 hover:translate-y-3"><span
                                    class="size-8 bg-primary-dark inline-flex items-center justify-center rounded-full">
                                    <i class="hgi hgi-stroke hgi-youtube text-base text-white"></i> </span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- SIDEBAR END -->



    <!-- ========== HEADER Section Start ========== -->
    <header>
        <!-- header-top start -->
        <div class="bg-primary header-top">
            <div class="container">
                <div class="flex items-center xl:justify-between justify-center">
                    <div class="xl:flex items-center gap-x-6 hidden">
                        <p class="flex items-center gap-x-2 text-white text-sm leading-[22px]">
                            <span><i class="hgi hgi-stroke hgi-customer-support text-xl text-white"></i>
                            </span>
                            Need Support ?
                            <span>Call Us</span>
                            <a href="tel:+919101145172"
                                class="bg-warning py-px px-2 text-xs leading-4.5 rounded-[60px] text-gray-800">+91
                                910-114-5172</a>
                        </p>

                    </div>
                    <div class="text-center py-3.5">
                        <p class="flex items-center gap-x-[7px] text-white text-sm leading-[22px] font-dm-sans">Welcome
                            To <?= PROJECT_NAME ?></p>
                    </div>

                    <div class="hidden xl:flex">
                        <ul class="flex items-center text-white">
                            <li>
                                <a href="to:info@sarvashreshthventures.com"
                                    class="text-sm leading-[22px] text-white py-3.5">info@sarvashreshthventures.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-top End -->

        <!-- header-middle Start -->
        <div class="py-4 border border-gray-300 xl:border-0 hidden xl:block header-middle">
            <div class="container">
                <!-- For Desktop Screen Start -->
                <div class="xl:flex items-center hidden">
                    <div>
                        <a href='<?= base_url('') ?>'>
                            <img src="<?= base_url('') ?>assets/images/logo.png" alt="Logo" style="height:80px;" />
                        </a>
                    </div>
                    <div class="flex items-center w-full justify-end gap-x-[54px]">
                        <div class="relative search-input-container w-full 2xl:max-w-[800px] xl:max-w-[600px]">



                        </div>

                        <div class="flex items-center gap-x-6 shrink-0">
                            <ul class="flex items-center gap-x-6">
                                <li class="flex items-center gap-x-4 cursor-pointer relative group">
                                    <p class="flex items-center">
                                        <span
                                            class="inline-flex items-center justify-center bg-warning w-12 h-12 rounded-full">
                                            <i
                                                class="hgi hgi-stroke hgi-lock-sync-01 text-2xl text-light-primary-text"></i>
                                        </span>
                                    </p>
                                    <p class="flex flex-col text-light-secondary-text text-sm leading-[22px]">
                                        Account
                                        <span
                                            class="text-base leading-6 text-light-primary-text"><?php if (!$this->session->userdata('aiplUserId')) { ?>log
                                            in<?php } else { ?>My Account<?php } ?></span>
                                    </p>
                                    <span><i
                                            class="hgi hgi-stroke hgi-arrow-down-01 text-2xl text-light-primary-text"></i></span>

                                    <ul
                                        class="absolute right-0 top-full py-2 z-10 w-[250px] max-w-[250px] bg-white rounded-lg shadow-dark-z-24 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
                                        <?php if (!$this->session->userdata('aiplUserId')) { ?>
                                        <li class="px-4 group/item">
                                            <a href="<?= base_url('user') ?>"
                                                class="flex items-center py-2 gap-x-2 relative text-light-primary-text group-hover/item:text-primary">
                                                <span
                                                    class="w-8 h-8 bg-[#F0F0F0] group-hover/item:bg-[rgba(0,171,85,0.08)] inline-flex items-center justify-center rounded-full">
                                                    <i
                                                        class="hgi hgi-stroke hgi-lock-sync-01 text-base text-light-primary-text group-hover/item:text-primary"></i>
                                                </span>
                                                Login
                                            </a>
                                        </li>
                                        <?php }else{ ?>
                                        <li class="px-4 group/item">
                                            <a href="<?= base_url('user') ?>"
                                                class="flex items-center py-2 gap-x-2 relative text-light-primary-text group-hover/item:text-primary">
                                                <span
                                                    class="w-8 h-8 bg-[#F0F0F0] group-hover/item:bg-[rgba(0,171,85,0.08)] inline-flex items-center justify-center rounded-full">
                                                    <i
                                                        class="hgi hgi-stroke hgi-user text-base text-light-primary-text group-hover/item:text-primary"></i>
                                                </span>
                                                My Dashboard
                                            </a>
                                        </li>
                                        <li class="px-4 group/item">
                                            <a href="#"
                                                class="flex items-center py-2 gap-x-2 relative text-light-primary-text group-hover/item:text-primary logout-button">
                                                <span
                                                    class="w-8 h-8 bg-[#F0F0F0] group-hover/item:bg-[rgba(0,171,85,0.08)] inline-flex items-center justify-center rounded-full">
                                                    <i
                                                        class="hgi hgi-stroke hgi-lock text-base text-light-primary-text group-hover/item:text-primary"></i>
                                                </span>
                                                Logout
                                            </a>
                                        </li>
                                        <?php } ?>
                                        <li class="px-4 group/item">
                                            <a href="<?=  base_url('registration') ?>"
                                                class="flex items-center py-2 gap-x-2 relative text-light-primary-text group-hover/item:text-primary">
                                                <span
                                                    class="w-8 h-8 bg-[#F0F0F0] group-hover/item:bg-[rgba(0,171,85,0.08)] inline-flex items-center justify-center rounded-full">
                                                    <i
                                                        class="hgi hgi-stroke hgi-id text-base text-light-primary-text group-hover/item:text-primary"></i>
                                                </span>
                                                Register
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                <?php
                                    $userid = $userid = $this->session->userdata('aiplUserId');
                                    $count_cart = $this->Crud->ciCount("cart_master", "`user_id` = '$userid' and `status` = '0'");
                                ?>
                                <li class="flex items-center">
                                    <a href="<?php echo base_url('/cart') ?>"
                                        class="flex items-center gap-x-4 cursor-pointer">
                                        <span
                                            class="inline-flex items-center justify-center bg-warning w-12 h-12 rounded-full"><i
                                                class="hgi hgi-stroke hgi-shopping-cart-02 text-2xl text-light-primary-text"></i>
                                        </span>
                                        <span
                                            class="flex flex-col items-start text-sm leading-[22px] text-light-secondary-text">
                                            Cart
                                            <span class="text-base leading-6 text-light-primary-text"><?= $count_cart ?>
                                                - Items</span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- FOr Desktop Screen End -->
            </div>
        </div>
        <!-- header-middle End -->

        <!-- Mobile Menu Start -->
        <div class="border border-gray-300 xl:border-0 sticky-header">
            <div class="pb-4 pt-3 block xl:hidden">
                <div class="container">
                    <div class="flex justify-between items-center">
                        <div>
                            <button class="btn btn-default outline shadow-none size-12 rounded-[50px]"
                                id="sidebar-menu-btn">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 12L10 12" stroke="#212529" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M20 5L4 5" stroke="#212529" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M20 19L4 19" stroke="#212529" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        <div>
                            <a href='<?= base_url('') ?>'>
                                <img src="<?= base_url('') ?>assets/images/logo.png" alt="Logo"
                                    class="w-[180px] md:w-[150px]" />
                            </a>
                        </div>
                        <div class="xl:hidden flex items-center gap-x-4">
                            <a href="<?php echo base_url('cart') ?>" class="btn bg-warning-light size-12 rounded-[50px]">
                                <i
                                    class="hgi hgi-stroke hgi-shopping-cart-01 text-light-primary-text text-2xl leading-6"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu End -->

        <!-- header-bottom End -->
        <div class="border border-gray-300 hidden xl:flex header-bottom sticky-header border-r-0 border-l-0">
            <div class="container">
                <div class="hidden relative items-center justify-between xl:flex">
                    <div class="relative">
                        <button class="btn btn-primary btn-large rounded-lg" id="dropdownButton" data-state="close">
                            <span class="inline-flex items-center">
                                <i class="hgi hgi-stroke hgi-grid-view text-base text-white"></i>
                            </span>
                            Explore All Categories
                            <span class="inline-flex items-center" id="dropdownIcon"><i
                                    class="hgi hgi-stroke hgi-arrow-down-01 text-xl text-white"></i>
                            </span>
                        </button>
                        <?php
                            $product_category = $this->Crud->ciRead("category_master", "`status`  = '1' AND `category_id` != '1' LIMIT 10 ");
                        ?>
                        <div>
                            <ul id="dropdownMenu"
                                class="bg-white hide shadow-dark-z-24 rounded-b-2xl px-4 py-4 z-40 transform origin-top transition-all duration-300 ease-in-out absolute left-0 top-full w-full divide-y divide-[rgba(145,158,171,0.24)]">
                                <li class="py-[9px] group">
                                    
                                    <a href="<?= base_url('products') ?>"
                                        class="flex items-center gap-x-2 relative text-light-primary-text group-hover:text-primary">
                                        <i class="hgi hgi-stroke hgi-square-arrow-right-02"></i>
                                        All Category
                                    </a>
                                </li>
                                <?php foreach( $product_category as $cat){ ?>
                                <li class="py-[9px] group">
                                    
                                    <a href="<?= base_url('category-products/'.$cat->category_id) ?>"
                                        class="flex items-center gap-x-2 relative text-light-primary-text group-hover:text-primary">
                                        <i class="hgi hgi-stroke hgi-square-arrow-right-02"></i>
                                        <?= $cat->category_name ?>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <nav class="main-menu">
                        <ul>
                            <li>
                                <a class="<?= $PAGE == 'Home' ? 'active' : '' ?>" href="<?= base_url("/") ?>">Home </a>
                            </li>

                            <li>
                                <a class="<?= $PAGE == 'About' ? 'active' : '' ?>" href="<?= base_url('about') ?>">About
                                    Us </a>
                            </li>
                            <li>
                                <a class="<?= $PAGE == 'Products' ? 'active' : '' ?>"
                                    href="<?= base_url("products") ?>">Products </a>
                            </li>
                            <li>
                                <a class="<?= $PAGE == 'Franchise' ? 'active' : '' ?>" href="#">Franchise </a>
                            </li>
                            <li>
                                <a class="<?= $PAGE == 'Documents' ? 'active' : '' ?>"
                                    href="<?= base_url('documents') ?>">Documents </a>
                            </li>
                            <li>
                                <a class="<?= $PAGE == 'Gallery' ? 'active' : '' ?>"
                                    href="<?= base_url('gallery') ?>">Gallery </a>
                            </li>
                            <li>
                                <a class="<?= $PAGE == 'Contact' ? 'active' : '' ?>"
                                    href="<?= base_url('contact') ?>">Contact </a>
                            </li>
                        </ul>
                    </nav>
                    <div>
                        <p class="xl:flex lg:items-center gap-x-4 hidden">
                            <span
                                class="size-12 inline-flex items-center justify-center rounded-full transition-colors duration-300 bg-[rgba(145,158,171,0.08)]">
                                <i class="hgi hgi-stroke hgi-customer-support text-2xl text-light-primary-text"></i>
                            </span>
                            <span class="flex flex-col text-sm leading-[22px]">
                                24/7 Support
                                <span class="text-base leading-6 text-light-primary-text">+91 910-114-5172</span>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-bottom End -->
    </header>
    <!-- ========== HEADER Section End ========== -->