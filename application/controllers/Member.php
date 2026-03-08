<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		$this->load->library('encryption');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function upgrade()
	{
		$data['PAGE'] = 'Upgrade Package';
		$customerid = $this->session->userdata('aiplUserId');

		$sql = $this->db->query("SELECT pm.*, cm.category_name FROM `product_master` pm JOIN category_master cm ON cm.category_id = pm.category_id");
		$data['PRODUCTS'] = $sql->result();

		$sql = $this->db->query("SELECT c.*, p.product_name, p.selling_price, p.product_image_one, p.pv FROM `cart_master` c JOIN product_master p ON p.product_id = c.product_id WHERE c.user_id = '$customerid' AND c.status = '0' AND c.purchase_type != 3");
		$data['cart'] = $sql->result();

		$data['count_cart'] = $this->Crud->ciCount("cart_master", "`user_id` = '$customerid' and `status` = '0' AND `purchase_type` = 3");

		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('member/upgrade');
		$this->load->view('user/layouts/footer');
	}

	public function addToCart(){
		extract($_POST);
		$customerid = $this->session->userdata('aiplUserId');
		$isExist = $this->Crud->ciCount("cart_master", "`user_id` = '$customerid' AND `product_id` = '$productid' AND `status` = '0'");

		if($isExist > 0){
			$pd = $this->Crud->ciRead("cart_master", "`user_id` = '$customerid' AND `product_id` = '$productid' AND `status` = '0' AND 'purchase_type' => 3");

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
				'purchase_type' => 3
			];

			if($this->Crud->ciCreate("cart_master", $data)){
				echo 1;
			}else{
				echo 0;
			}
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

	public function upgrade_now(){
		extract($_POST);
		$userid = $this->session->userdata('aiplUserId');

		$isActive = $this->Crud->ciCount("upgrade_master", "`customer_id` = '$userid' AND `status` = '0'");

		if($isActive > 0){
			$this->session->set_flashdata("success", "You already have a pending request.");
			redirect('member/checkout');
		}else{
			if($mode == 'Cash'){
				$str_result = '0123456789';
				$orderid = 'ORDR'.substr(str_shuffle($str_result), 0, 5).time();
				$package_id = $packid;
				
				$data = [
					'customer_id' =>$userid,
					'request_package' => $package_id,
					'request_on' => date('Y-m-d H:i:s')
				];

				$data2 = [
					'order_id' => $orderid,
					'pv' => $tbv,
					'customer_id' => $userid,
					'grand_total' => $gtotal,
					'address' => $address,
					'payment_mode' => $mode,
					'payment_status' => 1,
					'order_status' => 2,
					'added_on' => date('Y-m-d H:i:s'),
				];
		
				if($this->Crud->ciCreate("upgrade_master", $data)){
					$cart = $this->Crud->ciRead("cart_master", "`user_id` = '$userid' AND `status` = '0' AND `purchase_type` = 3");
					foreach($cart as $item){
						$productID = $item->product_id;
						$product_price = $this->Crud->ciRead("product_master", "`product_id` = '$productID'")[0]->final_price;

						$this->Crud->ciUpdate("cart_master", array(
							'order_id' => $orderid,
							'status' => 1,
							'price' => $product_price,
						), "`user_id` = '$userid' AND `status` = '0' AND `purchase_type` = '3' AND `product_id` = '$productID'");
					}
					$this->Crud->ciCreate("order_master", $data2);
					$this->session->set_flashdata("success", "Activation successful.");
				}else{
					$this->session->set_flashdata("danger", "Something went wrong. Try again.");
				}

				redirect('dashboard/index');
			}else if($mode == 'UPI'){
				$str_result = '0123456789';
				$orderid = 'ORDR'.substr(str_shuffle($str_result), 0, 5).time();

				$config['upload_path'] = FCPATH . '../uploads/member/proof/';
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
				$package_id = $packid;

				$data = [
					'customer_id' =>$userid,
					'request_package' => $package_id,
					'request_on' => date('Y-m-d H:i:s'),
					'transaction_no' => $tranno,
					'proof' => $proof_image,
				];
			

				$data2 = [
					'order_id' => $orderid,
					'pv' => $tbv,
					'customer_id' => $userid,
					'grand_total' => $gtotal,
					'address' => $address,
					'payment_mode' => $mode,
					'transaction_no' => $tranno,
					'proof' => $proof_image,
					'order_status' => 2,
					'payment_status' => 1,
					'added_on' => date('Y-m-d H:i:s'),
				];
		
				if($this->Crud->ciCreate("upgrade_master", $data)){
					$cart = $this->Crud->ciRead("cart_master", "`user_id` = '$userid' AND `status` = '0' AND `purchase_type` = 3");
					foreach($cart as $item){
						$productID = $item->product_id;
						$product_price = $this->Crud->ciRead("product_master", "`product_id` = '$productID'")[0]->final_price;

						$this->Crud->ciUpdate("cart_master", array(
							'order_id' => $orderid,
							'status' => 1,
							'price' => $product_price,
						), "`user_id` = '$userid' AND `status` = '0' AND `purchase_type` = '3' AND `product_id` = '$productID'");
					}
					$this->Crud->ciCreate("order_master", $data2);
					$this->session->set_flashdata("success", "Activation successful.");
				}else{
					$this->session->set_flashdata("danger", "Something went wrong. Try again.");
				}

				redirect('dashboard/index');
			}
		}
	}

	public function cart()
	{
		$userid = $this->session->userdata('aiplUserId');
		$sql = $this->db->query("SELECT c.*, p.product_name, p.selling_price, p.product_image_one, p.pv FROM `cart_master` c JOIN product_master p ON p.product_id = c.product_id WHERE c.user_id = '$userid' AND c.status = '0' AND c.purchase_type = 3");
		$data['cart'] = $sql->result();
		$data['cartItems'] = $sql->num_rows();
		$data['USERSTATUS'] = $this->Crud->ciRead("customer_master", "`customer_id` = '$userid'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('member/cart', $data);
		$this->load->view('user/layouts/footer');
			
	}

	public function checkout()
	{
		$userid = $this->session->userdata('aiplUserId');
		$sql = $this->db->query("SELECT c.*, p.product_name, p.selling_price, p.product_image_one, p.pv FROM `cart_master` c JOIN product_master p ON p.product_id = c.product_id WHERE c.user_id = '$userid' AND c.status = '0' AND c.purchase_type = 3");
		$data['cart'] = $sql->result();

		$data['member_details'] = $this->Crud->ciRead("customer_master", "`customer_id` = '$userid'");

		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('member/checkout', $data);
		$this->load->view('user/layouts/footer');
			
	}

	public function add_new_member()
	{
		$data['PAGE'] = 'Add New Member';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('member/add-member');
		$this->load->view('user/layouts/footer');
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
			'epin' => $d['epin'],
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

	public function welcome_letter(){
		$data['PAGE'] = 'Welcome Letter';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('welcome-letter');
		$this->load->view('user/layouts/footer');
	}
}