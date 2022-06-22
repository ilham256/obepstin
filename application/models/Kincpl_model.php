<?php
class kincpl_model extends CI_Model 
{
 
	public function __construct()
	{
		$this->load->database();
	}

	//public function get_cpmklang()
	//{
	//	$sql = 'select cpmklang.*, group_cpmklang.warna  
	//			from cpmklang 
	//			inner join group_cpmklang ON cpmklang.group_id = group_cpmklang.id 
	//			where semester_id = '.$semester_id.' order by id';
	//	$query = $this->db->query($sql);
	//	return $query->result();
	//} 

	public function get_semester()  
	{
		$query = $this->db->select('*');
		$query->from('semester');	
		return $query->get()->result();
	}

	public function get_cpl()  
	{
		$query = $this->db->select('*');
		$query->from('cpl_langsung');	
		return $query->get()->result();
	}
}
?>