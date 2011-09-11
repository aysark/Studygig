<?php

class Member extends CI_Model {
    
	function add($user_id,$itemNum) {
	
		$new = array(	
			'user_id' => $user_id,
			'item_num' => $itemNum
		);
	
		$this->db->insert('members',$new);
	}

	function get_subscription($id) {
		$this->db->where('user_id',$id);
		$query = $this->db->get('members');

		return $query->row();
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