<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->library('upload');
		$this->load->library('form_validation');
		$this->load->library('encryption');
	}

	public function not_found(){
		$this->load->view('not-found', $data);
	}

	public function index()
	{
		$data['BANK_DETAILS'] = $this->Crud->ciRead("kyc_master", "`customer_id` = '1'");
		$data['PRODUCTS'] = $this->Crud->ciRead("product_master", "`status`  = '1'");
		$data['PAGE'] = 'Home';
		$this->load->view('include/header', $data);
		$this->load->view('include/slider');
		$this->load->view('index', $data);
		$this->load->view('include/footer');
	}

	public function about()
	{
		$data['PAGE'] = 'About';
		$this->load->view('include/header', $data);
		$this->load->view('about');
		$this->load->view('include/footer');
	}

	public function documents()
	{
		$data['PAGE'] = 'Documents';
		$this->load->view('include/header', $data);
		$this->load->view('documents');
		$this->load->view('include/footer');
	}

	public function products()
	{
		$data['PAGE'] = 'Products';
			$data['PRODUCTS'] = $this->Crud->ciRead("product_master", "`status`  = '1'");
			$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`status`  = '1' AND `category_id` != 1");
			$this->load->view('include/header', $data);
			$this->load->view('products', $data);
			$this->load->view('include/footer');
	}

	public function category_wise_products($cat_id = '')
	{
		$data['PAGE'] = 'Products';
		if($cat_id){
			$data['PRODUCTS'] = $this->Crud->ciRead("product_master", "`status`='1' AND `category_id`='$cat_id'");
		}else{
			$data['PRODUCTS'] = $this->Crud->ciRead("product_master", "`status`='1'");
		}
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`status`  = '1' AND `category_id` != 1");
		$this->load->view('include/header', $data);
		$this->load->view('products', $data);
		$this->load->view('include/footer');
	}

	public function getCategoryWiseProducts() {
		$categoryId = $this->input->post('category_id');

		$products = $this->db->query("SELECT * FROM product_master WHERE status = 1 AND category_id = ?", [$categoryId])->result();

		foreach ($products as $data) {
			$img = $data->product_image_one == '' ? base_url('admin/uploads/products/No_Image_Available.jpg') : base_url('admin/uploads/products/' . $data->product_image_one);

			$details = '<div class="xl:col-span-4 md:col-span-6 col-span-12 wow animate__animated animate__fadeInUp"
                        data-wow-delay=".2s">
                        <div class="border border-gray-300 rounded-2xl product-card-1 p-4 group">
                            <div class="product-image-container relative">
                                <div class="product-image rounded-xl bg-[#F4F3F5] mb-4 overflow-hidden">
                                    <img src="' . $img . '"
                                        alt="product-1"
                                        class="group-hover:scale-110 transition-all transform group-hover:-rotate-3 ease-in-out duration-300" />
                                </div>
                            </div>

                            <div class="product-content">
                                <h5 class="text-base leading-6 font-semibold font-dm-sans mb-4">
                                    ' . $data->product_name . '
                                </h5>
                                <div class="price-section flex items-center gap-x-3 mb-2">
                                    <span
                                        class="current-price text-base font-semibold text-light-primary-text">&#8377;' . number_format($data->selling_price, 2) . '</span>
                                    <span
                                        class="old-price text-sm leading-[22px] font-normal text-light-disabled-text line-through">&#8377;' . number_format($data->mrp, 2) . '</span>
                                </div>
                                <div class="btn-section flex items-center gap-x-4">
                                    <span
                                        class="forgot-password-page-btn size-11 flex flex-none items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 border border-gray-300"
                                        onclick="showProductDetails(' . $data->product_id . ')">
                                        <i class="hgi hgi-stroke hgi-profile text-xl text-light-secondary-text"></i>
                                    </span>';
                                    if ($this->session->userdata('aiplUserId')) {
                                    $details .= '<button
                                        class="btn btn-primary rounded-full font-semibold text-sm leading-6 px-6.5 py-2 flex-1"
                                        id="' . $data->product_id . '" onclick="addToCart(this)">
                                        <i class="hgi hgi-stroke hgi-shopping-cart-02 text-xl text-white"></i>
                                        <span>Add to Cart</span>
                                    </button>';
                                    } else {
                                    $details .= '<a href="' . base_url('user') . '"
                                        class="btn btn-primary rounded-full font-semibold text-sm leading-6 px-6.5 py-2 flex-1"><i
                                            class="fa fa-shopping-cart"></i> Add To
                                        Cart</a>';
                                    }
                                $details .= '</div>
                            </div>
                        </div>
                    </div>';

			echo $details;
		}

		if (empty($products)) {
			echo '<div class="col-span-12 text-center" style="background-color: orange; border-radius:10px; padding: 20px; color : #fff; "><h5>No products found in this category.</h5></div>';
		}
	}



	public function showProductDetails() {
		extract($_POST);

		$sql = $this->db->query("SELECT p.*, c.category_name FROM `product_master` p JOIN category_master c ON c.category_id = p.category_id WHERE p.product_id = '$id'");
		$PRODUCTS = $sql->result();

		if (empty($PRODUCTS)) {
			echo '<tr><td colspan="2">Product not found.</td></tr>';
			return;
		}

		$product = $PRODUCTS[0];
		$button = '<button class="register-page-btn btn btn-info" onclick="showCombo(this.id)" id="'.$product->product_id.'">Show Combo Products</button>';
		$showButton = ($product->category_id == 2);

		echo '<tr>
				<th class="text-left py-3">Product Name</th>
				<td>' . $product->product_name . '</td>
			</tr>
			<tr>
				<th class="text-left py-3">HNS Code</th>
				<td>' . $product->HSN_code . '</td>
			</tr>
			<tr>
				<th class="text-left py-3">Category</th>
				<td>' . $product->category_name.'</td>
			</tr>
			<tr>
				<th class="text-left py-3">Product Price</th>
				<td>&#8377;' . number_format($product->mrp, 2) . '</td>
			</tr>
			<tr>
				<th class="text-left py-3">Selling Price</th>
				<td>&#8377;' . number_format($product->selling_price, 2) . '</td>
			</tr>
			<tr>
				<th class="text-left py-3">BV</th>
				<td>' . number_format($product->pv) . '</td>
			</tr>';
	}


	public function cart()
	{
			$userid = $this->session->userdata('aiplUserId');
			if($userid){
				$sql = $this->db->query("SELECT c.*, p.product_name, p.selling_price, p.mrp, p.product_image_one, p.pv FROM `cart_master` c JOIN product_master p ON p.product_id = c.product_id WHERE c.user_id = '$userid' AND c.status = '0' AND c.purchase_type != 3");
				$data['cart'] = $sql->result();
				$data['cartItems'] = $sql->num_rows();
				$data['USERSTATUS'] = $this->Crud->ciRead("customer_master", "`customer_id` = '$userid'");
				$this->load->view('include/header');
				$this->load->view('cart', $data);
				$this->load->view('include/footer');
			}else{
				redirect('authentication/login');
			}
	}

	public function checkout_for_activation()
	{
			$userid = $this->session->userdata('aiplUserId');
			if($userid){
				$sql = $this->db->query("SELECT c.*, p.product_name, p.selling_price, p.mrp, p.product_image_one, p.pv FROM `cart_master` c JOIN product_master p ON p.product_id = c.product_id WHERE c.user_id = '$userid' AND c.status = '0' AND c.purchase_type != 3");
				$data['cart'] = $sql->result();
				$data['cartItems'] = $sql->num_rows();
				$this->load->view('include/header');
				$this->load->view('checkout-for-activation', $data);
				$this->load->view('include/footer');
			}else{
				redirect('authentication/login');
			}
	}

	public function checkout()
	{
			$userid = $this->session->userdata('aiplUserId');
			if($userid){
				$sql = $this->db->query("SELECT c.*, p.product_name, p.selling_price, p.mrp, p.product_image_one, p.pv FROM `cart_master` c JOIN product_master p ON p.product_id = c.product_id WHERE c.user_id = '$userid' AND c.status = '0' AND c.purchase_type != 3");
				$data['cart'] = $sql->result();
				$data['cartItems'] = $sql->num_rows();
				$this->load->view('include/header');
				$this->load->view('checkout-for-repurchase', $data);
				$this->load->view('include/footer');
			}else{
				redirect('authentication/login');
			}
	}

	public function find_package_for_activation(){
		$d = $this->input->post();

		$bv = $d['bv'];
		$sql = $this->db->query("SELECT * FROM `package_master` WHERE `pv` <= '$bv' AND  `status` = '1' ORDER BY `pv` desc LIMIT 1");
		$packages = $sql->result();
		$count_package = $sql->num_rows();

		if($count_package == 0){
			echo 0;
		}else{
			echo $packages[0]->package_id;
		}
	}

	// public function activate_member_by_bv(){
	// 	extract($_POST);
	// 	$userid = $this->session->userdata('aiplUserId');

	// 	$isActive = $this->Crud->ciCount("customer_master", "`customer_id` = '$userid' AND `status` = '1'");

	// 	if($isActive > 0){
	// 		$this->session->set_flashdata("success", "You already activate your account");
	// 		redirect('products');
	// 	}else{
	// 		if($payment_method == 'Cash'){
	// 			$str_result = '0123456789';
	// 			$orderid = 'ORDR'.substr(str_shuffle($str_result), 0, 5).time();
				
	// 			$data = [
	// 				'package_id' => $packid,
	// 				'activation_status' => 0,
	// 				'requested_date' => date('Y-m-d H:i:s'),
	// 			];

	// 			$data2 = [
	// 				'order_id' => $orderid,
	// 				'bv' => $tbv,	
	// 				'customer_id' => $userid,
	// 				'grand_total' => $gtotal,
	// 				'address' => $address,
	// 				'payment_mode' => $payment_method,
	// 				'payment_status' => 1,
	// 				'added_on' => date('Y-m-d H:i:s'),
	// 			];
		
	// 			if($this->Crud->ciUpdate("customer_master", $data, "`customer_id` = '$userid'")){
	// 				$cart = $this->Crud->ciRead("cart_master", "`user_id` = '$userid' AND `status` = '0'");
	// 				foreach($cart as $item){
	// 					$productID = $item->product_id;
	// 					$product_price = $this->Crud->ciRead("product_master", "`product_id` = '$productID'")[0]->final_price;

	// 					$this->Crud->ciUpdate("cart_master", array(
	// 						'order_id' => $orderid,
	// 						'status' => 1,
	// 						'price' => $product_price,
	// 						'purchase_type' => 1,
	// 					), "`user_id` = '$userid' AND `status` = '0' AND `purchase_type` != '3' AND `product_id` = '$productID'");
	// 				}
	// 				$this->Crud->ciCreate("order_master", $data2);
	// 				redirect('activation_request');
	// 			}else{
	// 				$this->session->set_flashdata("danger", "Something went wrong. Try again.");
	// 			}

	// 			redirect('products');
	// 		}else if($payment_method == 'Bank'){
	// 			$str_result = '0123456789';
	// 			$orderid = 'ORDR'.substr(str_shuffle($str_result), 0, 5).time();

	// 			$config['upload_path'] = FCPATH . 'uploads/member/proof/';
	// 			$config['allowed_types'] = 'gif|jpg|png|jpeg';
	// 			$config['max_size'] = 2048;
	// 			$config['max_width'] = 5000;
	// 			$config['encrypt_name'] = TRUE;
	// 			$config['max_height'] = 5000;
	// 			$this->upload->initialize($config);
	// 			if (!$this->upload->do_upload('proof')) {
	// 				$error = array('error' => $this->upload->display_errors());
	// 				$this->session->set_flashdata('warning', $this->upload->display_errors());
	// 			} else {
	// 				$image_metadata = $this->upload->data();
	// 				$proof_image = $image_metadata['file_name'];
	// 			}
				
	// 			$data = [
	// 				'package_id' =>$packid,
	// 				'activation_status' => 0,
	// 				'requested_date' => date('Y-m-d H:i:s'),
	// 				'transaction_no' => $tranno,
	// 				'proof' => $proof_image,
	// 			];

	// 			$data2 = [
	// 				'order_id' => $orderid,
	// 				'bv' => $tbv,
	// 				'customer_id' => $userid,
	// 				'grand_total' => $gtotal,
	// 				'address' => $address,
	// 				'payment_mode' => $payment_method,
	// 				'transaction_no' => $tranno,
	// 				'proof' => $proof_image,
	// 				'added_on' => date('Y-m-d H:i:s'),
	// 			];
		
	// 			if($this->Crud->ciUpdate("customer_master", $data, "`customer_id` = '$userid'")){
	// 				$cart = $this->Crud->ciRead("cart_master", "`user_id` = '$userid' AND `status` = '0'");
	// 				foreach($cart as $item){
	// 					$productID = $item->product_id;
	// 					$product_price = $this->Crud->ciRead("product_master", "`product_id` = '$productID'")[0]->final_price;

	// 					$this->Crud->ciUpdate("cart_master", array(
	// 						'order_id' => $orderid,
	// 						'status' => 1,
	// 						'price' => $product_price,
	// 						'purchase_type' => 1,
	// 					), "`user_id` = '$userid' AND `status` = '0' AND `purchase_type` != '3' AND `product_id` = '$productID'");
	// 				}
	// 				$this->Crud->ciCreate("order_master", $data2);
	// 				redirect('activation_request');
	// 			}else{
	// 				$this->session->set_flashdata("danger", "Something went wrong. Try again.");
	// 			}

	// 			redirect('products');
	// 		}
	// 	}
	// }

	public function activate_member_by_bv(){
		extract($_POST);
		$userid = $this->session->userdata('aiplUserId');

		$user = $this->Crud->ciRead("customer_master","customer_id='$userid'")[0];

		if($user->status == 1){
			$this->session->set_flashdata("success","You already activated your account");
			redirect('products');
		}

		// 👉 Add previous pending BV
		$total_bv = $tbv + $user->pending_bv;

		// 👉 Find package based on TOTAL BV
		$package = $this->db->query("
			SELECT * FROM package_master
			WHERE pv <= '$total_bv'
			ORDER BY pv DESC
			LIMIT 1
		")->row();

		$package_id = NULL;
		$remaining_bv = $total_bv;

		if(!empty($package)){
			$package_id = $package->package_id;
			$remaining_bv = 0;
		}

		// Generate order id
		$str_result = '0123456789';
		$orderid = 'ORDR'.substr(str_shuffle($str_result), 0, 5).time();

		// 👉 CUSTOMER UPDATE DATA
		$data = [
			'package_id'        => $package_id, // will be NULL if not qualified
			'pending_bv'        => $remaining_bv,
			'activation_status' => ($package_id > 0 ? 0 : 1), // still request mode
			'requested_date'    => ($package_id > 0 ? date('Y-m-d H:i:s') : NULL),
		];

		// 👉 ORDER DATA
		$data2 = [
			'order_id'     => $orderid,
			'bv'           => $tbv,
			'customer_id'  => $userid,
			'grand_total'  => $gtotal,
			'address'      => $address,
			'payment_mode' => $payment_method,
			'payment_status' =>  ($package_id > 0 ? 1 : 0),
			'added_on'     => date('Y-m-d H:i:s'),
		];

		// BANK DETAILS
		if($payment_method == 'Bank'){

			$config['upload_path']   = FCPATH . 'uploads/member/proof/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if($this->upload->do_upload('proof')){
				$img = $this->upload->data();
				$data['proof'] = $img['file_name'];
				$data2['proof'] = $img['file_name'];
			}

			$data['transaction_no'] = $tranno;
			$data2['transaction_no'] = $tranno;
		}

		// 👉 UPDATE CUSTOMER
		if($this->Crud->ciUpdate("customer_master",$data,"customer_id='$userid'")){

			// 👉 UPDATE CART
			$cart = $this->Crud->ciRead("cart_master","user_id='$userid' AND status=0");

			foreach($cart as $item){

				$productID = $item->product_id;

				$product_price = $this->Crud->ciRead("product_master","product_id='$productID'")[0]->final_price;

				$this->Crud->ciUpdate("cart_master",[
					'order_id' => $orderid,
					'status'   => 1,
					'price'    => $product_price,
					'purchase_type' => 1
				],"user_id='$userid' AND product_id='$productID' AND status=0");
			}

			// 👉 CREATE ORDER
			$this->Crud->ciCreate("order_master",$data2);

			// 👉 AUTO MESSAGE
			if($package_id > 0){
				$this->session->set_flashdata("success","Package achieved successfully!");
			}else{
				$this->session->set_flashdata("warning","BV saved! Add more BV to activate package.");
			}

			redirect('activation_request');
		}

		$this->session->set_flashdata("danger","Something went wrong");
		redirect('products');
	}

	public function activation_request(){
		$this->load->view('include/header');
		$this->load->view('success', $data);
		$this->load->view('include/footer');
	}

	public function add_pv($pv, $position, $userid) {
		$user_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$userid'");
		if (empty($user_details)) {
			return;
		}

		$sponsor = $user_details[0]->sponsor_id;

		if (empty($sponsor)) {
			return;
		}

		// Fetch sponsor details
		$sponsor_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$sponsor'");
		if (empty($sponsor_details)) {
			return;
		}

		$right = $sponsor_details[0]->right_pv;
		$left = $sponsor_details[0]->left_pv;

		if ((int)$position === 0) {
			$updated_left = $left + $pv;
			$data = ['left_pv' => $updated_left];
		} else {
			$updated_right = $right + $pv;
			$data = ['right_pv' => $updated_right];
		}

		$this->Crud->ciUpdate("customer_master", $data, "`customer_id` = '$sponsor'");

		$this->add_pv($pv, $position, $sponsor);
	}


	public function repurchase_now(){
		extract($_POST);
		$userid = $this->session->userdata('aiplUserId');
		if($payment_method == 'Cash'){
			$str_result = '0123456789';
			$orderid = 'ORDR'.substr(str_shuffle($str_result), 0, 5).time();

			$data2 = [
				'order_id' => $orderid,
				'bv' => $tbv,
				'customer_id' => $userid,
				'order_status' => 1,
				'grand_total' => $gtotal,
				'address' => $address,
				'payment_mode' => $payment_method,
				'added_on' => date('Y-m-d H:i:s'),
			];

			if($this->Crud->ciCreate("order_master", $data2)){
				$cart = $this->Crud->ciRead("cart_master", "`user_id` = '$userid' AND `status` = '0'");
				foreach($cart as $item){
					$productID = $item->product_id;
					$product_price = $this->Crud->ciRead("product_master", "`product_id` = '$productID'")[0]->final_price;

					$this->Crud->ciUpdate("cart_master", array(
						'order_id' => $orderid,
						'status' => 1,
						'price' => $product_price,
						'purchase_type' => 2,
					), "`user_id` = '$userid' AND `status` = '0' AND `purchase_type` != '3' AND `product_id` = '$productID'");
				}
				$this->session->set_flashdata("success", "Item ordered successfully.");
			}else{
				$this->session->set_flashdata("danger", "Something went wrong. Try again.");
			}

			redirect('activation_request');
		}else if($payment_method == 'UPI'){
			$str_result = '0123456789';
			$orderid = 'ORDR'.substr(str_shuffle($str_result), 0, 5).time();

			$config['upload_path'] = FCPATH . 'uploads/member/proof/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = 2048;
			$config['max_width'] = 5000;
			$config['encrypt_name'] = TRUE;
			$config['max_height'] = 5000;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('proof')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('warning', $this->upload->display_errors());
			} else {
				$image_metadata = $this->upload->data();
				$proof_image = $image_metadata['file_name'];
			}

			$data2 = [
				'order_id' => $orderid,
				'bv' => $tbv,
				'grand_total' => $gtotal,
				'customer_id' => $userid,
				'order_status' => 1,
				'address' => $address,
				'payment_mode' => $payment_method,
				'transaction_no' => $tranno,
				'proof' => $proof_image,
				'added_on' => date('Y-m-d H:i:s'),
			];
	
			if($this->Crud->ciCreate("order_master", $data2)){
				$cart = $this->Crud->ciRead("cart_master", "`user_id` = '$userid' AND `status` = '0'");
				foreach($cart as $item){
					$productID = $item->product_id;
					$product_price = $this->Crud->ciRead("product_master", "`product_id` = '$productID'")[0]->final_price;

					$this->Crud->ciUpdate("cart_master", array(
						'order_id' => $orderid,
						'status' => 1,
						'price' => $product_price,
						'purchase_type' => 2,
					), "`user_id` = '$userid' AND `status` = '0' AND `purchase_type` != '3' AND `product_id` = '$productID'");
				}
				$this->session->set_flashdata("success", "Item ordered successfully.");
			}else{
				$this->session->set_flashdata("danger", "Something went wrong. Try again.");
			}

			redirect('activation_request');
		}
	}

	public function decreaseCartQty(){
		extract($_POST);
		$findProduct = $this->Crud->ciRead("cart_master", "`cart_id` = '$id'");
		$qty = $findProduct[0]->qty;
		$update = $qty - 1;
		$data = [
			'qty' => $update
		];
		$this->Crud->ciUpdate("cart_master", $data, "`cart_id` = '$id'");
	}

	public function increaseCartQty(){
		extract($_POST);
		$findProduct = $this->Crud->ciRead("cart_master", "`cart_id` = '$id'");
		$qty = $findProduct[0]->qty;
		$update = $qty + 1;
		$data = [
			'qty' => $update
		];
		$this->Crud->ciUpdate("cart_master", $data, "`cart_id` = '$id'");
	}

	public function update_cart_qty(){
		extract($_POST);
		$data = [
			'qty' => $qty
		];
		$this->Crud->ciUpdate("cart_master", $data, "`cart_id` = '$id'");
	}

	public function removeFromCart(){
		extract($_POST);
		if($this->Crud->ciDelete("cart_master", "`cart_id` = '$id'")){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function removeAll(){
		$userid = $this->session->userdata('aiplUserId');
		if($this->Crud->ciDelete("cart_master", "`user_id` = '$userid' AND `status` = '0'")){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function addToCart(){
		extract($_POST);
		$customerid = $this->session->userdata('aiplUserId');
		$isExist = $this->Crud->ciCount("cart_master", "`user_id` = '$customerid' AND `product_id` = '$productid' AND `status` = '0'");

		if($isExist > 0){
			$pd = $this->Crud->ciRead("cart_master", "`user_id` = '$customerid' AND `product_id` = '$productid' AND `status` = '0'");

			$productId = $pd[0]->cart_id;

			$pQty = $pd[0]->qty;

			$pQty += $qty;

			$data = [
				'qty' => $pQty
			];

			if($this->Crud->ciUpdate("cart_master", $data, "`cart_id` = '$productId'")){
				echo 1;
			}else{
				echo 0;
			}

		}else{
			$data = [
				'user_id' => $customerid,
				'product_id' => $productid,
				'qty' => $qty,
			];

			if($this->Crud->ciCreate("cart_master", $data)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}

	public function gallery()
	{
		$data['PAGE'] = 'Gallery';
		$this->load->view('include/header', $data);
		$this->load->view('gallery');
		$this->load->view('include/footer');
	}

	public function faq()
	{
		$file = file_get_contents(FCPATH . "admin/content/faq.json");
  		$data['faqs'] = json_decode($file, true);
		$this->load->view('include/header');
		$this->load->view('faq', $data);
		$this->load->view('include/footer');
	}

	public function packages()
	{
		// fetch packages
		$sql="SELECT * FROM `package_master` WHERE `status`=1";
		$query=$this->db->query($sql);
		$data['package']=$query->result_array();
		$this->load->view('include/header');
		$this->load->view('packages', $data);
		$this->load->view('include/footer');
	}

	public function contact()
	{
		$data['contact'] = $this->Crud->ciRead("contact_info", "`id` = '1'");
		$data['PAGE'] = 'Contact';
		$this->load->view('include/header', $data);
		$this->load->view('contact', $data);
		$this->load->view('include/footer');
	}

	public function registration()
	{
		$this->load->view('registration', $data);
	}

	public function check_placement(){
		extract($_POST);

		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `dowline_id` = '$sponsor' AND `position` ='$position'");
		$isExist = $sql->num_rows();
		$result = $sql->result();
		$downline_id = $result[0]->customer_id; 

		if($isExist > 0){
			echo $this->find_another($downline_id, $position);
		}else{
			echo $sponsor;
		}
	}

	public function find_another($sponsor, $position){
		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `dowline_id` = '$sponsor' AND `position` ='$position'");
		$isExist = $sql->num_rows();
		$result = $sql->result();
		$downline_id = $result[0]->customer_id; 

		if($isExist > 0){
			echo $this->find_another($downline_id, $position);
		}else{
			echo $sponsor;
		}
	}

	public function find_sponsor_id(){
		$data = $this->input->post();
		$sponsor = $data['sponsor_id'];
		$isFound = $this->db->query("SELECT * FROM `customer_master` WHERE `customer_id` = '$sponsor'");
		$isExist = $isFound->num_rows();
		$result = $isFound->result();
		if($isExist == 0){
			echo 0;
		}else{
			echo $result[0]->name;
		}
	}

	public function check_position(){
		$data = $this->input->post();
		$downline = $data['downline_id'];
		$position = $data['position'];

		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `dowline_id` = '$downline' AND `position` = '$position'");
		echo $sql->num_rows();
	}

	public function find_pan_number(){
		$data = $this->input->post();
		$pan = $data['pan'];

		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `pan` = '$pan'");
		echo $sql->num_rows();
	}

	public function add_new_member_user(){
		$d = $this->input->post();

		$data = [
			'customer_id' => $d['memberid'],
			'user_name' => $d['name'],
			'user_email' => $d['email'],
			'user_phone' => $d['phone'],
			'password' => $this->encryption->encrypt($d['password']),
			'transaction_password' => $this->encryption->encrypt($d['password']),
			'create_date_time' => date('Y-m-d H:i:s'),
			'user_type' => 2,
		];

		$data2 = [
			'customer_id' => $d['memberid'],
			'name' => $d['name'],
			'sponsor_id' => $d['sponsor'],
			'dowline_id' => $d['downline'],
			'position' => $d['position'],
			'pan' => $d['pan'],
			'member_reason' => $d['remark'],
			'registration_date' => date('Y-m-d H:i:s'),
			'status' => 0,
		];

		if($this->db->insert("user_master", $data)){
			$this->db->insert("customer_master", $data2);
			echo 1;
		}else{
			echo 0;
		}
	}

	private function pay_sponsor_amount($sponsor, $income, $member_id, $package_id){
		$sql2 = $this->db->query("SELECT * FROM `customer_master` WHERE `customer_id` = '$sponsor'");
		$sponsor_details = $sql2->result();

		$sponsor_prev_sponsor_bonus = $sponsor_details[0]->sponsor_bonus;
		$sponsor_prev_main_wallet = $sponsor_details[0]->main_wallet;
		$wallet = $sponsor_details[0]->wallet_income;
		$pv = $sponsor_details[0]->pv;

		$update_sponsor_bonus = floatval($sponsor_prev_sponsor_bonus) + floatval($income);
		$update_main_wallet = floatval($sponsor_prev_main_wallet) + floatval($income);
		$update_wallet = floatval($wallet) + floatval($income);

		$data = [
			'main_wallet' => $update_main_wallet,
			'sponsor_bonus' => $update_sponsor_bonus,
			'wallet_income' => $update_wallet,
		];

		$data2 = [
			'customer_id' => $sponsor,
			'credit' => $income,
			'remarks' => "Activation new member. ID : ".$member_id,
			'package_id' => $package_id,
			'income_type_id' => 1
		];

		$this->db->update("customer_master", $data, "`customer_id` = '$sponsor'");
		$this->db->insert("customer_transaction_master", $data2);
	}

	public function disclaimer()
	{
		$this->load->view('include/header');
		$this->load->view('disclaimer');
		$this->load->view('include/footer');
	}

	public function refund_policy()
	{
		$this->load->view('include/header');
		$this->load->view('refund-policy');
		$this->load->view('include/footer');
	}

	public function privacy_policy()
	{
		$this->load->view('include/header');
		$this->load->view('privacy-policy');
		$this->load->view('include/footer');
	}

	public function return_policy()
	{
		$this->load->view('include/header');
		$this->load->view('return-policy');
		$this->load->view('include/footer');
	}

	public function terms_and_condition()
	{
		$this->load->view('include/header');
		$this->load->view('terms-and-conditions');
		$this->load->view('include/footer');
	}

	public function getCombo(){
		extract($_POST);

		$sql = $this->db->query("SELECT cpm.*, pm.product_name FROM `combo_product_master` cpm JOIN product_master pm ON pm.product_id = cpm.product_id WHERE cpm.`status` = 1 AND cpm.`combo_id` = '4'");
		$result = $sql->result();

		$details = '';
		foreach ($result as $row) {
			$details .= '<tr><td>'.$row->product_name.'</td><td class="text-center">'.$row->quantity.'</td></tr>';
		}

		echo $details;
	}
}