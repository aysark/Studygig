<?php

class Ratings extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Rating');
	}
	
	function add() {

		$this->load->model('User');

		$userid = $this->session->userdata('user_id');
		$uploadid = $this->input->post('upload_id');

		if ($this->session->userdata('logged_in') && $this->User->already_has($userid,$uploadid)) 
		{	
			if ($this->Rating->validate_unique($uploadid)) 
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
			if (!$this->session->userdata('logged_in'))
			echo '<a href="'.base_url().'index.php/users/signup">Register</a> or <a href="'.base_url().'index.php/users/login">Login</a> to rate.';
				else
			echo 'Download it first!';
		}
	}
}
