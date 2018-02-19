<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('api/Subscribers_model');
	}

	public function index()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('category[]', 'Categories', 'required');
		$this->form_validation->set_rules('list[]', 'Lists', 'required');
		if($this->form_validation->run() !== FALSE)
		{
			$categories = $this->input->post('category');
			$list = $this->input->post('list');
			$file_type = $this->input->post('file_type');
			$compressed = $this->input->post('compressed');

			$array = TRUE;

			$subscribers = $this->Subscribers_model->custom_query($query, $array);
 		} 
 		else 
 		{
	 		$error['error'] = 'Please check the ff errors: '.strip_tags(validation_errors());
	 		header('HTTP/1.1 500 Internal Server Error');
        	header('Content-Type: application/json; charset=UTF-8');
			die( json_encode($error) );
		}
	}
}
