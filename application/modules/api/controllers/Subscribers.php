<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('api/Subscribers_model');
	}

	public function all()
	{
		$all_subscribers = $this->Subscribers_model->get_all_subscribers_table();
		$subscribers['data'] = $all_subscribers;

		// output JSON
		//header('Content-Type: application/json');		
		echo json_encode($subscribers);
	}

	public function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('fname', 'First Name', 'required|alpha');
		$this->form_validation->set_rules('lname', 'Last Name', 'required|alpha');
		$this->form_validation->set_rules('email_add', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('contact_no', 'Contact No', 'required|numeric');
		$this->form_validation->set_rules('address', 'Address', 'required');
		if($this->form_validation->run() !== FALSE)
		{
			$subscriber = array(
				'category' => $this->input->post('category'),
				'fname' => $this->input->post('fname'),
				'lname' => $this->input->post('lname'),
				'email' => $this->input->post('email_add'),
				'contact_no' => $this->input->post('contact_no'),
				'address' => $this->input->post('address'),
				'date_added' => date('Y-m-d H:i:s'),
				'date_updated' => date('Y-m-d H:i:s'),
				'status' => 'ACTIVE'
			);
			$subscriber_id = $this->Subscribers_model->add_subscriber($subscriber);

			if($subscriber_id>0) 
			{
				header('Content-Type: application/json');
				print json_encode($subscriber_id);
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
			if(!$this->Subscribers_model->remove_subscriber($value)) {
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
