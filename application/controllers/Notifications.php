<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends CI_Controller
{

	 public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function newNotification()
	{
		$sql="SELECT * FROM `user_type` WHERE `id`>1 order by `id`";
		$query=$this->db->query($sql);

		$data['utype']=$query->result_array();
		$data['PAGE'] = 'Notifications > Add Notification';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('notifications/new',$data);
		$this->load->view('user/layouts/footer');
	}

	public function addnotification()
	{
		$d=$this->input->post();
		$sql="INSERT INTO `notifications`(`notification`, `show_until`, `user_type_id`) VALUES ('".$d['notification']."','".$d['until']."','".$d['for']."')";
		$this->db->query($sql);
		echo $this->db->affected_rows();
	}

	

	public function notifications()
	{
		
		$sql="SELECT *,date_format(`show_until`,'%d-%m-%Y') as ud,date_format(`added_date`,'%d-%m-%Y %h:%i %p') as ad FROM `notifications` WHERE `show_until`>=CURDATE() order by id";
		$query=$this->db->query($sql);
		$data['NOTIFICATIONS'] =$query->result_array();
		$data['status']=1;
		$data['PAGE'] = 'Notifications > All Notifications';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('notifications/active', $data);
		$this->load->view('user/layouts/footer');
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
	
	
}
