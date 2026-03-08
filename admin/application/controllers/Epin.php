<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Epin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function generate_epin()
	{
		$data['PAGE'] = 'Epin Master > Generate Epin';
		$data['STATUS'] = 1;
		$data['PACKAGE'] = $this->Crud->ciRead("package_master", "`status` = '1'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('epin/generate-epin', $data);
		$this->load->view('layouts/footer');
	}

	public function generate_epins(){
		extract($_POST);
		for ($i = 1; $i <= $epins; $i++) {
			$epin = epinValidator();
			$data = [
				'epin' => $epin,
				'generated_date' => date('Y-m-d H:i:s'),
				'package_id' => $package
			];
			$creator = $this->Crud->ciCreate('epins', $data);
			if ($i == $epins) {
				$this->session->set_flashdata('success', "Success, " . $i . " epins generated");
				redirect('epin/generate_epin/');
			}
		}
	}

	public function epin_transfer()
	{
		$data['PAGE'] = 'Epin Master > Epin Trasfer';
		$data['PACKAGE'] = $this->Crud->ciRead("package_master", "`status` = '1'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('epin/transfer-epin', $data);
		$this->load->view('layouts/footer');
	}

	public function unused_epin()
	{
		$data['PAGE'] = 'Epin Management > Unused Epin';
		$sql = $this->db->query("SELECT e.*, p.package_name, p.package_amount FROM `epins` e JOIN package_master p ON p.package_id = e.package_id WHERE e.used = '0'");
		$data['UNUSED'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('epin/unused-epin', $data);
		$this->load->view('layouts/footer');
	}
	
	public function used_epin()
	{
		$sql = $this->db->query("SELECT e.*, p.package_name, p.package_amount, c.name FROM `epins` e JOIN package_master p ON p.package_id = e.package_id JOIN customer_master c ON c.customer_id = e.owner WHERE e.used = '1'");
		$data['UNUSED'] = $sql->result();
		$data['PAGE'] = 'Epin Management > Used Epin';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('epin/used-epin', $data);
		$this->load->view('layouts/footer');
	}

	public function count_epin(){
		extract($_POST);

		echo $this->Crud->ciCount("epins", "`used` = '0' AND `transfer_status` = '0' AND `package_id` = '$pkg'");
	}

	public function find_custid(){
		extract($_POST);

		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `customer_id` = '$customer'");
		$isExist = $sql->num_rows();
		$result = $sql->result();
		if($isExist > 0){
			echo 'Member Name : '.$result[0]->name;
		}else{
			echo 0;
		}
	}

	public function find_epin_amount(){
		extract($_POST);

		$package_price = $this->Crud->ciRead("package_master", "`package_id` = '$packid'")[0]->package_amount;

		echo 'Total Amount : &#8377;'.number_format($total_epin_price = $package_price * $enpin_count, 2);
	}

	public function transfer_epin_to_member(){
		extract($_POST);

		$epins = $this->Crud->ciRead("epins", "`package_id` = '$package' AND `transfer_status` = '0' LIMIT $tepin");

		foreach($epins as $data){
			$epin_no = $data->epin;

			$data = [
				'epin' => $epin_no,
				'transfered_from' => 'ADMIN',
				'transfered_to' => $custid,
				'transfered_date' => date('Y-m-d H:i:s'),
				'package_id' => $package,
			];

			$data2 = [
				'transfer_status' => 1,
				'owner' => $custid
			];

			if($this->Crud->ciCreate("epin_transfer_history", $data)){
				$this->Crud->ciUpdate("epins", $data2, "`epin` = '$epin_no'");
				$this->session->set_flashdata("success", "$tepin epin transferred successfully.");
			}else{
				$this->session->set_flashdata("danger", "Something went wrong. Try again.");
			}
		}

		redirect('epin/epin_transfer');
	}

	public function transfer_history(){
		extract($_POST);

		$sql = $this->db->query("SELECT h.*, p.package_name, p.package_amount FROM `epin_transfer_history` h JOIN package_master p ON p.package_id = h.package_id WHERE `epin` = '$epin'");
		$epins = $sql->result();

		$i = 0;
		foreach($epins as $data){
			echo '<tr>
					<td>'.++$i.'</td>
					<td>'.$data->epin.'</td>
					<td>'.$data->package_name.'</td>
					<td>'.$data->package_amount.'</td>
					<td>'.$data->transfered_from.'</td>
					<td>'.$data->transfered_to.'</td>
					<td>'.date('d M Y, h:i A', strtotime($data->transfered_date)).'</td>
				</tr>';
		}
	}
}
