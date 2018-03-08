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

	public function export_subscribers($data)
	{
		$this->load->dbutil();
		
		$this->db
				->select('`subscribers`.`id` as `id`, `fname`, `lname`,  `subscribers`.`email` as `email`, `contact_no`, `address`')
				->join('subscriber_category', '`subscribers`.`id` = `subscriber_category`.`subscriber`', 'left')
				->join('subscriber_list', '`subscribers`.`id` = `subscriber_list`.`subscriber`', 'left')
				->join('suppression', '`subscribers`.`email` = `suppression`.`email`', 'left');
		
		$this->db->group_start();
		foreach ($data['categories'] as $key => $category) {
			# code...
			$data['category_operator'] == 'OR' ? $this->db->or_where('category', $category) : $this->db->where('category', $category);
		}
		$this->db->group_end();

		$data['operator_match'] == 'OR' ? $this->db->or_group_start() : $this->db->group_start();
		foreach ($data['list'] as $key => $list) {
			# code...
			$data['list_operator'] == 'OR' ? $this->db->or_where('list', $list) : $this->db->where('list', $list);
		}
		$this->db->group_end();

		$this->db->where('`suppression`.`email`', NULL);

		$query = $this->db->get('subscribers');

		$delimiter = ",";
		$newline = "\r\n";
		$enclosure = '"';

		return $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
	}

	public function search_subscribers($data)
	{
		$this->load->dbutil();
		
		$this->db
				->select('`subscribers`.`id` as `id`, `subscribers`.`email` as `email`, `fname`, `lname`, `address`, `contact_no`, `subscribers`.`date_added` as `date_added`, `date_updated`, `status`')
				->join('subscriber_category', '`subscribers`.`id` = `subscriber_category`.`subscriber`', 'left')
				->join('subscriber_list', '`subscribers`.`id` = `subscriber_list`.`subscriber`', 'left')
				->join('suppression', '`subscribers`.`email` = `suppression`.`email`', 'left');
		
		$this->db->group_start();
		foreach ($data['categories'] as $key => $category) {
			# code...
			$data['category_operator'] == 'OR' ? $this->db->or_where('category', $category) : $this->db->where('category', $category);
		}
		$this->db->group_end();

		$data['operator_match'] == 'OR' ? $this->db->or_group_start() : $this->db->group_start();
		foreach ($data['list'] as $key => $list) {
			# code...
			$data['list_operator'] == 'OR' ? $this->db->or_where('list', $list) : $this->db->where('list', $list);
		}
		$this->db->group_end();

		$this->db->where('`suppression`.`email`', NULL);

		if($data['email_operator'] == 'CONTAINS') {
			$this->db->like('`subscribers`.`email`', $data['email'], 'both');
		} else if($data['email_operator'] == 'EQUALS') {
			$this->db->where('`subscribers`.`email`', $data['email']);
		}

		if($data['status_operator'] != 'ALL') {
			$this->db->where('`subscribers`.`status`', $data['status_operator']);
		}
		
		$query = $this->db->get('subscribers');
		
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