<?php

class Rating extends CI_Model {

	function add() {
	
		if ($this->input->post('rating_type') == 1) {
			$type = 1;
		}else{
			$type = 0;	
		}
		
		$newrating = array(	
			'upload_id' => $this->input->post('upload_id'),
			'type' => $type,
			'user_id'=> $this->session->userdata('user_id')	
		);
	
		$this->db->insert('ratings',$newrating);
		
		$this->db->where('id',$this->session->userdata('user_id'));
		$this->db->set('points', 'points+1', FALSE);
		$this->db->update('users'); 
		
	
			
	}
	
	function validate_unique($uploadid) {
		$isunique = TRUE;
		
		$this->db->where('upload_id',$uploadid);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$query = $this->db->get('ratings');
		
		if ($query->num_rows() >= 1) $isunique = FALSE;
		
		return $isunique;
	}

}
