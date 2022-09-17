<?php
class epbm_model extends CI_Model 
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

	public function get_epbm()  
	{ 
		$query = $this->db->select('*');
		$query->from('psd');
		return $query->get()->result();
	}

	public function get_psd()   
	{
		$query = $this->db->select('*');
		$query->from('psd'); 
		return $query->get()->result();
	} 

	public function update_excel_epbm_mata_kuliah($save_data)  
	{
		$result = $this->db->replace('epbm_mata_kuliah',$save_data);
		return true;
	}

	public function update_excel_dosen($save_data)  
	{
		$result = $this->db->replace('dosen',$save_data);
		return true;
	}
	public function update_excel_epbm_mata_kuliah_has_dosen($save_data)  
	{
		$result = $this->db->replace('epbm_mata_kuliah_has_dosen',$save_data);
		return true;
	}
	public function update_excel_nilai_epbm_mata_kuliah($save_data)  
	{
		$result = $this->db->replace('nilai_epbm_mata_kuliah',$save_data);
		return true;
	}

	public function update_excel_nilai_epbm_dosen($save_data)  
	{
		$result = $this->db->replace('nilai_epbm_dosen',$save_data);
		return true;
	}

	public function cek_dosen($data)  
	{
		$query = $this->db->select('*');
		$query->from('dosen');
		$query->where('NIP',$data);
		return $query->get()->result();
	}

	public function cek_mata_kuliah_kode_3($data)  
	{
		$query = $this->db->select('*');
		$query->from('mata_kuliah');
		$query->where('nama_kode_3',$data);
		return $query->get()->result();
	}

	public function cek_mata_kuliah_kode_2($data)  
	{
		$query = $this->db->select('*');
		$query->from('mata_kuliah');
		$query->where('nama_kode_2',$data);
		return $query->get()->result();
	}
	public function cek_mata_kuliah_kode_1($data)  
	{
		$query = $this->db->select('*');
		$query->from('mata_kuliah');
		$query->where('nama_kode',$data);
		return $query->get()->result();
	}

	public function cek_epbm_mata_kuliah($data)  
	{
		$query = $this->db->select('kode_epbm_mk');
		$query->from('epbm_mata_kuliah');
		$query->where('kode_epbm_mk',$data);
		return $query->get()->result();
	}

	public function cek_epbm_mata_kuliah_has_dosen($data)  
	{
		$query = $this->db->select('kode_epbm_mk_has_dosen');
		$query->from('epbm_mata_kuliah_has_dosen');
		$query->where('kode_epbm_mk_has_dosen',$data);
		return $query->get()->result();
	}

}
?>