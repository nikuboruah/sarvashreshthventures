<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function member_wallet()
	{
		$sql="SELECT * FROM `customer_master` order by `id` ";
		$data['wallet']=$this->db->query($sql)->result_array();
		$data['SETTINGS'] = $this->Crud->ciRead("setting", "`id` = '1'");
		$data['PAGE'] = 'Wallet Details > Member Wallet';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('wallet/member-wallet', $data);
		$this->load->view('layouts/footer');
	}

	public function member_accounts()
	{
		$data['PAGE'] = 'Wallet Details > Member Accounts';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('wallet/member-accounts');
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
		

		redirect('wallet/member_wallet');
	}
}