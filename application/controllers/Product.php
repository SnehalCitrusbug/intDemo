<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->database();
		$this->load->model('common_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('pagination');
    }
	
	public function index()
	{
		
		$config['base_url'] = $this->config->item('url').'/product';
		$config['total_rows'] = count($this->common_model->get_multiple_data_of_product());
		$config['per_page'] = 5;
		$config['uri_segment'] = 2;
		$choice = $config['total_rows']/$config['per_page'];
		$config['num_links'] = round($choice);
		
		$this->pagination->initialize($config);

		$page =($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$common['listData']=$this->common_model->get_multiple_data_of_product_via_limit($config['per_page'], $page);
		
		foreach($common['listData'] as $key => $value)
		{
			$common['listData'][$key]->userId = $value->fName.' '.$value->lName;
			$dirPath = $_SERVER['DOCUMENT_ROOT'].'/ci/intDemo/uploads/product/'.$value->productId.'/'.$value->productImage;
			if (file_exists($dirPath)) {
				$common['listData'][$key]->productImage = $this->config->item('url').'/uploads/product/'.$value->productId.'/'.$value->productImage;
			}
			else
			{
				$common['listData'][$key]->productImage = $this->config->item('url').'/uploads/noImage.jpg';
			}
		}
		$common['links'] = $this->pagination->create_links();
		$common['fileName']= 'product/list.php';
		$common['url'] = $this->config->item('url');
		$this->load->view('template.php',$common);
	}
	
	public function add()
	{
		
		if($this->input->post())
		{
			
			$this->form_validation->set_rules('productName', 'Product Name', 'required');
			if (empty($_FILES['productImage']['name']))
			{
				$this->form_validation->set_rules('productImage', 'Product Image', 'required');
			}
			$this->form_validation->set_rules('catId', 'Category Name', 'required');
			$this->form_validation->set_rules('userId', 'User Name', 'required');
	
			if ($this->form_validation->run() == FALSE)
			{
				$common['categoryList']=$this->common_model->get_multiple_data('category','catId','DESC');
				$common['userList']=$this->common_model->get_multiple_data('user','userId','DESC');
				$common['fileName']= 'product/addEdit.php';
				$common['mode'] = 'add';
				$common['url'] = $this->config->item('url');
				$this->load->view('template.php',$common);
			}
			else
			{
				$postArr= $this->input->post();
				unset($postArr['productImageStatus']);
				$productId = $this->common_model->insert_record('product',$postArr);
				if($_FILES['productImage']['name'])
				{
					$basepath = $_SERVER['DOCUMENT_ROOT'].'/ci/intDemo';
					if(is_dir($basepath.'/uploads') == FALSE)
					{
						mkdir($basepath.'/uploads', 0777, true);
					}
					if(!is_dir($basepath.'/uploads/product'))
					{
						mkdir($basepath.'/uploads/product', 0777, true);
					}
					if(!is_dir($basepath.'/uploads/product/'.$productId))
					{
						mkdir($basepath.'/uploads/product/'.$productId, 0777, true);
					}
					$uploadfile = $basepath .'/uploads/product/'.$productId.'/'.$_FILES['productImage']['name'];
					$uploadArr['productImage'] = $_FILES['productImage']['name'];
					if (move_uploaded_file($_FILES['productImage']['tmp_name'], $uploadfile)) {
						$this->common_model->update_record('product','productId',$productId,$uploadArr);
					}
				}
				redirect($this->config->item('url').'/product');exit;
			}
		}
		else
		{
			$common['categoryList']=$this->common_model->get_multiple_data('category','catId','DESC');
			$common['userList']=$this->common_model->get_multiple_data('user','userId','DESC');
			$common['fileName']= 'product/addEdit.php';
			$common['mode'] = 'add';
			$common['url'] = $this->config->item('url');
			$this->load->view('template.php',$common);
		}		
	}
	public function edit($id)
	{
		if($this->input->post())
		{
			
			$this->form_validation->set_rules('productName', 'Product Name', 'required');
			if($this->input->post('productImageStatus') == 'no')
			{
				if (empty($_FILES['productImage']['name']))
				{
					$this->form_validation->set_rules('productImage', 'Product Image', 'required');
				}
			}
			$this->form_validation->set_rules('catId', 'Category Name', 'required');
			$this->form_validation->set_rules('userId', 'User Name', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$common['categoryList']=$this->common_model->get_multiple_data('category','catId','DESC');
				$common['userList']=$this->common_model->get_multiple_data('user','userId','DESC');
				$common['singleRecord'] = $this->common_model->get_single_record('product','productId',$id);
				$dirPath = $_SERVER['DOCUMENT_ROOT'].'/ci/intDemo/uploads/product/'.$id.'/'.$common['singleRecord']->productImage;
				
				if (file_exists($dirPath)) {
					$common['singleRecord']->productImage = $this->config->item('url').'/uploads/product/'.$id.'/'.$common['singleRecord']->productImage;
				}
				else
				{
					$common['singleRecord']->productImage = '';
				}		
				$common['mode'] = 'edit';
				$common['fileName']= 'product/addEdit.php';
				$common['url'] = $this->config->item('url');
				$this->load->view('template.php',$common);
			}
			else
			{
				$uploadArr= $this->input->post();
				unset($uploadArr['productImageStatus']);
				if($_FILES['productImage']['name'])
				{
					$basepath = $_SERVER['DOCUMENT_ROOT'].'/ci/intDemo';
					if(is_dir($basepath.'/uploads') == FALSE)
					{
						mkdir($basepath.'/uploads', 0777, true);
					}
					if(!is_dir($basepath.'/uploads/product'))
					{
						mkdir($basepath.'/uploads/product', 0777, true);
					}
					if(!is_dir($basepath.'/uploads/product/'.$id))
					{
						mkdir($basepath.'/uploads/product/'.$id, 0777, true);
					}
					$uploadfile = $basepath .'/uploads/product/'.$id.'/'.$_FILES['productImage']['name'];
					
					if (move_uploaded_file($_FILES['productImage']['tmp_name'], $uploadfile)) {
						$uploadArr['productImage'] = $_FILES['productImage']['name'];
					}
					else
					{
						$uploadArr['productImage'] = '';
					}
				}
				
				$this->common_model->update_record('product','productId',$this->input->post('productId'),$uploadArr);
			    redirect($this->config->item('url').'/product');exit;
			}
		}
		else
		{
			$common['categoryList']=$this->common_model->get_multiple_data('category','catId','DESC');
			$common['userList']=$this->common_model->get_multiple_data('user','userId','DESC');
			$common['singleRecord'] = $this->common_model->get_single_record('product','productId',$id);
			$dirPath = $_SERVER['DOCUMENT_ROOT'].'/ci/intDemo/uploads/product/'.$id.'/'.$common['singleRecord']->productImage;
			
			if (file_exists($dirPath)) {
				$common['singleRecord']->productImage = $this->config->item('url').'/uploads/product/'.$id.'/'.$common['singleRecord']->productImage;
			}
			else
			{
				$common['singleRecord']->productImage = '';
			}		
			$common['mode'] = 'edit';
			$common['fileName']= 'product/addEdit.php';
			$common['url'] = $this->config->item('url');
			$this->load->view('template.php',$common);
		}		
	}
	public function delete()
	{
		if($this->input->post('ids') != NULL)
		{
			
			$idsArr = $this->input->post('ids');
			foreach($idsArr as $key => $value)
			{
				$dirPath = $_SERVER['DOCUMENT_ROOT'].'/ci/intDemo/uploads/product/'.$value;
				if (is_dir($dirPath)) {
					if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
						$dirPath .= '/';
					}
				$files = glob($dirPath . '*', GLOB_MARK);
				foreach ($files as $file) {
					if (is_dir($file)) {
						self::deleteDir($file);
					} else {
						unlink($file);
					}
				}
				rmdir($dirPath);
				}
			}
			$this->common_model->delete_multiple_data('product','productId',$this->input->post('ids'));
		}
		redirect($this->config->item('url').'/product');exit;
	}
	public function removeImage($id){
		$dirPath = $_SERVER['DOCUMENT_ROOT'].'/ci/intDemo/uploads/product/'.$id;
		if (is_dir($dirPath)) {
			if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
				$dirPath .= '/';
			}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
		}
		redirect($this->config->item('url').'/product/edit/'.$id);exit;
	}
}
