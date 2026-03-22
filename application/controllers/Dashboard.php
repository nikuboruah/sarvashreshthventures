<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->helper('process_helper');
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}
	public function index() {
		$userid = $this->session->userdata('aiplUserId');
		$sql = $this->db->query("SELECT *,date_format(`show_until`,'%d-%m-%Y') as ud,date_format(`added_date`,'%d-%m-%Y %h:%i %p') as ad FROM `notifications` WHERE `show_until`>=CURDATE() and status=1 and (user_type_id=0 or `member_id` = '$userid') order by id desc");
		$data['NOTIFICATIONS'] = $sql->result();

		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `customer_id` = '$userid'");
		$data['CUSTOMER_DETAILS'] = $sql->result();

		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `sponsor_id` = '$userid'");
		$data['TOTAL_SPONSOR'] = $sql->num_rows();

		$data['TOTAL_MEMBER'] = $this->count_total_member($userid, 0);
		$data['TOTAL_ACTIVE_MEMBER'] = $this->count_active_member($userid);
		$data['TOTAL_INACTIVE_MEMBER'] = $this->count_pending_member($userid);

		$data['TOTAL_ACTIVE_RIGHT_MEMBER'] = 0;
		$data['TOTAL_INACTIVE_RIGHT_MEMBER'] = 0;
		$data['TOTAL_ACTIVE_LEFT_MEMBER'] = 0;
		$data['TOTAL_INACTIVE_LEFT_MEMBER'] = 0;

		$right_member = $this->Crud->ciRead("customer_master", "`dowline_id` = '$userid'");

		foreach ($right_member as $right) {
			if ($right->position == 1) {
				$status = $right->status;
				if ($status == 1) {
					$data['TOTAL_ACTIVE_RIGHT_MEMBER'] += 1;
				}else if($status == 0){
					$data['TOTAL_INACTIVE_RIGHT_MEMBER'] += 1;
				}

				$customerId = $right->customer_id;
				$data['TOTAL_ACTIVE_RIGHT_MEMBER'] += $this->count_right_active_member($customerId);
				$data['TOTAL_INACTIVE_RIGHT_MEMBER'] += $this->count_right_inactive_member($customerId);
			}
		}

		foreach ($right_member as $right) {
			if ($right->position == 0) {
				$status = $right->status;
				if ($status == 1) {
					$data['TOTAL_ACTIVE_LEFT_MEMBER'] += 1;
				}else if($status == 0){
					$data['TOTAL_INACTIVE_LEFT_MEMBER'] += 1;
				}

				$customerId = $right->customer_id;
				$data['TOTAL_ACTIVE_LEFT_MEMBER'] += $this->count_left_active_member($customerId);
				$data['TOTAL_INACTIVE_LEFT_MEMBER'] += $this->count_left_inactive_member($customerId);
			}
		}

		$sql = $this->db->query("SELECT SUM(`req_amt`) as t_payout FROM `payout_request` WHERE `customer_id` = '$userid' AND `status` = '1'");
		$data['PAYOUT'] = $sql->result();


		$sql="SELECT c.customer_id as cid,c.name as cname,p.package_name as cpackage,c.pan as cpan,s.customer_id as sid,s.name as sname,sp.package_name as spackage, d.customer_id as did,d.name as dname,dp.package_name as dpackage, ct.*,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt,r.rank FROM ((((((customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) LEFT JOIN package_master p on c.package_id=p.package_id) LEFT JOIN customer_master s on c.sponsor_id=s.customer_id) LEFT JOIN package_master sp on s.package_id=sp.package_id) LEFT JOIN customer_master d on c.dowline_id=d.customer_id) LEFT JOIN package_master dp on d.package_id=dp.package_id) LEFT JOIN rank_master r on r.id=c.reward_rank_id where  ct.income_type_id='3' and c.customer_id = '".$userid."' order by ct.id";

		$query=$this->db->query($sql);
		$data['income']=$query->result_array();

		$data['rank_list'] = $this->Crud->ciRead("rank_master", "`id` != '0'");

		$user = $this->Crud->ciRead("customer_master","customer_id='$userid'")[0];

		$total_bv = $user->pending_bv;

		// 👉 Get next package
		$next_package = $this->db->query("
			SELECT * FROM package_master
			WHERE pv >= '$total_bv'
			ORDER BY pv ASC
			LIMIT 1
		")->row();

		if($next_package){
			$required_bv = $next_package->pv;
		}else{
			$required_bv = $total_bv; // max achieved
		}

		$data['total_bv'] = $total_bv;
		$data['required_bv'] = $required_bv;

		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('dashboard', $data);
		$this->load->view('user/layouts/footer');
	}

	public function is_activation_request_sent(){
		extract($_POST);
		$userid = $this->session->userdata('aiplUserId');

		$isExist = $this->Crud->ciCount("order_master", "`customer_id` = '$userid' AND `order_status` = '0' AND `payment_status` = '1' AND `approval_date` IS NULL");
		if($isExist > 0){
			echo 0;
		}else{
			echo 1;
		}
	}

	public function find_epin(){
		extract($_POST);
		$userid = $this->session->userdata('aiplUserId');

		$epin = $this->Crud->ciCount("epin_transfer_history", "`transfered_to` = '$userid' AND `status` = '1' AND `epin` = '$epin'");

		if($epin > 0){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function count_total_member($userid, $total){
		$total_member = $total;
		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `dowline_id` = '$userid'");
		$total_member = $sql->num_rows();
		$result = $sql->result();

		foreach($result as $data){
			$customerId = $data->customer_id;
			$total_member += $this->count_total_member($customerId, $total_member);
		}

		return $total_member;
	}

	public function count_active_member($userid){
		$active_member = 0;
		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `dowline_id` = '$userid'");
		$result = $sql->result();

		foreach($result as $data){
			$customerId = $data->customer_id;
			if ($data->status == 1) {
				$active_member += 1;
			}

			$active_member += $this->count_active_member($customerId);
		}

		return $active_member;
	}

	public function count_pending_member($userid){
		$pending_member = 0;
		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `dowline_id` = '$userid'");
		$result = $sql->result();

		foreach($result as $data){
			$customerId = $data->customer_id;
			if ($data->status == 0) {
				$pending_member += 1;
			}

			$pending_member += $this->count_pending_member($customerId);
		}

		return $pending_member;
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

	public function notifications()
	{
		
		$sql="SELECT *,date_format(`show_until`,'%d-%m-%Y') as ud,date_format(`added_date`,'%d-%m-%Y %h:%i %p') as ad FROM `notifications` WHERE `show_until`>=CURDATE() and status=1 and (user_type_id=2 or user_type_id=0)  order by id desc";
		$query=$this->db->query($sql);
		$data['NOTIFICATIONS'] =$query->result_array();
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('notifications/active', $data);
		$this->load->view('user/layouts/footer');
	
	}

	public function welcomeLetter()
	{
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('welcome-letter');
		$this->load->view('user/layouts/footer');
	
	}

	public function logout() {
		$this->session->unset_userdata('aiplUserId');
		 redirect('authentication/login');
	}
}