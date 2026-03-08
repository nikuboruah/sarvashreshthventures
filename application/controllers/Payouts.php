<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payouts extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		error_reporting(0);
		$this->load->library('encryption');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function my_earnings()
	{
		$userid = $this->session->userdata('aiplUserId');
		$data['EARNINGS'] = $this->Crud->ciRead("customer_transaction_master", "`customer_id` = '$userid'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('payout/my-earnings');
		$this->load->view('user/layouts/footer');
	}

	public function payout_requests()
	{
		$userid = $this->session->userdata('aiplUserId');
		$data['WALLET'] = $this->Crud->ciRead("customer_master", "`customer_id` = '$userid'");
		$data['SETTINGS'] = $this->Crud->ciRead("setting", "`id` = '1'");
		$data['BANK_DETAILS'] =  $this->Crud->ciCount('kyc_master', "`customer_id` = '$userid'");
		$data['PAGE'] = 'Payout Details > Payout Requests';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('payout/payout-request');
		$this->load->view('user/layouts/footer');
	}

	public function check_transaction_password(){
		extract($_POST);
		$userid = $this->session->userdata('aiplUserId');
		$customer_details = $this->Crud->ciRead("user_master", "`customer_id` = '$userid'");
		$customer_password = $customer_details[0]->transaction_password;
		
		if($this->encryption->decrypt($customer_password) == $password){
			echo 1;
		}else{
			echo 0;
		}

	}

	public function send_payout_request(){
		extract($_POST);
		$userid = $this->session->userdata('aiplUserId');

		$data = [
			'req_amt' => $req_amt,
			'processing_amt' => $p_amount,
			'final_amount' => $f_amount,
			'customer_id' => $userid,
		];

		if($this->Crud->ciCreate("payout_request", $data)){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function pending_payouts()
	{
		$data['PAGE'] = 'Payout Details > Pending Payouts';
		$data['STATUS'] = 1;
		$userid = $this->session->userdata('aiplUserId');
		extract($_POST);
		if(isset($_POST['sendSubmit'])){
			$FROM = $from;
			$TO = $to;
			$data['FROM'] = $FROM;
			$data['TO'] = $TO;
			$sql = $this->db->query("SELECT p.*, u.user_name, u.user_phone, pkg.package_name, k.ac_no, k.ifsc_code, k.payee_name, k.bank_name FROM `payout_request` p JOIN customer_master c ON c.customer_id = p.customer_id JOIN user_master u ON u.customer_id = p.customer_id JOIN package_master pkg ON pkg.package_id = c.package_id JOIN kyc_master k ON k.customer_id = p.customer_id WHERE p.`customer_id` = '$userid' AND p.status = '0' AND date_format(p.req_date, '%Y-%m-%d') >= '$FROM' AND date_format(p.req_date, '%Y-%m-%d') <= '$TO'");
			$data['PAYOUTS'] = $sql->result();
		}else{
			$sql = $this->db->query("SELECT p.*, u.user_name, u.user_phone, pkg.package_name, k.ac_no, k.ifsc_code, k.payee_name, k.bank_name FROM `payout_request` p JOIN customer_master c ON c.customer_id = p.customer_id JOIN user_master u ON u.customer_id = p.customer_id JOIN package_master pkg ON pkg.package_id = c.package_id JOIN kyc_master k ON k.customer_id = p.customer_id WHERE p.`customer_id` = '$userid' AND p.status = '0'");
			$data['PAYOUTS'] = $sql->result();
		}

		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('payout/payouts', $data);
		$this->load->view('user/layouts/footer');
	}

	public function paid_payouts()
	{
		$data['PAGE'] = 'Payout Details > Paid Payouts';
		$data['STATUS'] = 2;
		$userid = $this->session->userdata('aiplUserId');
		extract($_POST);
		if(isset($_POST['sendSubmit'])){
			$FROM = $from;
			$TO = $to;
			$data['FROM'] = $FROM;
			$data['TO'] = $TO;
			$sql = $this->db->query("SELECT p.*, u.user_name, u.user_phone, pkg.package_name, k.ac_no, k.ifsc_code, k.payee_name, k.bank_name FROM `payout_request` p JOIN customer_master c ON c.customer_id = p.customer_id JOIN user_master u ON u.customer_id = p.customer_id JOIN package_master pkg ON pkg.package_id = c.package_id JOIN kyc_master k ON k.customer_id = p.customer_id WHERE p.`customer_id` = '$userid' AND p.status = '1' AND date_format(p.req_date, '%Y-%m-%d') >= '$FROM' AND date_format(p.req_date, '%Y-%m-%d') <= '$TO'");
			$data['PAYOUTS'] = $sql->result();
		}else{
			$sql = $this->db->query("SELECT p.*, u.user_name, u.user_phone, pkg.package_name, k.ac_no, k.ifsc_code, k.payee_name, k.bank_name FROM `payout_request` p JOIN customer_master c ON c.customer_id = p.customer_id JOIN user_master u ON u.customer_id = p.customer_id JOIN package_master pkg ON pkg.package_id = c.package_id JOIN kyc_master k ON k.customer_id = p.customer_id WHERE p.`customer_id` = '$userid' AND p.status = '1'");
			$data['PAYOUTS'] = $sql->result();
		}
		
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('payout/payouts', $data);
		$this->load->view('user/layouts/footer');
	}

	public function rejected_payouts()
	{
		$data['PAGE'] = 'Payout Details > Rejected Payouts';
		$data['STATUS'] = 3;
		$userid = $this->session->userdata('aiplUserId');
		extract($_POST);
		if(isset($_POST['sendSubmit'])){
			$FROM = $from;
			$TO = $to;
			$data['FROM'] = $FROM;
			$data['TO'] = $TO;
			$sql = $this->db->query("SELECT p.*, u.user_name, u.user_phone, pkg.package_name, k.ac_no, k.ifsc_code, k.payee_name, k.bank_name FROM `payout_request` p JOIN customer_master c ON c.customer_id = p.customer_id JOIN user_master u ON u.customer_id = p.customer_id JOIN package_master pkg ON pkg.package_id = c.package_id JOIN kyc_master k ON k.customer_id = p.customer_id WHERE p.`customer_id` = '$userid' AND p.status = '2' AND date_format(p.req_date, '%Y-%m-%d') >= '$FROM' AND date_format(p.req_date, '%Y-%m-%d') <= '$TO'");
			$data['PAYOUTS'] = $sql->result();
		}else{
			$sql = $this->db->query("SELECT p.*, u.user_name, u.user_phone, pkg.package_name, k.ac_no, k.ifsc_code, k.payee_name, k.bank_name FROM `payout_request` p JOIN customer_master c ON c.customer_id = p.customer_id JOIN user_master u ON u.customer_id = p.customer_id JOIN package_master pkg ON pkg.package_id = c.package_id JOIN kyc_master k ON k.customer_id = p.customer_id WHERE p.`customer_id` = '$userid' AND p.status = '2'");
			$data['PAYOUTS'] = $sql->result();
		}
		
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('payout/payouts', $data);
		$this->load->view('user/layouts/footer');
	}
}
