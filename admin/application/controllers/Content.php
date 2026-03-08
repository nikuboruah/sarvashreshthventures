<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

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

	 public function about_content() {

		$file = FCPATH . "content/about.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/about', $data);
		$this->load->view('layouts/footer');

     }

	 public function privacy_policy_content() {

		$file = FCPATH . "content/privacy-policy.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/privacy-policy', $data);
		$this->load->view('layouts/footer');

     }

	 public function refund_policy_content() {

		$file = FCPATH . "content/refund-policy.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/refund-policy', $data);
		$this->load->view('layouts/footer');

     }

	 public function disclaimer_content() {

		$file = FCPATH . "content/disclaimer.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/disclaimer', $data);
		$this->load->view('layouts/footer');

     }

	 public function welcome_letter() {

		$file = FCPATH . "content/welcome-latter.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/welcome-letter', $data);
		$this->load->view('layouts/footer');

     }

	 public function return_policy_content() {

		$file = FCPATH . "content/return-policy.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/return-policy', $data);
		$this->load->view('layouts/footer');

     }

	 public function terms_and_condition_content() {

		$file = FCPATH . "content/terms-and-conditions.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/terms-and-condition', $data);
		$this->load->view('layouts/footer');

     }

	 public function mission_content() {

		$file = FCPATH . "content/mission.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/mission', $data);
		$this->load->view('layouts/footer');

     }

	 public function vision_content() {

		$file = FCPATH . "content/vision.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/vision', $data);
		$this->load->view('layouts/footer');

     }

	 public function faq_content() {
		$file = file_get_contents(FCPATH . "content/faq.json");
  		$data['faqs'] = json_decode($file, true);
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/faq', $data);
		$this->load->view('layouts/footer');

     }

	 public function company_documents() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/company-documents', $data);
		$this->load->view('layouts/footer');

     }

	 public function add_document(){
		if (isset($_POST['addDocument'])) {
            extract($_POST);
			echo $id = $name;
            $config['upload_path'] = FCPATH . '../assets/images/documents';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['overwrite'] = TRUE;
            $config['file_name'] = $id . '.png';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('document')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                $this->session->set_flashdata('success', "Documents added.");
            }
            redirect('content/company_documents');
        }
        redirect('content/company_documents');
	 }

	 public function remove_document() {
		$filename = $this->uri->segment(3);
		$file_path = FCPATH . "../assets/images/documents/" . $filename;
		if (file_exists($file_path)) {
		  unlink($file_path);
		  $this->session->set_flashdata('success', 'Image removed successfully!');
		} else {
		  $this->session->set_flashdata('error', 'Image not found!');
		}
		redirect('content/company_documents');
	  }

	  public function offer() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/offer', $data);
		$this->load->view('layouts/footer');

     }

	  public function add_offer(){
		if (isset($_POST['addOffer'])) {
            extract($_POST);
			echo $id = time();
            $config['upload_path'] = FCPATH . '../assets/images/offer';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['overwrite'] = TRUE;
            $config['file_name'] = $id . '.png';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('document')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                $this->session->set_flashdata('success', "Offer added.");
            }
            redirect('content/offer');
        }
        redirect('content/offer');
	 }

	 public function remove_offer() {
		$filename = $this->uri->segment(3);
		$file_path = FCPATH . "../assets/images/offer/" . $filename;
		if (file_exists($file_path)) {
		  unlink($file_path);
		  $this->session->set_flashdata('success', 'Image removed successfully!');
		} else {
		  $this->session->set_flashdata('error', 'Image not found!');
		}
		redirect('content/offer');
	  }

	 public function gallery() {
		if(isset($_POST['addCategory'])){
			extract($_POST);

			$isPresent = $this->Crud->ciCount("galler_category", "`gallery_category` = '$categoryName'");

			if($isPresent > 0){
				$this->session->set_flashdata('warning', "You already added this category.");
			}else{
				$data = [
					'gallery_category' => $categoryName
				];

				if ($this->Crud->ciCreate("galler_category", $data)) {
					$this->session->set_flashdata('success', "Category added.");
				} else {
					$this->session->set_flashdata('warning', "Something went wrong. Try again.");
				}
				redirect('content/gallery');
			}
		}
		$data['category'] = $this->Crud->ciRead("galler_category", "`id` != '0'");
		$data['gallery'] = $this->Crud->ciRead("gallery", "`id` != '0'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/gallery', $data);
		$this->load->view('layouts/footer');

     }

	 public function contact_information() {
		$data['CONTACT'] = $this->Crud->ciRead("contact_info", "`id` = '1'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/contact-info', $data);
		$this->load->view('layouts/footer');

     }

	 public function add_gallery(){
		if (isset($_POST['addGallery'])) {
            extract($_POST);
            $config['upload_path'] = FCPATH . 'uploads/gallery/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_width'] = 5000;
            $config['max_height'] = 5000;
            $config['encrypt_name'] = TRUE;
            $this->load->library('image_lib');
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            } else {
                $image_metadata = $this->upload->data();
                $configer =  array(
                    'image_library'   => 'gd2',
                    'source_image'    =>  $image_metadata['full_path'],
                    'maintain_ratio'  =>  TRUE,
                    'width'           =>  5000,
                    'height'          =>  5000,
                );
                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $image = $image_metadata['file_name'];
                $this->Crud->ciCreate('gallery', array(
                    'gallery_category' => $category,
                    'file_name' => $image,
                ));
                $this->session->set_flashdata('success', 'Image added successfully');
            }
        }
        redirect('content/gallery');
	 }

	 public function removeCategory(){
		extract($_POST);
		$gallery = $this->Crud->ciRead("gallery", "`gallery_category` = '$id'");
		
		foreach($gallery as $key){
			$gallery_image = $key->file_name;
			$path = 'uploads/gallery/' . $gallery_image;
			if (file_exists($path)) {
				unlink($path);
				$gallery = $this->Crud->ciDelete("gallery", "`gallery_category` = '$id'");
			} else {
				redirect('content/gallery');
			}
		}

		$this->Crud->ciDelete("galler_category", "`id` = '$id'");
		redirect('content/gallery');
	 }

	 public function delete_image(){
		$id = $this->uri->segment(3);
		$gallery = $this->Crud->ciRead("gallery", "`id` = '$id'");
		$gallery_image = $gallery[0]->file_name;
		
		$path = 'uploads/gallery/' . $gallery_image;
		if (file_exists($path)) {
			unlink($path);
			$gallery = $this->Crud->ciDelete("gallery", "`id` = '$id'");
			redirect('content/gallery');
		} else {
			redirect('content/gallery');
		}
	 }

	 public function add_faq() {
		$file = FCPATH . "content/faq.json";
	  
		if (isset($_POST['addFAQ'])) {
			extract($_POST);
		  $faqs = json_decode(file_get_contents($file), true);
		  $faqs['faqs'][] = [
			'question' => $question,
			'answer' => $answer,
			'status' => $status,
		  ];
		  file_put_contents($file, json_encode($faqs));
		  $this->session->set_flashdata('success', 'FAQ added successfully!');
		  redirect('content/faq_content');
		}
	  }


	  public function edit_faq() {
		$file = FCPATH . "content/faq.json";
	  
		if(isset($_POST['editFAQ'])) {
			extract($_POST);
		  $faqs = json_decode(file_get_contents($file), true);
		  $faqs['faqs'][$faqid]['question'] = $question;
		  $faqs['faqs'][$faqid]['answer'] = $answer;
		  file_put_contents($file, json_encode($faqs));
		  $this->session->set_flashdata('success', 'FAQ updated successfully!');
		  redirect('content/faq_content');
		}
	  }

	  public function view_faq(){
		$file = FCPATH . "content/faq.json";
		$faqs = json_decode(file_get_contents($file), true);

		extract($_POST);
		$faq = $faqs['faqs'][$id];
		echo $result = '<div class="row px-4">
		<div class="col-lg-12">
			<div class="form-group">
				<label for="name">Question</label>
				<input type="text" name="question" value="'.$faq['question'].'" placeholder="Question" id="question" class="form-control" required>
				<input type="hidden" name="faqid" value="'.$id.'">
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group">
				<label for="name">Answer</label>
				<textarea type="text" name="answer" rows="5" placeholder="Answer" id="answer" class="form-control" required>'.$faq['answer'].'</textarea>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group">
				<label for="name">Status</label>
				<select name="status" id="" class="form-control">
					<option value="active">Active</option>
					<option value="block">Blocked</option>
				</select>
			</div>
		</div>
	</div>';
	  }

	public function delete_faq() {
		$file = FCPATH . "content/faq.json";
		$index = $this->uri->segment(3);
		$faqs = json_decode(file_get_contents($file), true);
		unset($faqs['faqs'][$index]);
		file_put_contents($file, json_encode($faqs));
		$this->session->set_flashdata('success', 'FAQ deleted successfully!');
		redirect('content/faq_content');
	}

	public function block() {
		$file = FCPATH . "content/faq.json";
		echo $faqid = $this->uri->segment(3);
		$faqs = json_decode(file_get_contents($file), true);
		$faqs['faqs'][$faqid]['status'] = 'block';
		file_put_contents($file, json_encode($faqs));
		$this->session->set_flashdata('success', 'FAQ updated successfully!');
		redirect('content/faq_content');
	}

	public function unblock() {
		$file = FCPATH . "content/faq.json";
		echo $faqid = $this->uri->segment(3);
		$faqs = json_decode(file_get_contents($file), true);
		$faqs['faqs'][$faqid]['status'] = 'active';
		file_put_contents($file, json_encode($faqs));
		$this->session->set_flashdata('success', 'FAQ updated successfully!');
		redirect('content/faq_content');
	}

	public function slider() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/slider');
		$this->load->view('layouts/footer');

     }

	 public function addSlider(){
        if (isset($_POST['addSlider'])) {
            extract($_POST);
			echo $id = $no;
            $config['upload_path'] = FCPATH . '../assets/images/slider';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['overwrite'] = TRUE; // This allows the existing file to be overwritten
            $config['file_name'] = $id . '.png'; // Set the file name to the id of the record being updated
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('slider')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            }
            redirect('content/slider');
        }
	 }

	 public function remove_image() {
		$image = $this->uri->segment(3);
		$filename = $image.'.png';
		$file_path = FCPATH . "../assets/images/slider/" . $filename;
		if (file_exists($file_path)) {
		  unlink($file_path);
		  $this->session->set_flashdata('success', 'Image removed successfully!');
		} else {
		  $this->session->set_flashdata('error', 'Image not found!');
		}
		redirect('content/slider');
	  }

	  public function changeContact(){
		extract($_POST);

		$data = [
			'phone' => $phone,
			'phone2' => $phone2,
			'email' => $email,
			'email2' => $email2,
			'facebook' => $facebook,
			'instagram' => $instagram,
			'twitter' => $twitter,
			'youtube_link' => $youtube,
			'whatsapp' => $whatsapp,
			'address' => $map,
		];

		if($this->Crud->ciUpdate("contact_info", $data, "`id` = '1'")){
			$this->session->set_flashdata('success', "Information added Successfully.");
			redirect('settings/profile');
		}else{
			$this->session->set_flashdata('danger', "Something went wrong. Try again.");
			redirect('settings/profile');
		}
	  }

	  public function updateAboutImage(){
		$id = 'about';
		extract($_POST);
		$config['upload_path'] = FCPATH . 'content/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['overwrite'] = TRUE; // This allows the existing file to be overwritten
		$config['file_name'] = $id . '.jpg'; // Set the file name to the id of the record being updated
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('about')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('warning', $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
			$this->session->set_flashdata('warning', $this->upload->display_errors());
		}
		redirect('content/about_content');
	  }

	  public function updateMissionImage(){
		$id = 'mission';
		extract($_POST);
		$config['upload_path'] = FCPATH . 'content/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['overwrite'] = TRUE; // This allows the existing file to be overwritten
		$config['file_name'] = $id . '.jpg'; // Set the file name to the id of the record being updated
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('mission')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('warning', $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
			$this->session->set_flashdata('warning', $this->upload->display_errors());
		}
		redirect('content/mission_content');
	  }

	  public function updateVisionImage(){
		$id = 'vision';
		extract($_POST);
		$config['upload_path'] = FCPATH . 'content/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['overwrite'] = TRUE; // This allows the existing file to be overwritten
		$config['file_name'] = $id . '.jpg'; // Set the file name to the id of the record being updated
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('vision')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('warning', $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
			$this->session->set_flashdata('warning', $this->upload->display_errors());
		}
		redirect('content/vision_content');
	  }

	  public function bank_details() {
		$data['KYC'] = $this->Crud->ciRead("kyc_master", "`customer_id` = '1'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/bank-details');
		$this->load->view('layouts/footer');
     }

	 public function system_controls(){
		$sql = $this->db->query("SELECT * FROM `setting`");
		$data['DETAILS'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/breadcrumb', $data);
		$this->load->view('content/system-controls', $data);
		$this->load->view('layouts/footer');
	 }

	 public function update_system_controls(){
		extract($_POST);
		$data = [
			'tds' => $tds,
			'admIn_charge' => $charge,
			'min_withdrawal_amt' => $min_amt,
		];

		if($this->db->update("setting", $data, "`id` = '1'")){
			$this->session->set_flashdata("success", "Date updated successfully.");
		}else{
			$this->session->set_flashdata("danger", "Something went wrong. Try again.");
		}

		redirect('content/system_controls');
	 }

	 public function update_bank_details(){
        extract($_POST);

        $isExist = $this->Crud->ciCount("kyc_master", "`customer_id` = '1'");

        if($isExist > 0){
            $data = [
                'bank_name' => $bankname,
                'ac_no' => $account_no,
                'ifsc_code' => $ifsc,
                'payee_name' => $account_holder,
				'updated_date' => date('Y-m-d H:i:s')
            ];

            if($this->Crud->ciUpdate("kyc_master", $data, "`customer_id` = '1'")){
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
                'customer_id' => 1,
				'added_date' => date('Y-m-d H:i:s')
            ];

            if($this->Crud->ciCreate("kyc_master", $data)){
                $this->session->set_flashdata("success", "Kyc added.");
            }else{
                $this->session->set_flashdata("success", "Something went wrong. Try again.");
            }
        }

        redirect('content/bank_details');
	 }
}