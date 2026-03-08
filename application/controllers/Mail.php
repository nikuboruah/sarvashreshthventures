<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function compose()
	{
		$data['PAGE'] = 'Support > Compose';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('mail/compose-mail');
		$this->load->view('user/layouts/footer');
	}

	public function inbox()
	{
		$userid = $this->session->userdata('aiplUserId');
		$data['PAGE'] = 'Support > Inbox';
		$data['INBOX'] = $this->Crud->ciRead("support_master", "`to_customer_id` = '$userid'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('mail/mail-inbox');
		$this->load->view('user/layouts/footer');
	}

	public function sent()
	{
		$userid = $this->session->userdata('aiplUserId');
		$data['PAGE'] = 'Support > Sent Mails';
		$data['sent_mails'] = $this->Crud->ciRead("support_master", "`from_customer_id` = '$userid'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('mail/sent-mail');
		$this->load->view('user/layouts/footer');
	}

	public function send_mail(){
		extract($_POST);
		$userid = $this->session->userdata('aiplUserId');

		$data = [
			'from_customer_id' => $userid,
			'to_customer_id' => 'SSVT100000',
			'subject' => $subject,
			'msg' => $message,
		];

		if($this->Crud->ciCreate("support_master", $data)){
			$this->session->set_flashdata("success", "Message sent successfully.");
		}else{
			$this->session->set_flashdata("danger", "Something went wrong. Try again.");
		}

		redirect('mail/compose');
	}
}
