<?php 

class Subscribers_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_subscribers()
	{
		$query = $this->db
					->select('`subscribers`.`id` as `id`, `subscribers`.`email` as `email`, `fname`, `lname`, `address`, `contact_no`, `subscribers`.`date_added` as `date_added`, `date_updated`, `status`')
					->join('suppression', 'subscribers.email = suppression.email', 'left')
					->get_where('subscribers', array('suppression.email' => null));
		return $query->result();
	}

	public function get_all_subscribers_unfiltered()
	{
		$query = $this->db->get('subscribers');
		return $query->result();
	}

	public function add_subscriber($subscriber)
	{
		$this->db->insert('subscribers', $subscriber);
		return $this->db->insert_id();
	}

	public function add_subscriber_category($subscriber_category)
	{
		$this->db->insert('subscriber_category', $subscriber_category);
		return $this->db->insert_id();
	}

	public function remove_subscriber($subscriber_id)
	{
		$this->db->where('id', $subscriber_id);
		return $this->db->delete('subscribers');
	}
}