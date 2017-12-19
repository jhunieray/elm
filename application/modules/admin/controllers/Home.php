<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function index()
	{
		$this->load->model('Subscribers_model');
		$subscribers = $this->Subscribers_model->get_all_subscribers();
		$this->mViewData['subscribers_count'] = count($subscribers);
		$this->render('home');
	}
}
