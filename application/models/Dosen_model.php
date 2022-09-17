<?php
class dosen_model extends CI_Model 
{
 
	public function __construct()
	{
		$this->load->database();
	}

	//public function get_dosen()
	//{
	//	$sql = 'select dosen.*, group_dosen.warna  
	//			from dosen 
	//			inner join group_dosen ON dosen.group_id = group_dosen.id 
	//			where semester_id = '.$semester_id.' order by id';
	//	$query = $this->db->query($sql);
	//	return $query->result();
	//}

	public function get_dosen()  
	{
		$query = $this->db->select('*'); 
		$query->from('dosen');
		return $query->get()->result();
	}

	
	public function submit_tambah($save_data)  
	{
		$result = $this->db->insert('dosen',$save_data);
		return true;
	}
	public function update_excel($save_data)  
	{
		$result = $this->db->replace('dosen',$save_data);
		return true;
	}

	public function edit_dosen($id)
	{
		$this->db->where('nim', $id);
		$query = $this->db->select('*');
		$query->from('dosen');
		return $query->get()->result();
	}
	public function submit_edit($save_data, $id_edit)
	{
		$this->db->where('nim', $id_edit);
		$this->db->update('dosen', $save_data);
		return true;
	}

 	public function update_mahasiwa($save_data)  
	{
		$result = $this->db->replace('dosen',$save_data);
		return true;
	}


	public function hapus($id)
	{
		$this->db->where('nim', $id);
		$this->db->delete('dosen');
		return true;
	}
}
?>