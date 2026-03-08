<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}




	public function deduct_fund()
	{
		$data['PAGE'] = 'Fund Deduction > Deduct Fund';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('fund/deduct-fund', $data);
		$this->load->view('user/layouts/footer');
	}


	public function transfer_report()
	{
		$cust_id=$this->session->userdata('aiplUserId');
		
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
   		$sql="SELECT *,date_format(d.date,'%d-%m-%Y %h:%i %p') as dt,w.wallet as wl FROM (customer_master c INNER JOIN deduction_transfer_master d on c.customer_id=d.customer_id) INNER JOIN wallet_master as w on w.id=d.wallet_id where `is_deduct`=0 and date_format(d.date,'%Y-%m-%d')>='".$dtf."' and date_format(d.date,'%Y-%m-%d')<='".$dtt."'  and c.customer_id='".$cust_id."'  order by d.id";

		$query=$this->db->query($sql);
		$data['transfer']=$query->result_array();
		$data['PAGE'] = 'Fund Transfer > Transfer Report';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('fund/transfer-report', $data);
		$this->load->view('user/layouts/footer');
	}


	public function deduction_report()
	{
		$cust_id=$this->session->userdata('aiplUserId');
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
   		$sql="SELECT *,date_format(d.date,'%d-%m-%Y %h:%i %p') as dt,w.wallet as wl FROM (customer_master c INNER JOIN deduction_transfer_master d on c.customer_id=d.customer_id) INNER JOIN wallet_master as w on w.id=d.wallet_id where `is_deduct`=1 and date_format(d.date,'%Y-%m-%d')>='".$dtf."' and date_format(d.date,'%Y-%m-%d')<='".$dtt."' and c.customer_id='".$cust_id."' order by d.id";

		$query=$this->db->query($sql);
		$data['deduction']=$query->result_array();
		$data['PAGE'] = 'Fund Deduction > Deduction Report';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('fund/deduction-report', $data);
		$this->load->view('user/layouts/footer');
	}

	
}
