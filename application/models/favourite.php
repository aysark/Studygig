<?php

class Favourite extends CI_Model {

	function get($userid) {	
		$this->db->select('*');
		$this->db->from('favourites');
		$this->db->join('uploads', 'uploads.id = favourites.upload_id','right');
		
		$this->db->where('favourites.user_id',$userid);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function add($userid,$uploadid) {
	
		$newfavourite = array(
			'user_id' => $userid,
			'upload_id' => $uploadid
		);
		
		$this->db->insert('favourites',$newfavourite);
		
		//update upload database
		$this->db->where('id',$uploadid);
  		$this->db->set('favourites', 'favourites+1', FALSE);
		$this->db->update('uploads'); 
	}
	
	function remove($userid,$uploadid) {
	
		$this->db->where('upload_id',$uploadid);
		$this->db->where('user_id',$userid);
		
		$this->db->delete('favourites');
		
		//update upload database
		$this->db->where('id',$uploadid);
  		$this->db->set('favourites', 'favourites-1', FALSE);
		$this->db->update('uploads'); 
	}
	
	function is_favourited_by ($userid,$uploadid) {
	
		$this->db->where('user_id',$userid);
		$this->db->where('upload_id',$uploadid);
		
		$query = $this->db->get('favourites');
		
		if ($query->num_rows() == 1)
			return TRUE;
		else
			return FALSE;
		
	}

}
