<?php

class Member extends CI_Model {

	function add($user_id,$itemNum) {

		$new = array(
			'user_id' => $user_id,
			'item_num' => $itemNum
		);

		switch($itemNum) {
			case 1: $interval = 12;
					break;
			case 2: $interval = 4;
					break;
			case 3: $interval = 3;
					break;
			case 4: $interval = 1;
					break;
		}

		$remove_subscription_query = "CREATE EVENT remove$user_id
									  ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL $interval MONTH
									  DO
									  	DELETE FROM members WHERE user_id = '$user_id'";

		$this->db->insert('members',$new);
		$this->db->query($remove_subscription_query);
	}

	function get_subscription($id) {
		$this->db->where('user_id',$id);
		$query = $this->db->get('members');

		return $query->row();
	}

	function is_member($id) {

		$this->db->where('user_id',$id);
		$query = $this->db->get('members');

		if ($query->num_rows() != 0)
			return TRUE;
		else
			return FALSE;
	}
}