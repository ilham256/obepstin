<?php
class formula_model extends CI_Model 
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

	public function get_formula_cpl()  
	{
		$query = $this->db->select('*');
		$query->from('cpl_langsung');
		return $query->get()->result();
	}

	public function get_data_cpl($id)  
	{
		$query = $this->db->select('*');
		$query->from('cpl_langsung');
		$query->where('id_cpl_langsung',$id);
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

	public function edit_cpl_rumus_deskriptor($id)  
	{
		$query = $this->db->select('*');
		$query->from('cpl_rumus_deskriptor');
		$query->join('cpl_langsung','cpl_langsung.id_cpl_langsung = cpl_rumus_deskriptor.id_cpl_langsung');
		$query->join('deskriptor','deskriptor.id_deskriptor = cpl_rumus_deskriptor.id_deskriptor');
		$query->where('id_cpl_rumus_deskriptor',$id);
		return $query->get()->result();
	}


	public function get_deskriptor()  
	{
		$query = $this->db->select('*');
		$query->from('deskriptor');
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

	public function submit_tambah_formula_deskriptor($save_data)  
	{
		$result = $this->db->insert('cpl_rumus_deskriptor',$save_data);
		return true; 
	}

	public function submit_edit_formula_deskriptor($save_data, $id_edit) 
	{
		$this->db->where('id_cpl_rumus_deskriptor', $id_edit);
		$this->db->update('cpl_rumus_deskriptor',$save_data);
		return true;
	}

		public function hapus_formula_deskriptor($id)
	{
		$this->db->where('id_cpl_rumus_deskriptor', $id);
		$this->db->delete('cpl_rumus_deskriptor');
		return true;
	}

		public function hapus_cpl($id)
	{
		$this->db->where('id_cpl_langsung', $id);
		$this->db->delete('cpl_langsung');
		return true;
	}
} 
?>