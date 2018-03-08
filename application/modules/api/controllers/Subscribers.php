<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('api/Subscribers_model');
		$this->load->model('api/Lists_model');
		$this->load->model('api/Suppression_model');
	}

	public function all()
	{
		$all_subscribers = $this->Subscribers_model->get_all_subscribers();
		$subscribers['draw'] = 1;
		$subscribers['recordsTotal'] = count($all_subscribers);
		$subscribers['recordsFiltered'] = count($all_subscribers);
		$subscribers['data'] = $all_subscribers;

		// output JSON
		//header('Content-Type: application/json');		
		echo json_encode($subscribers);
	}

	public function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('email_add', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('contact_no', 'Contact No', 'required|numeric');
		$this->form_validation->set_rules('address', 'Address', 'required');
		if($this->form_validation->run() !== FALSE)
		{
			if(!$this->filter_suppression($this->input->post('email_add')))
			{
				$subscriber = array(
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
					$subscriber_category = array(
						'subscriber' => $subscriber_id,
						'category' => $this->input->post('category')
					);
					$subscriber_category_id = $this->Subscribers_model->add_subscriber_category($subscriber_category);

					if($subscriber_category_id>0)
					{
						$subscriber_list = array(
							'subscriber' => $subscriber_id,
							'list' => $this->input->post('list')
						);
						$subscriber_list_id = $this->Lists_model->add_list_subscriber($subscriber_list);

						if($subscriber_list_id>0)
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
						$error['error'] = 'There was an error saving your data.';
						header('HTTP/1.1 500 Internal Server Error');
		        		header('Content-Type: application/json; charset=UTF-8');
						die( json_encode($error) );
					}
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
				$error['error'] = 'Email is found in suppressed list.';
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

	public function search()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('category[]', 'Categories', 'required');
		$this->form_validation->set_rules('list[]', 'Lists', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if($this->form_validation->run() !== FALSE)
		{
			if(!$this->filter_suppression($this->input->post('email')))
			{
				$categories = $this->input->post('category');
				$category_operator = $this->input->post('category_operator');
				$operator_match = $this->input->post('operator_match');
				$list = $this->input->post('list');
				$list_operator = $this->input->post('list_operator');
				$email = $this->input->post('email');
				$email_operator = $this->input->post('email_operator');
				$status = $this->input->post('status_operator');

				$subscribers = $this->Subscribers_model->search_subscribers(
					array(
						'categories' 			=> $categories,
						'category_operator' 	=> $category_operator,
						'operator_match'		=> $operator_match,
						'list'					=> $list,
						'list_operator'			=> $list_operator,
						'email'					=> $email,
						'email_operator'		=> $email_operator,
						'status_operator'		=> $status
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
					echo json_encode($subscribers);
				}
			}
			else
			{
				$error['error'] = 'Email is found in suppressed list.';
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

	private function filter_suppression($email)
	{
		return $this->Suppression_model->get_suppression($email);
	}
}
