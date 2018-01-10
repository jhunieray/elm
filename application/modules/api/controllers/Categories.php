<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller {

	public function all()
	{
		$this->load->model('api/Categories_model');
		$categories = $this->Categories_model->get_all_categories();

		// output JSON
		//header('Content-Type: application/json');		
		echo json_encode($categories);
	}
}