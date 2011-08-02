<?php

class Member extends CI_Model {
    
	function add($user_id) {
	
		$new = array(	
			'user_id' => $user_id
		);
	
		$this->db->insert('members',$new);
	}

	function is_member($id) {
		
		$this->db->where('user_id',$id);
		$query = $this->db->get('members');

		if ($query->num_rows() == 1)
			return TRUE;
		else
			return FALSE;
	}
}