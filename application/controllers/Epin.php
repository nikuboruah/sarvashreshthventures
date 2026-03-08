<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Epin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function epin_transfer()
	{
		$data['PAGE'] = 'Epin Master > Epin Trasfer';
		$data['STATUS'] = 1;
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('epin/transfer-epin', $data);
		$this->load->view('user/layouts/footer');
	}

	public function unused_epin()
	{
		$userid = $this->session->userdata('aiplUserId');
		$sql = $this->db->query("SELECT e.*, p.package_name, p.package_amount FROM `epin_transfer_history` e JOIN package_master p ON p.package_id = e.package_id WHERE `transfered_to` = '$userid' AND e.status = '1'");
		$data['EPIN'] = $sql->result();
		$data['PAGE'] = 'Epin Management > Unused Epin';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('epin/unused-epin', $data);
		$this->load->view('user/layouts/footer');
	}

	public function used_epin()
	{
		$userid = $this->session->userdata('aiplUserId');
		$sql = $this->db->query("SELECT e.*, p.package_name, p.package_amount, es.owner, c.name FROM `epin_transfer_history` e JOIN package_master p ON p.package_id = e.package_id JOIN epins es ON es.epin = e.epin JOIN customer_master c ON c.customer_id = es.owner WHERE `transfered_to` = '$userid' AND e.status = '3'");
		$data['EPIN'] = $sql->result();
		$data['PAGE'] = 'Epin Management > Used Epin';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('epin/used-epin', $data);
		$this->load->view('user/layouts/footer');
	}
}
