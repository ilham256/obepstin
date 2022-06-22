<?php
class Semester_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database(); 
	}

	public function get_semesters($order = 'asc')
	{
		$sql = 'select * 
				from semester order by id_semester '.$order;
		$query = $this->db->query($sql);
		return $query->result();
	}

}
?>