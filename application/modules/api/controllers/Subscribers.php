<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers extends MY_Controller {

	public function all()
	{
		$this->load->model('api/Subscribers_model');
		$all_subscribers = $this->Subscribers_model->get_all_subscribers_table();
		$subscribers['data'] = $all_subscribers;

		// output JSON
		//header('Content-Type: application/json');		
		echo json_encode($subscribers);
	}
}
