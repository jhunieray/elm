<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('api/Lists_model');
	}

	public function all()
	{
		$lists = $this->Lists_model->get_all_lists();

		// output JSON
		//header('Content-Type: application/json');		
		echo json_encode($lists);
	}

	public function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('input_list', 'List Name', 'required');
		if($this->form_validation->run() !== FALSE)
		{
			$list = array(
				'name' => $this->input->post('input_list'),
				'description' => $this->input->post('description'),
				'operator_match' => $this->input->post('operator_match'),
			);
			$list_id = $this->Lists_model->add_list($list);

			if($list_id>0) 
			{
				header('Content-Type: application/json');
				print json_encode($list_id);
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
			if(!$this->Lists_model->remove_list($value)) {
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
