<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function manageProducts()
	{
		$userList = $this->uri->segment(3);
		if ($userList == 'active') {
			$page_name = 'Active Product';
			$data['PRODUCT'] = $this->Crud->ciRead("product_master", "`status` = '1'");
		} else if ($userList == 'inactive') {
			$page_name = 'Inactive Product';
			$data['PRODUCT'] = $this->Crud->ciRead("product_master", "`status` = '0'");
		}
		$data['page_name']=$page_name;
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('product/manage-products', $data);
		$this->load->view('user/layouts/footer');
	}

	public function viewImages(){
		extract($_POST);
		$images = $this->Crud->ciRead("product_master", "`product_id` = '$id'");
		echo '<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('admin/uploads/products/'.$images[0]->product_image_one).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('admin/uploads/products/'.$images[0]->product_image_two).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('admin/uploads/products/'.$images[0]->product_image_three).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('admin/uploads/products/'.$images[0]->product_image_four).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('admin/uploads/products/'.$images[0]->product_image_five).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('admin/uploads/products/'.$images[0]->product_image_six).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>';
	}

	// Orders
	public function orders(){
		$userid = $this->session->userdata('aiplUserId');
		$page_name = 'All Orders';
		$sql = $this->db->query("SELECT o.*, c.name FROM `order_master` o JOIN customer_master c ON c.customer_id = o.customer_id WHERE o.customer_id = '$userid' order by `added_on` desc");
		$data['orders'] = $sql->result();
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('product/orders', $data);
		$this->load->view('user/layouts/footer');
	}

	public function show_product_list(){
		extract($_POST);

		$sql = $this->db->query("SELECT c.*, p.product_name FROM `cart_master` c JOIN product_master p ON p.product_id = c.product_id WHERE c.order_id = '$oid'");
		$products = $sql->result();
		$id = 0;
		foreach($products as $data){
			echo '<tr>
				<td class="text-center">'.++$id.'</td>
				<td>'.$data->product_name.'</td>
				<td class="text-center">'.$data->qty.'</td>
			</tr>';
		}
	}
}