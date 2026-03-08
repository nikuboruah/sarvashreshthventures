<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rank extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}


	public function upgrade_history()
	{
		$customerid=$this->session->userdata('aiplUserId');

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
   	
		$sql="SELECT *,date_format(p.upgrade_date,'%d-%m-%Y %h:%i %p') as dt,CONCAT(pp.package_name,' - ',pp.package_amount) as pack_from,CONCAT(pt.package_name,' - ',pt.package_amount) as pack_to,pt.package_amount as pt_amount FROM ((customer_master c INNER JOIN package_upgrade p on c.customer_id=p.customer_id) INNER JOIN package_master pp on p.upgrade_from_package_id=pp.package_id) INNER JOIN package_master pt on p.package_id=pt.package_id where date_format(p.upgrade_date,'%Y-%m-%d')>='".$dtf."' and date_format(p.upgrade_date,'%Y-%m-%d')<='".$dtt."'  order by p.upgrade_date";
		$data['history']=$this->db->query($sql)->result_array();

		$data['PAGE'] = 'Upgrade Package > History';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('rank/upgrade-history', $data);
		$this->load->view('layouts/footer');
	}

	public function upgrade_request()
	{
		$data['PAGE'] = 'Upgrade Rank > Upgrade Request';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('rank/upgrade-request', $data);
		$this->load->view('layouts/footer');
	}

	public function pending_request()
	{
		$data['PAGE'] = 'Upgrade Rank > Pending Rank';
		$data['STATUS'] = 1;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('rank/rank-request', $data);
		$this->load->view('layouts/footer');
	}

	public function approved_request()
	{
		$data['PAGE'] = 'Upgrade Rank > Approved Rank';
		$data['STATUS'] = 2;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('rank/rank-request', $data);
		$this->load->view('layouts/footer');
	}

	public function rejected_request()
	{
		$data['PAGE'] = 'Upgrade Rank > Rejected Rank';
		$data['STATUS'] = 3;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('rank/rank-request', $data);
		$this->load->view('layouts/footer');
	}

	public function rank_details()
	{
		$data['PAGE'] = 'Rank List';
		$data['RANK'] = $this->Crud->ciRead("rank_master", "`id` <> 0");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('rank/rank-list', $data);
		$this->load->view('layouts/footer');
	}

	public function update_reward(){
		extract($_POST);

		$data = [
			'reward' => $amt,
			'updated_on' => date('Y-m-d H:i:s')
		];

		if($this->Crud->ciUpdate("rank_master", $data, "`id` = '$rid'")){
			$this->session->set_flashdata('success', 'Reward updated successfully');
		}else{
			$this->session->set_flashdata('error', 'Failed to update reward');
		}
		redirect('rank/rank_details');
	}
}
