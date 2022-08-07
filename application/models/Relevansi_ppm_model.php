<?php
class relevansi_ppm_model extends CI_Model 
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

	public function get_relevansi_ppm()  
	{ 
		$query = $this->db->select('*');
		$query->from('relevansi_ppm');
		return $query->get()->result();
	}


 

	public function get_cpl()   
	{
		$query = $this->db->select('*');
		$query->from('cpl_langsung'); 
		return $query->get()->result();
	}

	public function update_excel_relevansi_ppm($save_data)  
	{
		$result = $this->db->replace('relevansi_ppm',$save_data);
		return true;
	}

	public function update_excel_nilai_relevansi_ppm($save_data)  
	{
		$result = $this->db->replace('nilai_relevansi_ppm',$save_data);
		return true;
	}

	public function update_excel_nilai_relevansi_ppm_cpl($save_data)  
	{
		$result = $this->db->replace('nilai_relevansi_ppm_cpl',$save_data);
		return true;
	}

	public function cek_cpl($data)  
	{
		$query = $this->db->select('id_cpl_langsung');
		$query->from('cpl_langsung');
		$query->where('id_cpl_langsung',$data);
		return $query->get()->result();
	}

	public function cek_ppm($data)  
	{
		$query = $this->db->select('id');
		$query->from('ppm');
		$query->where('id',$data);
		return $query->get()->result();
	}

}
?>