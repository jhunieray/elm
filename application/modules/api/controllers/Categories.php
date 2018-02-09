<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('api/Categories_model');
	}

	public function all()
	{
		$categories = $this->Categories_model->get_all_categories();

		// output JSON
		//header('Content-Type: application/json');		
		echo json_encode($categories);
	}

	public function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('input_category', 'Category', 'required');
		if($this->form_validation->run() !== FALSE)
		{
			$category = array(
				'name' => $this->input->post('input_category')
			);
			$category_id = $this->Categories_model->add_category($category);

			if($category_id>0) 
			{
				header('Content-Type: application/json');
				print json_encode($category_id);
			}
			else
			{
				$error['error'] = 'There was an error saving your data.';
				header('HTTP/1.1 500 Internal Server Error');
        		header('Content-Type: application/json; charset=UTF-8');
				die( json_encode($error) );
			}
 		} 
 		else 
 		{
	 		$error['error'] = 'Please check the ff errors: '.strip_tags(validation_errors());
	 		header('HTTP/1.1 500 Internal Server Error');
        	header('Content-Type: application/json; charset=UTF-8');
			die( json_encode($error) );
		}
	}

	public function remove()
	{
		$data = json_decode(file_get_contents('php://input'));
		foreach ($data as $key => $value) {
			# code...
			if(!$this->Categories_model->remove_category($value)) {
				$error['error'] = 'There was an error deleting your data.';
				header('HTTP/1.1 500 Internal Server Error');
	    		header('Content-Type: application/json; charset=UTF-8');
				die( json_encode($error) );
			}
		}

		header('Content-Type: application/json');
		print json_encode(array('status' => 'SUCCESS'));
	}
}
