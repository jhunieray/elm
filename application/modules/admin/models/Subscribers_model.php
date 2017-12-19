<?php 

class Subscribers_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_subscribers()
	{
		$query = $this->db->get('subscribers');
		return $query->result();
	}
}