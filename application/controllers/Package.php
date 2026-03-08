<?php
class Package extends CI_Controller
{    
      
    public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

public function package()
{
	$sql="SELECT * FROM `package_master` WHERE `status` = 1 order by `package_id`";
	$data['pack']=$this->db->query($sql)->result_array();
	$data['PAGE'] = 'Package > All Packages';
	$this->load->view('user/layouts/header');
	$this->load->view('user/layouts/bar');
	$this->load->view('user/layouts/sub-header');
	$this->load->view('user/layouts/nav');
	$this->load->view('user/layouts/breadcrumb', $data);
	$this->load->view('master/package');
	$this->load->view('user/layouts/footer');
}

public function upgrade(){
	$userid = $this->session->userdata('aiplUserId');
	$sql="SELECT um.*, pm.package_name, pm.package_price, pm.pv FROM `upgrade_master` um JOIN package_master pm ON pm.package_id = um.request_package WHERE um.customer_id = '$userid'";
	$data['pack']=$this->db->query($sql)->result();
	$data['PAGE'] = 'Package > Upgrade Request';
	$this->load->view('user/layouts/header');
	$this->load->view('user/layouts/bar');
	$this->load->view('user/layouts/sub-header');
	$this->load->view('user/layouts/nav');
	$this->load->view('user/layouts/breadcrumb', $data);
	$this->load->view('master/upgrade', $data);
	$this->load->view('user/layouts/footer');
}
}

?>