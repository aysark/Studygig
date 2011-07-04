<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subjects extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('User');
		$data->points = $this->User->total_points($this->session->userdata('user_id'));
		$this->load->vars($data);
	}
	
	function all() {	
		$data['subjects'] = $this->Subject->get_all();
		$data['content'] = 'subjects/all';
		$this->load->view('subTemplate',$data);	
	}
	
	function view($id) {
		$data['subject'] = $this->Subject->get($id);
		$data['content'] = 'subjects/view';
		$this->load->view('subTemplate',$data);
	}
	
	function get_courses() {
	

	}	
	
}
