<?php class Moderators extends CI_Controller {

	function __construct(){
	
		parent::__construct();		
		$this->load->model('User');
		$this->load->model('Upload');
	}

	function index() {
		
		if ($this->session->userdata('logged_in')) {

			if ($this->User->is_moderator($this->session->userdata('user_id')))
				redirect('admin/dashboard','refresh');
			else 
				echo "You are not a moderator!";
					
		}
			else
			 
		redirect('users/login','refresh');
	}	
	
	function dashboard() {

		$data['all_users'] = $this->User->get_all_users();
		$data['inactive_uploads'] = $this->Upload->get_inactive();
		
		$data['stats'] = array(
			'total_users' => count($data['all_users']),
			'queries' => $this->db->get('queries')->result()
			);

		$this->load->view('admin/dashboard',$data);
	}

	function approve() {
		$approved = $_POST['uploads'];
		foreach ($approved as $uploadid) {
			$this->Upload->approve($uploadid);
		}
		$this->dashboard();
	}

}