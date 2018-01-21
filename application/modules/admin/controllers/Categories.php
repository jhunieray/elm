<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	// Subscribers
	public function index()
	{
		$this->mPageTitle = 'Categories';
		$this->render('categories/index');
	}
}
