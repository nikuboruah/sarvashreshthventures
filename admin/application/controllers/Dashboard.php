<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function index() {
		$user_id = $this->session->userdata('aiplAdminId');

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('dashboard',$data);
		$this->load->view('layouts/footer');
	}

	public function count_right_active_member($userid) {
		$active_member = 0;
		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `dowline_id` = '$userid'");
		$result = $sql->result();
	
		foreach ($result as $data) {
			$customerId = $data->customer_id;
			if ($data->status == 1) {
				$active_member += 1;
			}
	
			$active_member += $this->count_right_active_member($customerId);
		}
	
		return $active_member;
	}
	

	public function count_right_inactive_member($userid){
		$active_member = 0;
		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `dowline_id` = '$userid'");
		$result = $sql->result();

		foreach($result as $data){
			$customerId = $data->customer_id;
			if ($data->status == 0) {
				$active_member += 1;
			}

			$active_member += $this->count_right_inactive_member($customerId);
		}

		return $active_member;
	}

	public function count_left_active_member($userid){
		$active_member = 0;
		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `dowline_id` = '$userid'");
		$result = $sql->result();

		foreach($result as $data){
			$customerId = $data->customer_id;
			if ($data->status == 1) {
				$active_member += 1;
			}

			$active_member += $this->count_left_active_member($customerId);
		}

		return $active_member;
	}

	public function count_left_inactive_member($userid){
		$active_member = 0;
		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `dowline_id` = '$userid'");
		$result = $sql->result();

		foreach($result as $data){
			$customerId = $data->customer_id;
			if ($data->status == 0) {
				$active_member += 1;
			}

			$active_member += $this->count_left_inactive_member($customerId);
		}

		return $active_member;
	}

	public function count_total_sv($user_id){
		$customers_details = $this->Crud->ciRead("customer_master", "`dowline_id` = '$user_id'");
		$total_sv = 0;

		foreach($customers_details as $customer){
			$c_id = $customer->customer_id;
			$customer_package_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$c_id'");
			if($customer_package_details[0]->status != 0){
				$package = $customer_package_details[0]->package_id;
				$p_sv = $this->Crud->ciRead("package_master", "`package_id` = '$package'")[0]->sv;
				$total_sv += $p_sv;
			}


			$total_sv += $this->count_total_sv($c_id);
		}

		return $total_sv;

	}

	public function logout() {
		$this->session->unset_userdata('aiplAdminId');
		 redirect('authentication/login');
	}
}