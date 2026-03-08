<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewards extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function requests()
	{
		$data['PAGE'] = 'Earnings > Rewards Request';
		$data['STATUS'] = 1;
		$userid = $this->session->userdata('aiplUserId');
		$sql = $this->db->query("SELECT r.*, rm.rank, rm.sv_matching, rm.reward, rm.reward_amount FROM `rank_history` r JOIN rank_master rm ON rm.id = r.rank_reward_id WHERE `customer_id` = '$userid' AND r.gift_received = '0'");
		$data['REWARD'] = $sql->result();
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('rewards/rewards-request', $data);
		$this->load->view('user/layouts/footer');
	}

	public function send_request(){
		extract($_POST);

		$data = [
			'request_status' => 1,
			'request_type' => $r_type,
			'requested_date' => date('Y-m-d H:i:s'),
		];

		if($this->Crud->ciUpdate("rank_history", $data, "`rank_history_id` = '$r_id'")){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function approved_rewards()
	{
		$data['PAGE'] = 'Earnings > Approved Rewards';
		$userid = $this->session->userdata('aiplUserId');
		$sql = $this->db->query("SELECT rh.*, cm.name, p.package_name, r.rank, r.sv_matching, r.reward, r.reward_amount FROM `rank_history` rh JOIN customer_master cm ON cm.customer_id = rh.customer_id JOIN package_master p ON p.package_id = cm.package_id JOIN rank_master r ON r.id = rh.rank_reward_id WHERE rh.request_status = '1' AND rh.gift_received = '1' AND rh.customer_id = '$userid'");
		$data['REWARD'] = $sql->result();
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('rewards/rewards', $data);
		$this->load->view('user/layouts/footer');
	}
}
