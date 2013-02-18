<?php

class Transaction extends CI_Model {

	function add($userid,$uploadid,$uploader,$already_has,$subscriber) {
	
		$this->db->trans_start();
		
		$newtrans = array('user_id' => $userid, 'upload_id' => $uploadid);
		$this->db->insert('transactions', $newtrans);
		
		
		if(!$already_has){
			if (!$subscriber)
			{
				$this->db->where('id',$userid);
				$this->db->set('points','points-50',FALSE);
				$this->db->update('users');
			}	
		}
		if ($userid != $uploader){
			$this->db->where('id',$uploader);
			$this->db->set('points','points+1',FALSE);
			$this->db->update('users');
		}	
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		
				# Error in download process.
				return FALSE;
		else
				# Transaction successful!
				return TRUE;
			
	}
}
