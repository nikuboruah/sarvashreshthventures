<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		$this->load->library('encryption');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function pending_topup()
	{
		$data['PAGE'] = 'Topup > Pending Topup';
		$data['TOPUP'] = 0;
		$sql = $this->db->query("SELECT r.*, u.user_name FROM `topup_request` r JOIN user_master u ON u.customer_id = r.customer_id WHERE r.status = '0'");
		$data['REQUEST'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('topup/topup-requests', $data);
		$this->load->view('layouts/footer');
	}

	public function approved_topup()
	{
		$data['PAGE'] = 'Topup > Approved Topup';
		$data['TOPUP'] = 1;
		$sql = $this->db->query("SELECT r.*, u.user_name FROM `topup_request` r JOIN user_master u ON u.customer_id = r.customer_id WHERE r.status = '1'");
		$data['REQUEST'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('topup/topup-requests', $data);
		$this->load->view('layouts/footer');
	}

	public function rejected_topup()
	{
		$data['PAGE'] = 'Topup > Rejected Topup';
		$data['TOPUP'] = 2;
		$sql = $this->db->query("SELECT r.*, u.user_name FROM `topup_request` r JOIN user_master u ON u.customer_id = r.customer_id WHERE r.status = '2'");
		$data['REQUEST'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('topup/topup-requests', $data);
		$this->load->view('layouts/footer');
	}

	public function changeTopupStatus(){
		$d = $this->input->post();

		$status = $d['status'];
		$request_id = $d['rid'];
		$customer_id = $d['c_id'];
		$r_amount = $d['amount'];

		$customer_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$customer_id'");
		$topup_wallet = $customer_details[0]->topup_wallet;
		$updated_amount = $topup_wallet + $r_amount;

		$data = [
			'status' => $status,
			'approve_reject_date' => date('Y-m-d H:i:s')
		];

		if($this->Crud->ciUpdate("topup_request", $data, "`id` = '$request_id'")){
			$this->Crud->ciUpdate("customer_master", array(
				'topup_wallet' => $updated_amount
			), "`customer_id` = '$customer_id'");

			$data2 = [
				'customer_id' => $customer_id,
				'credit' => $r_amount,
				'remarks' => "Topup request approval",
				'income_type_id' => 6
			];
			
			$this->db->insert("customer_transaction_master", $data2);
			$this->session->set_flashdata("success", "Topup request approved.");
		}else{
			$this->session->set_flashdata("success", "Something went wrong. Try again.");
		}

		redirect('topup/pending_topup');
	}

	public function reject_topup_request(){
		$d = $this->input->post();

		$r_id = $d['request_id'];
		$reason = $d['request_reason'];

		$data = [
			'status' => 2,
			'reject_reason' => $reason,
			'approve_reject_date' => date('Y-m-d H:i:s')
		];

		if($this->Crud->ciUpdate("topup_request", $data, "`id` = '$r_id'")){
			$this->session->set_flashdata("success", "Topup request rejected successfully.");
		}else{
			$this->session->set_flashdata("danger", "Something went wrong. Try again.");
		}

		redirect('topup/pending_topup');
	}

	public function check_transaction_password(){
		extract($_POST);

		$find_password = $this->Crud->ciRead("user_master", "`user_id` = '1'");
		$t_password = $this->encryption->decrypt($find_password[0]->transaction_password);

		if($t_password == $password){
			echo 1;
		}else{
			echo 0;
		}
	}
}
