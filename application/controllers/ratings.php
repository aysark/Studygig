<?php

class Ratings extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Rating');
	}
	
	function add() {
		if ($this->session->userdata('logged_in')) 
		{	
			if ($this->Rating->validate_unique($this->input->post('upload_id'))) 
				{
					$this->Rating->add();
					echo "+1 point!";
				}			
					else
				{
					echo "You've already rated this!";
				}
		}
			else
		{
			echo '<a href="'.base_url().'index.php/users/signup">Register</a> or <a href="'.base_url().'index.php/users/login">Login</a> to rate.';
		}
	}
}
