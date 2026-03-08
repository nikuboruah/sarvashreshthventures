<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function activate_member(){
		$d = $this->input->post();
		$member_id = $d['id'];

		// Member details
		$member_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$member_id'");
		$sponsor = $member_details[0]->sponsor_id;
		$package_id = $member_details[0]->package_id;

		// Package details
		$sql = $this->db->query("SELECT * FROM `order_master` WHERE `customer_id` = '$member_id' ORDER BY `id` asc LIMIT 1");
		$purchase_pv = $sql->row();
		$activation_pv = $purchase_pv->bv;
		
		$data = [
			'status' =>1,
			'activation_status' => 1,
			'activation_date' => date('Y-m-d H:i:s')
		];

		if($this->Crud->ciUpdate("customer_master", $data, "`customer_id` = '$member_id'")){
			$this->add_volume_point($member_id);
			$this->check_matching($member_id);
			$this->check_rank_achievement($member_id);
			$this->check_leadership_duplication($member_id);
			 // activation pv distribution
        	$this->add_activation_pv($activation_pv, $member_id);
			echo 1;
		}else{
			echo 0;
		}
	}

	public function add_volume_point($userid){
		$user = $this->Crud->ciRead("customer_master","customer_id='$userid'");
		if(empty($user)) return;

		$sponsor = $user[0]->dowline_id;
		$position = $user[0]->position;

		if(empty($sponsor)) return;

		$sponsor_data = $this->Crud->ciRead("customer_master","customer_id='$sponsor'")[0];

		if($position == 0){
			$left = $sponsor_data->left_pv + 1;
			$this->Crud->ciUpdate("customer_master",
			['left_pv'=>$left],
			"customer_id='$sponsor'");
		}else{
			$right = $sponsor_data->right_pv + 1;
			$this->Crud->ciUpdate("customer_master",
			['right_pv'=>$right],
			"customer_id='$sponsor'");
		}

		// Check matching
		$this->check_matching($sponsor);
		$this->check_rank_achievement($sponsor);
		$this->check_leadership_duplication($sponsor);

		// Recursive to next upline
		$this->add_volume_point($sponsor);
	}

	public function check_matching($userid){

		$user = $this->Crud->ciRead("customer_master","customer_id='$userid'")[0];

		$left = $user->left_pv;
		$right = $user->right_pv;

		$matched_left = $user->match_left;
		$matched_right = $user->match_right;

		$available_left = $left - $matched_left;
		$available_right = $right - $matched_right;

		$pairs = min($available_left,$available_right);

		if($pairs > 0){

			$new_match_left = $matched_left + $pairs;
			$new_match_right = $matched_right + $pairs;

			$points = $user->total_points + $pairs;

			$data = [
				'match_left' => $new_match_left,
				'match_right' => $new_match_right,
				'total_points' => $points
			];

			$this->Crud->ciUpdate("customer_master",$data,"customer_id='$userid'");
		}
	}

	public function add_activation_pv($pv, $userid){

		$user_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$userid'");
		if(empty($user_details)){
			return;
		}

		$sponsor = $user_details[0]->dowline_id;
		$position = $user_details[0]->position;

		if(empty($sponsor)){
			return;
		}

		$sponsor_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$sponsor'");
		if(empty($sponsor_details)){
			return;
		}

		$left_activation = $sponsor_details[0]->left_activation_pv;
		$right_activation = $sponsor_details[0]->right_activation_pv;

		if((int)$position === 0){

			$updated_left = $left_activation + $pv;

			$data = [
				'left_activation_pv' => $updated_left
			];

		}else{

			$updated_right = $right_activation + $pv;

			$data = [
				'right_activation_pv' => $updated_right
			];
		}

		$this->Crud->ciUpdate("customer_master", $data, "`customer_id` = '$sponsor'");

		// recursive to upline
		$this->add_activation_pv($pv, $sponsor);
	}

	public function check_rank_achievement($userid)
	{
		$user = $this->Crud->ciRead("customer_master","customer_id='$userid'");
		if(empty($user)){
			return;
		}

		$activation_date = $user[0]->activation_date;
		$current_rank_level = $user[0]->reward_rank_id;

		$points =  $user[0]->total_points;

		$rank = '';
		$rank_id = 0;
		$reward = 0;

		if($points >= 150000){
			$rank = 'CROWN DIAMOND';
			$rank_id = 14;
			$reward = 50000000;
		}
		if($points >= 75000){
			$rank = 'GLOBAL DIAMOND';
			$rank_id = 13;
			$reward = 25000000;
		}
		if($points >= 35000){
			$rank = 'PRESIDENTIAL DIAMOND';
			$rank_id = 12;
			$reward = 10000000;
		}
		if($points >= 15000){
			$rank = 'PINK DIAMOND DIR';
			$rank_id = 11;
			$reward = 5000000;
		}
		if($points >= 7500){
			$rank = 'BLUE DIAMOND DIR';
			$rank_id = 10;
			$reward = 2500000;
		}
		if($points >= 3500){
			$rank = 'BLACK DIAMOND DIR';
			$rank_id = 9;
			$reward = 1250000;
		}
		if($points >= 1500){
			$rank = 'DIAMOND DIRECTOR';
			$rank_id = 8;
			$reward = 750000;
		}
		elseif($points >= 750){
			$rank = 'SAPPHIRE DIRECTOR';
			$rank_id = 7;
			$reward = 350000;
		}
		elseif($points >= 350){
			$rank = 'EMERALD DIRECTOR';
			$rank_id = 6;
			$reward = 80000;
		}
		elseif($points >= 150){
			$rank = 'RUBY DIRECTOR';
			$rank_id = 5;
			$reward = 60000;
		}
		elseif($points >= 75){
			$rank = 'TEAM DIRECTOR';
			$rank_id = 4;
			$reward = 30000;
		}
		elseif($points >= 35){
			$rank = 'TEAM CONSULTANT';
			$rank_id = 3;
		}
		elseif($points >= 15){
			$rank = 'TEAM BUILDER';
			$rank_id = 2;
			$reward = 5000;
		}
		elseif($points >= 5){
			$rank = 'TEAM STAR';
			$rank_id = 1;
			$reward = 5000;
		}

		if($rank_id > $current_rank_level){

			$update_data = [
				'reward_rank_id'=>$rank_id
			];

			if($rank_name == 'TEAM STAR'){
				$update_data['team_star_date'] = date('Y-m-d H:i:s');
			}

			if($rank_name == 'TEAM BUILDER'){
				$update_data['team_builder_date'] = date('Y-m-d H:i:s');
			}

			$this->Crud->ciUpdate("customer_master",$update_data,"customer_id='$userid'");

			// Check reward time condition
			$activation = date('Y-m-d', strtotime($activation_date));
			$today = date('Y-m-d');
			$weeks = floor(($today - $activation) / (7*24*60*60));

			if($rank == 'TEAM STAR' && $weeks <= 5){
				$this->give_rank_reward($userid,$reward,$rank,$rank_id);
			}

			if($rank == 'TEAM BUILDER' && $weeks <= 6){
				$this->give_rank_reward($userid,$reward,$rank,$rank_id);
			}
		}
	}

	public function give_rank_reward($userid,$amount,$rank,$rank_id)
	{
		 // Add wallet balance
		$this->db->query("
			UPDATE customer_master 
			SET main_wallet = main_wallet + $amount
			WHERE customer_id='$userid'
		");

		$data = [
			'customer_id'=>$userid,
			'credit'=>$amount,
			'remark'=>$rank.' Reward',
			'vc_date'=>date('Y-m-d H:i:s'),
			'income_type_id'=>$rank_id,
		];

		$this->Crud->ciCreate("customer_transaction_master",$data);
	}

	public function check_leadership_duplication($userid)
	{
		$user = $this->Crud->ciRead("customer_master","customer_id='$userid'");
		if(empty($user)){ return; }

		$rank_level = $user[0]->reward_rank_id;
		$ldb1_status = $user[0]->ldb1_status;
		$ldb2_status = $user[0]->ldb2_status;

		$left = $user[0]->left_id;
		$right = $user[0]->right_id;

		// LEFT MEMBER
		$left_member = $this->Crud->ciRead("customer_master","customer_id='$left'");

		// RIGHT MEMBER
		$right_member = $this->Crud->ciRead("customer_master","customer_id='$right'");

		if(empty($left_member) || empty($right_member)){
			return;
		}

		/* ----------------------------
		BONUS 1
		---------------------------- */

		if($rank_level >= 1 && $ldb1_status == 0){

			$rank_date = strtotime($user[0]->team_star_date);
			$today = strtotime(date('Y-m-d'));
			$weeks = floor(($today - $rank_date)/(7*24*60*60));

			if($weeks <= 16){

				if($left_member[0]->reward_rank_id >= 2 && $right_member[0]->reward_rank_id >= 2){

					$this->give_bonus($userid,8000,"Leadership Duplication Bonus 1", 3);

					$this->Crud->ciUpdate("customer_master",
					['ldb1_status'=>1],
					"customer_id='$userid'");
				}
			}
		}

		/* ----------------------------
		BONUS 2
		---------------------------- */

		if($rank_level >= 2 && $ldb2_status == 0){

			$rank_date = strtotime($user[0]->team_builder_date);
			$today = strtotime(date('Y-m-d'));
			$weeks = floor(($today - $rank_date)/(7*24*60*60));

			if($weeks <= 16){

				if($left_member[0]->reward_rank_id >= 3 && $right_member[0]->reward_rank_id >= 3){

					$this->give_bonus($userid,16000,"Leadership Duplication Bonus 2", 4);

					$this->Crud->ciUpdate("customer_master",
					['ldb2_status'=>1],
					"customer_id='$userid'");
				}
			}
		}
	}

	public function give_bonus($userid,$amount,$remark,$incomeid)
	{
		// Wallet credit
		$this->db->query("
			UPDATE customer_master 
			SET main_wallet = main_wallet + $amount
			WHERE customer_id='$userid'
		");

		$data = [
			'customer_id'=>$userid,
			'credit'=>$amount,
			'remark'=>$remark,
			'vc_date'=>date('Y-m-d H:i:s'),
			'income_type_id'=>$incomeid
		];

		$this->Crud->ciInsert("customer_transaction_master",$data);
	}
}