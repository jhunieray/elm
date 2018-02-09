<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppression extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('api/Suppression_model');
	}

	public function all()
	{
		$suppression = $this->Subscribers_model->get_all_suppression_table();

		// output JSON
		//header('Content-Type: application/json');		
		echo json_encode($suppression);
	}

	
}
