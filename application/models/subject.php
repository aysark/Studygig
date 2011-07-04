<?php

class Subject extends CI_Model {

  function __construct()
    {
        parent::__construct();
    }
    
  function get_titles() {
  
		$query = $this->db->get('subjects');
		return $query->result();
  }

}
