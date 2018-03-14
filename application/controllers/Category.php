<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->database();
		$this->load->model('common_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library("table");
    }
	
	public function index()
	{
		$config['base_url'] = $this->config->item('url').'/category';
		$config['total_rows'] = count($this->common_model->get_multiple_data('category','catId','DESC'));
		$config['per_page'] = 5;
		$config['uri_segment'] = 2;
		$choice = $config['total_rows']/$config['per_page'];
		$config['num_links'] = round($choice);
		$this->pagination->initialize($config);
		$page =($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$common['listData']=$this->common_model->get_multiple_data_via_limit('category','catId','DESC',$config['per_page'], $page);
		$common['links'] = $this->pagination->create_links();
		$common['fileName']= 'category/list.php';
		$common['url'] = $this->config->item('url');
		$this->load->view('template.php',$common);
	}
	
	public function add()
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('catName', 'Category Name', 'required');
	
			if ($this->form_validation->run() == FALSE)
			{
				$common['fileName']= 'category/addEdit.php';
				$common['mode'] = 'add';
				$common['url'] = $this->config->item('url');
				$this->load->view('template.php',$common);
			}
			else
			{
				$this->common_model->insert_record('category',$this->input->post());
				redirect($this->config->item('url').'/category');exit;
			}
		}
		else
		{
			$common['fileName']= 'category/addEdit.php';
			$common['mode'] = 'add';
			$common['url'] = $this->config->item('url');
			$this->load->view('template.php',$common);
		}		
	}
	public function edit($id)
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('catName', 'Category Name', 'required');
	
			if ($this->form_validation->run() == FALSE)
			{
				$common['singleRecord'] = $this->common_model->get_single_record('category','catId',$this->input->post('catId'));
				$common['fileName']= 'category/addEdit.php';
				$common['mode'] = 'edit';
				$common['url'] = $this->config->item('url');
				$this->load->view('template.php',$common);
			}
			else
			{
				$this->common_model->update_record('category','catId',$this->input->post('catId'),$this->input->post());
			    redirect($this->config->item('url').'/category');exit;
			}
		}
		else
		{
			
			$common['singleRecord'] = $this->common_model->get_single_record('category','catId',$id);
			$common['mode'] = 'edit';
			$common['fileName']= 'category/addEdit.php';
			$common['url'] = $this->config->item('url');
			$this->load->view('template.php',$common);
		}		
	}
	public function delete()
	{
		if($this->input->post('ids') != NULL)
		{
			$this->common_model->delete_multiple_data('category','catId',$this->input->post('ids'));
		}
		redirect($this->config->item('url').'/category');exit;
	}
}
