<?php 

class Categories_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_categories()
	{
		$query = $this->db->get('categories');
		return $query->result();
	}
}