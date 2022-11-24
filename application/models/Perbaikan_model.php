<?php
class perbaikan_model extends CI_Model 
{
 
	public function __construct()
	{
		$this->load->database();
	}

	//public function get_perbaikan_mata_kuliah()
	//{
	//	$sql = 'select perbaikan_mata_kuliah.*, group_perbaikan_mata_kuliah.warna  
	//			from perbaikan_mata_kuliah 
	//			inner join group_perbaikan_mata_kuliah ON perbaikan_mata_kuliah.group_id = group_perbaikan_mata_kuliah.id 
	//			where semester_id = '.$semester_id.' order by id';
	//	$query = $this->db->query($sql);
	//	return $query->result();
	//}

	public function get_perbaikan_mata_kuliah()  
	{
		$query = $this->db->select('*'); 
		$query->from('perbaikan_mata_kuliah');
		$query->join('dosen','dosen.NIP = perbaikan_mata_kuliah.NIP');
		$query->join('mata_kuliah','mata_kuliah.kode_mk = perbaikan_mata_kuliah.kode_mk');
		return $query->get()->result();
	}

	
	public function submit_tambah($save_data)  
	{
		$result = $this->db->insert('perbaikan_mata_kuliah',$save_data);
		return true;
	}
	public function update_excel($save_data)  
	{
		$result = $this->db->replace('perbaikan_mata_kuliah',$save_data);
		return true;
	}

	public function edit_perbaikan_mata_kuliah($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->select('*');
		$query->from('perbaikan_mata_kuliah'); 
		$query->join('dosen','dosen.NIP = perbaikan_mata_kuliah.NIP');
		$query->join('mata_kuliah','mata_kuliah.kode_mk = perbaikan_mata_kuliah.kode_mk');
		return $query->get()->result();
	}
	public function submit_edit($save_data, $id_edit)
	{
		$this->db->where('id', $id_edit);
		$this->db->update('perbaikan_mata_kuliah', $save_data);
		return true;
	}

 	public function update_perbaikan_mata_kuliah($save_data)  
	{
		$result = $this->db->replace('perbaikan_mata_kuliah',$save_data);
		return true;
	}


	public function hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('perbaikan_mata_kuliah');
		return true;
	}
}
?>