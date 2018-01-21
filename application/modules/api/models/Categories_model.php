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

	public function add_categories($categories)
	{
		$this->db->insert('categories', $categories);
		return $this->db->insert_id();
	}

	public function remove_categories($categories_id)
	{
		$this->db->where('id', $categories_id);
		return $this->db->delete('categories');
	}

	public function edit_categories($data)
	{
		$this->db->trans_start();
		$this->db->where('id', $data['id']);
		$this->db->update('categories', $data);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
}
