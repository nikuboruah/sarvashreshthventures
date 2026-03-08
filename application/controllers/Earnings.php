<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Earnings extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function sponsor_bonus()
	{
		$userid=$this->session->userdata('aiplUserId');
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
        $sql="SELECT ct.*, c.name FROM `customer_transaction_master` ct JOIN customer_master c ON c.customer_id = ct.customer_id WHERE date_format(ct.vc_date,'%Y-%m-%d')>='".$dtf."' and date_format(ct.vc_date,'%Y-%m-%d')<='".$dtt."' and ct.income_type_id='1' and ct.customer_id='".$userid."' order by ct.id";
	
		
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$data['incomeid']=1;
		$data['PAGE'] = 'Earnings > Sponsor Bonus';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('earnings/sponsor-bonus', $data);
		$this->load->view('user/layouts/footer');
	}

	

	public function hybrid_bonus()
	{
		$userid=$this->session->userdata('aiplUserId');
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

		$sql="SELECT ct.*, c.name FROM `customer_transaction_master` ct JOIN customer_master c ON c.customer_id = ct.customer_id WHERE date_format(ct.vc_date,'%Y-%m-%d')>='".$dtf."' and date_format(ct.vc_date,'%Y-%m-%d')<='".$dtt."' and ct.income_type_id='3' and ct.customer_id='".$userid."' order by ct.id";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$data['incomeid']=2;
		$data['PAGE'] = 'Earnings > Matching Bonus';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('earnings/matching-bonus', $data);
		$this->load->view('user/layouts/footer');
	}

	public function repurchase_bonus()
	{
		$userid=$this->session->userdata('aiplUserId');
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

		$sql="SELECT ct.*, c.name FROM `customer_transaction_master` ct JOIN customer_master c ON c.customer_id = ct.customer_id WHERE date_format(ct.vc_date,'%Y-%m-%d')>='".$dtf."' and date_format(ct.vc_date,'%Y-%m-%d')<='".$dtt."' and ct.income_type_id='2' and ct.customer_id='".$userid."' order by ct.id";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$data['incomeid']=3;
		$data['PAGE'] = 'Earnings > Repurchase Bonus';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('earnings/repurchase-bonus', $data);
		$this->load->view('user/layouts/footer');
	}

	public function self_repurchase_bonus()
	{
		$userid=$this->session->userdata('aiplUserId');
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

		$sql="SELECT ct.*, c.name FROM `customer_transaction_master` ct JOIN customer_master c ON c.customer_id = ct.customer_id WHERE date_format(ct.vc_date,'%Y-%m-%d')>='".$dtf."' and date_format(ct.vc_date,'%Y-%m-%d')<='".$dtt."' and ct.income_type_id='5' and ct.customer_id='".$userid."' order by ct.id";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$data['incomeid']=3;
		$data['PAGE'] = 'Earnings > Self Repurchase Bonus';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('earnings/self-repurchase-bonus', $data);
		$this->load->view('user/layouts/footer');
	}


	public function rank_reward()
	{
		$userid=$this->session->userdata('aiplUserId');

   		$sql="SELECT r.*, rm.rank as rk, rm.pv FROM `rank_history` r JOIN rank_master rm ON rm.id = r.rank_reward_id WHERE r.customer_id = '".$userid."'";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$data['PAGE'] = 'Earnings > Rank & Reward';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('earnings/reward', $data);
		$this->load->view('user/layouts/footer');
	}
}
