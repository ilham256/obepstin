<?php
class report_model extends CI_Model 
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
		
		$query->join('mata_kuliah','mata_kuliah.kode_mk = spk_cpmklang.kode_mk');
		$query->where('tahun_masuk',$data_tahun_masuk);
		$query->where('kode_mk',$data_mata_kuliah);
		return $query->get()->result();
	}

	public function get_nama_mahasiswa($nim)  
		{
			$query = $this->db->select('nama');
			$query->from('mahasiswa');
			$query->where('nim',$nim);
			return $query->get()->result();
		}

		public function get_mahasiswa_select($nim)  
		{
			$query = $this->db->select('*');
			$query->from('mahasiswa');
			$query->where('nim',$nim);
			return $query->get()->result();
		}

 
		public function get_mahasiswa_cpl($nim)  
		{
			$query = $this->db->select('*');
			$query->from('spk_cpltlang');
			$query->where('nim',$nim);
			return $query->get()->result();
		}
 

	public function get_cpmklang()   
	{
		$query = $this->db->select('*');
		$query->from('spk_cpmklang');
		
		$query->join('mata_kuliah','mata_kuliah.kode_mk = spk_cpmklang.kode_mk');
		return $query->get()->result();
	}


// Nilai Cpmk Mahasiswa

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

	public function get_nilai_cpmk_tl($key,$nim)  
	{
		$query = $this->db->select('*');
		$query->from('nilai_cpmk_tak_langsung');	
		$query->where('id_matakuliah_has_cpmk',$key);
		$query->where('nim',$nim);
		return $query->get()->result();
	}
//submenu report

	public function get_cpl()  
	{
		$query = $this->db->select('*');
		$query->from('cpl_langsung');
		return $query->get()->result();
	}

	public function get_data_mk($id)  
	{
		$query = $this->db->select('*');
		$query->from('mata_kuliah');
		$query->where('kode_mk',$id);
		return $query->get()->result();
	}


// sub menu PPM

	public function get_relevansi_ppm()  
	{
		$query = $this->db->select('id_relevansi_ppm');
		$query->from('relevansi_ppm');
		return $query->get()->result();
	}
	public function get_ppm()  
	{
		$query = $this->db->select('*');
		$query->from('ppm');
		return $query->get()->result();
	}

	public function get_nilai_ppm_cpl($cpl,$relevansi_ppm)  
	{
		$query = $this->db->select('*');
		$query->from('nilai_relevansi_ppm_cpl');
		$query->where('id_relevansi_ppm',$relevansi_ppm);
		$query->where('id_cpl_langsung',$cpl);
		return $query->get()->result();
	}
	public function get_nilai_ppm($ppm,$relevansi_ppm)  
	{
		$query = $this->db->select('nilai_relevansi_ppm');
		$query->from('nilai_relevansi_ppm');
		$query->where('id_relevansi_ppm',$relevansi_ppm);
		$query->where('id_ppm',$ppm);
		return $query->get()->result();
	}

// Sub Menu Efektivitas CPL
	public function get_mahasiswa()  
		{
			$query = $this->db->select('*');
			$query->from('mahasiswa');
			return $query->get()->result();
		}
	public function get_nilai_efektivitas_cpl($cpl,$nim)  
	{
		$query = $this->db->select('nilai');
		$query->from('nilai_efektivitas_cpl');
		$query->where('nim',$nim);
		$query->where('id_cpl_langsung',$cpl);
		return $query->get()->result();
	}

	public function get_psd()   
	{
		$query = $this->db->select('*');
		$query->from('psd'); 
		$query->order_by('nama'); 
		return $query->get()->result();
	}

	public function get_dosen()   
	{
		$query = $this->db->select('*');
		$query->from('dosen'); 
		return $query->get()->result();
	}

	public function get_nilai_epbm_dosen($tahun,$semester,$d)   
	{
		$query = $this->db->select('*');
		$query->from('nilai_epbm_dosen'); 
		$query->where('tahun',$tahun);
		$query->where('semester',$semester);
		$query->where('kode_epbm_mk_has_dosen',$d);
		return $query->get()->result();
	}
	
	public function get_nilai_raport_epbm_dosen($tahun,$semester,$d)   
	{
		$query = $this->db->select('*');
		$query->from('nilai_epbm_dosen'); 
		$query->where('tahun',$tahun);
		$query->where('semester',$semester);
		$query->where('kode_epbm_mk_has_dosen',$d);
		return $query->get()->result();
	}

	public function get_nilai_epbm_mk($tahun,$semester,$d)   
	{
		$query = $this->db->select('*');
		$query->from('nilai_epbm_mata_kuliah');
		$query->where('tahun',$tahun); 
		$query->where('semester',$semester);
		$query->where('kode_epbm_mk',$d);
		return $query->get()->result();
	} 

	public function get_epbm_mata_kuliah_has_dosen()   
	{
		$query = $this->db->select('*');
		$query->from('epbm_mata_kuliah_has_dosen'); 
		return $query->get()->result();
	}

	public function get_epbm_mata_kuliah_has_dosen_select($dosen)   
	{
		$query = $this->db->select('*');
		$query->from('epbm_mata_kuliah_has_dosen'); 
		$query->join('epbm_mata_kuliah','epbm_mata_kuliah.kode_epbm_mk = epbm_mata_kuliah_has_dosen.kode_epbm_mk');
		$query->join('mata_kuliah','mata_kuliah.kode_mk = epbm_mata_kuliah.kode_mk');
		$query->where('NIP',$dosen);
		return $query->get()->result();
	}

	public function get_epbm_mata_kuliah_has_dosen_mk_select($mk)   
	{
		$query = $this->db->select('*');
		$query->from('epbm_mata_kuliah_has_dosen'); 
		$query->join('epbm_mata_kuliah','epbm_mata_kuliah.kode_epbm_mk = epbm_mata_kuliah_has_dosen.kode_epbm_mk');
		$query->join('dosen','dosen.NIP = epbm_mata_kuliah_has_dosen.NIP');
		$query->join('mata_kuliah','mata_kuliah.kode_mk = epbm_mata_kuliah.kode_mk');
		$query->where('epbm_mata_kuliah.kode_mk',$mk);
		return $query->get()->result();
	}

	public function get_tahun()   
	{
		$query = $this->db->select('tahun');
		$query->from('nilai_epbm_dosen'); 
		$query->distinct();
		return $query->get()->result();
	}


	public function get_epbm_mata_kuliah()   
	{
		$query = $this->db->select('*');
		$query->from('epbm_mata_kuliah'); 
		$query->join('mata_kuliah','mata_kuliah.kode_mk = epbm_mata_kuliah.kode_mk');
		return $query->get()->result();
	}
	
}
?>