<?php
class kincpmk_model extends CI_Model 
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

	public function get_cpmklang_select($data_tahun_masuk,$data_mata_kuliah)  
	{
		$query = $this->db->select('*');
		$query->from('spk_cpmklang'); 
		$query->join('mahasiswa','mahasiswa.nim = spk_cpmklang.nim');
		$query->join('mata_kuliah','mata_kuliah.kode_mk = spk_cpmklang.kode_mk');
		$query->where('tahun_masuk',$data_tahun_masuk);
		$query->where('kode_mk',$data_mata_kuliah);
		return $query->get()->result();
	}

	public function get_cpmklang()   
	{
		$query = $this->db->select('*');
		$query->from('spk_cpmklang');
		$query->join('mahasiswa','mahasiswa.nim = spk_cpmklang.nim');
		$query->join('mata_kuliah','mata_kuliah.kode_mk = spk_cpmklang.kode_mk');
		return $query->get()->result();
	}

	public function get_cpmklang_avg_all_cpmklang_a($key,$tahun)  
	{
		$query = $this->db->select_avg('cpmklang_a');
		$query->from('spk_cpmklang');
		$query->join('mahasiswa','mahasiswa.nim = spk_cpmklang.nim');
		$query->where('kode_mk',$key);
		$query->where('tahun_masuk',$tahun);
		return $query->get()->result();
	}

	public function get_cpmklang_avg_all_cpmklang_b($key,$tahun)  
	{
		$query = $this->db->select_avg('cpmklang_b');
		$query->from('spk_cpmklang');
		$query->join('mahasiswa','mahasiswa.nim = spk_cpmklang.nim');
		$query->where('kode_mk',$key);
		$query->where('tahun_masuk',$tahun);
		return $query->get()->result();
	}

	public function get_cpmklang_avg_all_cpmklang_c($key,$tahun)  
	{
		$query = $this->db->select_avg('cpmklang_c');
		$query->from('spk_cpmklang');
		$query->join('mahasiswa','mahasiswa.nim = spk_cpmklang.nim');
		$query->where('kode_mk',$key);
		$query->where('tahun_masuk',$tahun);
		return $query->get()->result();
	}


		public function get_cpmktlang_avg_all_cpmktlang_a($key,$tahun)  
	{
		$query = $this->db->select_avg('cpmktlang_a');
		$query->from('spk_cpmktlang');
		$query->join('mahasiswa','mahasiswa.nim = spk_cpmktlang.nim');
		$query->where('kode_mk',$key);
		$query->where('tahun_masuk',$tahun);
		return $query->get()->result();
	}

	public function get_cpmktlang_avg_all_cpmktlang_b($key,$tahun)  
	{
		$query = $this->db->select_avg('cpmktlang_b');
		$query->from('spk_cpmktlang');
		$query->join('mahasiswa','mahasiswa.nim = spk_cpmktlang.nim');
		$query->where('kode_mk',$key);
		$query->where('tahun_masuk',$tahun);
		return $query->get()->result();
	}

	public function get_cpmktlang_avg_all_cpmktlang_c($key,$tahun)  
	{
		$query = $this->db->select_avg('cpmktlang_c');
		$query->from('spk_cpmktlang');
		$query->join('mahasiswa','mahasiswa.nim = spk_cpmktlang.nim');
		$query->where('kode_mk',$key);
		$query->where('tahun_masuk',$tahun);
		return $query->get()->result();
	}


	public function get_mk_cpmk($key)   
	{
		$query = $this->db->select('*');
		$query->from('matakuliah_has_cpmk');		
		$query->where('kode_mk',$key);
		return $query->get()->result();
	}

	public function get_nilai_cpmk($key,$nim)  
	{
		$query = $this->db->select('*');
		$query->from('nilai_cpmk');	
		$query->where('id_matakuliah_has_cpmk',$key);
		$query->where('nim',$nim);
		return $query->get()->result();
	}
}
?>