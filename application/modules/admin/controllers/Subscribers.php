<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	// Subscribers CRUD
	public function index()
	{
		$this->mPageTitle = 'Subscribers';
		$this->render('subscribers/index');
	}
}
