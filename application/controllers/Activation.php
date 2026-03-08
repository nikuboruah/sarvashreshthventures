<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		$this->load->library('upload');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function activate_now(){
		$userid = $this->session->userdata('aiplUserId');
		$d = $this->input->post();

		$epin = $d['epin'];
		// Package details
		$sql = $this->db->query("SELECT *, e.package_id as pakg FROM `epin_transfer_history` e JOIN package_master p on p.package_id = e.package_id WHERE e.epin = '$epin'");
		$package_info = $sql->result();

		$package_id = $package_info[0]->pakg;
		$referral_income = $package_info[0]->referral_income_number;

		// Member details
		$member_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$userid'");
		$sponsor = $member_details[0]->sponsor_id;
		
		$data = [
			'package_id' =>$package_id,
			'status' =>1,
			'epin' => $epin,
			'activation_date' => date('Y-m-d H:i:s')
		];

		if($this->Crud->ciUpdate("customer_master", $data, "`customer_id` = '$userid'")){
			$this->pay_sponsor_amount($sponsor, $referral_income, $userid, $package_id);
			$this->Crud->ciUpdate("epin_transfer_history",array(
				'status' => 3
			), "`epin` = '$epin'");
			$this->Crud->ciUpdate("epins", array(
				'used' => 1,
				'owner' => $userid
			), "`epin` = '$epin'");
			echo 1;
		}else{
			echo 0;
		}
	}

	private function pay_sponsor_amount($sponsor, $income, $member_id, $package_id){
		$sql2 = $this->db->query("SELECT * FROM `customer_master` WHERE `customer_id` = '$sponsor'");
		$sponsor_details = $sql2->result();

		
		$sponsor_prev_sponsor_bonus = $sponsor_details[0]->sponsor_bonus;
		$sponsor_prev_main_wallet = $sponsor_details[0]->main_wallet;
		$wallet = $sponsor_details[0]->wallet_income;
		$bv = $sponsor_details[0]->bv;

		$update_sponsor_bonus = floatval($sponsor_prev_sponsor_bonus) + floatval($income);
		$update_main_wallet = floatval($sponsor_prev_main_wallet) + floatval($income);
		$update_wallet = floatval($wallet) + floatval($income);
		$update_bv = floatval($bv) + floatval($income);

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
}