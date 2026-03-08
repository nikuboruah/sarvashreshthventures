<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	 public function __construct() {

		parent::__construct();
        error_reporting(0);
		$this->load->library('form_validation');

        $this->load->model('Settings_model');
        
        $this->load->library('encryption');

		if (!$this->session->userdata('aiplAdminId')) {

            redirect('authentication/login');

        }

     }

	 public function password() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('settings/password');
		$this->load->view('layouts/footer');

     }

     public function profile() {
        $data['PAGE'] = 'Settings > Profile';
        $data['CONTACT'] = $this->Crud->ciRead("contact_info", "`id` = '1'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
        $this->load->view('layouts/breadcrumb', $data);
		$this->load->view('settings/profile', $data);
		$this->load->view('layouts/footer');
     }

     public function logo() {
        $data['PAGE'] = 'Site Settings > Logo';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
        $this->load->view('layouts/breadcrumb', $data);
		$this->load->view('settings/logo');
		$this->load->view('layouts/footer');
     }

     public function page_controls() {
        $data['PAGE'] = 'Site Settings > Page Controls';
        $data['PAGE_CONTROL'] = $this->Crud->ciRead("page_status", "`id` != 0");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
        $this->load->view('layouts/breadcrumb', $data);
		$this->load->view('settings/page-controls', $data);
		$this->load->view('layouts/footer');
     }

     public function update_page_status(){
        extract($_POST);

        $data =[
            'status' => $status
        ];

        if($this->Crud->ciUpdate("page_status", $data, "`id` = '$id'")){
            echo 1;
        }else{
            echo 0;
        }
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


    public function logs()
    {

        $data['LOGIN_HISTORY'] = $this->Settings_model->getLoginHistory();

        $this->load->view('layouts/header');
        $this->load->view('layouts/bar');
        $this->load->view('layouts/nav');
        $this->load->view('layouts/sub-header');
        $this->load->view('settings/logs', $data);
        $this->load->view('layouts/footer');
    }

    public function changeFavicon(){
        $id = 'favicon';
        if (isset($_POST['addFavicon'])) {
            extract($_POST);
            $config['upload_path'] = FCPATH . '../portal_assets/images';
            $config['allowed_types'] = 'jpg|ico|jpeg|png';
            $config['overwrite'] = TRUE; // This allows the existing file to be overwritten
            $config['file_name'] = $id . '.ico'; // Set the file name to the id of the record being updated
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('favicon')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            }
            redirect('settings/logo');
        }
    }

    public function updateProfile(){
        extract($_POST);
        $data = [
            'customer_id' => $id,
            'user_name' => $name,
            'user_email' => $email,
            'user_phone' => $phone,
        ];

        if ($this->Crud->ciUpdate("user_master", $data, "`user_id` = '1'")) {
            $this->session->set_flashdata('success', "Profile updated.");
        } else {
            $this->session->set_flashdata('warning', "Something went wrong. Try again.");
        }
        redirect('settings/profile');
    }

    public function changeLogo(){
        $id = 'logo';
        if (isset($_POST['change'])) {
            extract($_POST);
            $config['upload_path'] = FCPATH . '../portal_assets/images';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['overwrite'] = TRUE; // This allows the existing file to be overwritten
            $config['file_name'] = $id . '.png'; // Set the file name to the id of the record being updated
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('logo')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            }
            redirect('settings/logo');
        }
    }

    public function logout() {
        $data = $this->session->all_userdata();
        foreach ($data as $key => $value) {
            $this->session->unset_userdata($key);
        }
        redirect('authentication/login');

	}

}