<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function new_topup()
	{
		$data['PAGE'] = 'Topup > New Topup';
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('topup/new-topup');
		$this->load->view('user/layouts/footer');
	}

	public function send_topup_request(){
		$member_id = $this->session->userdata('aiplUserId');
		$d = $this->input->post();

		$request_amount = $d['tamount'];
		$utr_no = $d['utr'];
		$remark = $d['remark'];

		$config['upload_path'] = FCPATH . 'uploads/member/proof';

        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $config['max_size'] = 2048;

        $config['max_width'] = 5000;

        $config['encrypt_name'] = TRUE;

        $config['max_height'] = 5000;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('tproof')) {

            $error = array('error' => $this->upload->display_errors());

            $this->session->set_flashdata('warning', $this->upload->display_errors());
        } else {

            $image_metadata = $this->upload->data();

            $proofImage = $image_metadata['file_name'];
        }

		$data = [
			'amount' => $request_amount,
			'proof' => $proofImage,
			'utr_no' => $utr_no,
			'remark' => $remark,
			'customer_id' => $member_id,
		];

		if($this->Crud->ciCreate("topup_request", $data)){
			$this->session->set_flashdata("success", "Resquest sent successfully.");
		}else{
			$this->session->set_flashdata("danger", "Resquest not sent.");
		}

		redirect('topup/new_topup');
	}

	public function pending_topup()
	{
		$data['PAGE'] = 'Topup > Pending Topup';
		$data['TOPUP'] = 0;
		$member_id = $this->session->userdata('aiplUserId');
		$data['REQUEST'] = $this->Crud->ciRead("topup_request", "`status` = '0' AND `customer_id` = '$member_id'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('topup/topup-requests', $data);
		$this->load->view('user/layouts/footer');
	}

	public function approved_topup()
	{
		$data['PAGE'] = 'Topup > Approved Topup';
		$data['TOPUP'] = 1;
		$member_id = $this->session->userdata('aiplUserId');
		$data['REQUEST'] = $this->Crud->ciRead("topup_request", "`status` = '1' AND `customer_id` = '$member_id'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('topup/topup-requests', $data);
		$this->load->view('user/layouts/footer');
	}

	public function rejected_topup()
	{
		$data['PAGE'] = 'Topup > Rejected Topup';
		$data['TOPUP'] = 2;
		$member_id = $this->session->userdata('aiplUserId');
		$data['REQUEST'] = $this->Crud->ciRead("topup_request", "`status` = '2' AND `customer_id` = '$member_id'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('topup/topup-requests', $data);
		$this->load->view('user/layouts/footer');
	}
}
