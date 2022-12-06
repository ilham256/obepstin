<?php
class cpl_tersimpan_model extends CI_Model 
{
 
	public function __construct()
	{
		$this->load->database();
	}

	//public function get_cpl_tersimpan()
	//{
	//	$sql = 'select cpl_tersimpan.*, group_cpl_tersimpan.warna  
	//			from cpl_tersimpan 
	//			inner join group_cpl_tersimpan ON cpl_tersimpan.group_id = group_cpl_tersimpan.id 
	//			where semester_id = '.$semester_id.' order by id';
	//	$query = $this->db->query($sql);
	//	return $query->result();
	//}
	public function get_cpl()   
	{
		$query = $this->db->select('*');
		$query->from('cpl_langsung'); 
		return $query->get()->result();
	}

	public function cek_cpl($data)  
	{
		$query = $this->db->select('id_cpl_langsung');
		$query->from('cpl_langsung');
		$query->where('id_cpl_langsung',$data);
		return $query->get()->result();
	}
	
	public function get_mahasiswa($data_tahun_masuk)  
	{
		$query = $this->db->select('*');
		$query->from('mahasiswa'); 
		$query->where('tahun_masuk',$data_tahun_masuk);
		return $query->get()->result();
	}

	public function get_mahasiswa_all()  
	{
		$query = $this->db->select('*'); 
		$query->from('mahasiswa'); 
		return $query->get()->result();
	}

	public function get_cpl_tersimpan($data_tahun_masuk)  
	{
		$query = $this->db->select('*');
		$query->from('nilai_cpl_tersimpan');
		$query->join('mahasiswa','mahasiswa.nim = nilai_cpl_tersimpan.nim');
		$query->where('tahun_masuk',$data_tahun_masuk);
		return $query->get()->result();
	}

	public function get_cpl_tersimpan_all()  
	{
		$query = $this->db->select('*');
		$query->from('nilai_cpl_tersimpan');
		$query->join('mahasiswa','mahasiswa.nim = nilai_cpl_tersimpan.nim');
		return $query->get()->result();
	}

  
	public function update_excel($save_data)  
	{
		$result = $this->db->replace('nilai_cpl_tersimpan',$save_data);
		return true;
	}
}
?>