<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	 public function __construct() {

		parent::__construct();
        error_reporting(0);

		$this->load->library('form_validation');

        $this->load->model('Settings_model');
        
        $this->load->library('encryption');

		if (!$this->session->userdata('aiplUserId')) {

            redirect('authentication/login');

        }

     }

	 public function password() {

		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('settings/password');
		$this->load->view('user/layouts/footer');

     }

     public function profile() {
        $userid = $this->session->userdata("aiplUserId");
        $sql = $this->db->query("SELECT u.*, um.user_name as s_name, um.customer_id as s_id FROM user_master u JOIN customer_master c ON c.customer_id = u.customer_id JOIN user_master um ON um.customer_id = c.sponsor_id WHERE u.customer_id = '$userid'");
        $data['DETAILS'] = $sql->result();
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('settings/details', $data);
		$this->load->view('user/layouts/footer');

     }

     public function bank_details() {
        $userid = $this->session->userdata('aiplUserId');
        $data['PAGE'] = 'Bank Details';
        $data['KYC'] = $this->Crud->ciRead("kyc_master", "`customer_id` = '$userid'");
        $data['TOTAL'] = $this->Crud->ciCount("kyc_master", "`customer_id` = '$userid'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/breadcrumb', $data);
		$this->load->view('settings/bank-details');
		$this->load->view('user/layouts/footer');
     }

     public function changePassword() {

        $this->form_validation->set_rules('password', 'Current password', 'required');

        $this->form_validation->set_rules('new_password', 'New password', 'required');

        if ($this->form_validation->run()) {

            $output = $this->Settings_model->changePassword($this->input->post('password'), $this->input->post('new_password'));

            if ($output == 'Password changed') {

                $message = 'success';

            } else {

                $message = 'danger';

            }

            $this->session->set_flashdata($message, $output);

            redirect('settings/password');

        } else {

            $this->session->set_flashdata('danger', 'Please enter valid passwords');

            redirect('settings/password');

        }

    }

    public function changeTransactionPassword() {

        $this->form_validation->set_rules('t_password', 'Current password', 'required');

        $this->form_validation->set_rules('t__password', 'New password', 'required');

        if ($this->form_validation->run()) {

            $output = $this->Settings_model->changeTransactionPassword($this->input->post('t_password'), $this->input->post('t__password'));

            if ($output == 'Password changed') {

                $message = 'success';

            } else {

                $message = 'danger';

            }

            $this->session->set_flashdata($message, $output);

            redirect('settings/password');

        } else {

            $this->session->set_flashdata('danger', 'Please enter valid passwords');

            redirect('settings/password');

        }

    }

    public function changeProfile(){
        $id = $this->session->userdata("aiplUserId");
        extract($_POST);
        $config['upload_path'] = FCPATH . 'uploads/profile';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['overwrite'] = TRUE; // This allows the existing file to be overwritten
        $config['file_name'] = $id . '.png'; // Set the file name to the id of the record being updated
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        unlink(FCPATH . 'uploads/profile'.$id.".png");
        
        if (!$this->upload->do_upload('profile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('warning', "Something went wrong");
            redirect('settings/profile');
        } else {
            $data = array('upload_data' => $this->upload->data());
            $sql="UPDATE `user_master` SET `profile`=1 where `customer_id`='".$id."'";
            $this->db->query($sql);
            $sql="UPDATE `customer_master` SET `profile`='".$id."' where `customer_id`='".$id."'";
            $this->db->query($sql);
            $this->session->set_flashdata('success', "Profile pic updated");
            redirect('settings/profile');
        }
        redirect('settings/profile');
    }

    public function add_bank_details(){
        $userid = $this->session->userdata("aiplUserId");
        extract($_POST);

        $isExist = $this->Crud->ciCount("kyc_master", "`customer_id` = '$userid'");

        if($isExist > 0){
            $data = [
                'bank_name' => $bankname,
                'ac_no' => $account_no,
                'ifsc_code' => $ifsc,
                'payee_name' => $account_holder,
                'updated_date' => date('Y-m-d H:i:s')
            ];

            if($this->Crud->ciUpdate("kyc_master", $data, "`customer_id` = '$userid'")){
                $this->session->set_flashdata("success", "Kyc updated.");
            }else{
                $this->session->set_flashdata("success", "Something went wrong. Try again.");
            }
        }else{
            $data = [
                'bank_name' => $bankname,
                'ac_no' => $account_no,
                'ifsc_code' => $ifsc,
                'payee_name' => $account_holder,
                'customer_id' => $userid,
                'added_date' => date('Y-m-d H:i:s')
            ];

            if($this->Crud->ciCreate("kyc_master", $data)){
                $this->session->set_flashdata("success", "Kyc added.");
            }else{
                $this->session->set_flashdata("success", "Something went wrong. Try again.");
            }
        }

        redirect('settings/bank_details');


    }

    public function updateProfile(){
        extract($_POST);
        $userid = $this->session->userdata("aiplUserId");

        $data = [
            'user_name' => $u_name,
            'user_email' => $u_mail,
            'user_phone' => $u_phone,
        ];

        $data2 = [
            'email' => $u_mail,
            'email2' => $u_mail2,
            'phone' => $u_phone,
            'phone2' => $u_phone2,
            'address' => $u_address,
            'customer_id' => $userid
        ];

        if($this->Crud->ciUpdate("user_master", $data, "`customer_id` = '$userid'")){
            $this->session->set_flashdata("success", "User details added");
            $this->Crud->ciCreate("contact_info", $data2);
        }else{
            $this->session->set_flashdata("danger", "Something went wrong. Try again.");
        }

        redirect('settings/profile');
    }

    public function updateProfileDetails(){
        extract($_POST);
        $userid = $this->session->userdata("aiplUserId");

        $data = [
            'user_name' => $u_name,
            'user_email' => $u_mail,
            'user_phone' => $u_phone,
        ];

        $data2 = [
            'email' => $u_mail,
            'email2' => $u_mail2,
            'phone' => $u_phone,
            'phone2' => $u_phone2,
            'address' => $u_address
        ];

        if($this->Crud->ciUpdate("user_master", $data, "`customer_id` = '$userid'")){
            $this->session->set_flashdata("success", "User details added");
            $this->Crud->ciUpdate("contact_info", $data2, "`customer_id` = '$userid'");
        }else{
            $this->session->set_flashdata("danger", "Something went wrong. Try again.");
        }

        redirect('settings/profile');
    }
    

    public function logout() {
        $data = $this->session->all_userdata();
        foreach ($data as $key => $value) {
            $this->session->unset_userdata($key);
        }
        redirect('user/authentication/login');

	}

}