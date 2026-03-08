<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends CI_Controller
{

	 public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function newNotification()
	{
		$data['PAGE'] = 'Notifications > Add Notification';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('notifications/new',$data);
		$this->load->view('layouts/footer');
	}

	public function addnotification()
	{
		$d=$this->input->post();
		$sql="INSERT INTO `notifications`(`notification`, `show_until`, `user_type_id`, `member_id`) VALUES ('".$d['notification']."','".$d['show_until']."','".$d['added_for']."', '".$d['member_id']."')";
		$this->db->query($sql);
		$affeted_rows = $this->db->affected_rows();

		if($affeted_rows > 0){
			$this->session->set_flashdata("success", "Notification sent.");
		}else{
			$this->session->set_flashdata("danger", "Something went wrong. Try again.");
		}

		redirect('notifications/newNotification');
	}

	

	public function notifications()
	{
		
		$sql="SELECT *,date_format(`show_until`,'%d-%m-%Y') as ud,date_format(`added_date`,'%d-%m-%Y %h:%i %p') as ad FROM `notifications` WHERE `show_until`>=CURDATE() order by id";
		$query=$this->db->query($sql);
		$data['NOTIFICATIONS'] =$query->result_array();
		$data['status']=1;
		$data['PAGE'] = 'Notifications > All Notifications';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('notifications/active', $data);
		$this->load->view('layouts/footer');
	}
	
	
	
	public function disableNotification()
	{
		if ($this->uri->segment(3)) {
			$id = $this->uri->segment(3);
			$data = [
				'status' => 0
			];
			$this->Crud->ciUpdate('notifications', $data, " `id` = '$id'");
			$this->session->set_flashdata('success', "Success");
		}
		redirect('notifications/notifications');
	}
	
	public function find_memberid(){
		extract($_POST);

		$find_mid = $this->Crud->ciCount("user_master", "`customer_id` = '$mid' AND `user_type` != '1'");
		if($find_mid > 0){
			echo 1;
		}else{
			echo 0;
		}
	}
}
