<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payouts extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		$this->load->library('encryption');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function payout_requests()
	{
		$data['PAGE'] = 'Payout Details > Payout Requests';
		$data['STATUS'] = 1;
		$sql = $this->db->query("SELECT p.*, u.user_name, u.user_phone, pkg.package_name, k.ac_no, k.ifsc_code, k.payee_name, k.bank_name FROM `payout_request` p JOIN customer_master c ON c.customer_id = p.customer_id JOIN user_master u ON u.customer_id = p.customer_id JOIN package_master pkg ON pkg.package_id = c.package_id JOIN kyc_master k ON k.customer_id = p.customer_id WHERE p.status = '0'");
		$data['PAYOUTS'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('payout/payouts', $data);
		$this->load->view('layouts/footer');
	}

	public function validate_transaction_password(){
		extract($_POST);
		$userid = $this->session->userdata('aiplAdminId');
		$admin_details = $this->Crud->ciRead("user_master", "`customer_id` = '$userid'");
		$admin_password = $admin_details[0]->transaction_password;
		
		if($this->encryption->decrypt($admin_password) == $password){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function approve_customer_wallet(){
		extract($_POST);

		$data = [
			'status' => 1,
			'approve_request_date' => date('Y-m-d H:i:s')
		];

		if($this->Crud->ciUpdate("payout_request", $data, "`id` = '$req_id'")){
			$customer_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$cust_id'");
			$wallet_balance = $customer_details[0]->main_wallet;
			$updated_wallet_balance = (int)$wallet_balance - (int)$r_amount;

			$this->Crud->ciUpdate("customer_master", array(
				'main_wallet' => $updated_wallet_balance
			), "`customer_id` = '$cust_id'");

			$data2 = [
				'customer_id' => $cust_id,
				'debit' => $r_amount,
				'remark' => "Payout request approved",
				'income_type_id' => 6
			];

			$this->Crud->ciCreate("customer_transaction_master", $data2);
			

			$this->session->set_flashdata("success", "Payout request approved successfully.");
		}else{
			$this->session->set_flashdata("danger", "Something went wrong. Try again.");
		}

		redirect('payouts/payout_requests');
	}

	public function reject_payout(){
		extract($_POST);

		$data = [
			'status' => 2,
			'approve_request_date' => date('Y-m-d H:i:s')
		];

		if($this->Crud->ciUpdate("payout_request", $data, "`id` = '$id'")){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function paid_payouts()
	{
		$data['PAGE'] = 'Payout Details > Paid Payouts';
		$data['STATUS'] = 2;
		extract($_POST);
		if(isset($_POST['sendSubmit'])){
			$FROM = $from;
			$TO = $to;
			$data['FROM'] = $FROM;
			$data['TO'] = $TO;
			$sql = $this->db->query("SELECT p.*, u.user_name, u.user_phone, pkg.package_name, k.ac_no, k.ifsc_code, k.payee_name, k.bank_name FROM `payout_request` p JOIN customer_master c ON c.customer_id = p.customer_id JOIN user_master u ON u.customer_id = p.customer_id JOIN package_master pkg ON pkg.package_id = c.package_id JOIN kyc_master k ON k.customer_id = p.customer_id WHERE p.status = '1' AND date_format(p.req_date, '%Y-%m-%d') >= '$FROM' AND date_format(p.req_date, '%Y-%m-%d') <= '$TO'");
			$data['PAYOUTS'] = $sql->result();
		}else{
			$sql = $this->db->query("SELECT p.*, u.user_name, u.user_phone, pkg.package_name, k.ac_no, k.ifsc_code, k.payee_name, k.bank_name FROM `payout_request` p JOIN customer_master c ON c.customer_id = p.customer_id JOIN user_master u ON u.customer_id = p.customer_id JOIN package_master pkg ON pkg.package_id = c.package_id JOIN kyc_master k ON k.customer_id = p.customer_id WHERE p.status = '1'");
			$data['PAYOUTS'] = $sql->result();
		}
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('payout/payouts', $data);
		$this->load->view('layouts/footer');
	}

	public function rejected_payouts()
	{
		$data['PAGE'] = 'Payout Details > Rejected Payouts';
		$data['STATUS'] = 3;
		extract($_POST);
		if(isset($_POST['sendSubmit'])){
			$FROM = $from;
			$TO = $to;
			$data['FROM'] = $FROM;
			$data['TO'] = $TO;
			$sql = $this->db->query("SELECT p.*, u.user_name, u.user_phone, pkg.package_name, k.ac_no, k.ifsc_code, k.payee_name, k.bank_name FROM `payout_request` p JOIN customer_master c ON c.customer_id = p.customer_id JOIN user_master u ON u.customer_id = p.customer_id JOIN package_master pkg ON pkg.package_id = c.package_id JOIN kyc_master k ON k.customer_id = p.customer_id WHERE p.status = '2' AND date_format(p.req_date, '%Y-%m-%d') >= '$FROM' AND date_format(p.req_date, '%Y-%m-%d') <= '$TO'");
			$data['PAYOUTS'] = $sql->result();
		}else{
			$sql = $this->db->query("SELECT p.*, u.user_name, u.user_phone, pkg.package_name, k.ac_no, k.ifsc_code, k.payee_name, k.bank_name FROM `payout_request` p JOIN customer_master c ON c.customer_id = p.customer_id JOIN user_master u ON u.customer_id = p.customer_id JOIN package_master pkg ON pkg.package_id = c.package_id JOIN kyc_master k ON k.customer_id = p.customer_id WHERE p.status = '2'");
			$data['PAYOUTS'] = $sql->result();
		}
		
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('payout/payouts', $data);
		$this->load->view('layouts/footer');
	}

	public function payout_days(){
		$data['PAGE'] = 'Payout Details > Payout Days';
		$data['DAYS'] = $this->Crud->ciRead("payout_days", "`id` != 0");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('payout/payouts-days', $data);
		$this->load->view('layouts/footer');
	}

	public function update_days_status(){
		extract($_POST);

		$data =[
			'status' => $status
		];

		if($this->Crud->ciUpdate("payout_days", $data, "`id` = '$id'")){
			echo 1;
		}else{
			echo 0;
		}
	}


	public function weekly_payouts(){
		$data['PAGE'] = 'Weekly Payout Details > Payouts';
		$settings_sql = $this->db->query("SELECT * FROM `setting`");
		$query = $settings_sql->result();
		$min_withdrawl = $query[0]->min_withdrawal_amt;
		$sql="SELECT cm.* FROM `customer_master` cm JOIN kyc_master km ON km.customer_id = cm.customer_id WHERE cm.main_wallet >= '".$min_withdrawl."'";
		$data['wallet']=$this->db->query($sql)->result_array();
		$data['SETTINGS'] = $settings_sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('payout/weekly-payouts', $data);
		$this->load->view('layouts/footer');
	}

	public function pay_amount(){
		extract($_POST);

		$customer_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$c_id'");
		$wallet_balance = $customer_details[0]->main_wallet;
		$updated_wallet_balance = (int)$wallet_balance - (int)$p_amt;

		$this->Crud->ciUpdate("customer_master", array(
			'main_wallet' => $updated_wallet_balance
		), "`customer_id` = '$c_id'");

		$data2 = [
			'customer_id' => $c_id,
			'debit' => $p_amt,
			'remark' => "Payout form admin",
			'income_type_id' => 6
		];

		$data4 = [
			'req_amt' => $p_amt,
			'processing_amt' => (int)$p_amt - (int)$net_amt,
			'final_amount' => $net_amt,
			'customer_id' => $c_id,
			'approve_request_date' => date('Y-m-d H:i:s'),
			'status' => 1,
		];

		$this->Crud->ciCreate("customer_transaction_master", $data2);
		$this->Crud->ciCreate("payout_request", $data4);
		

		$this->session->set_flashdata("success", "Payout send successfully.");
		

		redirect('payouts/weekly_payouts');
	}


	public function find_payout_list(){
		extract($_POST);
		$sql = $this->db->query("SELECT pr.*, k.bank_name, k.ac_no, k.ifsc_code, k.payee_name FROM `payout_request` pr JOIN kyc_master k ON k.customer_id = pr.customer_id WHERE date_format(pr.approve_request_date, '%Y-%m-%d') = '$pdate' AND pr.status = 1");
		$data['DETAILS'] = $sql->result();
		$data['isExist'] = $sql->num_rows();
		$this->load->view('payout/payout-list', $data);
	}
}
