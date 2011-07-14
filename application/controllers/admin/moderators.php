<?php class Moderators extends CI_Controller {

	function __construct(){
	
		parent::__construct();		
		$this->load->model('User');
		$this->load->model('Upload');

		//Check if user is moderator
		if (!$this->_verify_mod()) redirect(site_url(''),'refresh');

	}

	function _verify_mod() {
		
		if ($this->User->is_moderator($this->session->userdata('user_id')))	return TRUE;			
		return FALSE;
	}

	function index() {
		# All stats here 

		$data['all_users'] = $this->User->get_all_users();
		$data['inactive_uploads'] = $this->Upload->get_inactive();

		$this->load->model('Flag');
		$data['flags'] = $this->Flag->get_all();
		
		$data['stats'] = array(
			'total_users' => count($data['all_users']),
			'queries' => $this->db->get('queries')->result()
			);

		$this->load->view('admin/dashboard',$data);
	}	

	function approve() {
		# Approve pending uploads

		$approved = $_POST['uploads'];
		foreach ($approved as $uploadid) {
			$this->Upload->approve($uploadid);
		}
		redirect(site_url('admin'),'refresh');
	}

	function add() {
		# Add a new moderator (only if user is also admin)
		$users = $_POST['users'];
		foreach ($users as $userid) {
			$this->User->get_made($userid);
		}
		redirect(site_url('admin'),'refresh');
	}

}