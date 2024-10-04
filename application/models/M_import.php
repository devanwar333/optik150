<?php


class M_import extends CI_Model
{
	var $table = 'tbl_import';
	var $primary = 'id';
	var $column_order = array(null, 'id', 'type', 'file', 'created_at', 'updated_at', 'proceed', 'size' ,'status');
	var $column_search = array('id');
	var $order = array('id' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('string_helper');
        
	}

	private function _get_datatables_query()
	{
	
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by($this->primary, "DESC");


		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	
	public function batchUploadBarang() {
		
	}
}
