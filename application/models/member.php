<?php

class Member extends CI_Model {
    
	function log($user_id) {
	
		$new = array(	
			'user_id' => $user_id
		);
	
		$this->db->insert('members',$new);
	}

}
