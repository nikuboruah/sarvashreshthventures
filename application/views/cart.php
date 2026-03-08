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
             <li><span class="text-sm leading-[22px]">Cart</span></li>
         </ul>
     </div>
 </div>

 <!-- ========== Breadcrumb Section End ========== -->
 <!-- ========== Cart vendor Section Start ========== -->
 <div class="pb-[70px]">
     <div class="container">
         <?php if($cartItems == 0){ ?>
         <div class="text-center">
             <h4 style="color:#ccc;">NO PRODUCT FOUND</h4>
         </div>
         <?php }else{ ?>
         <div class="grid grid-cols-12">
             <div class="xl:col-span-8 col-span-12">
                 <div class="flex items-center justify-between mb-6 xl:px-2 px-0">
                     <div class="flex items-center gap-x-1">
                         <h5>Cart</h5>
                         <p></p>
                     </div>
                     <div class="flex items-center">
                         <button onclick="removeAll()"
                             class="inline-flex gap-x-1 items-center justify-center font-semibold leading-[26px] text-error">
                             <i class="hgi hgi-stroke hgi-cancel-01 text-xl leading-5 font-semibold"></i>
                             Remove All
                         </button>
                     </div>
                 </div>
             </div>
         </div>
         <div class="grid grid-cols-12 gap-x-6 gap-y-6">
             <div class="xl:col-span-8 col-span-12">
                 <div class="wishlist-table-wrapper border-gray-300 rounded-2xl border overflow-x-auto">
                     <table class="w-full wishlist-table">
                         <thead class="bg-gray-200">
                             <tr>
                                 <th class="product text-left font-semibold pl-4">
                                     <p class="product-name">Product</p>
                                 </th>
                                 <th class="product-quantity text-left py-2.5 font-semibold">
                                     Quantity
                                 </th>
                                 <th class="product-price text-left py-2.5 font-semibold">
                                     Price
                                 </th>
                                 <th class="product-total-price text-left py-2.5 font-semibold">
                                     Total Price
                                 </th>
                                 <th class="product-total-price text-left py-2.5 font-semibold">
                                     BV
                                 </th>
                                 <th class="product-actions text-center py-2.5 font-semibold pr-4">
                                     Action
                                 </th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $id = 0; foreach($cart as $cart){
                                 $price = $cart->qty * $cart->selling_price;
                                 $totalPrice += $price;

                                 $totalPV += $cart->qty * $cart->pv;
                            ?>
                             <tr class="py-4">
                                 <td data-title="Product " class="py-4 px-3 lg:px-4 product">
                                     <div class="flex items-end md:items-center gap-x-4 flex-col md:flex-row gap-y-4">
                                         <div class="product-thumbnail max-w-[120px] h-[50px] rounded-2xl bg-[#F4F3F5]">
                                             <img src="<?php echo base_url('admin/uploads/products/'.$cart->product_image_one) ?>"
                                                 alt="vitamin-c" class="rounded-2xl h-full w-full object-cover"
                                                 style="height: 50px; width: 50px;" />
                                         </div>
                                         <div class="flex flex-col gap-y-2 items-end md:items-start">
                                             <a class='product-name text-light-primary-text font-semibold truncate hover:text-primary transition-colors duration-300'
                                                 href='product-details.html'>
                                                 <?= $cart->product_name ?>
                                             </a>
                                         </div>
                                     </div>
                                 </td>

                                 <td data-title="Quantity " class="capitalize py-4 px-3 lg:px-0 product-quantity">
                                     <div
                                         class="border border-gray-300 inline-flex items-center justify-center rounded-[80px] max-w-[108px] py-2.5 px-4">
                                         <button onclick="minus_cart_(<?= $cart->cart_id ?>)"
                                             class="quantity__minus inline-flex items-center justify-center hover:text-primary">
                                             <i class="hgi hgi-stroke hgi-remove-circle text-xl leading-6"></i>
                                         </button>
                                         <input type="text" readonly id="qty<?= $cart->cart_id ?>"
                                             onchange="updateQty('<?= $cart->cart_id ?>')" value="<?= $cart->qty ?>"
                                             class="quantity__input border-0 w-full grow text-center focus:outline-none font-semibold text-light-primary-text" />

                                         <button onclick="plus_cart_(<?= $cart->cart_id ?>)"
                                             class="quantity__plus inline-flex items-center justify-center hover:text-primary">
                                             <i class="hgi hgi-stroke hgi-add-circle text-xl leading-6"></i>
                                         </button>
                                     </div>
                                 </td>

                                 <td data-title="Price " class="capitalize py-4 px-3 lg:px-0 product-price">
                                     <div class="flex items-center gap-x-3">
                                         <span
                                             class="text-light-primary-text font-semibold">&#8377;<?= number_format($cart->selling_price,2) ?></span>
                                         <?php if($cart->selling_price != $cart->mrp){ ?>
                                         <span
                                             class="line-through text-light-disabled-text font-normal">&#8377;<?= number_format($cart->mrp,2) ?></span>
                                         <?php } ?>
                                     </div>
                                 </td>

                                 <td data-title="Total Price " class="capitalize py-4 px-3 lg:px-0 product-total-price">
                                     <p class="font-semibold text-light-primary-text">
                                         &#8377;<span><?= number_format($price,2) ?>
                                     </p>
                                 </td>

                                 <td data-title="Total Price " class="capitalize py-4 px-3 lg:px-0 product-total-price">
                                     <p class="font-semibold text-light-primary-text">
                                         <?= $cart->qty * $cart->pv ?>
                                     </p>
                                 </td>

                                 <td data-title="Action " class="capitalize py-4 px-3 lg:px-4 product-actions">
                                     <div class="flex items-center justify-center gap-x-2 md:gap-x-6">
                                         <button onclick="removeFromCart(<?= $cart->cart_id ?>)"
                                             class="inline-flex items-center justify-center product-remove">
                                             <i
                                                 class="hgi hgi-stroke hgi-delete-01 text-2xl leading-6 text-light-primary-text"></i>
                                         </button>
                                     </div>
                                 </td>
                             </tr>
                             <?php } ?>
                         </tbody>
                     </table>
                 </div>
             </div>
             <div class="xl:col-span-4 col-span-12">
                 <div class="border border-gray-300 rounded-2xl md:px-6 md:py-6 px-3 py-4 flex flex-col gap-y-6">
                     <div class="border border-gray-300 md:p-6 p-3 rounded-2xl">
                         <div class="flex flex-col gap-y-6">
                             <h5><u>Order Summary</u></h5>
                             <div>
                                 <h6 class="flex items-center justify-between text-light-primary-text pt-1">
                                     Total BV<span class="text-gray-900"><?= $totalPV ?></span>
                                 </h6>
                                 <h6 class="flex items-center justify-between text-light-primary-text pt-4">
                                     Total<span class="text-gray-900">&#8377;<?= number_format($totalPrice, 2) ?></span>
                                 </h6>
                             </div>
                         </div>
                     </div>
                     <!-- Checkbox -->

                     <!-- <label class="flex items-center cursor-pointer">
                         <span
                             class="has-[input:checked]:hover:bg-[#00AB55]/8 flex items-center justify-center w-10 h-10 bg-transparent rounded-full hover:bg-[#919EAB]/8 transition-colors duration-300 ease-in-out">
                             <span class="relative inline-flex w-5 h-5 items-center justify-center">
                                 <input type="checkbox"
                                     class="peer appearance-none w-full h-full border-2 focus:outline-none checked:border-none border-gray-300 rounded-sm bg-white checked:bg-primary transition-all" />
                                 <span
                                     class="absolute inset-0 inline-flex items-center justify-center text-white opacity-0 peer-checked:opacity-100 transition-all">
                                     <i class="hgi hgi-stroke hgi-tick-02 text-[18px] leading-[18px]"></i>
                                 </span>
                             </span>
                         </span>

                        <span>
                             I agree with the
                             <span class="text-secondary underline font-semibold">Terms</span>
                             and
                             <span class="text-secondary underline font-semibold">Conditions</span>
                         </span>
                     </label> -->
                     <!-- Checkout Buttons -->
                     <div class="flex flex-col gap-y-6">
                         <?php 
                            $member_status = $USERSTATUS[0]->status;
                            if($cartItems > 0 && $member_status == 0){
                        ?>
                         <a class='btn btn-primary py-3 w-full rounded-[80px]' href="<?php echo base_url('checkout_for_activation') ?>">
                             Proceed to checkout
                         </a>
                         <?php
                            }else if($cartItems > 0 && $member_status > 0){
                        ?>
                         <a href="<?php echo base_url('checkout') ?>" class='btn btn-primary py-3 w-full rounded-[80px]'>
                             Proceed to checkout
                         </a>
                         <?php } ?>
                         <a class='btn btn-default outline shadow-none w-full py-[11px] rounded-[80px]'
                             href='<?= base_url('products') ?>'>
                             Continue Shopping
                             <span class="inline-flex items-center justify-center"><i
                                     class="hgi hgi-stroke hgi-arrow-right-02 text-[22px] leading-[22px]"></i></span>
                         </a>
                     </div>
                 </div>
             </div>
         </div>
         <?php } ?>
     </div>
 </div>
 <!-- ========== Cart vendor Section End ========== -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
function minus_cart_(x) {
    var value = $("#qty" + x).val();
    if (value > 1) {
        value--;
        decrease_qty(x);
    }
    $("#qty" + x).val(value);
}

function decrease_qty(x) {
    $.ajax({
        type: 'POST',
        url: '<?= base_url('decreaseCartQty') ?>',

        data: {
            id: x
        },

        success: function(response) {
            location.reload();
        }
    })
}

function plus_cart_(x) {
    var value = $("#qty" + x).val();
    value++;
    $("#qty" + x).val(value);
    increase_qty(x);
}

function increase_qty(x) {
    $.ajax({
        type: 'POST',
        url: '<?= base_url('increaseCartQty') ?>',

        data: {
            id: x
        },

        success: function(response) {
            location.reload();
        }
    })
}

function updateQty(x) {
    let qty = $('#qty' + x).val()
    $.ajax({
        type: 'POST',
        url: '<?= base_url('update_cart_qty') ?>',

        data: {
            id: x,
            qty: qty
        },

        success: function(response) {
            location.reload();
        }
    })
}

function removeFromCart(x) {
    $.ajax({
        type: 'POST',
        url: '<?= base_url('removeFromCart') ?>',
        data: {
            id: x
        },

        success: function(response) {
            if (response == 0) {
                Swal.fire(
                    'Ooops. Something went wrong.',
                    'Try Again.',
                    'question'
                ).then((result) => {
                    window.location.assign("<?php echo base_url('cart') ?>")
                });
            } else if (response == 1) {
                Swal.fire(
                    'Success',
                    'Item removed from Cart.',
                    'success'
                ).then((result) => {
                    window.location.assign("<?php echo base_url('cart') ?>")
                });
            }
        }
    })
}

function removeAll() {
    $.ajax({
        type: 'POST',
        url: '<?= base_url('removeAll') ?>',

        success: function(response) {
            if (response == 0) {
                Swal.fire(
                    'Ooops. Something went wrong.',
                    'Try Again.',
                    'question'
                ).then((result) => {
                    window.location.assign("<?php echo base_url('cart') ?>")
                });
            } else if (response == 1) {
                Swal.fire(
                    'Success',
                    'Items removed from Cart.',
                    'success'
                ).then((result) => {
                    window.location.assign("<?php echo base_url('cart') ?>")
                });
            }
        }
    })
}
 </script>