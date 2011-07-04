<?php

class Course extends CI_Model {

	function get_courses_by_subject_id($id) {
	
	$this->db->where('subject_id', $id);
	$query = $this->db->get('courses');
	
	return $query->result_array();
	}
	

}
