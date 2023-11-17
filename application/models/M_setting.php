<?php
class M_setting extends CI_Model
{

    function get_setting_by_name($name) {
		$this->db->select('*');
		$this->db->from('tbl_setting');
		$this->db->like('nama', $name);
        return $this->db->get()->row();
    }
}
