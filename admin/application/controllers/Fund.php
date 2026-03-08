<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function transfer_fund()	
	{
		$sql="SELECT * FROM `wallet_master` order by `id`";
		$data['wallet']=$this->db->query($sql)->result_array();
		$data['PAGE'] = 'Fund Transfer > Transfer Fund';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('fund/transfer-fund', $data);
		$this->load->view('layouts/footer');
	}

	public function transfer_report()
	{
		$d=$this->input->post();
		
        $dtf=date("Y-m-d");
		$dtt=date("Y-m-d");
        $d=$this->input->post();
        if($d)
        {           
			$dtf=$d['dtf'];
			$dtt=$d['dtt'];
        }

        $data['dtf']=$dtf;
		$data['dtt']=$dtt;
   		$sql="SELECT *,date_format(d.date,'%d-%m-%Y %h:%i %p') as dt,w.wallet as wl FROM (customer_master c INNER JOIN deduction_transfer_master d on c.customer_id=d.customer_id) INNER JOIN wallet_master as w on w.id=d.wallet_id where `is_deduct`=0 and date_format(d.date,'%Y-%m-%d')>='".$dtf."' and date_format(d.date,'%Y-%m-%d')<='".$dtt."'  order by d.id";

		$query=$this->db->query($sql);
		$data['transfer']=$query->result_array();
		$data['PAGE'] = 'Fund Transfer > Transfer Report';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('fund/transfer-report', $data);
		$this->load->view('layouts/footer');
	}

	public function transfer()
	{
		$d=$this->input->post();
		$sql="SELECT * FROM `customer_master` WHERE `customer_id`='".$d['customer_id']."'";
		$this->db->query($sql);


		if($this->db->affected_rows()==0)
		{
			echo json_encode("d");
			return;
		}

		$wl=$d['wallet'];

		
		$amt=$d['amount'];
		if($wl==1) $criteria="`main_wallet`=`main_wallet`+".$amt;
		else if($wl==2)	$criteria="`main_wallet`=`main_wallet`+".$amt.",`sponsor_bonus`=`sponsor_bonus`+".$amt;
		
		else if($wl==3) $criteria="`main_wallet`=`main_wallet`+".$amt.",`hybridglobal_bonus`=`hybridglobal_bonus`+".$amt;
		else if($wl==4) $criteria="`main_wallet`=`main_wallet`+".$amt.",`lifemaker_bonus`=`lifemaker_bonus`+".$amt;
		else if($wl==5) $criteria="`main_wallet`=`main_wallet`+".$amt.",`rank_bonus_wallet`=`rank_bonus_wallet`+".$amt;
		else $criteria="`topup_wallet`=`topup_wallet`+".$amt;

	
		$sql="INSERT INTO `deduction_transfer_master`(`customer_id`, `wallet_id`,`amount`, `remarks`,is_deduct) VALUES ('".$d['customer_id']."','".$d['wallet']."','".$d['amount']."','".$d['remarks']."','0')";
		$this->db->query($sql);
		if($this->db->affected_rows()==1)
		{
			$sql="UPDATE `customer_master` SET ".$criteria." where `customer_id`='".$d['customer_id']."'";		
			$this->db->query($sql);
		}

		echo 1;
		
	}

	public function deduct()
	{
		$d=$this->input->post();
		$sql="SELECT * FROM `customer_master` WHERE `customer_id`='".$d['customer_id']."'";
		// $this->db->query($sql);
		$result=$this->db->query($sql)->result_array();


		if($this->db->affected_rows()==0)
		{
			echo json_encode("d");
			return;
		}

		$wallet=0;
		$mwallet=0;
		$wl=$d['wallet'];
		foreach($result as $rs)
		{
			$mwallet=$rs['main_wallet'];
			if($wl==1) $wallet=$rs['main_wallet'];
			else if($wl==2) $wallet=$rs['sponsor_bonus']; 
			else if($wl==3) $wallet=$rs['hybridglobal_bonus'];
			else if($wl==4) $wallet=$rs['lifemaker_bonus'];
			else if($wl==5) $wallet=$rs['rank_bonus_wallet'];
			else $wallet=$rs['topup_wallet'];
		}
		
		$amt=$d['amount'];
	
		if($wl==6){
			if($wallet<$amt)
			{
				echo json_encode("n");
				return;
			}
		}else{
			if($wallet<$amt || $mwallet<$amt) 
			{
				echo json_encode("n");
				return;
			}
		}
		if($wl==1) $criteria="`main_wallet`=`main_wallet`-".$amt;
		else if($wl==2) $criteria="`main_wallet`=`main_wallet`-".$amt.",`sponsor_bonus`=`sponsor_bonus`-".$amt;
		else if($wl==3) $criteria="`main_wallet`=`main_wallet`-".$amt.",`hybridglobal_bonus`=`hybridglobal_bonus`-".$amt;
		else if($wl==4) $criteria="`main_wallet`=`main_wallet`-".$amt.",`lifemaker_bonus`=`lifemaker_bonus`-".$amt;
		else if($wl==5) $criteria="`main_wallet`=`main_wallet`-".$amt.",`rank_bonus_wallet`=`rank_bonus_wallet`-".$amt;
		else $criteria="`topup_wallet`=`topup_wallet`-".$amt;

	
		$sql="INSERT INTO `deduction_transfer_master`(`customer_id`, `wallet_id`,`amount`, `remarks`) VALUES ('".$d['customer_id']."','".$d['wallet']."','".$d['amount']."','".$d['remarks']."')";
		$this->db->query($sql);
		if($this->db->affected_rows()==1)
		{
			$sql="UPDATE `customer_master` SET ".$criteria." where `customer_id`='".$d['customer_id']."'";		
			$this->db->query($sql);
		}

		echo 1;
		
	}

	public function deduct_fund()
	{
		$sql="SELECT * FROM `wallet_master` order by `id`";
		$data['wallet']=$this->db->query($sql)->result_array();
		$data['PAGE'] = 'Fund Deduction > Deduct Fund';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('fund/deduct-fund', $data);
		$this->load->view('layouts/footer');
	}


	
	public function deduction_report()
	{
		$d=$this->input->post();
		
        $dtf=date("Y-m-d");
		$dtt=date("Y-m-d");
        $d=$this->input->post();
        if($d)
        {           
			$dtf=$d['dtf'];
			$dtt=$d['dtt'];
        }

        $data['dtf']=$dtf;
		$data['dtt']=$dtt;
   		$sql="SELECT *,date_format(d.date,'%d-%m-%Y %h:%i %p') as dt,w.wallet as wl FROM (customer_master c INNER JOIN deduction_transfer_master d on c.customer_id=d.customer_id) INNER JOIN wallet_master as w on w.id=d.wallet_id where `is_deduct`=1 and date_format(d.date,'%Y-%m-%d')>='".$dtf."' and date_format(d.date,'%Y-%m-%d')<='".$dtt."'  order by d.id";

		$query=$this->db->query($sql);
		$data['deduction']=$query->result_array();
		$data['PAGE'] = 'Fund Deduction > Deduction Report';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('fund/deduction-report', $data);
		$this->load->view('layouts/footer');
	}

	public function find_customer_id(){
		$data = $this->input->post();
		$customer = $data['id'];

		$isFound = $this->db->query("SELECT * FROM `customer_master` WHERE `customer_id` = '$customer'");
		$isExist = $isFound->num_rows();
		$result = $isFound->result();
		if($isExist == 0){
			echo 0;
		}else{
			echo 'Member ID found. Name : '.$result[0]->name;
		}
	}
}
