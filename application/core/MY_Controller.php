<?php class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('User','Upload');
		$this->user = $this->User->find_by_id($this->session->userdata('user_id'));
		$this->loggedin = $this->session->userdata('logged_in');
		
		date_default_timezone_set('America/Toronto');
		
		$data->points = $this->user->points;
		$this->load->vars($data);
		
	}
}
