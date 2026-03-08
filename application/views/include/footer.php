 <!-- ========== Footer Section Start ========== -->
 <footer class="md:pb-15 pb-[100px] bg-primary-darker pt-40 xl:rounded-tr-[22px] xl:rounded-tl-[22px]">
     <div class="container">
         <!-- ========== Footer Top Section Start ========== -->
         <div class="pb-9 grid grid-cols-12 gap-6">
             <div class="md:col-span-12 col-span-12 xl:col-span-3 flex flex-col gap-y-6 wow animate__animated animate__fadeInUp"
                 data-wow-delay=".2s">
                 <div class="bg-white rounded-xl">
                     <a href='<?= base_url('') ?>'>
                         <img src="<?= base_url('') ?>assets/images/logo.png" alt="logo" />
                     </a>
                 </div>
                 <p class="text-primary-lighter text-base">
                     SARVASHRESHTH VENTURES PRIVATE LIMITED started its business on 10th October, 2023.
                     SARVASHRESHTH VENTURES is a leading direct selling company that provides a wide range
                     of innovative and quality products to our consumers market in health care, beauty care,
                     personal care, Ayurveda Product, Home care, Agro, FMCG, and many more. From day one,
                     Our Company is receiving overwhelming support from our consumers. The Company is
                     established and has a Registered Office in Guwahati, Assam.
                 </p>
                 <div class="flex flex-wrap gap-x-4 gap-y-4">
                     <a class="inline-flex items-center justify-center size-10 rounded-full bg-[rgba(145,158,171,0.16)]"
                         href="#">
                         <i class="hgi hgi-stroke hgi-facebook-01 text-2xl text-white"></i>
                     </a>
                     <a class="inline-flex items-center justify-center size-10 rounded-full bg-[rgba(145,158,171,0.16)]"
                         href="#"><i class="hgi hgi-stroke hgi-instagram text-2xl text-white"></i>
                     </a>
                 </div>
             </div>
             <div class="md:col-span-6 col-span-12 xl:col-span-3 wow animate__animated animate__fadeInUp"
                 data-wow-delay=".3s">
                 <h5 class="text-primary-lighter pb-6 border-b border-[rgba(145,158,171,0.24)]">
                     About
                 </h5>
                 <ul class="flex flex-col gap-y-1.5 pt-4">
                     <li class="py-1.5 flex items-center gap-x-2">
                         <span class="inline-flex items-center"><i
                                 class="hgi hgi-stroke hgi-arrow-right-01 text-xl text-primary-lighter"></i>
                         </span>
                         <a class='text-primary-lighter font-semibold hover:underline' href='<?= base_url('about') ?>'>About Us</a>
                     </li>
                     
                     <li class="py-1.5 flex items-center gap-x-2">
                         <span class="inline-flex items-center"><i
                                 class="hgi hgi-stroke hgi-arrow-right-01 text-xl text-primary-lighter"></i>
                         </span>
                         <a href="<?= base_url('gallery') ?>" class="text-primary-lighter font-semibold hover:underline">Gallery</a>
                     </li>
                     <li class="py-1.5 flex items-center gap-x-2">
                         <span class="inline-flex items-center"><i
                                 class="hgi hgi-stroke hgi-arrow-right-01 text-xl text-primary-lighter"></i>
                         </span>
                         <a class='text-primary-lighter font-semibold hover:underline' href='<?= base_url('contact') ?>'>Contact
                             Us</a>
                     </li>
                     <li class="py-1.5 flex items-center gap-x-2">
                         <span class="inline-flex items-center"><i
                                 class="hgi hgi-stroke hgi-arrow-right-01 text-xl text-primary-lighter"></i>
                         </span>
                         <a href="<?= base_url('terms_and_condition') ?>" class="text-primary-lighter font-semibold hover:underline">Terms &
                             Conditions</a>
                     </li>
                     <li class="py-1.5 flex items-center gap-x-2">
                         <span class="inline-flex items-center"><i
                                 class="hgi hgi-stroke hgi-arrow-right-01 text-xl text-primary-lighter"></i>
                         </span>
                         <a href="<?= base_url('privacy_policy') ?>" class="text-primary-lighter font-semibold hover:underline">Privacy Policy</a>
                     </li>
                 </ul>
             </div>

             <?php
                $category = $this->Crud->ciRead("category_master", "`status`  = '1' AND `category_id` != '1' LIMIT 5 ");
             ?>
             
             <div class="md:col-span-6 col-span-12 xl:col-span-3 wow animate__animated animate__fadeInUp"
                 data-wow-delay=".5s">
                 <h5 class="text-primary-lighter pb-6 border-b border-[rgba(145,158,171,0.24)]">
                     Categories
                 </h5>
                 <ul class="flex flex-col gap-y-1.5 pt-4">
                    <?php foreach($category as $cat){ ?>
                     <li class="py-1.5 flex items-center gap-x-2">
                         <span class="inline-flex items-center"><i
                                 class="hgi hgi-stroke hgi-arrow-right-01 text-xl text-primary-lighter"></i>
                         </span>
                         <a href="<?= base_url('category-products/'.$cat->category_id) ?>" class="text-primary-lighter font-semibold hover:underline"><?= $cat->category_name ?></a>
                     </li>
                     <?php } ?>
                 </ul>
             </div>
             <div class="md:col-span-6 col-span-12 xl:col-span-3 wow animate__animated animate__fadeInUp"
                 data-wow-delay=".6s">
                 <h5 class="text-primary-lighter pb-6 border-b border-[rgba(145,158,171,0.24)]">
                     Contact Information's
                 </h5>
                 <ul class="flex flex-col gap-y-1.5 py-4">
                     <li class="flex items-center gap-x-3">
                         <span
                             class="size-10 inline-flex items-center justify-center rounded-full bg-[rgba(145,158,171,0.16)]"><i
                                 class="hgi hgi-stroke hgi-maps-global-01 text-2xl text-primary-lighter"></i>
                         </span>
                         <p class="text-primary-lighter font-semibold">
                             SARVASHRESHTH VENTURES PVT LTD H/No.267, Borbora Building, Near 2nd Bylane, Rajghar, GUWAHATI - 781003
                         </p>
                     </li>
                     <li class="flex items-center gap-x-3">
                         <span
                             class="size-10 inline-flex items-center justify-center rounded-full bg-[rgba(145,158,171,0.16)]"><i
                                 class="hgi hgi-stroke hgi-call text-2xl text-primary-lighter"></i>
                         </span>
                         <p class="text-primary-lighter font-semibold">
                             Call Us: (+91) 910-114-5172
                         </p>
                     </li>
                     <li class="flex items-center gap-x-3">
                         <span
                             class="size-10 inline-flex items-center justify-center rounded-full bg-[rgba(145,158,171,0.16)]"><i
                                 class="hgi hgi-stroke hgi-call text-2xl text-primary-lighter"></i>
                         </span>
                         <p class="text-primary-lighter font-semibold">
                             Call Us: (+91) 700-213-0845
                         </p>
                     </li>
                     <li class="flex items-center gap-x-3">
                         <span
                             class="size-10 inline-flex items-center justify-center rounded-full bg-[rgba(145,158,171,0.16)]"><i
                                 class="hgi hgi-stroke hgi-mail-02 text-2xl text-primary-lighter"></i>
                         </span>
                         <p class="text-primary-lighter font-semibold">
                             sarvashreshth23@gmail.com
                         </p>
                     </li>
                 </ul>
             </div>
         </div>
         <!-- ========== Footer Top Section End ========== -->

         <!-- ========== Footer Bottom Section Start ========== -->
         <div class="text-center text-white bg-[url('images/bottom-border.html')] pt-[22px] bg-center pb-px bg-no-repeat wow animate__animated animate__fadeInUp"
             data-wow-delay=".2s">
             <?= date('Y') ?> Copyright By Sarvashreshth Ventures Pvt. Ltd.
         </div>
         <!-- ========== Footer Bottom Section End ========== -->
     </div>
 </footer>
 <!-- ========== Footer Section End ========== -->

 <!-- Footer Bottom Nav Start -->
 <div class="w-full z-80 bg-white border-t border-gray-300 block md:hidden fixed bottom-0 left-0 pb-3">
     <div class="container">
         <ul class="flex items-center justify-between footer-bottom-nav -mt-px">
             <li class="group">
                 <a class='footer-bottom-nav-btn flex items-center flex-col gap-y-1 border-t-2 border-transparent text-sm leading-[22px] text-light-primary-text px-[9px] pt-2.5 pb-1 active'
                     href='<?= base_url('') ?>'><span class="inline-flex items-center justify-center">
                         <i
                             class="hgi hgi-stroke hgi-home-01 text-2xl leading-6 text-light-primary-text"></i></span>Home</a>
             </li>
             <li class="group">
                 <a class='footer-bottom-nav-btn flex items-center flex-col gap-y-1 border-t-2 border-transparent text-sm leading-[22px] text-light-primary-text px-[9px] pt-2.5 pb-1'
                     href='<?= base_url('') ?>'><span class="inline-flex items-center justify-center">
                         <i
                             class="hgi hgi-stroke hgi-package-moving text-2xl leading-6 text-light-primary-text"></i></span>Products</a>
             </li>
             <li class="group">
                 <a class='footer-bottom-nav-btn flex items-center flex-col gap-y-1 border-t-2 border-transparent text-sm leading-[22px] text-light-primary-text px-[9px] pt-2.5 pb-1'
                     href='<?= base_url('registration') ?>'><span class="inline-flex items-center justify-center">
                         <i
                             class="hgi hgi-stroke hgi-registered text-2xl leading-6 text-light-primary-text"></i></span>Register</a>
             </li>
             <li class="group">
                 <a class='footer-bottom-nav-btn flex items-center flex-col gap-y-1 border-t-2 border-transparent text-sm leading-[22px] text-light-primary-text px-[9px] pt-2.5 pb-1'
                     href='<?= base_url('user') ?>'><span class="inline-flex items-center justify-center">
                         <i
                             class="hgi hgi-stroke hgi-user-circle text-2xl leading-6 text-light-primary-text"></i></span>Login</a>
             </li>
         </ul>
     </div>
 </div>
 <!-- Footer Bottom Nav End -->

 <div class="logout-modal data-[state=close]:invisible data-[state=close]:opacity-0 data-[state=open]:visible data-[state=open]:opacity-100 transition-all duration-250 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 fixed z-91 max-w-[356px] w-full bg-white rounded-2xl"
     data-state="close">
     <div class="p-10 text-center">
         <h5 class="mb-2">Logout Information</h5>
         <p>Are you sure you want to logout?</p>
         <div class="flex items-center justify-end gap-x-4 mt-8">
             <button data-close-sidebar=".logout-modal"
                 class="btn btn-default outline btn-large md:px-[33px] w-[45%] md:w-auto py-2.5 rounded-[100px] shadow-none close-sidebar-btn">
                 Cancel
             </button>
             <a href="<?= base_url('dashboard/logout') ?>"
                 class="btn btn-warning btn-large md:px-[41px] w-[45%] md:w-auto py-[11px] rounded-[100px] close-sidebar-btn">
                 Logout
             </a>
         </div>
     </div>
 </div>

 <!-- ========== Plugins JS ========== -->
 <script src="<?= base_url('') ?>assets/js/vendor/jquery-3.7.1.min.js"></script>
 <script src="<?= base_url('') ?>assets/js/vendor/slick.min.js"></script>
 <script src="<?= base_url('') ?>assets/js/vendor/jquery.countdown.min.js"></script>
 <script src="<?= base_url('') ?>assets/js/vendor/jquery.nice-select.min.js"></script>
 <script src="<?= base_url('') ?>assets/js/vendor/jquery.counterup-2.min.js"></script>
 <script src="<?= base_url('') ?>assets/js/vendor/jquery.magnific-popup.min.js"></script>
 <script src="<?= base_url('') ?>assets/js/vendor/nouislider.min.js"></script>
 <script src="<?= base_url('') ?>assets/js/vendor/wow.min.js"></script>

 <!-- ========== Custom JS ========== -->
 <script src="<?= base_url('') ?>assets/js/main.js"></script>
 </body>

 </html>