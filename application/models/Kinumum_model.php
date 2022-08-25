<?php
class kinumum_model extends CI_Model 
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
	public function get_kinumum()  
	{
		$query = $this->db->select('*');
		$query->from('kinerja_cpl_cpmk');
		return $query->get()->result();
	} 
	public function submit_edit($save_data, $id_edit)
	{
		$this->db->where('id', '1');
		$this->db->update('kinerja_cpl_cpmk', $save_data); 
		return true;
	}  



// Codingan Baru

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
		return $query->get()->result();
	}

	public function get_deskriptor_rumus_cpmk()  
	{
		$query = $this->db->select('*');
		$query->from('deskriptor_rumus_cpmk');
		$query->join('matakuliah_has_cpmk','deskriptor_rumus_cpmk.id_matakuliah_has_cpmk = matakuliah_has_cpmk.id_matakuliah_has_cpmk');
		$query->join('mata_kuliah','matakuliah_has_cpmk.kode_mk = mata_kuliah.kode_mk');
		return $query->get()->result();
	}


	public function get_mahasiswa_tahun($tahun)  
	{
		$status = array('Aktif','Lulus');
		$query = $this->db->select('*');
		$query->from('mahasiswa');
		$query->where('tahun_masuk',$tahun);
		$query->where_in('StatusAkademik',$status);

		return $query->get()->result();
	}

	public function get_data_mahasiswa($nim)  
	{
		$query = $this->db->select('*');
		$query->from('mahasiswa');
		$query->where('nim',$nim);
		return $query->get()->result();
	}

	public function get_nilai_cpmk()  
	{
		$query = $this->db->select('*');
		$query->from('nilai_cpmk');
		return $query->get()->result();
	}

	public function get_nilai_cpmk_select($id)  
	{
		$query = $this->db->select('*');
		$query->from('nilai_cpmk');
		$query->where('id_nilai',$id);
		return $query->get()->result();
	}
}  

?>