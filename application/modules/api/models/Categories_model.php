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

	public function add_category($category)
	{
		$this->db->insert('categories', $category);
		return $this->db->insert_id();
	}

	public function remove_category($category_id)
	{
		$this->db->where('id', $category_id);
		return $this->db->delete('categories');
	}
}