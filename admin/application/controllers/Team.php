<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		$this->load->library('encryption');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function activate_member(){
		$d = $this->input->post();

		$member_id = $d['id'];
		$package_id = $d['package'];
		$package_amount = $d['pamount'];

		$isExist = $this->Crud->ciRead("customer_master", "`customer_id` = '$member_id' AND `status` = '0'");

		if($isExist == 0){
			$this->session->set_flashdata("warning", "Member ID not found");
			redirect('activation/activation');
		}else{
			$data = [
				'package_id' =>$package_id,
				'status' =>1,
				'activated_by' => $userid,
				'activation_date' => date('Y-m-d H:i:s')
			];

			if($this->Crud->ciUpdate("customer_master", $data, "`customer_id` = '$member_id'")){
				$customer_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$member_id'");

				$this->pay_sponsor_amount($customer_details[0]->package_id, $customer_details[0]->sponsor_id, $customer_details[0]->customer_id);

				$this->give_sv_point($customer_details[0]->dowline_id, $customer_details[0]->package_id, $customer_details[0]->customer_id);

				$this->session->set_flashdata("success", "Member activated successfully.");
			}else{
				$this->session->set_flashdata("danger", "Something went wrong. Try again.");
			}
	
			redirect('activation/activation');
		}
	}

	public function all_members()
	{
		$data['PAGE'] = 'Team > All Members';
		$data['STATUS'] = 1;
		extract($_POST);
		if(isset($_POST['submit'])){
			$FROM = $from;
			$TO = $to;
			$STATUS = $status;

			if($STATUS == 4){
				$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE `id` != 1 AND date_format(c.activation_date, '%Y-%m-%d') >= '$FROM' AND date_format(c.activation_date, '%Y-%m-%d') <= '$TO'");
				$data['TEAM'] = $sql->result();
				$data['FROM'] = $FROM;
				$data['TO'] = $TO;
				$data['STATUSS'] = $STATUS;
			}else{
				$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE `id` != 1 AND date_format(c.activation_date, '%Y-%m-%d') >= '$FROM' AND date_format(c.activation_date, '%Y-%m-%d') <= '$TO' AND c.status = '$STATUS'");
				$data['TEAM'] = $sql->result();
				$data['FROM'] = $FROM;
				$data['TO'] = $TO;
				$data['STATUSS'] = $STATUS;
			}
		}else{
			$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE `id` != 1");
			$data['TEAM'] = $sql->result();
		}
		
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/members', $data);
		$this->load->view('layouts/footer');
	}

	public function direct_sponsors(){
		extract($_POST);
		$data['PAGE'] = 'Team > Direct Sponsor Members';

		$cust__id = $this->uri->segment(3);
		$sql = $this->db->query("SELECT cm.* FROM `customer_master` cm  WHERE cm.sponsor_id = '$cust__id'");
		$data['DIRECT'] = $sql->result();

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/direct-members', $data);
		$this->load->view('layouts/footer');
	}

	public function pending_members()
	{
		$data['PAGE'] = 'Team > Pending Members';
		$data['STATUS'] = 2;

		extract($_POST);
		if(isset($_POST['submit'])){
			$FROM = $from;
			$TO = $to;

			$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE `id` != 1 AND date_format(c.activation_date, '%Y-%m-%d') >= '$FROM' AND date_format(c.activation_date, '%Y-%m-%d') <= '$TO' AND c.status = '0'");
			$data['TEAM'] = $sql->result();
			$data['FROM'] = $FROM;
			$data['TO'] = $TO;
		}else{
			$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE `id` != 1 AND c.status = '0'");
			$data['TEAM'] = $sql->result();
		}

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/members', $data);
		$this->load->view('layouts/footer');
	}

	public function remove_user(){
		extract($_POST);

		if($this->Crud->ciDelete("user_master", "`customer_id` = '$id'")){
			$this->Crud->ciDelete("customer_master", "`customer_id` = '$id'");
			$this->Crud->ciDelete("cart_master", "`user_id` = '$id'");
			$this->Crud->ciDelete("order_master", "`customer_id` = '$id'");
			echo 1;
		}else{
			echo 0;
		}
	}

	public function active_members()
	{
		$data['PAGE'] = 'Team > Active Members';
		$data['STATUS'] = 3;
		extract($_POST);
		if(isset($_POST['submit'])){
			$FROM = $from;
			$TO = $to;

			$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE `id` != 1 AND date_format(c.activation_date, '%Y-%m-%d') >= '$FROM' AND date_format(c.activation_date, '%Y-%m-%d') <= '$TO' AND c.status = '1'");
			$data['TEAM'] = $sql->result();
			$data['FROM'] = $FROM;
			$data['TO'] = $TO;
		}else{
			$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE `id` != 1 AND c.status = '1'");
			$data['TEAM'] = $sql->result();
		}
		$data['PACKAGE'] =$this->Crud->ciRead("package_master", "`status` = '1'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/members', $data);
		$this->load->view('layouts/footer');
	}

	public function blocked_members()
	{
		$data['PAGE'] = 'Team > Blocked Members';
		$data['STATUS'] = 4;
		extract($_POST);
		if(isset($_POST['submit'])){
			$FROM = $from;
			$TO = $to;

			$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE `id` != 1 AND date_format(c.activation_date, '%Y-%m-%d') >= '$FROM' AND date_format(c.activation_date, '%Y-%m-%d') <= '$TO' AND c.status = '2'");
			$data['TEAM'] = $sql->result();
			$data['FROM'] = $FROM;
			$data['TO'] = $TO;
		}else{
			$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE `id` != 1 AND c.status = '2'");
			$data['TEAM'] = $sql->result();
		}
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/members', $data);
		$this->load->view('layouts/footer');
	}

	public function member_details()
	{
		extract($_POST);
		$data['PAGE'] = 'Team > Member Details';
		$sql = $this->db->query("SELECT u.*, c.pan, ci.phone2, ci.email2, ci.address FROM `user_master` u JOIN customer_master c ON c.customer_id = u.customer_id JOIN contact_info ci ON ci.customer_id = u.customer_id WHERE u.customer_id = '$customer_id'");
		$isExist = $sql->num_rows();
		if($isExist == 0){
			$sql = $this->db->query("SELECT u.*, c.pan FROM `user_master` u JOIN customer_master c ON c.customer_id = u.customer_id WHERE u.customer_id = '$customer_id'");
			$data['CUSTOMER_DETAILS'] = $sql->result();
		}else{
			$data['CUSTOMER_DETAILS'] = $sql->result();
		}

		$data['BANK'] = $this->Crud->ciRead("kyc_master", "`customer_id` = '$customer_id'");
		
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/member-details', $data);
		$this->load->view('layouts/footer');
	}

	public function edit_customer_details(){
		extract($_POST);

		$data = [
			'user_name' => $name,
			'user_email' => $email,
			'user_phone' => $phone,
		];

		if($this->Crud->ciUpdate("user_master", $data, "`customer_id` = '$customer_id'")){
			$this->Crud->ciUpdate("customer_master", array(
				'name' => $name,
				'pan' => $pan,
			), "`customer_id` = '$customer_id'");

			$contact_info = $this->Crud->ciCount("contact_info", "`customer_id` = '$customer_id'");
			if($contact_info == 0){
				$data2 = [
					'phone' => $phone,
					'phone2' => $nominee,
					'email' => $email,
					'email2' => $relation,
					'address' => $address,
					'customer_id' => $customer_id,
				];

				$this->Crud->ciCreate("contact_info", $data2);
			}else{
				$data2 = [
					'phone' => $phone,
					'phone2' => $nominee,
					'email' => $email,
					'email2' => $relation,
					'address' => $address
				];

				$this->Crud->ciUpdate("contact_info", $data2, "`customer_id` = '$customer_id'");
			}

			$this->session->set_flashdata("success", "User details updated.");
		}

		redirect('team/all_members');
	}

	public function update_bank_details(){
		extract($_POST);

		$data = [
			'bank_name' => $bank_name,
			'ac_no' => $acc_no,
			'ifsc_code' => $ifsc,
			'payee_name' => $acc_holder,
			'updated_date' => date('Y-m-d H:i:s'),
		];

		if($this->Crud->ciUpdate("kyc_master", $data, "`customer_id` = '$cust_id'")){
			$this->session->set_flashdata("success", "Bank details updated successfully.");
		}else{
			$this->session->set_flashdata("danger", "Something went wrong. Try again.");
		}

		redirect('team/all_members');
	}

	public function find_pan_no(){
		extract($_POST);

		$search = $this->Crud->ciCount("customer_master", "`pan` = '$pan' AND `customer_id` != '$customer'");

		if($search > 0){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function referral_list()
	{
		$data['PAGE'] = 'Referral List';
		$data['LIST'] = 1;
		extract($_POST);
		if(isset($_POST['sendSubmit'])){
			$FROM = $from;
			$TO = $to;
			$data['FROM'] = $FROM;
			$data['TO'] = $TO;
			$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE `id` != 1 AND date_format(c.activation_date, '%Y-%m-%d') >= '$FROM' AND date_format(c.activation_date, '%Y-%m-%d') <= '$TO'");
			$data['TEAM'] = $sql->result();
		}else{
			$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE `id` != 1");
			$data['TEAM'] = $sql->result();
		}
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/referral-downline-list', $data);
		$this->load->view('layouts/footer');
	}

	public function view_referral_list(){
		$d = $this->input->post();
		$customerId = $d['memberid_r_list'];
		$data['PAGE'] = 'Referral List';
		$data['LIST'] = 1;
		$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE c.sponsor_id = '$customerId'");
		$data['TEAM'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/referral-downline-list', $data);
		$this->load->view('layouts/footer');
	}

	public function downline_list()
	{
		$adminID = $this->session->userdata('aiplAdminId');
		$data['PAGE'] = 'Downline List';
		$data['LIST'] = 2;
		$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE c.dowline_id = '$adminID'");
		$data['TEAM'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/referral-downline-list');
		$this->load->view('layouts/footer');
	}

	public function view_downline_list(){
		$d = $this->input->post();
		$customerId = $d['memberid_d_list'];
		$data['PAGE'] = 'Referral List';
		$data['LIST'] = 1;
		$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE c.dowline_id = '$customerId'");
		$data['TEAM'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/referral-downline-list', $data);
		$this->load->view('layouts/footer');
	}

	public function genealogy()
	{	
		$userId = 'SSVT100000';
		$sql="SELECT * FROM `customer_master` WHERE `customer_id`='".$userId."'";
		$query=$this->db->query($sql);
		$details = $query->result();
	
		$data['cname']=$details[0]->name;
		$data['cid']=$details[0]->customer_id;		
		$sql="SELECT * FROM `customer_master` WHERE `customer_id`='".$userId."'";

		
		$query=$this->db->query($sql);
		$data['profile']=$query->result_array()[0]['profile'];
		$data['status']=$query->result_array()[0]['status'];


		$sql="SELECT * FROM `customer_master` WHERE `dowline_id`='".$userId."'  ORDER BY `position` ASC";
		$query=$this->db->query($sql);
		$data['tree']=$query->result_array();
		$data['PAGE'] = 'Genealogy';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/genealogy');
		$this->load->view('layouts/footer');
	}

	public function find_downline(){
		extract($_POST);
	}

	public function team_kyc(){
		$data['PAGE'] = 'Team KYC';
		$sql = $this->db->query("SELECT k.*, u.customer_id as cid, u.user_name FROM `kyc_master` k JOIN user_master u ON u.customer_id = k.customer_id WHERE k.customer_id <> 1");
		$data['KYC'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/team-kyc', $data);
		$this->load->view('layouts/footer');
	}

	public function show_password(){
		$d = $this->input->post();

		$password = $d['password'];
		$cpassword = $d['c_password'];

		echo '<p><b><span class="text-info">Account Password :</span> '.$this->encryption->decrypt($password).'</b><br/> <b><span class="text-info">Transaction Password :</span> '.$this->encryption->decrypt($cpassword).'</b></p>';
	}

	public function change_status(){
		$d = $this->input->post();

		$member_id = $d['cid'];
		$status = $d['status'];

		$data = [
			'status' => $status
		];

		if($this->Crud->ciUpdate("customer_master", $data, "`customer_id` = '$member_id'")){
			$this->Crud->ciUpdate("user_master", $data, "`customer_id` = '$member_id'");
			echo 1;
		}else{
			echo 0;
		}
	}

	public function view_customer_details(){
		extract($_POST);

		$details = $this->Crud->ciRead("customer_master", "`customer_id` = '$c_id'");
		$rank_id = $details[0]->reward_rank_id;

		$rank = '';
		if($rank_id == 0){
			$rank = 'Not Achieve';
		}else{
			$rank = $this->Crud->ciRead("rank_master", "`id` = '$rank_id'")[0]->rank;
		}

		$ACTIVE_RIGHT_MEMBER = 0;
		$ACTIVE_LEFT_MEMBER = 0;

		$right_member = $this->Crud->ciRead("customer_master", "`dowline_id` = '$c_id'");

		foreach ($right_member as $right) {
			if ($right->position == 1) {
				$status = $right->status;
				if ($status == 1) {
					$ACTIVE_RIGHT_MEMBER += 1;
				}

				$customerId = $right->customer_id;
				$ACTIVE_RIGHT_MEMBER += $this->count_right_active_member($customerId);
			}
		}

		foreach ($right_member as $right) {
			if ($right->position == 0) {
				$status = $right->status;
				if ($status == 1) {
					$ACTIVE_LEFT_MEMBER += 1;
				}

				$customerId = $right->customer_id;
				$ACTIVE_LEFT_MEMBER += $this->count_left_active_member($customerId);
			}
		}

		$output .='<table class="table table-bordered">
			<tbody>
				<tr>
					<td>Name</td>
					<td>'.$details[0]->name.'</td>
				</tr>
				<tr>
					<td>Joining On</td>
					<td>'.date('d M Y, h:i A', strtotime($details[0]->registration_date)).'</td>
				</tr>
				<tr>
					<td>Right active members</td>
					<td>'.$ACTIVE_RIGHT_MEMBER.'</td>
				</tr>
				<tr>
					<td>Left active members</td>
					<td>'.$ACTIVE_LEFT_MEMBER.'</td>
				</tr>
				<tr>
					<td>Rank</td>
					<td>'.$rank.'</td>
				</tr>
			</tbody>
		</table>';

		echo $output;
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

	public function upgrade_package(){
		extract($_POST);

		$data = [
			'package_id' => $pack__id,
		];

		$data2 = [
			'pre_package_id' => $pre_pack__id,
			'new_package_id' => $pack__id,
			'customer_id' => $cust__id,
			'added_date' => date('Y-m-d H:i:s'),
		];

		if($this->Crud->ciUpdate("customer_master", $data, "`customer_id` = '$cust__id'")){
			$this->Crud->ciCreate("package_upgrade_master", $data2);
			$this->session->set_flashdata("success", "Package upgrade successfully.");
		}else{
			$this->session->set_flashdata("danger", "Something went wrong. Please try again.");
		}

		redirect('team/active_members');
	}

	public function upgrade_repurchase_bv(){
		extract($_POST);

		$data = [
			'repurchase_right_bv' =>$rbv,
			'repurchase_left_bv' =>$lbv,
		];

		if($this->Crud->ciUpdate("customer_master", $data, "`customer_id` = '$bv_cust__id'")){
			$this->Crud->ciCreate("repurchase_bv_upgrade", [
				'right_bv' => $rbv,
				'left_bv' => $lbv,
				'customer_id' => $bv_cust__id,
				'added_date' => date('Y-m-d'),
			]);
			$this->session->set_flashdata("success", "BV updated successfully.");
		}else{
			$this->session->set_flashdata("danger", "Something went wrong. Try again.");
		}

		redirect('team/all_members');
	}

	public function upgrade_request(){
		$data['PAGE'] = 'Upgrade Request';
		$sql = $this->db->query("SELECT um.*, cm.name, pm.package_name FROM `upgrade_master` um JOIN customer_master cm ON cm.customer_id = um.customer_id JOIN package_master pm ON pm.package_id = um.request_package");
		$data['UPGRADE'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('team/upgrade-request', $data);
		$this->load->view('layouts/footer');
	}

	public function upgrade__(){
		extract($_POST);

		$data = [
			'status' => 1,
			'approved_on' => date('Y-m-d H:i:s')
		];

		if($this->Crud->ciUpdate("upgrade_master", $data, "`id` = '$id'")){
			$this->Crud->ciUpdate("customer_master", [
				"package_id" => $request_package
			], "`customer_id` = '$customer'");

			// Member details
			$member_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$customer'");
			$sponsor = $member_details[0]->sponsor_id;
			$package_id = $member_details[0]->package_id;

			// Package details
			$sql = $this->db->query("SELECT * FROM `order_master` WHERE `customer_id` = '$customer' ORDER BY `id` desc LIMIT 1;");
			$purchase_pv = $sql->row();
			$activation_pv = $purchase_pv->pv;

			$package = $this->Crud->ciRead("package_master", "`package_id` = '$package_id'");
			$sponsor_percentage = $package[0]->referral_income_percentage;
			$package_pv = $package[0]->pv;
			$referral_income = $package_pv*$sponsor_percentage/100;

			// Pay Income
			$this->pay_sponsor_amount($sponsor, $referral_income, $customer, $package_id);
			$this->add_pv($activation_pv, $customer);
			echo 1;
		}else{
			echo 0;
		}
	}

	private function pay_sponsor_amount($sponsor, $income, $member_id, $package_id){
		$sql2 = $this->db->query("SELECT * FROM `customer_master` WHERE `customer_id` = '$sponsor'");
		$sponsor_details = $sql2->result();

		 if (!$sponsor_details) {
			echo "$sponsor - Sponsor not found<br/>";
			return;
		}
		
		$sponsor_prev_sponsor_bonus = $sponsor_details[0]->sponsor_bonus;
		$sponsor_prev_main_wallet = $sponsor_details[0]->main_wallet;
		$wallet = $sponsor_details[0]->wallet_income;

		// Get sponsor weekly capping from package_master
		$package = $sponsor_details[0]->package_id;
		$package_details = $this->db->query("SELECT weekly_capping FROM `package_master` WHERE `package_id` = '$package'")->row_array();
		$weekly_capping = $package_details['weekly_capping'] ?? 0;

		// Calculate sponsor income already received this week
		$week_start = date("Y-m-d 00:00:00", strtotime("monday this week"));
		$week_end = date("Y-m-d 23:59:59", strtotime("sunday this week"));

		$weekly_income = $this->db->select_sum('credit')
			->where("customer_id", $sponsor)
			->where("income_type_id", 1) // 1 = Sponsor Income
			->where("vc_date >=", $week_start)
			->where("vc_date <=", $week_end)
			->get("customer_transaction_master")
			->row()
			->credit;

		$weekly_income = $weekly_income ?? 0;
		$remaining_capping = $weekly_capping - $weekly_income;

		if ($remaining_capping <= 0) {
			echo "$sponsor - Sponsor Weekly capping reached<br/>";
			return;
		}

		if ($income > $remaining_capping) {
			$income = $remaining_capping;
		}

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

	public function add_pv($pv, $userid) {
		$user_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$userid'");
		if (empty($user_details)) {
			return;
		}

		$sponsor = $user_details[0]->dowline_id;
		$position = $user_details[0]->position;

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

		$rank_right = $sponsor_details[0]->rank_right_pv;
		$rank_left = $sponsor_details[0]->rank_left_pv;

		if ((int)$position === 0) {
			$updated_left = $left + $pv;
			$updated_rank_left = $rank_left + $pv;
			$data = ['left_pv' => $updated_left, 'rank_left_pv' => $updated_rank_left];
		} else {
			$updated_right = $right + $pv;
			$updated_rank_right = $rank_right + $pv;
			$data = ['right_pv' => $updated_right, 'rank_right_pv' => $updated_rank_right];
		}

		$this->Crud->ciUpdate("customer_master", $data, "`customer_id` = '$sponsor'");

		$this->add_pv($pv, $sponsor);
	}

	public function reject_upgradation(){
		extract($_POST);

		$data = [
			'rejected_reason' => $reject_reason,
			'approved_on' => date('Y-m-d H:i:s'),
			'status' => 2
		];

		if($this->Crud->ciUpdate("upgrade_master", $data, "`id` = '$upgradeId'")){
			$this->session->set_flashdata("success", "Request rejected successfully.");
		}else{
			$this->session->set_flashdata("danger", "Something went wrong. Please try again.");
		}

		redirect('team/upgrade_request');
	}
}
