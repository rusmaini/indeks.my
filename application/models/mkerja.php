<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mkerja extends MY_Model
{
	//protected $_table = 'kerja_jawatan';
	
	
	function get_all($limit,$start)
	{
		return $this->db->limit($limit, $start)
						->select('	kerja_jawatan.*,
									kerja_terma.nama 	as terma,
									kerja_imbuhan.nama 	as imbuhan,
									kerja_syarikat.nama as syarikat,
									negeri.nama 		as negeri,
									negeri.id 			as negeri_id')
						->from('kerja_jawatan')
						->join('kerja_terma','kerja_terma.id = kerja_jawatan.terma_id','left')
						->join('kerja_imbuhan','kerja_imbuhan.id = kerja_jawatan.imbuhan_id','left')
						->join('kerja_industri','kerja_industri.id = kerja_jawatan.industri_id','left')
						->join('kerja_pengkhususan','kerja_pengkhususan.id = kerja_jawatan.pengkhususan_id','left')
						->join('kerja_peringkat','kerja_peringkat.id = kerja_jawatan.peringkat_id','left')
						->join('kerja_syarikat','kerja_syarikat.id = kerja_jawatan.syarikat_id','left')
						->join('negeri','negeri.id = kerja_syarikat.negeri_id','left')
						->where('kerja_jawatan.tarikh_tutup >=',date('Y-m-d'))
						->order_by('kerja_jawatan.updated_at','desc')
						->get()
						->result_array();	
	}

	function count_get_all()
	{
		return $this->db->select('	kerja_jawatan.id')
						->from('kerja_jawatan')
						->join('kerja_terma','kerja_terma.id = kerja_jawatan.terma_id','left')
						->join('kerja_imbuhan','kerja_imbuhan.id = kerja_jawatan.imbuhan_id','left')
						->join('kerja_industri','kerja_industri.id = kerja_jawatan.industri_id','left')
						->join('kerja_pengkhususan','kerja_pengkhususan.id = kerja_jawatan.pengkhususan_id','left')
						->join('kerja_peringkat','kerja_peringkat.id = kerja_jawatan.peringkat_id','left')
						->join('kerja_syarikat','kerja_syarikat.id = kerja_jawatan.syarikat_id','left')
						->join('negeri','negeri.id = kerja_syarikat.negeri_id','left')
						->where('kerja_jawatan.tarikh_tutup >=',date('Y-m-d'))
						->count_all_results();	
	}
	
	function insert($data)
	{
		$this->db->insert('kerja_jawatan', $data); 
	}
	
	function update($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('kerja_jawatan', $data); 
	}
	
	function delete($uid,$id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $uid);
		$this->db->delete('kerja_jawatan'); 
	}
	
	function get($id)
	{
		return $this->db->select('	kerja_jawatan.*,
									
									users.username,
									
									kerja_terma.nama 	as terma,
									kerja_peringkat.nama as peringkat,
									kerja_imbuhan.nama 	as imbuhan,
									kerja_pengkhususan.nama as pengkhususan,
									kerja_industri.nama as industri,
									
									kerja_syarikat.nama as syarikat,
									kerja_syarikat.alamat,
									kerja_syarikat.bandar,
									kerja_syarikat.poskod,
									kerja_syarikat.telefon,
									kerja_syarikat.faks,
									kerja_syarikat.laman_web,
									kerja_syarikat.orang_dihubungi,
									kerja_syarikat.emel,
									kerja_syarikat.no_pendaftaran,
									
									negeri.nama 		as negeri,
									negeri.id 			as negeri_id')
						->from('kerja_jawatan')
						->join('kerja_terma','kerja_terma.id = kerja_jawatan.terma_id','left')
						->join('kerja_imbuhan','kerja_imbuhan.id = kerja_jawatan.imbuhan_id','left')
						->join('kerja_industri','kerja_industri.id = kerja_jawatan.industri_id','left')
						->join('kerja_pengkhususan','kerja_pengkhususan.id = kerja_jawatan.pengkhususan_id','left')
						->join('kerja_peringkat','kerja_peringkat.id = kerja_jawatan.peringkat_id','left')
						->join('kerja_syarikat','kerja_syarikat.id = kerja_jawatan.syarikat_id','left')
						->join('negeri','negeri.id = kerja_syarikat.negeri_id','left')
						->join('users','users.id = kerja_jawatan.user_id','left')
						->where('kerja_jawatan.tarikh_tutup >=',date('Y-m-d'))
						->where('kerja_jawatan.id',$id)
						->get()
						->row_array();	
						
	}
	
	function byuser_count_all($uid)
	{
		return $this->db->select('kerja_jawatan.id')
						->from('kerja_jawatan')
						->join('kerja_terma','kerja_terma.id = kerja_jawatan.terma_id','left')
						->join('kerja_imbuhan','kerja_imbuhan.id = kerja_jawatan.imbuhan_id','left')
						->join('kerja_industri','kerja_industri.id = kerja_jawatan.industri_id','left')
						->join('kerja_pengkhususan','kerja_pengkhususan.id = kerja_jawatan.pengkhususan_id','left')
						->join('kerja_peringkat','kerja_peringkat.id = kerja_jawatan.peringkat_id','left')
						->join('kerja_syarikat','kerja_syarikat.id = kerja_jawatan.syarikat_id','left')
						->join('negeri','negeri.id = kerja_syarikat.negeri_id','left')
						->where('kerja_jawatan.user_id',$uid)
						->count_all_results();		
	}
	
	
	function byuser_get_all($uid,$limit,$start)
	{
		return $this->db->limit($limit, $start)
						->select('	kerja_jawatan.*,
									kerja_terma.nama 	as terma,
									kerja_imbuhan.nama 	as imbuhan,
									kerja_syarikat.nama as syarikat,
									negeri.nama 		as negeri,
									negeri.id 			as negeri_id')
						->from('kerja_jawatan')
						->join('kerja_terma','kerja_terma.id = kerja_jawatan.terma_id','left')
						->join('kerja_imbuhan','kerja_imbuhan.id = kerja_jawatan.imbuhan_id','left')
						->join('kerja_industri','kerja_industri.id = kerja_jawatan.industri_id','left')
						->join('kerja_pengkhususan','kerja_pengkhususan.id = kerja_jawatan.pengkhususan_id','left')
						->join('kerja_peringkat','kerja_peringkat.id = kerja_jawatan.peringkat_id','left')
						->join('kerja_syarikat','kerja_syarikat.id = kerja_jawatan.syarikat_id','left')
						->join('negeri','negeri.id = kerja_syarikat.negeri_id','left')
						->where('kerja_jawatan.user_id',$uid)
						->order_by('kerja_jawatan.updated_at','desc')
						->get()
						->result_array();	
	}

	function byuser_get($uid,$id)
	{
		return $this->db->select('	kerja_jawatan.*,
									
									users.username,
									
									kerja_terma.nama 	as terma,
									kerja_peringkat.nama as peringkat,
									kerja_imbuhan.nama 	as imbuhan,
									kerja_pengkhususan.nama as pengkhususan,
									kerja_industri.nama as industri,
									
									kerja_syarikat.nama as syarikat,
									kerja_syarikat.alamat,
									kerja_syarikat.bandar,
									kerja_syarikat.poskod,
									kerja_syarikat.telefon,
									kerja_syarikat.faks,
									kerja_syarikat.laman_web,
									kerja_syarikat.orang_dihubungi,
									kerja_syarikat.emel,
									kerja_syarikat.no_pendaftaran,
									
									negeri.nama 		as negeri,
									negeri.id 			as negeri_id')
						->from('kerja_jawatan')
						->join('kerja_terma','kerja_terma.id = kerja_jawatan.terma_id','left')
						->join('kerja_imbuhan','kerja_imbuhan.id = kerja_jawatan.imbuhan_id','left')
						->join('kerja_industri','kerja_industri.id = kerja_jawatan.industri_id','left')
						->join('kerja_pengkhususan','kerja_pengkhususan.id = kerja_jawatan.pengkhususan_id','left')
						->join('kerja_peringkat','kerja_peringkat.id = kerja_jawatan.peringkat_id','left')
						->join('kerja_syarikat','kerja_syarikat.id = kerja_jawatan.syarikat_id','left')
						->join('negeri','negeri.id = kerja_syarikat.negeri_id','left')
						->join('users','users.id = kerja_jawatan.user_id','left')
						->where('kerja_jawatan.user_id',$uid)
						->where('kerja_jawatan.id',$id)
						->get()
						->row_array();	
						
	}

	function bynegeri_count_all($nid)
	{
		return $this->db->select('kerja_jawatan.id')
						->from('kerja_jawatan')
						->join('kerja_terma','kerja_terma.id = kerja_jawatan.terma_id','left')
						->join('kerja_imbuhan','kerja_imbuhan.id = kerja_jawatan.imbuhan_id','left')
						->join('kerja_industri','kerja_industri.id = kerja_jawatan.industri_id','left')
						->join('kerja_pengkhususan','kerja_pengkhususan.id = kerja_jawatan.pengkhususan_id','left')
						->join('kerja_peringkat','kerja_peringkat.id = kerja_jawatan.peringkat_id','left')
						->join('kerja_syarikat','kerja_syarikat.id = kerja_jawatan.syarikat_id','left')
						->join('negeri','negeri.id = kerja_syarikat.negeri_id','left')
						->where('kerja_syarikat.negeri_id',$nid)
						->count_all_results();		
	}
	
	
	function bynegeri_get_all($nid,$limit,$start)
	{
		return $this->db->limit($limit, $start)
						->select('	kerja_jawatan.*,
									kerja_terma.nama 	as terma,
									kerja_imbuhan.nama 	as imbuhan,
									kerja_syarikat.nama as syarikat,
									negeri.nama 		as negeri,
									negeri.id 			as negeri_id')
						->from('kerja_jawatan')
						->join('kerja_terma','kerja_terma.id = kerja_jawatan.terma_id','left')
						->join('kerja_imbuhan','kerja_imbuhan.id = kerja_jawatan.imbuhan_id','left')
						->join('kerja_industri','kerja_industri.id = kerja_jawatan.industri_id','left')
						->join('kerja_pengkhususan','kerja_pengkhususan.id = kerja_jawatan.pengkhususan_id','left')
						->join('kerja_peringkat','kerja_peringkat.id = kerja_jawatan.peringkat_id','left')
						->join('kerja_syarikat','kerja_syarikat.id = kerja_jawatan.syarikat_id','left')
						->join('negeri','negeri.id = kerja_syarikat.negeri_id','left')
						->where('kerja_syarikat.negeri_id',$nid)
						->order_by('kerja_jawatan.updated_at','desc')
						->get()
						->result_array();	
	}

	function get_peringkat()
	{
		$this->db->order_by('nama');
		return $this->db->get('kerja_peringkat')->result_array();	
	}
	
	function get_pengkhususan()
	{
		$this->db->order_by('nama');
		return $this->db->get('kerja_pengkhususan')->result_array();	
	}
	
	function get_industri()
	{
		$this->db->order_by('nama');
		return $this->db->get('kerja_industri')->result_array();	
	}
	
	function get_imbuhan()
	{
		$this->db->order_by('susun');
		return $this->db->get('kerja_imbuhan')->result_array();	
	}
	
	function get_terma()
	{
		$this->db->order_by('nama');
		return $this->db->get('kerja_terma')->result_array();	
	}
	
	function syarikat_byuser_get($uid)
	{
		return $this->db->select('	kerja_syarikat.*,									
									negeri.nama 		as negeri,
									negeri.id 			as negeri_id')
						->from('kerja_syarikat')
						->join('negeri','negeri.id = kerja_syarikat.negeri_id','left')
						->join('users','users.id = kerja_syarikat.user_id')
						->where('users.id',$uid)
						->get()
						->row_array();
	}

	function syarikat_insert($data)
	{
		$this->db->insert('kerja_syarikat', $data); 
	}

	function syarikat_update($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('kerja_syarikat', $data); 
	}








}
	