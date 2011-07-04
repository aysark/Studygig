<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flags extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Flag');
	}
	
	function add() {
		if ($this->session->userdata('logged_in')) 
		{	
				$this->Flag->add();
				echo "Thanks - we'll get right on it!";
		}
			else
		{
			echo '<a href="'.base_url().'index.php/users/signup">Register</a> or <a href="'.base_url().'index.php/users/login">Login</a> to report content.';
		}
	}
	
}
