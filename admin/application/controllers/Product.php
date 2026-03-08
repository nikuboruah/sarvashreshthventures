<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('getcurrency_helper');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	// ************************************************************************
	// *****************************CATEGORIES*********************************
	// ************************************************************************

	public function categories()
	{
		$page_name = 'Add Categories';
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`status` = '1' and type='p'");
		$data['CATEGORIES'] = $this->Crud->ciRead("category_master", "`category_id` != '0' and type='p'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/categories', $data);
		$this->load->view('layouts/footer');
	}
	public function brand()
	{
		$page_name = 'Add Brand';
		$sql="SELECT * FROM `brand_master` order by `brand_name`";
		$query=$this->db->query($sql);
		$data['brand'] =$query->result_array();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/brand', $data);
		$this->load->view('layouts/footer');
	}
	public function add_brand()
	{
		$userId=$this->session->userdata('aiplAdminId');
		$d=$this->input->post();
		$sql="SELECT * FROM `brand_master` WHERE `brand_name`='".$d['brand']."'";
		$this->db->query($sql);
		if($this->db->affected_rows()>0)
		{
			echo "e";
		}
		else
		{
			$sql="UPDATE `brand_master` SET `brand_name`='".$d['brand']."' WHERE `brand_id`='".$d['brandid']."'";
			$this->db->query($sql);
			if($this->db->affected_rows()==0)
			{
				$sql="INSERT INTO `brand_master`(`brand_name`, `user_id`) VALUES ('".$d['brand']."','".$userId."')";
				$this->db->query($sql);
				echo json_encode($this->db->affected_rows(),true);
			}
			else "u";
		}
		
	}

	public function editCategories()
	{
		$page_name = 'Edit Categories';
		$categoryid = $this->input->post('categoryid');
		$data['CATEGORIES'] = $this->Crud->ciRead("category_master", "`category_id` = '$categoryid'");
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`category_id` != '0'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/edit-categories', $data);
		$this->load->view('layouts/footer');
	}

	public function addNewCategory()
	{
		$userId = $this->session->userdata('aiplAdminId');
		if (isset($_POST['addCategory'])) {
			extract($_POST);

			$isExist = $this->Crud->ciCount("category_master", "`category_name` = '$name' AND `under_category_id` = 1");

			if($isExist > 0){
				$this->session->set_flashdata("warning", "Category name already exist.");
				redirect('product/categories');
			}else{
				$data = [
					'under_category_id' => 1,
					'category_name' => $name,
					'user_id' => $userId,
				];

				if ($this->Crud->ciCreate("category_master", $data)) {
					$this->session->set_flashdata("success", "Category added successfully.");
				} else {
					$this->session->set_flashdata("danger", "Try again.");
				}

				redirect('product/categories');
			}
		}
	}

	public function changeStatus()
	{
		$categoryId = $this->uri->segment(4);
		$status = $this->uri->segment(3);

		$data = [
			'status' => $status,
		];

		if ($this->Crud->ciUpdate("category_master", $data, "`category_id` = '$categoryId'")) {
			$this->session->set_flashdata("success", "Category status changed successfully.");
		} else {
			$this->session->set_flashdata("danger", "Try again.");
		}

		redirect('product/categories');
	}

	public function changeProductStatus()
	{
		extract($_POST);
		$id = $id;
		$status = $status;

		$data = [
			'status' => $status,
		];

		if ($this->Crud->ciUpdate("product_master", $data, "`product_id` = '$id'")) {
			echo 1;
		} else {
			echo 0;
		}
	}

	public function updateCategory()
	{
		$userId = $this->session->userdata('aiplAdminId');
		if (isset($_POST['upadteCategory'])) {
			extract($_POST);

			$isExist = $this->Crud->ciCount("category_master", "`category_name` = '$name' AND `under_category_id` = '$category'");

			if($isExist > 0){
				$this->session->set_flashdata("warning", "Category name already exist.");
				redirect('product/categories');
			}else{
				$data = [
					'under_category_id' => $category,
					'category_name' => $name,
					'user_id' => $userId,
				];

				if ($this->Crud->ciUpdate("category_master", $data, "`category_id` = '$categoryid'")) {
					$this->session->set_flashdata("success", "Category updated successfully.");
				} else {
					$this->session->set_flashdata("danger", "Try again.");
				}

				redirect('product/categories');
			}
		}
	}
	public function updateServiceCategory()
	{
		$userId = $this->session->userdata('aiplAdminId');
		if (isset($_POST['upadteCategory'])) {
			extract($_POST);
			$config['upload_path'] = FCPATH . 'uploads/categories/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('avatar')) {
				$error = array('error' => $this->upload->display_errors());
			} else {

				$image_metadata = $this->upload->data();

				$avatar = $image_metadata['file_name'];
			}

			$data = [
				'under_category_id' => $category,
				'category_name' => $name,
				'user_id' => $userId,
				'avatar' => $avatar,
			];

			if ($this->Crud->ciUpdate("category_master", $data, "`category_id` = '$categoryid'")) {
				$this->session->set_flashdata("success", "Category updated successfully.");
			} else {
				$this->session->set_flashdata("danger", "Try again.");
			}

			redirect('product/service_categories');
		}
	}


	// ************************************************************************
	// *****************************PRODUCTS***********************************
	// ************************************************************************

	public function products()
	{
		$page_name = 'Add Products';
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`category_id` != '1' AND `under_category_id` = '1' and type='p'");
		$data['PRODUCTS'] = $this->Crud->ciRead("product_master", "`status` = 1 AND `category_id` != 2");
		$sql = $this->db->query("SELECT cp.*, p.product_name FROM `combo_product_master` cp JOIN product_master p ON p.product_id = cp.product_id WHERE cp.combo_id = 0");
		$data['COMBO_PRODUCTS'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/add-product', $data);
		$this->load->view('layouts/footer');
	}

	public function getsubcategory()
	{
		if (!empty($_POST["categoryID"])) {
			$categoryID = $_POST['categoryID'];
			$isExist = $this->Crud->ciCount('category_master', "`under_category_id` = '$categoryID' ");
			if ($isExist == 0) {
				echo 0;
			} else {
				$SUBCATEGORIES = $this->Crud->ciRead('category_master', "`under_category_id` = '$categoryID'");

				if ($SUBCATEGORIES) {
					echo '<option value="">Select an option</option>';
					foreach ($SUBCATEGORIES as $key) {
						echo '<option value="' . $key->category_id . '">' . $key->category_name . '</option>';
					}
				}
			}
		}
	}

	public function addProduct(){
        $this->form_validation->set_rules('category', 'Category Name', 'required');
		$userId = $this->session->userdata('aiplAdminId');
            extract($_POST);
          
			$isExist = $this->Crud->ciCount("product_master", "`HSN_code` = '$hsn' AND `product_name` = '$product'");
			if($isExist > 0){
				redirect('product/products');
			}else{
            if ($this->form_validation->run()) {
                $this->load->library('upload');
                $dataInfo = array();
                $files = $_FILES;
               $cpt = count($_FILES['productImage']['name']);
               $cpt=($cpt>6?6:$cpt);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['productImage']['name'] = $files['productImage']['name'][$i];
                    $_FILES['productImage']['type'] = $files['productImage']['type'][$i];
                    $_FILES['productImage']['tmp_name'] = $files['productImage']['tmp_name'][$i];
                    $_FILES['productImage']['error'] = $files['productImage']['error'][$i];
                    $_FILES['productImage']['size'] = $files['productImage']['size'][$i];

                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload('productImage');
                    $dataInfo[] = $this->upload->data();
                }
                if (!isset($dataInfo[0]['file_name'])) {
                    $dataInfo[0]['file_name'] = NULL;
                }
                if (!isset($dataInfo[1]['file_name'])) {
                    $dataInfo[1]['file_name'] = NULL;
                }
                if (!isset($dataInfo[2]['file_name'])) {
                    $dataInfo[2]['file_name'] = NULL;
                }
                if (!isset($dataInfo[3]['file_name'])) {
                    $dataInfo[3]['file_name'] = NULL;
                }
                if (!isset($dataInfo[4]['file_name'])) {
                    $dataInfo[4]['file_name'] = NULL;
                }
                if (!isset($dataInfo[5]['file_name'])) {
                    $dataInfo[5]['file_name'] = NULL;
                }

               $data = array(
                    'HSN_code' => $hsn,
                    'product_name' => $product,
                    'category_id' => $category,
                    'mrp' => $mrp,
                    'selling_price' => $sPrice,
                    'discount' => $dist,
                    'final_price' => $fPrice,
                    'gst' => $gst ?? 0,
                    'pv' => $pv,
                    'product_image_one' => $dataInfo[0]['file_name'],
                    'product_image_two' => $dataInfo[1]['file_name'],
                    'product_image_three' => $dataInfo[2]['file_name'],
                    'product_image_four' => $dataInfo[3]['file_name'],
                    'product_image_five' => $dataInfo[4]['file_name'],
                    'product_image_six' => $dataInfo[5]['file_name'], 
					'added_date' => date('Y-m-d H:i:s')           
                );

                if ($this->Crud->ciCreate('product_master', $data)) {
					if($category == 2){
						$get_combo_id = $this->Crud->ciRead("product_master", "`HSN_code` = '$hsn' AND `product_name` = '$product' AND `category_id` = '$category'");
						$combo_id = $get_combo_id[0]->product_id;
						$combo = [
							'combo_id' => $combo_id,
						];

						$this->Crud->ciUpdate("combo_product_master", $combo, "`combo_id` = 0");
					}
					$this->session->set_flashdata('success', 'Product added successfully');
					redirect('product/products');
                } else {
                    $this->session->set_flashdata('danger', 'Something went wrong');
					redirect('product/products');
                }
			}
        }
    }

	private function set_upload_options() {
        //upload an image options
        $config = array();
        $config['upload_path'] = 'uploads/products/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;
        $config['encrypt_name'] = TRUE;
        return $config;
    }

	public function manageProducts()
	{
		$userList = $this->uri->segment(3);
		if ($userList == 'active') {
			$page_name = 'All Products';
			$data['PRODUCT'] = $this->Crud->ciRead("product_master", "`product_id` != '0'");
		}
		$data['page_name']=$page_name;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/manage-products', $data);
		$this->load->view('layouts/footer');
	}

	public function viewImages(){
		extract($_POST);
		$images = $this->Crud->ciRead("product_master", "`product_id` = '$id'");
		$product_image = '';
			if($images[0]->product_image_one){
			$product_image .='<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/products/'.$images[0]->product_image_one).'" style="height:200px; width:100%;" alt="">
				</div>
			</div>';
			}if($images[0]->product_image_two){
			$product_image .='<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/products/'.$images[0]->product_image_two).'" style="height:200px; width:100%;" alt="">
				</div>
			</div>';
			} if($images[0]->product_image_three){
			$product_image .='<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/products/'.$images[0]->product_image_three).'" style="height:200px; width:100%;" alt="">
				</div>
			</div>';
			}if($images[0]->product_image_four){
			$product_image .='<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/products/'.$images[0]->product_image_four).'" style="height:200px; width:100%;" alt="">
				</div>
			</div>';
			}if($images[0]->product_image_five){
			$product_image .='<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/products/'.$images[0]->product_image_five).'" style="height:200px; width:100%;" alt="">
				</div>
			</div>';
			}if($images[0]->product_image_six){
			$product_image .='<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/products/'.$images[0]->product_image_six).'" style="height:200px; width:100%;" alt="">
				</div>
			</div>';
			}

			echo $product_image;
	}

	public function viewServiceImages(){
		extract($_POST);
		$images = $this->Crud->ciRead("service_master", "`id` = '$id'");
		echo '<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('../uploads/service/'.$images[0]->image_1).'" style="height:200px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('../uploads/service/'.$images[0]->image_2).'" style="height:200px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('../uploads/service/'.$images[0]->image_3).'" style="height:200px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('../uploads/service/'.$images[0]->image_4).'" style="height:200px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('../uploads/service/'.$images[0]->image_5).'" style="height:200px; width:100%;" alt="">
				</div>
			</div>';
	}

	public function updateImage(){
		extract($_POST);
		$details = $this->Crud->ciRead("product_master", "`product_id` = '$id'");
		$image_name = $details[0]->$image;
		$image_field = 'image'.$id;
		$config['upload_path'] = FCPATH . '/uploads/products';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['overwrite'] = TRUE; 
		$config['file_name'] = $image_name; 
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload($image_field)) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('warning', $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
			$this->session->set_flashdata('warning', $this->upload->display_errors());
		}
	}

	public function u_category($catid)
	{

		$cat = "";
		$sql = "SELECT * FROM `category_master` WHERE `category_id`='" . $catid . "' and type='p' and status=1 ";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		foreach ($result as $rs) {
			if ($rs['under_category_id'] != 1) {
				$cat = $this->u_category($rs['under_category_id']);
			} else  $cat = $rs['category_id'];
		}
		return $cat;
	}

	public function product_details()
	{
		$productid = $this->input->post('pcode');
		$data['products'] = $this->Crud->ciRead("product_master", "`product_id` = '$productid'");

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/product-details', $data);
		$this->load->view('layouts/footer');
	}

	public function product_edit(){
		$productid= $this->input->post('editpid');
        $catid=$this->input->post('editcatid');
        $pcode=$this->input->post('editpcode');
        $pname=$this->input->post('editpname');
        $data['catid']=$catid;
        // Fetch all category
        $cat="SELECT `category_id`,`category_name` FROM `category_master` where `under_category_id`=1 order by category_name";
        $query=$this->db->query($cat);
        $data['category'] = $query->result_array();
   
        // Fetch all category
        $cat="SELECT * FROM `product_master` WHERE `product_id`='".$productid."'";
        $query=$this->db->query($cat);
        $data['product'] = $query->result_array();

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('product/edit-product', $data);
		$this->load->view('layouts/footer');
	}

	public function getsubcategory1() {
		if(!empty($_POST["categoryID"])){ 
		$categoryID = $_POST['categoryID'];
            $SUBCATEGORIES = $this->Crud->ciRead('category_master', " `under_category_id` = '$categoryID' ");
			// Generate HTML of state options list 
            if($SUBCATEGORIES)
            {
                echo '<option value="">---Select---</option>'; 
                foreach ($SUBCATEGORIES as $key) {
                   echo'<option value="'.$key->category_id.'">'.$key->category_name.'</option>';
                }
            }
            else 
            { 
                echo 0;}
			 } 
		}

		public function updateProductBasic(){
			extract($_POST);
			
				/* delete Existing File */ 
				$this->load->helper("file");
				$productId=$this->input->post("productid");
				$pcode=$this->input->post("pcode");
				$path=FCPATH."uploads/products/";
				
				/* end delete */
				$this->load->library('upload');
				$dataInfo = array();
				$files = $_FILES;
				$cpt = count($_FILES['productImage']['name']);
				$condition = "`product_id` = $productid";
				
				if($cpt>1)
				{
					$images = $this->Crud->ciRead("product_master", $condition);
					$productimage1=$images[0]->product_image_one;      
					if (is_file($path.$productimage1) && file_exists($path.$productimage1)) unlink($path.$productimage1);     
					$productimage2=$images[0]->product_image_two;    
					if (is_file($path.$productimage2) && file_exists($path.$productimage2)) unlink($path.$productimage2);        
					$productimage3=$images[0]->product_image_three;     
					if (is_file($path.$productimage3) && file_exists($path.$productimage3)) unlink($path.$productimage3);        
					$productimage4=$images[0]->product_image_four;      
					if (is_file($path.$productimage4) && file_exists($path.$productimage4)) unlink($path.$productimage4);
					$productimage5=$images[0]->product_image_five;       
					if (is_file($path.$productimage5) && file_exists($path.$productimage5)) unlink($path.$productimage5);
					$productimage6=$images[0]->product_image_six;      
					if (is_file($path.$productimage6) && file_exists($path.$productimage6)) unlink($path.$productimage6);
				}             
				
				for ($i = 0; $i < $cpt; $i++) {
					echo $_FILES['productImage']['name'] = $files['productImage']['name'][$i];
					$_FILES['productImage']['type'] = $files['productImage']['type'][$i];
					$_FILES['productImage']['tmp_name'] = $files['productImage']['tmp_name'][$i];
					$_FILES['productImage']['error'] = $files['productImage']['error'][$i];
					$_FILES['productImage']['size'] = $files['productImage']['size'][$i];
					$this->upload->initialize($this->set_upload_options());
					$this->upload->do_upload('productImage');
					$dataInfo[] = $this->upload->data();
				} 
				
				if($cpt>1){
				$data = array(
							'HSN_code' => $hsn,
							'product_name' => $product,
							'category_id' => $category,
							'mrp' => $mrp,
							'selling_price' => $sPrice,
							'discount' => $dist,
							'final_price' => $fPrice,
							'gst' => $gst,
							'pv' => $pv,
							'product_image_one' => ($dataInfo[0]?$dataInfo[0]['file_name']:''),
							'product_image_two' => ($dataInfo[1]?$dataInfo[1]['file_name']:''),
							'product_image_three' =>($dataInfo[2]?$dataInfo[2]['file_name']:''),
							'product_image_four' => ($dataInfo[3]?$dataInfo[3]['file_name']:''),
							'product_image_five' => ($dataInfo[4]?$dataInfo[4]['file_name']:''),
							'product_image_six' => ($dataInfo[5]?$dataInfo[5]['file_name']:''),                   
					);
					}
					else {
					$data = array(
						'HSN_code' => $hsn,
						'product_name' => $product,
						'category_id' => $category,
						'mrp' => $mrp,
						'selling_price' => $sPrice,
						'discount' => $dist,
						'final_price' => $fPrice,
						'gst' => $gst,
						'pv' => $pv,            
						);
					}
				if ($this->Crud->ciUpdate('product_master', $data,$condition)) {
					$this->session->set_flashdata('success', 'Product added successfully');
					redirect('product/manageProducts/active');
				} else {
					$this->session->set_flashdata('danger', 'Something went wrong');
				}
		}
	

	public function addProductItem()
	{
		$userId = $this->session->userdata('aiplAdminId');

		extract($_POST);

		$data = [
			'product_id' => $productId,
			'purchase_price' => $purchase,
			'sale_price' => $sale,
			'qty' => $qty,
			'warehouse' => $warehouse,
			'added_by' => $userId,
			'updated_on' => date('Y-m-d')
		];

		if ($this->Crud->ciCreate("product_details", $data)) {
			$this->session->set_flashdata("success", "Product item added successfully.");
		} else {
			$this->session->set_flashdata("danger", "Try again.");
		}
	}

	public function updateProductItem()
	{
		$userId = $this->session->userdata('aiplAdminId');
		extract($_POST);

		$previousitemdetails = $this->Crud->ciRead("product_details", "`product_id` = '$uproductId'");

		$data = [
			'product_id' => $uproductId,
			'purchase_price' => $upurchase,
			'sale_price' => $usale,
			'qty' => $uqty,
			'warehouse' => $uwarehouse,
			'updated_on' => date('Y-m-d')
		];

		$data2 = [
			'product_id' => $uproductId,
			'purchase_price' => $previousitemdetails[0]->purchase_price,
			'purchase_price_new' => $upurchase,
			'sale_price' => $previousitemdetails[0]->sale_price,
			'sale_price_new' => $usale,
			'qty' => $uqty,
			'warehouse' => $uwarehouse,
			'added_by' => $userId
		];

		if ($this->Crud->ciUpdate("product_details", $data, "`id` = '$uproductdetailsId'")) {
			$this->Crud->ciCreate("product_details_updated", $data2);
			$this->session->set_flashdata("success", "Product item updated successfully.");
		} else {
			$this->session->set_flashdata("danger", "Try again.");
		}
	}


	//service
	public function service_categories()
	{
		$page_name = 'Add Categories';
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`status` = '1' and type='s'");
		$data['CATEGORIES'] = $this->Crud->ciRead("category_master", "`category_id` != '0' and type='s'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('service/categories', $data);
		$this->load->view('layouts/footer');
	}
	function addNewServiceCategory()
	{
		$userId = $this->session->userdata('aiplAdminId');
		if (isset($_POST['addCategory'])) {
			extract($_POST);

			$config['upload_path'] = FCPATH . 'uploads/categories/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('avatar')) {
				$error = array('error' => $this->upload->display_errors());
			} else {

				$image_metadata = $this->upload->data();

				$avatar = $image_metadata['file_name'];
			}

			$data = [
				'under_category_id' => $category,
				'category_name' => $name,
				'type'=>'s',
				'user_id' => $userId,
				'avatar' => $avatar,
			];

			if ($this->Crud->ciCreate("category_master", $data)) {
				$this->session->set_flashdata("success", "Category added successfully.");
			} else {
				$this->session->set_flashdata("danger", "Try again.");
			}

			redirect('product/service_categories');
		}
	}

	public function editServiceCategories()
	{
		$page_name = 'Edit Categories';
		$categoryid = $this->input->post('categoryid');
		$data['CATEGORIES'] = $this->Crud->ciRead("category_master", "`category_id` = '$categoryid'");
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`category_id` != '0'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('service/edit-categories', $data);
		$this->load->view('layouts/footer');
	}

	public function manageServices()
	{
		$userList = $this->uri->segment(3);
		if ($userList == 'pending') {
			$page_name = 'Pending Service';
			$data['PRODUCT'] = $this->Crud->ciRead("service_master", "`status` = '1'");
		} else if ($userList == 'active') {
			$page_name = 'Inactive Service';
			$data['PRODUCT'] = $this->Crud->ciRead("service_master", "`status` = '2'");
		} else if ($userList == 'inactive') {
			$page_name = 'Inactive Service';
			$data['PRODUCT'] = $this->Crud->ciRead("service_master", "`status` = '0'");
		}

       	$data['page_name']=$page_name;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('service/active_service', $data);
		$this->load->view('layouts/footer');
	}

	public function serviceRequest(){
		$id = $this->uri->segment(4);
		$status = $this->uri->segment(3);
		$table = 'service_master';
		$data = [
			'status' => $status
		];
		$condition = "`id` = '$id'";

		if($this->Crud->ciUpdate("$table", $data, $condition)){
			$this->session->set_flashdata("success", "Status changed successfully.");
			$referer = basename($_SERVER['HTTP_REFERER']);
        	redirect('product/manageServices/' . $referer);
		}else{
			$this->session->set_flashdata("success", "Something went wrong.");
			$referer = basename($_SERVER['HTTP_REFERER']);
        	redirect('product/manageServices/' . $referer);
		}
	}

	public function queries(){
		$page_name = 'Service Queries';
		$data['services_query'] = $this->Crud->ciRead("service_request", "`id` != '0' ORDER BY `added_date` desc");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('service/query', $data);
		$this->load->view('layouts/footer');
	}
	public function setscratch()
	{
		$d=$this->input->post();
		$sql="UPDATE `product_master` SET `used_in_scratch`='".$d['status']."' WHERE `product_id`='".$d['pid']."'";
	
		$this->db->query($sql);
		echo $this->db->affected_rows();
	}



	// Orders
	public function orders(){
		$page_name = 'All Orders';
		$sql = $this->db->query("SELECT o.*, c.name FROM `order_master` o JOIN customer_master c ON c.customer_id = o.customer_id order by `added_on` desc");
		$data['orders'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/orders', $data);
		$this->load->view('layouts/footer');
	}

	public function show_product_list(){
		extract($_POST);

		$sql = $this->db->query("SELECT c.*, p.product_name FROM `cart_master` c JOIN product_master p ON p.product_id = c.product_id WHERE c.order_id = '$oid'");
		$products = $sql->result();
		$id = 0;
		foreach($products as $data){
			echo '<tr>
				<td class="text-center">'.++$id.'</td>
				<td>'.$data->product_name.'</td>
				<td class="text-center">'.$data->qty.'</td>
			</tr>';
		}
	}

	public function take_payment(){
		extract($_POST);

		$data = [
			'payment_status' => 1,
			'approval_date' => date('Y-m-d')
		];

		if($this->Crud->ciUpdate("order_master", $data, "`id` = '$id'")){
			if($tbv > 0 AND $p_status == 1){
				$this->add_bv_to_upline($cust_id, $tbv);
			}
			echo 1;
		}else{
			echo 0;
		}
	}

	public function add_bv_to_upline($userid, $tbv)
	{
		// Get current user's sponsor/upline details
		$sql = $this->db->query("SELECT * FROM `customer_master` WHERE `customer_id` = ?", array($userid));
		$result = $sql->result();

		if (!$result) return;

		$upline_id = $result[0]->dowline_id;
		$position  = (int) $result[0]->position;

		if ($upline_id) {
			// Fetch upline details
			$sponsor_sql = $this->db->query("SELECT * FROM `customer_master` WHERE `customer_id` = ?", array($upline_id));
			$sponsor_details = $sponsor_sql->result();
			if (!$sponsor_details) return;

			// Update side BV + PV + Rank PV
			if ($position === 0) {
				$this->db->where('customer_id', $upline_id)
						->update('customer_master', [
							'left_repurchase_bv' => $sponsor_details[0]->left_repurchase_bv + $tbv
						]);
			} else {
				$this->db->where('customer_id', $upline_id)
						->update('customer_master', [
							'right_repurchase_bv' => $sponsor_details[0]->right_repurchase_bv + $tbv
						]);
			}

			// Continue recursion to next upline
			$this->add_bv_to_upline($upline_id, $tbv);
		}
	}


	public function deliver_now(){
		extract($_POST);

		$data = [
			'delivery_status' => 1
		];

		if($this->Crud->ciUpdate("order_master", $data, "`id` = '$id'")){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function print_invoice(){
		$order_id = $this->uri->segment(3);
		$sql = $this->db->query("SELECT o.*, u.user_name, u.user_phone FROM `order_master` o JOIN user_master u ON u.customer_id = o.customer_id WHERE o.order_id = '$order_id'");
		$data['DETAILS'] = $sql->result();

		$sql2 = $this->db->query("SELECT c.*, pm.product_name, pm.HSN_code, pm.gst FROM `cart_master` c JOIN product_master pm ON pm.product_id = c.product_id WHERE c.order_id = '$order_id'");
		$data['ITEMS'] = $sql2->result();

		$data['BANK_DETAILS'] = $this->Crud->ciRead("kyc_master", "`customer_id` = '1'");
		
		$this->load->view('product/print-invoice', $data);
	}

	public function add_combo_product(){
		extract($_POST);

		$isExist = $this->Crud->ciCount("combo_product_master", "`combo_id` = 0 AND `product_id` = '$productid'");
		if($isExist > 0){
			echo 2;
		}else{
			$data = [
				'product_id' => $productid,
				'quantity' => $qty,
				'added_on' => date('Y-m-d H:i:s'),
			];

			if($this->Crud->ciCreate("combo_product_master", $data)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}

	public function get_combo_products(){
		extract($_POST);

		$sql = $this->db->query("SELECT cp.*, p.product_name FROM `combo_product_master` cp JOIN product_master p ON p.product_id = cp.product_id WHERE cp.combo_id = 0");
		$combo_products = $sql->result();

		$products = '';
		foreach($combo_products as $data){
			$products .= '<tr>
							<td>'.$data->product_name.'</td>
							<td class="text-center">'.$data->quantity.'</td>
							<td><button class="btn btn-danger" type="button" onclick="remove_product('.$data->id.')">Remove</button></td>
						</tr>';
		}

		echo $products;
	}

	public function remove_product(){
		extract($_POST);
		if($this->Crud->ciDelete("combo_product_master", "`id` = '$id'")){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function product_combo(){
		$id = $this->uri->segment(3);
		$page_name = 'Update Combo Products';
		$data['products_list'] = $this->Crud->ciRead("product_master", "`status` = 1 AND `category_id` != 2");
		$data['PRODUCTS'] = $this->Crud->ciRead("product_master", "`product_id` = '$id'");
		$sql = $this->db->query("SELECT cm.*, p.product_name FROM `combo_product_master` cm JOIN product_master p ON p.product_id = cm.product_id WHERE cm.`combo_id` = '$id'");
		$data['COMBO'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/update-combo', $data);
		$this->load->view('layouts/footer');
	}

	public function update_status(){
		extract($_POST);
		$data = [
			'status' => $status
		];

		if($this->Crud->ciUpdate("combo_product_master", $data, "`id` = '$id'")){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function update_qty(){
		extract($_POST);
		$data = [
			'quantity' => $qty
		];

		if($this->Crud->ciUpdate("combo_product_master", $data, "`id` = '$id'")){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function add_product_combo(){
		extract($_POST);

		$isExist = $this->Crud->ciCount("combo_product_master", "`combo_id` = '$add_combo' AND `product_id` = '$add_product'");
		if($isExist > 0){
			$this->session->set_flashdata("warning", "Product already exist in combo");
			redirect('product/product_combo/'.$add_combo);
		}else{
			$data = [
				'combo_id' => $add_combo,
				'product_id' => $add_product,
				'quantity' => $add_qty,
			];

			if($this->Crud->ciCreate("combo_product_master", $data)){
				$this->session->set_flashdata("success", "Product added successfully");
			}else{
				$this->session->set_flashdata("danger", "Failed to add product");
			}
			redirect('product/product_combo/'.$add_combo);
		}
	}
}