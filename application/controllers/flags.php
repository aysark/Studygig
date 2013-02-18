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
				$this->Flag->add($this->input->post('reportReason'),$this->input->post('reportAdditionalInfo'),$this->input->post('upload_id'),$this->session->userdata('user_id'));
				echo "Thanks - we'll get right on it!";
		}
			else
		{
			echo '<a href="'.base_url().'index.php/users/signup">Register</a> or <a href="'.base_url().'index.php/users/login">Login</a> to report content.';
		}
	}
	
}
