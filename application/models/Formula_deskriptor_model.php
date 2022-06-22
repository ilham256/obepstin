<?php
class formula_deskriptor_model extends CI_Model 
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

	public function get_deskriptor()  
	{
		$query = $this->db->select('*');
		$query->from('deskriptor');
		return $query->get()->result();
	}

	public function get_data_deskriptor($id)  
	{
		$query = $this->db->select('*');
		$query->from('deskriptor');
		$query->where('id_deskriptor',$id);
		return $query->get()->result();
	}


	public function get_matakuliah_has_cpmk()  
	{
		$query = $this->db->select('*');
		$query->from('matakuliah_has_cpmk');
		$query->join('cpmk_langsung','cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung');
		$query->join('mata_kuliah','mata_kuliah.kode_mk = matakuliah_has_cpmk.kode_mk');
		$query->order_by("id_matakuliah_has_cpmk", "asc");
		return $query->get()->result();
	}


	public function get_deskriptor_rumus_cpmk()  
	{
		$query = $this->db->select('*');
		$query->from('deskriptor_rumus_cpmk');
		$query->join('deskriptor','deskriptor.id_deskriptor = deskriptor_rumus_cpmk.id_deskriptor');
		$query->join('matakuliah_has_cpmk','matakuliah_has_cpmk.id_matakuliah_has_cpmk = deskriptor_rumus_cpmk.id_matakuliah_has_cpmk');
		$query->join('cpmk_langsung','cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung');
		$query->join('mata_kuliah','mata_kuliah.kode_mk = matakuliah_has_cpmk.kode_mk');
		return $query->get()->result();
	}

	public function edit_deskriptor($id)  
	{ 
		$query = $this->db->select('*');
		$query->from('deskriptor');
		$query->where('id_deskriptor',$id);
		return $query->get()->result();
	}

	public function edit_formula_deskriptor($id)  
	{
		$query = $this->db->select('*');
		$query->from('deskriptor_rumus_cpmk');
		$query->join('deskriptor','deskriptor.id_deskriptor = deskriptor_rumus_cpmk.id_deskriptor');
		$query->join('matakuliah_has_cpmk','matakuliah_has_cpmk.id_matakuliah_has_cpmk = deskriptor_rumus_cpmk.id_matakuliah_has_cpmk');
		$query->join('cpmk_langsung','cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung');
		$query->join('mata_kuliah','mata_kuliah.kode_mk = matakuliah_has_cpmk.kode_mk');
		$query->where('id_deskriptor_rumus_cpmk',$id);
		
		
		$query->order_by("id_deskriptor_rumus_cpmk", "asc");
		return $query->get()->result();
	}


	public function submit_tambah_deskriptor($save_data)  
	{
		$result = $this->db->insert('deskriptor',$save_data);
		return true;
	}

	public function submit_edit_deskriptor($save_data, $id_edit) 
	{
		$this->db->where('id_deskriptor', $id_edit);
		$this->db->update('deskriptor',$save_data);
		return true;
	}

	public function submit_tambah_formula($save_data)  
	{
		$result = $this->db->insert('deskriptor_rumus_cpmk',$save_data);
		return true; 
	}

	public function submit_edit_formula_deskriptor($save_data, $id_edit) 
	{
		$this->db->where('id_deskriptor_rumus_cpmk', $id_edit);
		$this->db->update('deskriptor_rumus_cpmk',$save_data);
		return true;
	}

		public function hapus_formula_deskriptor($id)
	{
		$this->db->where('id_deskriptor_rumus_cpmk', $id);
		$this->db->delete('deskriptor_rumus_cpmk');
		return true;
	}

		public function hapus_deskriptor($id)
	{
		$this->db->where('id_deskriptor', $id);
		$this->db->delete('deskriptor');
		return true;
	}
} 
?>