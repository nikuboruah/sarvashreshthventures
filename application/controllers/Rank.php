<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rank extends CI_Controller {

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function upgrade_request()
	{
		$customerid=$this->session->userdata('aiplUserId');
		$sql="SELECT * FROM customer_master c INNER JOIN package_master p on c.package_id=p.package_id WHERE `customer_id`='".$customerid."'";
		$result=$this->db->query($sql)->result_array();
		$package_amount=$result[0]['package_amount'];		
		$data['current_package']=$result;
		
		$sql="SELECT *  FROM package_master where package_amount>'".$package_amount."' order by package_amount ";
		$data['package']=$this->db->query($sql)->result_array();

		$data['PAGE'] = 'Upgrade Package > Upgrade';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('rank/upgrade-request', $data);
		$this->load->view('user/layouts/footer');
	}

	public function pack_upgrade()
	{
		
		$d=$this->input->post();
		$customerid=$this->session->userdata('aiplUserId');
		

		$sql="SELECT * FROM `customer_master`  WHERE `customer_id`='".$customerid."' and `topup_wallet`>=".$d['amount'];
		$result=$this->db->query($sql);
		if($this->db->affected_rows()==0)
		{
			echo 'd';
			return;
		}


		$sql="SELECT *,`sponsor_id` FROM `customer_master` WHERE `customer_id`='".$customerid."'";
		$result=$this->db->query($sql)->result_array();
		$sponsor_id=$result[0]['sponsor_id'];
		$sponsor_income=round($d['amount']*$d['sp_income']/100,2);
		$sql="INSERT INTO `package_upgrade`(`customer_id`, `package_id`, `upgrade_from_package_id`,amount_paid) VALUES ('".$customerid."','".$d['up_package_id']."','".$d['pre_package_id']."','".$d['amount']."')";
		$this->db->query($sql);
		if($this->db->affected_rows()==1)
		{
			$sql="UPDATE `customer_master` SET `package_id`='".$d['up_package_id']."' ,`pre_package_id` ='".$d['pre_package_id']."',`topup_wallet`=`topup_wallet`-".$d['amount']." where `customer_id`='".$customerid."'";
			$this->db->query($sql);

			$sql="UPDATE `customer_master` SET `total_income`=`total_income`+".$sponsor_income.",`main_wallet`=`main_wallet`+".$sponsor_income.",`sponsor_bonus`=`sponsor_bonus`+".$sponsor_income." WHERE `customer_id`='".$sponsor_id."' and status=1";
            $this->db->query($sql);
            if($this->db->affected_rows()==1){
                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$sponsor_id."','".$sponsor_income."','Sponsor Bonus ','1')";
                $this->db->query($sql);
            }
			
		}
		echo 1;
	}
	public function upgrade_history()
	{
		$customerid=$this->session->userdata('aiplUserId');
		$sql="SELECT *,date_format(p.upgrade_date,'%d-%m-%Y %h:%i %p') as dt,CONCAT(pp.package_name,' - ',pp.package_amount) as pack_from,CONCAT(pt.package_name,' - ',pt.package_amount) as pack_to,pt.package_amount as pt_amount FROM ((customer_master c INNER JOIN package_upgrade p on c.customer_id=p.customer_id) INNER JOIN package_master pp on p.upgrade_from_package_id=pp.package_id) INNER JOIN package_master pt on p.package_id=pt.package_id WHERE p.customer_id='".$customerid."'";
		$data['history']=$this->db->query($sql)->result_array();

		$data['PAGE'] = 'Upgrade Package > History';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('rank/upgrade-history', $data);
		$this->load->view('user/layouts/footer');
	}
}
