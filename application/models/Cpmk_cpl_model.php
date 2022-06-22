<?php
class Cpmk_cpl_model extends CI_Model 
{
 
	public function __construct()
	{
		$this->load->database();
	}

	//public function get_matakuliah()
	//{
	//	$sql = 'select mata_kuliah.*, group_mata_kuliah.warna  
	//			from mata_kuliah 
	//			inner join group_mata_kuliah ON mata_kuliah.group_id = group_mata_kuliah.id 
	//			where semester_id = '.$semester_id.' order by id';
	//	$query = $this->db->query($sql);
	//	return $query->result();
	//}

	public function get_cpmk()  
	{
		$query = $this->db->select('*'); 
		$query->from('cpmk_langsung');
		return $query->get()->result();
	}

	public function get_cpl()  
	{
		$query = $this->db->select('*');
		$query->from('cpl_langsung');
		return $query->get()->result();
	}

	public function get_cpl_rumus_deskriptor()  
	{
		$query = $this->db->select('*');
		$query->from('cpl_rumus_deskriptor');
		$query->join('deskriptor','deskriptor.id_deskriptor = cpl_rumus_deskriptor.id_deskriptor');
		return $query->get()->result();
	}

	public function edit_cpl($id)  
	{
		$query = $this->db->select('*');
		$query->from('cpl_langsung');
		$query->where('id_cpl_langsung',$id);
		return $query->get()->result();
	} 

 	public function submit_tambah_cpl($save_data)  
	{
		$result = $this->db->insert('cpl_langsung',$save_data);
		return true;
	}

	public function submit_edit_cpl($save_data, $id_edit) 
	{
		$this->db->where('id_cpl_langsung', $id_edit);
		$this->db->update('cpl_langsung',$save_data);
		return true;
	}

			public function hapus_cpl($id)
	{
		$this->db->where('id_cpl_langsung', $id);
		$this->db->delete('cpl_langsung');
		return true;
	}

	public function edit_cpmk($id)  
	{
		$query = $this->db->select('*');
		$query->from('cpmk_langsung');
		$query->where('id_cpmk_langsung',$id);
		return $query->get()->result();
	} 

 	public function submit_tambah_cpmk($save_data)  
	{
		$result = $this->db->insert('cpmk_langsung',$save_data);
		return true;
	}

	public function submit_edit_cpmk($save_data, $id_edit) 
	{
		$this->db->where('id_cpmk_langsung', $id_edit);
		$this->db->update('cpmk_langsung',$save_data);
		return true;
	}

			public function hapus_cpmk($id)
	{
		$this->db->where('id_cpmk_langsung', $id);
		$this->db->delete('cpmk_langsung');
		return true;
	}
}
?>