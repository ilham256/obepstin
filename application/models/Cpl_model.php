<?php
class Cpl_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_cpls($order = 'asc')
	{
		$sql = 'select * 
				from cpl order by id '.$order;
		$query = $this->db->query($sql);
		return $query->result();
	}

}
?>