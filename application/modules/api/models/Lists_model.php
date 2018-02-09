<?php 

class Lists_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_lists()
	{
		$query = $this->db->get('lists');
		return $query->result();
	}

	public function add_list($list)
	{
		$this->db->insert('lists', $list);
		return $this->db->insert_id();
	}

	public function add_list_subscriber($subscriber_list)
	{
		$this->db->insert('subscriber_list', $subscriber_list);
		return $this->db->insert_id();
	}

	public function remove_list($list_id)
	{
		$this->db->where('id', $list_id);
		return $this->db->delete('lists');
	}
}