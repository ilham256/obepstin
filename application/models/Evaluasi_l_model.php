<?php
class evaluasi_l_model extends CI_Model 
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

	public function get_tahun_masuk_select($tahun_min,$tahun_max)  
	{
		$query = $this->db->select('tahun_masuk');
		$query = $this->db->distinct();
		$query->from('mahasiswa');
		$query->where('tahun_masuk >=', $tahun_min);
		$query->where('tahun_masuk <=', $tahun_max);

		return $query->get()->result();
	}
 
	 public function get_avg_cpl_1($key)  
		{
			$query = $this->db->select_avg('cpl_1');
			$query->from('spk_cpltlang');
			$query->join('mahasiswa','mahasiswa.nim = spk_cpltlang.nim');
			$query->where('tahun_masuk', $key);
			return $query->get()->result();
		}
		
	 public function get_avg_cpl_2($key)  
		{
			$query = $this->db->select_avg('cpl_2');
			$query->from('spk_cpltlang');
			$query->join('mahasiswa','mahasiswa.nim = spk_cpltlang.nim');
			$query->where('tahun_masuk', $key);
			
			return $query->get()->result();
		}

	 public function get_avg_cpl_3($key)  
		{
			$query = $this->db->select_avg('cpl_3');
			$query->from('spk_cpltlang');
			$query->join('mahasiswa','mahasiswa.nim = spk_cpltlang.nim');
			$query->where('tahun_masuk', $key);
			
			return $query->get()->result();
		}

	 public function get_avg_cpl_4($key)  
		{
			$query = $this->db->select_avg('cpl_4');
			$query->from('spk_cpltlang');
			$query->join('mahasiswa','mahasiswa.nim = spk_cpltlang.nim');
			$query->where('tahun_masuk', $key);
			
			return $query->get()->result();
		}

	 public function get_avg_cpl_5($key)  
		{
			$query = $this->db->select_avg('cpl_5');
			$query->from('spk_cpltlang');
			$query->join('mahasiswa','mahasiswa.nim = spk_cpltlang.nim');
			$query->where('tahun_masuk', $key);
			
			return $query->get()->result();
		}

	 public function get_avg_cpl_6($key)  
		{
			$query = $this->db->select_avg('cpl_6');
			$query->from('spk_cpltlang');
			$query->join('mahasiswa','mahasiswa.nim = spk_cpltlang.nim');
			$query->where('tahun_masuk', $key);
			
			return $query->get()->result();
		}

	 public function get_avg_cpl_7($key)  
		{
			$query = $this->db->select_avg('cpl_7');
			$query->from('spk_cpltlang');
			$query->join('mahasiswa','mahasiswa.nim = spk_cpltlang.nim');
			$query->where('tahun_masuk', $key);
			
			return $query->get()->result();
		}

	 public function get_avg_cpl_8($key)  
		{
			$query = $this->db->select_avg('cpl_8');
			$query->from('spk_cpltlang');
			$query->join('mahasiswa','mahasiswa.nim = spk_cpltlang.nim');
			$query->where('tahun_masuk', $key);
			
			return $query->get()->result();
		}





}
?>