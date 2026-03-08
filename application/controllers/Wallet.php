<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function member_wallet()
	{
		$userid=$this->session->userdata('aiplUserId');
		$sql="SELECT * FROM `customer_master` where customer_id='".$userid."' order by `id` ";
		$data['wallet']=$this->db->query($sql)->result_array();

		$data['PAGE'] = 'Wallet Details > Member Wallet';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('wallet/member-wallet');
		$this->load->view('user/layouts/footer');
	}

	public function member_accounts()
	{
		$data['PAGE'] = 'Wallet Details > Member Accounts';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('wallet/member-accounts');
		$this->load->view('user/layouts/footer');
	}
}
