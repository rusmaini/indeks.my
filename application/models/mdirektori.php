<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdirektori extends MY_Model
{
	protected $_table = 'direktori';
	
	
	function get_all($limit,$start)
	{
		return $this->db->limit($limit, $start)
						->select('	direktori.*,
									direktori_kategori.nama as kategori,
									negeri.nama as negeri,
									direktori_jenistempoh.nama as jenistempoh,
									direktori_jenisurusniaga.nama as jenisurusniaga')
						->from('direktori')
						->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left')
						->join('negeri','negeri.id = direktori.negeri_id','left')
						->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left')
						->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left')
						->where('direktori.status','1')
						->order_by('direktori.created_at','desc')
						->get()
						->result_array();	
	}
	
	function get($id)
	{
		
		return $this->db->select('	direktori.*,
									direktori_kategori.nama as kategori,
									negeri.nama as negeri,
									direktori_jenistempoh.nama as jenistempoh,
									direktori_jenisurusniaga.nama as jenisurusniaga,
									users.username as nama,
									users.email')
						->from('direktori')
						->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left')
						->join('negeri','negeri.id = direktori.negeri_id','left')
						->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left')
						->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left')
						->join('users','users.id = direktori.user_id','left')
						->where('direktori.id',$id)
						->where('direktori.status','1')
						->order_by('direktori.created_at','desc')
						->get()
						->row_array();	
						
	}
	
	//by direktori_id
	function get_gambar_all($id)
	{
		$query = $this->db->order_by('susun','asc')->get_where('direktori_gambar',array('direktori_id'=>$id));
		return $query->result_array();
	}

	function get_gambar($id)
	{
		$query = $this->db->get_where('direktori_gambar',array('id'=>$id));
		return $query->row_array();
	}
	
	function insert($data)
	{
		$this->db->insert($this->_table, $data); 
	}
	
	function update($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_table, $data); 
	}
	
	function my_update($data,$id)
	{
		$this->db->where(array('id'=>$id,'user_id'=>$this->session->userdata('user_id')));
		$this->db->update($this->_table, $data); 
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->_table); 
	}
	
	function insert_gambar($data)
	{
		$this->db->insert('direktori_gambar', $data); 
	}

	function delete_gambar($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('direktori_gambar'); 
	}

	//by direktori_id
	function delete_gambar_all($id)
	{
		$this->db->where('direktori_id', $id);
		$this->db->delete('direktori_gambar'); 
	}
	
	/**************************************************************************************************************************
	 * DIREKTORI : BY KATEGORI -- KATEGORI DITETAPKAN DALAM CONTROLLER
	 **************************************************************************************************************************/
	function get_by_kategori($kid,$limit,$start)
	{
		$this->db->limit($limit, $start);
		$this->db->select('	direktori.*,
					direktori_kategori.nama as kategori,
					negeri.nama as negeri,
					direktori_jenistempoh.nama as jenistempoh,
					direktori_jenisurusniaga.nama as jenisurusniaga');
		$this->db->from('direktori');
		$this->db->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left');
		$this->db->join('negeri','negeri.id = direktori.negeri_id','left');
		$this->db->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left');
		$this->db->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left');
		if($kid!=0):
		$this->db->where('direktori_kategori.id',$kid);
		endif;
		$this->db->where('direktori.status','1');
		$this->db->order_by('direktori.created_at','desc');
		$query = $this->db->get();
		return	$query->result_array();	
	}
	
	function count_by_kategori($kid)
	{
		$this->db->select('direktori.id');
		$this->db->from('direktori');
		$this->db->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left');
		$this->db->join('negeri','negeri.id = direktori.negeri_id','left');
		$this->db->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left');
		$this->db->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left');
		if($kid!=0):
		$this->db->where('direktori_kategori.id',$kid);
		endif;	
		$query = $this->db->where('direktori.status','1');
		return	$query->count_all_results();	
	}
	
	function get_by_kategori_negeri($kid,$nid,$limit,$start)
	{
		$this->db->limit($limit, $start);
		$this->db->select('	direktori.*,
					direktori_kategori.nama as kategori,
					negeri.nama as negeri,
					direktori_jenistempoh.nama as jenistempoh,
					direktori_jenisurusniaga.nama as jenisurusniaga');
		$this->db->from('direktori');
		$this->db->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left');
		$this->db->join('negeri','negeri.id = direktori.negeri_id','left');
		$this->db->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left');
		$this->db->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left');
		if($kid!=0):
		$this->db->where('direktori_kategori.id',$kid);
		endif;
		$this->db->where('negeri.id',$nid);
		$this->db->where('direktori.status','1');
		$this->db->order_by('direktori.created_at','desc');
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	function count_by_kategori_negeri($kid,$nid)
	{
		$this->db->select('	direktori.*,
					direktori_kategori.nama as kategori,
					negeri.nama as negeri,
					direktori_jenistempoh.nama as jenistempoh,
					direktori_jenisurusniaga.nama as jenisurusniaga');
		$this->db->from('direktori');
		$this->db->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left');
		$this->db->join('negeri','negeri.id = direktori.negeri_id','left');
		$this->db->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left');
		$this->db->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left');
		if($kid!=0):
		$this->db->where('direktori_kategori.id',$kid);
		endif;	
		$this->db->where('negeri.id',$nid);
		$query = $this->db->where('direktori.status','1');
		return $query->count_all_results();		
	}
	
	function get_by_kategori_cari($kid,$cari,$nid)
	{
		$key		= str_replace(" "," ",$cari);
		$search 	= explode(" ",$key);
		$csearch 	= count($search);
		
		$sql = "
					select 	direktori.*,
							direktori_kategori.nama as kategori,
							negeri.nama as negeri,
							direktori_jenistempoh.nama as jenistempoh,
							direktori_jenisurusniaga.nama as jenisurusniaga
					from	direktori, direktori_kategori, negeri, direktori_jenistempoh, direktori_jenisurusniaga
					where 	direktori_kategori.id = direktori.kategori_id 
					and		negeri.id = direktori.negeri_id 
					and		direktori_jenistempoh.id = direktori.jenistempoh_id 
					and		direktori_jenisurusniaga.id = direktori.jenisurusniaga_id 
					and 	direktori.status = '1'
		";
		if($kid!=0):
		$sql .= "	and 	(direktori_kategori.id = $kid) ";
		endif;
		if($nid!=0):
		$sql .= "	and		(direktori.negeri_id = $nid) ";
		endif;	
		for($i = 0; $i < $csearch; $i++):
			$sql .= " 	and concat_ws(' ',direktori.perkara,direktori_kategori.nama,direktori.alamat,direktori.kawasan,negeri.nama) like '%".$search[$i]."%'";
		endfor;
		$sql .= "	
					order by direktori.created_at desc ";
		
		$query = $this->db->query($sql);
		return $query->result_array();
		/*
		$this->db->select('	direktori.*,
							direktori_kategori.nama as kategori,
							negeri.nama as negeri,
							direktori_jenistempoh.nama as jenistempoh,
							direktori_jenisurusniaga.nama as jenisurusniaga');
		$this->db->from('direktori');
		$this->db->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left');
		$this->db->join('negeri','negeri.id = direktori.negeri_id','left');
		$this->db->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left');
		$this->db->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left');
		if($kid!=0):
		$this->db->where('direktori_kategori.id',$kid);
		endif;	
		if($nid!=0):
		$this->db->where('direktori.negeri_id',$nid);
		endif;	
		$this->db->where('direktori.status','1');
		for($i = 0; $i < $csearch; $i++):	
		$this->db->or_like("direktori.perkara",$search[$i]);
		$this->db->or_like("direktori_kategori.nama",$search[$i]);
		$this->db->or_like("direktori.alamat",$search[$i]);
		$this->db->or_like("direktori.kawasan",$search[$i]);
		$this->db->or_like("negeri.nama",$search[$i]);
		endfor;
		$this->db->order_by('direktori.created_at','desc');
		$query = $this->db->get();
		return $query->result_array();
		 * */
	}
	
	
	function get_kategori()
	{
		$this->db->order_by('nama');
		$this->db->where('status','1');
		return $this->db->get('direktori_kategori')->result_array();	
	}
	
	function get_jenisurusniaga()
	{
		$this->db->order_by('nama');
		return $this->db->get('direktori_jenisurusniaga')->result_array();	
	}
	
	function get_jenistempoh()
	{
		$this->db->order_by('nama');
		return $this->db->get('direktori_jenistempoh')->result_array();	
	}
	
	/**************************************************************************************************************************
	 * BILIK
	 *************************************************************************************************************************/
	function get_bilik($id)
	{
		return $this->db->select('	direktori_bilik.*,
									direktori_kelengkapan.nama as kelengkapan,
									direktori_jeniskediaman.nama as jeniskediaman
								')
						->from('direktori_bilik')
						->join('direktori_kelengkapan','direktori_kelengkapan.id = direktori_bilik.kelengkapan_id','left')
						->join('direktori_jeniskediaman','direktori_jeniskediaman.id = direktori_bilik.jeniskediaman_id','left')
						->where('direktori_bilik.direktori_id',$id)
						->get()
						->row_array();
	}
	
	
	
	
	/**************************************************************************************************************************
	 * ADMIN / URUS DIREKTORI : BY KATEGORI -- KATEGORI DITETAPKAN DALAM CONTROLLER
	 **************************************************************************************************************************/
	function admin_get_by_kategori($kid,$limit,$start)
	{
		$this->db->limit($limit, $start);
		$this->db->select('	direktori.*,
					direktori_kategori.nama as kategori,
					negeri.nama as negeri,
					direktori_jenistempoh.nama as jenistempoh,
					direktori_jenisurusniaga.nama as jenisurusniaga');
		$this->db->from('direktori');
		$this->db->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left');
		$this->db->join('negeri','negeri.id = direktori.negeri_id','left');
		$this->db->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left');
		$this->db->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left');
		if($kid!=0):
		$this->db->where('direktori_kategori.id',$kid);
		endif;	
		$this->db->order_by('direktori.created_at','desc');
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	function admin_count_by_kategori($kid)
	{
		$this->db->select('direktori.id');
		$this->db->from('direktori');
		$this->db->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left');
		$this->db->join('negeri','negeri.id = direktori.negeri_id','left');
		$this->db->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left');
		$this->db->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left');
		if($kid!=0):
		$this->db->where('direktori_kategori.id',$kid);
		endif;	
		$query = $this->db->order_by('direktori.created_at','desc');
		return $query->count_all_results();	
	}

	function admin_get_by_kategori_cari($kid,$cari)
	{
		
		$key		= str_replace(" "," ",$cari);
		$search 	= explode(" ",$key);
		$csearch 	= count($search);
			
		$this->db->select('	direktori.*,
							direktori_kategori.nama as kategori,
							negeri.nama as negeri,
							direktori_jenistempoh.nama as jenistempoh,
							direktori_jenisurusniaga.nama as jenisurusniaga');
		$this->db->from('direktori');
		$this->db->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left');
		$this->db->join('negeri','negeri.id = direktori.negeri_id','left');
		$this->db->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left');
		$this->db->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left');
		if($kid!=0):
		$this->db->where('direktori_kategori.id',$kid);
		endif;
		//$this->db->where('direktori.status','1');
		for($i = 0; $i < $csearch; $i++):	
		$this->db->or_like("direktori.perkara",$search[$i]);
		$this->db->or_like("direktori_kategori.nama",$search[$i]);
		$this->db->or_like("negeri.nama",$search[$i]);
		endfor;
		$this->db->order_by('direktori.created_at','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	function admin_get($id)
	{
		return $this->db->select('	direktori.*,
									direktori_kategori.nama as kategori,
									negeri.nama as negeri,
									direktori_jenistempoh.nama as jenistempoh,
									direktori_jenisurusniaga.nama as jenisurusniaga,
									users.username as nama,
									users.email')
						->from('direktori')
						->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left')
						->join('negeri','negeri.id = direktori.negeri_id','left')
						->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left')
						->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left')
						->join('users','users.id = direktori.user_id','left')
						->where('direktori.id',$id)
						->order_by('direktori.created_at','desc')
						->get()
						->row_array();	
	}
	
	/**************************************************************************************************************************
	 * PENGGUNA PUNYA / MY DIREKTORI : BY KATEGORI -- KATEGORI DITETAPKAN DALAM CONTROLLER
	 **************************************************************************************************************************/
	function my_get_by_kategori($kid,$limit,$start)
	{
		$this->db->limit($limit, $start);	
		$this->db->select('	direktori.*,
							direktori_kategori.nama as kategori,
							negeri.nama as negeri,
							direktori_jenistempoh.nama as jenistempoh,
							direktori_jenisurusniaga.nama as jenisurusniaga');
		$this->db->from('direktori');
		$this->db->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left');
		$this->db->join('negeri','negeri.id = direktori.negeri_id','left');
		$this->db->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left');
		$this->db->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left');
		if($kid!=0):
		$this->db->where('direktori_kategori.id',$kid);
		endif;	
		$this->db->where('direktori.user_id',$this->session->userdata('user_id'));
		$this->db->order_by('direktori.created_at','desc');
		$query = $this->db->get();
		return $query->result_array();	
		
	}
	
	function my_count_by_kategori($kid)
	{
		$this->db->select('direktori.id');
		$this->db->from('direktori');
		$this->db->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left');
		$this->db->join('negeri','negeri.id = direktori.negeri_id','left');
		$this->db->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left');
		$this->db->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left');
		if($kid!=0):
		$this->db->where('direktori_kategori.id',$kid);
		endif;
		$query = $this->db->where('direktori.user_id',$this->session->userdata('user_id'));
		return $query->count_all_results();	
	}

	function my_get_by_kategori_cari($kid,$cari)
	{
		
		$key		= str_replace(" "," ",$cari);
		$search 	= explode(" ",$key);
		$csearch 	= count($search);
			
		$this->db->select('	direktori.*,
							direktori_kategori.nama as kategori,
							negeri.nama as negeri,
							direktori_jenistempoh.nama as jenistempoh,
							direktori_jenisurusniaga.nama as jenisurusniaga');
		$this->db->from('direktori');
		$this->db->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left');
		$this->db->join('negeri','negeri.id = direktori.negeri_id','left');
		$this->db->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left');
		$this->db->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left');
		if($kid!=0):
		$this->db->where('direktori_kategori.id',$kid);
		endif;
		$this->db->where('direktori.user_id',$this->session->userdata('user_id'));
		//$this->db->where('direktori.status','1');
		for($i = 0; $i < $csearch; $i++):	
		$this->db->or_like("direktori.perkara",$search[$i]);
		$this->db->or_like("direktori_kategori.nama",$search[$i]);
		$this->db->or_like("negeri.nama",$search[$i]);
		endfor;
		$this->db->order_by('direktori.created_at','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	function my_get($id)
	{
		return $this->db->select('	direktori.*,
									direktori_kategori.nama as kategori,
									negeri.nama as negeri,
									direktori_jenistempoh.nama as jenistempoh,
									direktori_jenisurusniaga.nama as jenisurusniaga,
									users.username as nama,
									users.email')
						->from('direktori')
						->join('direktori_kategori','direktori_kategori.id = direktori.kategori_id','left')
						->join('negeri','negeri.id = direktori.negeri_id','left')
						->join('direktori_jenistempoh','direktori_jenistempoh.id = direktori.jenistempoh_id','left')
						->join('direktori_jenisurusniaga','direktori_jenisurusniaga.id = direktori.jenisurusniaga_id','left')
						->join('users','users.id = direktori.user_id','left')
						->where('direktori.id',$id)
						->where('direktori.user_id',$this->session->userdata('user_id'))
						->order_by('direktori.created_at','desc')
						->get()
						->row_array();	
	}
}
	