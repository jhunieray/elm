<?php 

class Subscribers_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_subscribers_table()
	{
		$query = $this->db->get('subscribers_table');
		return $query->result();
	}

	public function add_subscriber($subscriber)
	{
		$this->db->insert('subscribers', $subscriber);
		return $this->db->insert_id();
	}

	public function remove_subscriber($subscriber_id)
	{
		$this->db->where('id', $subscriber_id);
		return $this->db->delete('subscribers');
	}
}