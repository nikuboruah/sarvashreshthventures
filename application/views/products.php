<!-- ========== Breadcrumb Section Start ========== -->
<div class="container py-12">
    <div class="breadcrumb">
        <ul>
            <li>
                <a href='<?= base_url('/') ?>'>
                    <span class="inline-flex items-center justify-center">
                        <i class="hgi hgi-stroke hgi-home-01 text-2xl leading-6"></i></span>Home</a>
            </li>
            <li class="text-light-disabled-text">&#8226;</li>
            <li><span class="text-sm leading-[22px]">Products</span></li>
        </ul>
    </div>
</div>
<!-- ========== Breadcrumb Section End ========== -->

<!-- ========== Filter with 3-column Section Start ========== -->
<section class="pb-[90px]">
    <div class="container">
        <?php $this->load->view('messages') ?>
        <div class="grid grid-cols-12 lg:gap-x-6 gap-y-6">
            <div class="xl:col-span-3 lg:col-span-4 col-span-12 row-start-2 lg:row-start-auto">
                <div class="sidebar sticky top-20">
                    <div class="border border-gray-300 rounded-2xl">
                        <!-- title -->
                        <div class="px-6 py-4 bg-gray-200 rounded-t-2xl sidebar-title"
                            data-wow-delay=".2s">
                            <div class="flex items-center justify-between">
                                <h5 class="text-light-primary-text">Filters</h5>
                            </div>
                        </div>

                        <!-- category -->
                        <div class="px-6 py-6">
                            <!-- Category-content -->
                            <div class="widget-category" data-wow-delay=".2s">
                                <div class="flex flex-col gap-y-4 border-gray-300">
                                    <div class="flex items-center justify-between widget-category-title">
                                        <h6>Category</h6>
                                    </div>

                                    <div class="widget-category-content-list">
                                        <div class="max-h-[170px] overflow-y-auto pr-2.5 category-scroll">
                                            <ul class="flex flex-col gap-y-2">
                                                <li class="widget-category-content-list-items">
                                                    <label
                                                        class="group flex items-center justify-between w-full cursor-pointer">
                                                        <span class="flex items-center gap-x-2">
                                                            <a href="<?= base_url('products') ?>"
                                                                class="text-light-primary-text group-hover:text-primary transition-colors duration-300 ease-in-out">
                                                                All Category
                                                            </a>
                                                        </span>>
                                                    </label>
                                                </li>

                                                <?php foreach ($CATEGORY as $category) { ?>
                                                <li class="widget-category-content-list-items">
                                                    <label
                                                        class="group flex items-center justify-between w-full cursor-pointer">
                                                        <span class="flex items-center gap-x-2">
                                                            <span id="<?= $category->category_id ?>"
                                                                onclick="showCategoryWiseProduct(this.id)"
                                                                class="text-light-primary-text group-hover:text-primary transition-colors duration-300 ease-in-out">
                                                                <?= $category->category_name ?>
                                                            </span>
                                                        </span>>
                                                    </label>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="xl:col-span-9 lg:col-span-8 col-span-12 row-start-1 lg:row-start-auto">
                <div class="flex items-center justify-between pb-12"
                    data-wow-delay=".2s">
                    <div class="flex items-center gap-x-4 shrink-0 justify-start">
                        <div class="lg:flex hidden">
                            <p class="text-light-secondary-text">
                                Showing 1-12 of 16 results
                            </p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-6 pb-12" id="productList">
                    <!-- products -->
                    <?php foreach($PRODUCTS as $data){ ?>
                    <div class="xl:col-span-4 md:col-span-6 col-span-12"
                        data-wow-delay=".2s">
                        <div class="border border-gray-300 rounded-2xl product-card-1 p-4 group">
                            <div class="product-image-container relative">
                                <div class="product-image rounded-xl bg-[#F4F3F5] mb-4 overflow-hidden">
                                    <img src="<?php echo $data->product_image_one == '' ? base_url('admin/uploads/products/No_Image_Available.jpg') : base_url('admin/uploads/products/'. $data->product_image_one) ?>"
                                        alt="product-1"
                                        class="group-hover:scale-110 transition-all transform group-hover:-rotate-3 ease-in-out duration-300" />
                                </div>
                            </div>

                            <div class="product-content">
                                <h5 class="text-base leading-6 font-semibold font-dm-sans mb-4">
                                    <?= $data->product_name ?>
                                </h5>
                                <div class="price-section flex items-center gap-x-3 mb-2">
                                    <span
                                        class="current-price text-base font-semibold text-light-primary-text">&#8377;<?= number_format($data->selling_price,2) ?></span>
                                    <span
                                        class="old-price text-sm leading-[22px] font-normal text-light-disabled-text line-through">&#8377;<?= number_format($data->mrp,2) ?></span>
                                </div>
                                <div class="btn-section flex items-center gap-x-4">
                                    <span
                                        class='forgot-password-page-btn size-11 flex flex-none items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 border border-gray-300'
                                        onclick="showProductDetails('<?= $data->product_id ?>')">
                                        <i class="hgi hgi-stroke hgi-profile text-xl text-light-secondary-text"></i>
                                    </span>
                                    <?php if($this->session->userdata('aiplUserId')){ ?>
                                    <button
                                        class='btn btn-primary rounded-full font-semibold text-sm leading-6 px-6.5 py-2 flex-1'
                                        id="<?= $data->product_id ?>" onclick="addToCart(this)">
                                        <i class="hgi hgi-stroke hgi-shopping-cart-02 text-xl text-white"></i>
                                        <span>Add to Cart</span>
                                    </button>
                                    <?php }else{ ?>
                                    <a href="<?php echo base_url('user') ?>"
                                        class='btn btn-primary rounded-full font-semibold text-sm leading-6 px-6.5 py-2 flex-1'><i
                                            class="fa fa-shopping-cart"></i> Add To
                                        Cart</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========== Filter with 3-column Section End ========== -->

<div data-state="close"
    class="forgot-password-page-sidebar fixed xl:top-[30px] xl:right-[22px] right-0 top-0 xl:h-[calc(100vh-52px)] h-full z-99 max-w-[600px] w-full bg-white xl:rounded-2xl rounded-none transition-all duration-250 ease-[cubic-bezier(0.645,0.045,0.355,1)] data-[state=open]:translate-x-0 data-[state=open]:opacity-100 data-[state=open]:visible data-[state=close]:translate-x-[200px] data-[state=close]:opacity-0 data-[state=close]:invisible">
    <div class="forgot-password-page-sidebar-header px-6 pt-6 pb-4 border-b border-gray-300 relative">
        <h5>Product Details</h5>
        <button data-close-sidebar=".forgot-password-page-sidebar"
            class="close-sidebar-btn absolute top-1/2 right-6 -translate-y-1/2 cursor-pointer inline-flex items-center justify-center size-9 rounded-full bg-[rgba(145,158,171,0.08)]">
            <i class="hgi hgi-stroke hgi-multiplication-sign text-xl leading-5 text-light-primary-text"></i>
        </button>
    </div>
    <div
        class="forgot-password-page-sidebar-content p-10 flex flex-col gap-y-10 overflow-y-auto max-h-[calc(100%-70px)]">
        <table class="table table-bordered">
            <tbody id="details">

            </tbody>
        </table>
    </div>
</div>

<div data-state="close"
    class="register-page-sidebar fixed xl:top-[30px] xl:right-[22px] right-0 top-0 xl:h-[calc(100vh-52px)] h-full z-99 max-w-[600px] w-full bg-white xl:rounded-2xl rounded-none transition-all duration-250 ease-[cubic-bezier(0.645,0.045,0.355,1)] data-[state=open]:translate-x-0 data-[state=open]:opacity-100 data-[state=open]:visible data-[state=close]:translate-x-[200px] data-[state=close]:opacity-0 data-[state=close]:invisible">
    <div class="register-page-sidebar-header px-6 pt-6 pb-4 border-b border-gray-300 relative">
        <h5>Create an Account</h5>
        <button data-close-sidebar=".login-page-sidebar"
            class="close-sidebar-btn absolute top-1/2 right-6 -translate-y-1/2 cursor-pointer inline-flex items-center justify-center size-9 rounded-full bg-[rgba(145,158,171,0.08)]">
            <i class="hgi hgi-stroke hgi-multiplication-sign text-xl leading-5 text-light-primary-text"></i>
        </button>
    </div>
    <!-- <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th class="text-center">Quantity</th>
            </tr>
        </thead>
        <tbody id="combo">

        </tbody>
    </table> -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
showProductDetails = function(x) {
    $.ajax({
        url: '<?php echo base_url('showProductDetails') ?>',
        method: 'POST',
        data: 'id=' + x,

        success: function(data) {
            $('#details').html(data)
        }
    })
}

function addToCart(x) {

    var details = {
        productid: x.id,
        qty: 1
    };

    $.ajax({
        type: "POST",
        url: '<?php echo base_url('welcome/addToCart') ?>',
        data: details,

        success: function(response) {

            if (response == 0) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong. Try again.'
                });

            } else if (response == 1) {

                let currentCart = Number($("#cart").text());
                $("#cart").text(currentCart + 1);

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Item added to Cart.',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload(); // ✅ Refresh page
                });
            }
        },

        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: 'Please try again later.'
            });
        }
    });
}

function showCategoryWiseProduct(categoryId) {
    $.ajax({
        url: '<?= base_url('welcome/getCategoryWiseProducts') ?>',
        type: 'POST',
        data: {
            category_id: categoryId
        },
        success: function(data) {
            $('#productList').html(data);
        },
        error: function() {
            Swal.fire('Error', 'Failed to load products.', 'error');
        }
    });
}

showCombo = function(x) {
    $.ajax({
        type: "POST",
        url: '<?php echo base_url('welcome/getCombo') ?>',
        data: {
            product_id: x
        },
        success: function(response) {
            $('#combo').html(response);
        }
    });
}

$('span[id]').on('click', function(e) {
    e.preventDefault();
    $('span[id]').css('font-weight', 'normal');
    $(this).css('font-weight', 'bold');
    $(this).css('color', 'green');
});
</script>