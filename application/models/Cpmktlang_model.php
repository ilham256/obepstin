<?php
class cpmktlang_model extends CI_Model 
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

	public function get_cpmktlang($data_mata_kuliah)  
	{ 
		$query = $this->db->select('*');
		$query->from('nilai_cpmk_tak_langsung');
		$query->join('matakuliah_has_cpmk','matakuliah_has_cpmk.id_matakuliah_has_cpmk = nilai_cpmk_tak_langsung.id_matakuliah_has_cpmk');
		$query->where('kode_mk',$data_mata_kuliah);
		return $query->get()->result();
	}

	public function get_mahasiswa($data_tahun_masuk)   
	{
		$query = $this->db->select('*');
		$query->from('mahasiswa'); 
		$query->where('tahun_masuk',$data_tahun_masuk);
		return $query->get()->result();
	}

	public function get_matakuliah_has_cpmk($data_mata_kuliah)  
	{
		$query = $this->db->select('*');
		$query->from('matakuliah_has_cpmk');
		$query->join('cpmk_langsung','cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung');
		$query->where('kode_mk',$data_mata_kuliah);
		return $query->get()->result();
	}
 






	public function cek_matakuliah_has_cpmk($data)  
	{
		$query = $this->db->select('id_matakuliah_has_cpmk');
		$query->from('matakuliah_has_cpmk');
		$query->where('id_matakuliah_has_cpmk',$data);
		return $query->get()->result();
	}
	public function cek_matakuliah_kode_2($data)  
	{
		$query = $this->db->select('kode_mk');
		$query->from('mata_kuliah');
		$query->where('nama_kode_2',$data);
		return $query->get()->result();
	}

	public function cek_matakuliah_kode_3($data)  
	{
		$query = $this->db->select('kode_mk');
		$query->from('mata_kuliah');
		$query->where('nama_kode_3',$data);
		return $query->get()->result();
	}

	public function update_excel($save_data)  
	{
		$result = $this->db->replace('nilai_cpmk_tak_langsung',$save_data);
		return true;
	}
}
?>