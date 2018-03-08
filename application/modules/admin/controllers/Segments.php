<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Segments extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	// Subscribers
	public function index()
	{
		$this->mPageTitle = 'List Segments';
		$this->render('segments/index');
	}
}