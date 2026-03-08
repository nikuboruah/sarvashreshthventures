<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewards extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function requests()
	{
		$data['PAGE'] = 'Earnings > Rewards Request';
		$data['STATUS'] = 1;
		$sql = $this->db->query("SELECT rh.*, cm.name, p.package_name, r.rank, r.sv_matching, r.reward, r.reward_amount FROM `rank_history` rh JOIN customer_master cm ON cm.customer_id = rh.customer_id JOIN package_master p ON p.package_id = cm.package_id JOIN rank_master r ON r.id = rh.rank_reward_id WHERE rh.request_status = '1' AND rh.gift_received = '0'");
		$data['REWARD'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('rewards/rewards', $data);
		$this->load->view('layouts/footer');
	}

	public function approve_reward(){
		extract($_POST);

		$data = [
			'gift_received' =>1,
			'approve_reject_date' => date('Y-m-d H:i:s')
		];

		if($r_type == 1){
			if($this->Crud->ciUpdate("rank_history", $data, "`rank_history_id` = '$id'")){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			$sql = $this->db->query("SELECT rh.*, r.reward_amount FROM `rank_history` rh JOIN rank_master r ON r.id = rh.rank_reward_id WHERE rh.rank_history_id = '$id'");
			$rank_d = $sql->result();
			$amount = $rank_d[0]->reward_amount;
			$customer_id = $rank_d[0]->customer_id;

			$customer_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$customer_id'");

			$main_wallet = $customer_details[0]->main_wallet;
			$updated_main_wallet = (int)$main_wallet + (int)$amount;

			$total_income = $customer_details[0]->total_income;
			$updated_total_income = (int)$total_income + (int)$amount;

			if($this->Crud->ciUpdate("rank_history", $data, "`rank_history_id` = '$id'")){
				$this->Crud->ciUpdate("customer_master", array(
					'main_wallet' => $updated_main_wallet,
					'total_income' => $updated_total_income,
				), "`customer_id` = '$customer_id'");

				$data2 = [
					'customer_id' => $customer_id,
					'credit' => $amount,
					'remarks' => "Reward received",
					'income_type_id' => 8
				];
				$this->db->insert("customer_transaction_master", $data2);
				echo 1;
			}else{
				echo 0;
			}
		}
		
	}

	public function approved_rewards()
	{
		$data['PAGE'] = 'Earnings > Approved Rewards';
		$data['STATUS'] = 2;
		$sql = $this->db->query("SELECT rh.*, cm.name, p.package_name, r.rank, r.sv_matching, r.reward, r.reward_amount FROM `rank_history` rh JOIN customer_master cm ON cm.customer_id = rh.customer_id JOIN package_master p ON p.package_id = cm.package_id JOIN rank_master r ON r.id = rh.rank_reward_id WHERE rh.request_status = '1' AND rh.gift_received = '1'");
		$data['REWARD'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('rewards/rewards', $data);
		$this->load->view('layouts/footer');
	}
}
