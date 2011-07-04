<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Member');
		$this->load->model('User');
		$this->user = $this->User->find_by_id($this->session->userdata('user_id'));
		$this->loggedin = $this->session->userdata('logged_in');
		
		if ($this->session->userdata('logged_in')) {
			
			$data->points = $this->User->total_points($this->session->userdata('user_id'));
			$this->load->vars($data);
		}
	}
	
	function index() {	
	if ($this->loggedin) {
		  $this->Member->log($this->session->userdata('user_id'));
	      $data['content'] = 'users/underconstruction';	  
	  	  
	      $data['pageTitle'] = 'Become a member on Studygig and enjoy unlimited access to study material';
		  $data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
	      $this->load->view('subTemplate', $data);
    }
    else
    	  redirect('users/login');
	}
	
}
