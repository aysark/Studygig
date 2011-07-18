<?php

class Flag extends CI_Model {
    
	function add($reason,$info,$upload_id,$type) {
	
		
		$new = array(	
			'reason' => $reason,
			'comments' => mysql_real_escape_string(trim($info)),
			'upload_id'=> $upload_id,
			'type'=> $type,
			'user_id'=> $this->session->userdata('user_id')	
		);
	
		$this->db->insert('flags',$new);
	}

	function get_all() {
		return $this->db->get('flags')->result();
	}

}
