<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Earnings extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function sponsor_bonus()
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
        $sql="SELECT c.customer_id as cid,c.name as cname,p.package_name as cpackage,c.pan as cpan,s.customer_id as sid,s.name as sname,sp.package_name as spackage, d.customer_id as did,d.name as dname,dp.package_name as dpackage, ct.*,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (((((customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) LEFT JOIN package_master p on c.package_id=p.package_id) LEFT JOIN customer_master s on c.sponsor_id=s.customer_id) LEFT JOIN package_master sp on s.package_id=sp.package_id) LEFT JOIN customer_master d on c.dowline_id=d.customer_id) LEFT JOIN package_master dp on d.package_id=dp.package_id where date_format(ct.vc_date,'%Y-%m-%d')>='".$dtf."' and date_format(ct.vc_date,'%Y-%m-%d')<='".$dtt."' and ct.income_type_id='1' order by ct.id";
	
		
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$data['incomeid']=1;
		$data['PAGE'] = 'Earnings > Sponsor Bonus';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('earnings/sponsor-bonus', $data);
		$this->load->view('layouts/footer');
	}

	public function matching_bonus(){
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
        $sql="SELECT c.customer_id as cid,c.name as cname,p.package_name as cpackage,c.pan as cpan,s.customer_id as sid,s.name as sname,sp.package_name as spackage, d.customer_id as did,d.name as dname,dp.package_name as dpackage, ct.*,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (((((customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) LEFT JOIN package_master p on c.package_id=p.package_id) LEFT JOIN customer_master s on c.sponsor_id=s.customer_id) LEFT JOIN package_master sp on s.package_id=sp.package_id) LEFT JOIN customer_master d on c.dowline_id=d.customer_id) LEFT JOIN package_master dp on d.package_id=dp.package_id where date_format(ct.vc_date,'%Y-%m-%d')>='".$dtf."' and date_format(ct.vc_date,'%Y-%m-%d')<='".$dtt."' and ct.income_type_id='3' order by ct.id";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$data['incomeid']=3;
		$data['PAGE'] = 'Earnings > Matching Bonus';

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('earnings/matching-bonus', $data);
		$this->load->view('layouts/footer');
	}

	public function repurchase_bonus(){
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
        $sql="SELECT c.customer_id as cid,c.name as cname,p.package_name as cpackage,c.pan as cpan,s.customer_id as sid,s.name as sname,sp.package_name as spackage, d.customer_id as did,d.name as dname,dp.package_name as dpackage, ct.*,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (((((customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) LEFT JOIN package_master p on c.package_id=p.package_id) LEFT JOIN customer_master s on c.sponsor_id=s.customer_id) LEFT JOIN package_master sp on s.package_id=sp.package_id) LEFT JOIN customer_master d on c.dowline_id=d.customer_id) LEFT JOIN package_master dp on d.package_id=dp.package_id where date_format(ct.vc_date,'%Y-%m-%d')>='".$dtf."' and date_format(ct.vc_date,'%Y-%m-%d')<='".$dtt."' and ct.income_type_id='2' order by ct.id";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$data['incomeid']=3;
		$data['PAGE'] = 'Earnings > Repurchase Bonus';

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('earnings/repurchase-bonus', $data);
		$this->load->view('layouts/footer');
	}

	public function self_repurchase_bonus(){
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
        $sql="SELECT c.customer_id as cid,c.name as cname,p.package_name as cpackage,c.pan as cpan,s.customer_id as sid,s.name as sname,sp.package_name as spackage, d.customer_id as did,d.name as dname,dp.package_name as dpackage, ct.*,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (((((customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) LEFT JOIN package_master p on c.package_id=p.package_id) LEFT JOIN customer_master s on c.sponsor_id=s.customer_id) LEFT JOIN package_master sp on s.package_id=sp.package_id) LEFT JOIN customer_master d on c.dowline_id=d.customer_id) LEFT JOIN package_master dp on d.package_id=dp.package_id where date_format(ct.vc_date,'%Y-%m-%d')>='".$dtf."' and date_format(ct.vc_date,'%Y-%m-%d')<='".$dtt."' and ct.income_type_id='5' order by ct.id";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$data['incomeid']=3;
		$data['PAGE'] = 'Earnings > Self Repurchase Bonus';

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('earnings/repurchase-bonus', $data);
		$this->load->view('layouts/footer');
	}

	public function rewards_and_awards_bonus(){
		$sql = $this->db->query("SELECT r.*, c.name, rm.rank, rm.pv FROM `rank_history` r JOIN customer_master c ON c.customer_id = r.customer_id JOIN rank_master rm ON rm.id = r.rank_reward_id;
		");
		$data['reward'] = $sql->result();
		$data['PAGE'] = 'Earnings > Rewards &amp; Awards';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('earnings/reward', $data);
		$this->load->view('layouts/footer');
	}

	public function weekly_payments(){
		$data['PAGE'] = 'Earnings > Weekly Payments';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('earnings/weekly-payments');
		$this->load->view('layouts/footer');
	}
}
