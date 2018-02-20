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
			$category_operator = $this->input->post('category_operator');
			$operator_match = $this->input->post('operator_match');
			$list = $this->input->post('list');
			$list_operator = $this->input->post('list_operator');
			$file_type = $this->input->post('file_type');
			$compressed = $this->input->post('compressed');

			$subscribers = $this->Subscribers_model->export_subscribers(
				array(
					'categories' 			=> $categories,
					'category_operator' 	=> $category_operator,
					'operator_match'		=> $operator_match,
					'list'					=> $list,
					'list_operator'			=> $list_operator
				)
			);

			if ( ! $subscribers)
			{
			    $error['error'] = 'Please check the ff errors: Unable to retrieve email list.';
		 		header('HTTP/1.1 500 Internal Server Error');
	        	header('Content-Type: application/json; charset=UTF-8');
				die( json_encode($error) );
			}
			else
			{
				$path  = '';
				$file_name = 'email_list_'.date('YmdHis').'.'.$file_type;

				if($compressed == 1)
				{
					$this->load->library('zip');

					$path = './files/compressed/'.$file_name.'.zip';
					$this->zip->add_data($file_name, $subscribers);
					$this->zip->archive($path);
					//$this->zip->download($file_name.'.zip');
				}
				else
				{
					$path = './files/'.$file_type.'/'.$file_name;
					$this->load->helper('file');
			    	if( ! write_file($path, $subscribers) )
			    	{
			    		$error['error'] = 'Please check the ff errors: Unable to save file.';
				 		header('HTTP/1.1 500 Internal Server Error');
			        	header('Content-Type: application/json; charset=UTF-8');
						die( json_encode($error) );
			    	}
				}
				echo base_url($path);
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
}
