<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		$this->load->library('encryption');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function add_new_member()
	{
		$data['PAGE'] = 'Add New Member';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('member/add-member');
		$this->load->view('layouts/footer');
	}

	public function free_activation()
	{
		$data['PAGE'] = 'Free Activation';
		$sql = $this->db->query("SELECT * FROM `package_master` WHERE `free_activation` = '1' AND `status` = '1'");
		$data['PACKAGES'] = $sql->result();
		$data['TOTAL_PACKAGES'] = $sql->num_rows();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('member/free-activation');
		$this->load->view('layouts/footer');
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

	public function add_new_free_member_admin(){
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
			'package_id' => $d['package'],
			'member_reason' => $d['remark'],
			'registration_date' => date('Y-m-d H:i:s'),
			'activation_date' => date('Y-m-d H:i:s'),
			'status' => 1,
			'is_free' => 1,
		];

		if($this->db->insert("user_master", $data)){
			$this->db->insert("customer_master", $data2);
			// $this->pay_sponsor_amount($d['package'], $d['sponsor'], $d['memberid']);
			$this->give_sv_point($d['downline'], $d['package'], $d['memberid']);
			echo 1;
		}else{
			echo 0;
		}
	}

	private function pay_sponsor_amount($package_id, $sponsor_id, $member_id){
		$sql = $this->db->query("SELECT * FROM `package_master` WHERE `package_id` = '$package_id'");
		$package_details = $sql->result();

		$sponsor_amount = $package_details[0]->sponsor_income_amount;

		$sql2 = $this->db->query("SELECT * FROM `customer_master` WHERE `customer_id` = '$sponsor_id'");
		$sponsor_details = $sql2->result();

		$sponsor_prev_sponsor_bonus = $sponsor_details[0]->sponsor_bonus;
		$sponsor_prev_main_wallet = $sponsor_details[0]->main_wallet;

		$update_sponsor_bonus = $sponsor_prev_sponsor_bonus + $sponsor_amount;
		$update_main_wallet = $sponsor_prev_main_wallet + $sponsor_amount;

		$data = [
			'main_wallet' => $update_main_wallet,
			'sponsor_bonus' => $update_sponsor_bonus,
		];

		$data2 = [
			'customer_id' => $sponsor_id,
			'credit' => $sponsor_amount,
			'remarks' => "Register new member. ID : ".$member_id,
			'package_id' => $package_id,
			'income_type_id' => 1
		];

		$this->db->update("customer_master", $data, "`customer_id` = '$sponsor_id'");
		$this->db->insert("customer_transaction_master", $data2);
	}

	public function give_sv_point($downline_id, $package_id, $member_id){
		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `customer_id` = '$downline_id'");
		$details = $sql->result();
		if($sql->num_rows() > 0){
			$upline_id = $details[0]->dowline_id;
			$prev_sv_point = $details[0]->sv;

			$sql2 = $this->db->query("SELECT * FROM `package_master` WHERE `package_id` = '$package_id'");
			$package_details = $sql2->result();
			$sv_amount = $package_details[0]->sv;

			$updated_sv_point = $prev_sv_point + $sv_amount;

			$data = [
				'sv' => $updated_sv_point
			];

			$data2 = [
				'customer_id' => $downline_id,
				'credit' => 0,
				'remarks' => "Register new member. ID : ".$member_id.". Get another ".$sv_amount." SV point.",
				'package_id' => $package_id,
				'income_type_id' => 0
			];

			$this->db->update("customer_master", $data, "`customer_id` = '$downline_id'");
			$this->db->insert("customer_transaction_master", $data2);
			$this->give_sv_point($upline_id, $package_id, $member_id);
		}
	}

	public function add_new_member_admin(){
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
}
