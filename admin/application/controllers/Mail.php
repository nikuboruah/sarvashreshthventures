<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function compose()
	{
		$data['PAGE'] = 'Support > Compose';
		$d = $this->input->post();
		if($d['memId'] != ''){
			$data['MEMBER_ID'] = $d['memId'];
		}else{
			$data['MEMBER_ID'] = '';
		}
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('mail/compose-mail');
		$this->load->view('layouts/footer');
	}

	public function inbox()
	{
		$userid = $this->session->userdata('aiplAdminId');
		$data['PAGE'] = 'Support > Inbox';
		$data['INBOX'] = $this->Crud->ciRead("support_master", "`to_customer_id` = '$userid'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('mail/mail-inbox');
		$this->load->view('layouts/footer');
	}

	public function sent()
	{
		$userid = $this->session->userdata('aiplAdminId');
		$data['PAGE'] = 'Support > Sent Mails';
		$data['SENT'] = $this->Crud->ciRead("support_master", "`from_customer_id` = '$userid'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('mail/sent-mail');
		$this->load->view('layouts/footer');
	}

	public function find_member_id(){
		extract($_POST);

		echo $findMemberid = $this->Crud->ciCount("customer_master", "`customer_id` = '$member_id'");
	}

	public function send_mail(){
		$userid = $this->session->userdata('aiplAdminId');
		$d = $this->input->post();
		
		$member_id = $d['to'];
		$subject = $d['subject'];
		$message = $d['message'];

		$isExist = $this->Crud->ciCount("customer_master", "`customer_id` = '$member_id'");

		if($isExist == 0){
			$this->session->set_flashdata("success", "Member ID not found.");
			redirect('mail/compose');
		}else{
			$data = [
				'from_customer_id' => $userid,
				'to_customer_id' => $member_id,
				'subject' => $subject,
				'msg' => $message,
			];

			if($this->Crud->ciCreate("support_master", $data)){
				$this->session->set_flashdata("success", "Mail sent to Member.");
			}else{
				$this->session->set_flashdata("success", "Something went wrong. Try again.");
			}

			redirect('mail/compose');
		}
	}
}
