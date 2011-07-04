<?php

function points_for_user($id) {

	$this->load->model('User');
	return $this->User->total_points($id);	
}

