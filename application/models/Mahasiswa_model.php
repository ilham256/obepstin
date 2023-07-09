<?php
class mahasiswa_model extends CI_Model 
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
 
	public function get_mahasiswa()  
	{
		$query = $this->db->select('*');
		$query->from('mahasiswa');
		$query->order_by('tahun_masuk','ASC');
		return $query->get()->result();
	}

	public function get_tahun_masuk()  
	{
		$query = $this->db->select('tahun_masuk');
		$query = $this->db->distinct();
		$query->from('mahasiswa');
		return $query->get()->result();
	} 

	public function get_tahun_masuk_min()  
	{
		$query = $this->db->select_min('tahun_masuk');
		$query->from('mahasiswa');
		return $query->get()->result();
	}

	public function get_tahun_masuk_max()  
	{
		$query = $this->db->select_max('tahun_masuk');
		$query->from('mahasiswa');
		return $query->get()->result();
	}

	
	public function submit_tambah($save_data)  
	{
		$result = $this->db->insert('mahasiswa',$save_data);
		return true;
	}
	public function update_excel($save_data)  
	{
		$result = $this->db->replace('mahasiswa',$save_data);
		return true;
	}

	public function edit_mahasiswa($id)
	{
		$this->db->where('nim', $id);
		$query = $this->db->select('*');
		$query->from('mahasiswa');
		return $query->get()->result();
	}
	public function submit_edit($save_data, $id_edit)
	{
		$this->db->where('nim', $id_edit);
		$this->db->update('mahasiswa', $save_data);
		return true;
	}

 	public function update_mahasiwa($save_data)  
	{
		$result = $this->db->replace('mahasiswa',$save_data);
		return true;
	}


	public function hapus($id)
	{
		$this->db->where('nim', $id);
		$this->db->delete('mahasiswa');
		return true;
	}

	public function cek_user_mahasiswa($data)  
	{
		$query = $this->db->select('id');
		$query->from('user');
		$query->where('id',$data);
		return $query->get()->result();
	}
	public function update_user_mahasiswa($save_data_user)  
	{
		$result = $this->db->replace('user',$save_data_user);
		return true;
	}

}
?>