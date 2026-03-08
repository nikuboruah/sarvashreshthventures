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
             <li><span class="text-sm leading-[22px]">Checkout</span></li>
         </ul>
     </div>
 </div>

 <div class="pb-[70px]">
     <div class="container">
         <?php $this->load->view('messages') ?>
         <?php if($cartItems == 0){ ?>
         <div class="text-center">
             <h4 style="color:#ccc;">NO PRODUCT FOUND</h4>
         </div>
         <?php }else{ ?>
         <form action="<?php echo base_url('repurchase_now') ?>" method="post" enctype="multipart/form-data">
             <div class="grid grid-cols-12 gap-x-6 gap-y-6">
                 <!-- Account and payment part -->
                 <div class="xl:col-span-8 col-span-12">
                     <div class="flex flex-col gap-y-6">
                         <div class="border border-gray-300 rounded-2xl">
                             <div class="py-4 px-6 bg-gray-200 rounded-t-2xl">
                                 <h5>Shipping Address</h5>
                             </div>
                             <div class="md:px-6 px-3 py-6">

                                 <div class="relative w-full">
                                     <textarea name="address" id="address"
                                         class="form-control peer input-group medium rounded-[20px] ps-4 pe-6 resize-none placeholder-transparent focus:placeholder-transparent focus:outline-none"
                                         rows="4" placeholder="Delivery address"></textarea>

                                     <label for="address_comment"
                                         class="absolute left-[14px] top-1/2 -translate-y-1/2 text-xs leading-[18px] transition-all peer-placeholder-shown:text-light-disabled-text peer-focus:text-light-disabled-text peer-placeholder-shown:text-[16px] peer-placeholder-shown:top-6 peer-focus:text-[12px] peer-focus:top-0 peer-[:not(:placeholder-shown)]:text-[12px] peer-[:not(:placeholder-shown)]:top-0 bg-white peer-focus:px-1 peer-[:not(:placeholder-shown)]:px-1">
                                         Delivery address
                                     </label>
                                 </div>
                             </div>
                         </div>
                         <!-- Payment -->
                         <div class="border border-gray-300 rounded-2xl">
                             <div class="py-4 px-6 bg-gray-200 rounded-t-2xl">
                                 <h5 class="text-light-primary-text">Payment</h5>
                             </div>
                             <!-- create account-form -->
                             <div class="md:px-6 px-3 py-6">
                                 <div class="payment-methods flex flex-col gap-y-6">
                                     <div class="border border-gray-300 w-full payment-method px-3 py-4">
                                         <div>
                                             <label class="flex items-center gap-x-2 cursor-pointer">
                                                 <!-- custom radio -->
                                                 <span
                                                     class="has-[input:checked]:hover:bg-[#00AB55]/8 flex items-center justify-center w-9 h-9 bg-transparent rounded-full hover:bg-[#919EAB]/8 transition-colors duration-300 ease-in-out">
                                                     <span
                                                         class="relative inline-flex w-5 h-5 items-center justify-center">
                                                         <input type="radio" value="Cash" name="payment_method"
                                                             id="cash_payment"
                                                             class="peer appearance-none w-full h-full border-2 focus:outline-none checked:border-primary border-gray-300 rounded-full bg-white transition-all" />

                                                         <!-- radio inner dot -->
                                                         <span
                                                             class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-2 h-2 rounded-full bg-primary opacity-0 scale-0 peer-checked:opacity-100 peer-checked:scale-100 transition-all"></span>
                                                     </span>
                                                 </span>

                                                 <!-- label text -->
                                                 <span class="text-light-primary-text">
                                                     Cash on Delivery
                                                 </span>
                                             </label>
                                         </div>
                                         <div class="payment-content pt-4 pl-2">
                                             Pay with cash upon delivery.
                                         </div>
                                     </div>

                                     <div class="border border-gray-300 w-full payment-method px-3 py-4">
                                         <div class="flex items-center">
                                             <label class="flex items-center gap-x-2 cursor-pointer w-full">
                                                 <!-- custom radio -->
                                                 <span
                                                     class="has-[input:checked]:hover:bg-[#00AB55]/8 flex items-center justify-center w-9 h-9 bg-transparent rounded-full hover:bg-[#919EAB]/8 transition-colors duration-300 ease-in-out">
                                                     <span
                                                         class="relative inline-flex w-5 h-5 items-center justify-center">
                                                         <input type="radio" value="Bank" name="payment_method"
                                                             id="bank_payment"
                                                             class="peer appearance-none w-full h-full border-2 focus:outline-none checked:border-primary border-gray-300 rounded-full bg-white transition-all" />

                                                         <!-- radio inner dot -->
                                                         <span
                                                             class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-2 h-2 rounded-full bg-primary opacity-0 scale-0 peer-checked:opacity-100 peer-checked:scale-100 transition-all"></span>
                                                     </span>
                                                 </span>

                                                 <!-- label text -->
                                                 <span class="text-light-primary-text">Bank Payments (UPI/Debit
                                                     Card/Credit
                                                     Card/Cheque/Transfer)</span>
                                             </label>
                                         </div>
                                         <div class="payment-content pt-4 pl-2">
                                             <div class="flex flex-col gap-y-6">
                                                 <div>
                                                     <div class="relative w-full">
                                                         <input name="tranno" id="tranno" type="number"
                                                             class="peer form-control input-group medium rounded-[80px] px-3.5 placeholder-transparent focus:placeholder-transparent focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                                             placeholder="Transaction No" />
                                                         <label for="card_number"
                                                             class="absolute left-[14px] top-1/2 -translate-y-1/2 text-xs leading-[18px] transition-all peer-placeholder-shown:text-light-disabled-text peer-focus:text-light-disabled-text peer-placeholder-shown:text-[16px] peer-placeholder-shown:top-1/2 peer-focus:text-[12px] peer-focus:top-0 peer-[:not(:placeholder-shown)]:text-[12px] peer-[:not(:placeholder-shown)]:top-0 peer-[:not(:placeholder-shown)]:bg-white peer-focus:bg-white peer-focus:px-1 peer-[:not(:placeholder-shown)]:px-1">
                                                             Transaction No
                                                         </label>
                                                     </div>
                                                 </div>

                                                 <div>
                                                     <div class="relative w-full">
                                                         <input name="proof" id="proof" type="file"
                                                             class="peer form-control input-group medium rounded-[80px] px-3.5 placeholder-transparent focus:placeholder-transparent focus:outline-none"
                                                             placeholder="Payment Proof" />
                                                         <label for="card_on_name"
                                                             class="absolute left-[14px] top-1/2 -translate-y-1/2 text-xs leading-[18px] transition-all peer-placeholder-shown:text-light-disabled-text peer-focus:text-light-disabled-text peer-placeholder-shown:text-[16px] peer-placeholder-shown:top-1/2 peer-focus:text-[12px] peer-focus:top-0 peer-[:not(:placeholder-shown)]:text-[12px] peer-[:not(:placeholder-shown)]:top-0 peer-[:not(:placeholder-shown)]:bg-white peer-focus:bg-white peer-focus:px-1 peer-[:not(:placeholder-shown)]:px-1">
                                                             Payment Proof
                                                         </label>
                                                     </div>
                                                 </div>

                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- Cart items part -->
                 <div class="xl:col-span-4 col-span-12">
                     <div
                         class="border border-gray-300 rounded-2xl md:px-6 md:py-6 px-3 py-4 flex flex-col gap-y-6 sticky top-5">
                         <!-- cart-items -->
                         <h5 class="text-light-primary-text">Cart Items</h5>
                         <div class="border border-gray-300 rounded-xl overflow-x-auto">
                             <table class="w-full cart-items-table">
                                 <tbody class="space-y-6">
                                     <?php $id = 0; foreach($cart as $cart){
                                        $price = $cart->qty * $cart->selling_price;
                                        $mrp_total = $cart->qty * $cart->mrp;
                                        $totalPrice += $price;

                                        $totalPV += $cart->qty * $cart->pv;
                                    ?>
                                     <tr>
                                         <td class="py-4 px-4 product-thumbnail">
                                             <div class="w-[60px] h-[60px] rounded-xl bg-[#F4F3F5] overflow-hidden">
                                                 <img src="<?php echo base_url('admin/uploads/products/'.$cart->product_image_one) ?>"
                                                     alt="vitamin-c-2" class="w-full h-full object-cover rounded-xl" />
                                             </div>
                                         </td>
                                         <td class="py-4 md:pr-4 pr-2 align-bottom w-full">
                                             <div class="flex flex-col gap-y-2">
                                                 <a class='text-light-primary-text font-semibold truncate hover:text-primary transition-colors duration-300 product-title'
                                                     href='product-details.html'>
                                                     <?= $cart->product_name ?>
                                                 </a>
                                                 <div class="flex items-center justify-between">
                                                     <p
                                                         class="text-sm leading-[22px] font-normal text-light-secondary-text cart-item-quantity">
                                                         <?= $cart->qty ?> x
                                                         &#8377;<?= number_format($cart->selling_price,2) ?>
                                                     </p>
                                                     <div class="flex items-center gap-x-1.5">
                                                         <?php if($cart->selling_price != $cart->mrp){ ?>
                                                         <span
                                                             class="line-through text-light-disabled-text font-normal product-total-price">
                                                             &#8377;<?= number_format($mrp_total,2) ?></span>
                                                         <?php } ?>
                                                         <span class="text-primary font-semibold product-offer-price">
                                                             &#8377;<?= number_format($price,2) ?></span>
                                                     </div>
                                                 </div>
                                             </div>
                                         </td>
                                     </tr>
                                     <?php } ?>
                                 </tbody>
                             </table>
                         </div>
                         <!-- order-summary -->
                         <div class="bg-gray-100 md:px-6 px-4 py-6 rounded-2xl">
                             <div class="flex flex-col gap-y-6">
                                 <h5>Total Product BV</h5>
                                 <div>
                                     <p class="flex items-center justify-between text-light-primary-text pt-4">
                                         Collected BV<span class="text-gray-900"><?= $totalPV ?></span>
                                     </p>
                                 </div>
                             </div>
                         </div>

                         <div class="bg-gray-100 md:px-6 px-4 py-6 rounded-2xl">
                             <div class="flex flex-col gap-y-6">
                                 <h5>Order Summary</h5>
                                 <!-- total -->
                                 <div>
                                     <h6 class="flex items-center justify-between text-light-primary-text pt-4">
                                         Total<span
                                             class="text-gray-900">&#8377;<?= number_format($totalPrice, 2) ?></span>
                                     </h6>
                                 </div>
                             </div>
                         </div>
                         <div>
                             <button type="submit" id="activate" class='btn btn-primary py-3 rounded-[80px] w-full'>
                                 Order Now
                             </button>
                             <div class="msg-box">
                                 <span id="msg"></span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <input type="text" name="tbv" value="<?= $totalPV ?>" id="tbv" hidden>
             <input type="text" name="gtotal" value="<?= $totalPrice ?>" id="gtotal" hidden>
         </form>
         <?php } ?>
     </div>
 </div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <style>
/* Activation warning message */
.activation-warning {
    color: #dc2626;
    /* red */
    background-color: #fee2e2;
    border: 1px solid #fca5a5;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 13px;
    margin-top: 8px;
    display: inline-block;
}

/* Disabled button style */
#activate:disabled {
    background-color: #9ca3af !important;
    border-color: #9ca3af !important;
    cursor: not-allowed;
    opacity: 0.7;
}

.text-danger {
    color: red;
    text-align: center;
}

.msg-box {
    padding: 10px;
    border-radius: 10px;
    margin-top: 23px !important;
}
 </style>
 <script>
$(document).ready(function() {

    const paymentMethod = $(".payment-methods input[name='payment_method']");

    // Hide all payment content initially
    $(".payment-content").hide();

    // If already checked (page reload case)
    const selectedPaymentMethod = $(".payment-methods input[name='payment_method']:checked");

    if (selectedPaymentMethod.length) {
        const parent = selectedPaymentMethod.closest(".payment-method");

        parent.addClass("selected");
        parent.find(".payment-content").show();

        if (selectedPaymentMethod.val() === "Bank") {
            $("#tranno").prop("required", true);
            $("#proof").prop("required", true);
        }
    }

    // On Change
    paymentMethod.on("change", function() {

        const value = $(this).val();

        // Remove all selected styles
        $(".payment-method").removeClass("selected");
        $(".payment-content").slideUp();

        // Add selected style to current
        const parent = $(this).closest(".payment-method");
        parent.addClass("selected");
        parent.find(".payment-content").slideDown();

        // Required validation for Bank
        if (value === "Bank") {
            $("#tranno").prop("required", true);
            $("#proof").prop("required", true);
        } else {
            $("#tranno").prop("required", false);
            $("#proof").prop("required", false);
        }

    });

    // Remove required initially
    $('#tranno').prop('required', false);
    $('#proof').prop('required', false);

    // Payment method change
    $('input[name="payment_method"]').on('change', function() {
        let mode = $('input[name="payment_method"]:checked').val();

        if (mode == 'Bank') {
            $('#tranno').prop('required', true);
            $('#proof').prop('required', true);
        } else {
            $('#tranno').prop('required', false);
            $('#proof').prop('required', false);
        }
    });

    // Form submit validation
    $('form').on('submit', function(e) {
        let address = $('#address').val().trim();
        let mode = $('input[name="payment_method"]:checked').val();

        // Address validation
        if (address == '') {
            e.preventDefault();
            Swal.fire('Error', 'Delivery address is required!', 'error');
            return false;
        }

        // Payment not selected
        if (!mode) {
            e.preventDefault();
            Swal.fire('Error', 'Please select a payment method!', 'error');
            return false;
        }

        // Bank validation
        if (mode == 'Bank') {

            if ($('#tranno').val().trim() == '') {
                e.preventDefault();
                Swal.fire('Error', 'Transaction Number is required!', 'error');
                return false;
            }

            if ($('#proof').val() == '') {
                e.preventDefault();
                Swal.fire('Error', 'Payment Proof is required!', 'error');
                return false;
            }
        }

    });
});
 </script>