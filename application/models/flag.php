<?php

class Flag extends CI_Model {
    
	function add() {
	
		
		$new = array(	
			'reason' => $this->input->post('reportReason'),
			'comments' => mysql_real_escape_string(trim($this->input->post('reportAdditionalInfo'))),
			'upload_id'=> $this->input->post('upload_id'),
			'type'=> $this->input->post('type'),
			'user_id'=> $this->session->userdata('user_id')	
		);
	
		$this->db->insert('flags',$new);
	}

	function get_all() {
		return $this->db->get('flags')->result();
	}

}
