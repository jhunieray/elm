<?php 

class Suppression_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_suppressions()
	{
		$query = $this->db->get('suppression');
		return $query->result();
	}

	public function get_suppression($email)
	{
		$query = $this->db->get_where('suppression', array('email' => $email));
		return $query->row();

	}
	
}