<?php
class Matakuliah_model extends CI_Model 
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

	public function get_matakuliah()  
	{
		$query = $this->db->select('*');
		$query->from('mata_kuliah'); 
		$query->join('semester','semester.id_semester = mata_kuliah.id_semester');
		$query->order_by("nama", "asc");
		return $query->get()->result();
	}

	public function get_matakuliah_has_cpmk_by_mk($id)  
	{
		$query = $this->db->select('*');
		$query->from('matakuliah_has_cpmk');
		$query->where('kode_mk',$id);
		$query->join('cpmk_langsung','cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung');
		$query->order_by("id_matakuliah_has_cpmk", "asc");
		return $query->get()->result();
	}

	public function get_mk_matakuliah_has_cpmk($id)  
	{
		$query = $this->db->select('kode_mk');
		$query->from('matakuliah_has_cpmk');
		$query->where('id_matakuliah_has_cpmk',$id);
		return $query->get()->result();
	}

	public function get_mk_matakuliah_has_cpmk_all()  
	{
		$query = $this->db->select('*');
		$query->from('matakuliah_has_cpmk');
		$query->join('cpmk_langsung','cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung');
		return $query->get()->result();
	}

	public function get_select_matakuliah($semester)
	{
		$query = $this->db->select('*');
		$query->from('mata_kuliah');
		$query->where('id_semester', $semester);
		return $query->get()->result();
	}
	public function get_semester()  
	{
		$query = $this->db->select('*');
		$query->from('semester');
		return $query->get()->result();
	}

	public function get_cpmk()  
	{
		$query = $this->db->select('*');
		$query->from('cpmk_langsung');
		return $query->get()->result();
	}

	public function get_rps($id)  
	{
		$query = $this->db->select('rps');
		$query->from('mata_kuliah');
		$query->where('kode_mk',$id);
		return $query->get()->result();
	}

	public function submit_tambah($save_data)  
	{
		$result = $this->db->insert('mata_kuliah',$save_data);
		return true;
	}

	public function edit_matakuliah($id)
	{
		$this->db->where('kode_mk', $id);
		$query = $this->db->select('*');
		$query->from('mata_kuliah');
		return $query->get()->result();
	}

	public function edit_matakuliah_has_cpmk($id)
	{
		$this->db->where('id_matakuliah_has_cpmk', $id);
		$query = $this->db->select('*');
		$query->from('matakuliah_has_cpmk');
		return $query->get()->result();
	}
	public function submit_edit($save_data, $id_edit)
	{
		$this->db->where('kode_mk', $id_edit);
		$this->db->update('mata_kuliah', $save_data);
		return true;
	}

	public function hapus($id)
	{
		$this->db->where('kode_mk', $id);
		$this->db->delete('mata_kuliah');
		return true;
	}

	public function hapus_matakuliah_has_cpmk($id)
	{
		$this->db->where('id_matakuliah_has_cpmk', $id);
		$this->db->delete('matakuliah_has_cpmk');
		return true;
	}

	public function get_nama_mk($data_mata_kuliah)  
	{
		$query = $this->db->select('*');
		$query->from('mata_kuliah');
		$query->where('kode_mk',$data_mata_kuliah);
		return $query->get()->result();
	}

	public function submit_tambah_matakuliah_has_cpmk($save_data)  
	{
		$result = $this->db->insert('matakuliah_has_cpmk',$save_data);
		return true;
	}

	public function submit_edit_matakuliah_has_cpmk($save_data, $id_edit)
	{
		$this->db->where('id_matakuliah_has_cpmk', $id_edit);
		$this->db->update('matakuliah_has_cpmk', $save_data);
		return true;
	}
}
?>