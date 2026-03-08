<?php
class Package extends CI_Controller
{    
      
    public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

    public function addPackage()
	{
		$d=$this->input->post();

		$query = $this->db->query("SELECT * FROM `package_master` WHERE `package_name` = '".$d['p_name']."'");
		$isExist = $query->num_rows();

		if($isExist > 0){
			echo json_encode(0);
		}else{
			$sql="INSERT INTO `package_master`( `package_name`, `pv`,  `matching_income_percentage`, `weekly_capping`, `lesserleg_volume`) VALUES ('".$d['p_name']."','".$d['bv']."','".$d['matching_income_p']."','".$d['weekly_capping']."','".$d['lesserleg']."')";
			$this->db->query($sql);
			echo json_encode($this->db->affected_rows(),true);
		}
	}

	public function package()
	{
		$data['PAGE'] = 'Package Master > Create Package';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('master/package');
		$this->load->view('layouts/footer');
	}

	public function active_package()
	{
		$sql="SELECT * FROM `package_master` order by `package_id`";
		$data['pack']=$this->db->query($sql)->result_array();
		$data['PAGE'] = 'Package Master > Create Package';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('master/listpackage');
		$this->load->view('layouts/footer');
	}


	public function edit_package()
	{
		$d=$this->input->post();
		
		$sql="UPDATE `package_master` SET `package_name`='".$d['p_name']."',`pv`='".$d['pv']."',`matching_income_percentage`='".$d['matching_income_p']."',`weekly_capping`='".$d['weekly_capping']."',`lesserleg_volume`='".$d['lesserleg']."' WHERE `package_id` = '".$d['packageId']."'";
		$query=$this->db->query($sql);
		echo json_encode($this->db->affected_rows(),true);
	}

	public function changePackageStatus(){
		$d=$this->input->post();
		$sql="UPDATE `package_master` SET `status`='".$d['status']."' WHERE `package_id` = '".$d['id']."'";
		$query=$this->db->query($sql);
		echo json_encode($this->db->affected_rows(),true);
	}

	public function change_free_activation_status(){
		$d=$this->input->post();
		$sql="UPDATE `package_master` SET `free_activation`='".$d['status']."' WHERE `package_id` = '".$d['id']."'";
		$query=$this->db->query($sql);
		echo json_encode($this->db->affected_rows(),true);
	}
}

?>