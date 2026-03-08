<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function active_members()
	{
		$data['PAGE'] = 'Team > Active Members';
		$data['STATUS'] = 3;

		$userId=$this->session->userdata('aiplUserId');
		$data['cname']=$this->session->userdata('aiplUserName');
		
		$data['cid']=$userId;		
		$sql="SELECT * FROM `customer_master` WHERE `customer_id`='".$userId."'";
		$query=$this->db->query($sql);


		$sql="SELECT * FROM `customer_master` WHERE `dowline_id`='".$userId."'  ORDER BY `position` DESC";
		$query=$this->db->query($sql);
		$data['TEAM']=$query->result_array();

		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('team/members', $data);
		$this->load->view('user/layouts/footer');
	}

	public function referral_list()
	{
		$data['PAGE'] = 'Referral List';
		$data['PAGE_LIST'] = 1;
		$userId=$this->session->userdata('aiplUserId');
		extract($_POST);
		$data['FROM'] = '';
		$data['TO'] = '';
		if(isset($_POST['sendSubmit'])){
			$FROM = $from;
			$TO = $to;
			$data['FROM'] = $FROM;
			$data['TO'] = $TO;
			$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE c.sponsor_id = '$userId' AND date_format(c.activation_date, '%Y-%m-%d') >= '$FROM' AND date_format(c.activation_date, '%Y-%m-%d') <= '$TO'");
			$data['LIST'] = $sql->result();
		}else{
			$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE c.sponsor_id = '$userId'");
			$data['LIST'] = $sql->result();
		}
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('team/referral-downline-list', $data);
		$this->load->view('user/layouts/footer');
	}

	public function downline_list()
	{
		$data['PAGE'] = 'Downline List';
		$data['PAGE_LIST'] = 2;
		$userId=$this->session->userdata('aiplUserId');
		$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE c.dowline_id = '$userId'");
		$data['LIST'] = $sql->result();
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('team/referral-downline-list', $data);
		$this->load->view('user/layouts/footer');
	}

	public function view_downline_list(){
		$d = $this->input->post();
		$memberID = $d['memberid_d_list'];
		$data['PAGE'] = 'Downline List';
		$data['PAGE_LIST'] = 2;
		$userId=$this->session->userdata('aiplUserId');
		$sql = $this->db->query("SELECT c.*, u.user_name, u.user_phone, u.password, u.transaction_password FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE c.dowline_id = '$memberID'");
		$data['LIST'] = $sql->result();
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('team/referral-downline-list', $data);
		$this->load->view('user/layouts/footer');
	}

	public function genealogy()
	{
		$userId=$this->session->userdata('aiplUserId');
		
		$data['cname']=$this->session->userdata('aiplUserName');
		$data['cid']=$userId;		
		$sql="SELECT * FROM `customer_master` WHERE `customer_id`='".$userId."'";

		
		$query=$this->db->query($sql);
		$data['profile']=$query->result_array()[0]['profile'];
		$data['status']=$query->result_array()[0]['status'];


		

		$sql="SELECT * FROM `customer_master` WHERE `dowline_id`='".$userId."'  ORDER BY `position` ASC";
		$query=$this->db->query($sql);
		$data['tree']=$query->result_array();

		$data['PAGE'] = 'Genealogy';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('team/genealogy',$data);
		$this->load->view('user/layouts/footer');
	}
}