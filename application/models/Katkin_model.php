<?php
class katkin_model extends CI_Model 
{
 
	public function __construct()
	{
		$this->load->database();
	}

	//public function get_mahasiswa()
	//{
	//	$sql = 'select mahasiswa.*, group_mahasiswa.warna  
	//			from mahasiswa 
	//			inner join group_mahasiswa ON mahasiswa.group_id = group_mahasiswa.id 
	//			where semester_id = '.$semester_id.' order by id';
	//	$query = $this->db->query($sql);
	//	return $query->result();
	//}
	public function get_katkin()  
	{
		$query = $this->db->select('*');
		$query->from('kinerja_cpl_cpmk');
		return $query->get()->result();
	}
	public function submit_edit($save_data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('kinerja_cpl_cpmk', $save_data);
		return true;
	}
}
?> 