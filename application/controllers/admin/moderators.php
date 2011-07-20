<?php class Moderators extends CI_Controller {

	function __construct(){
	
		parent::__construct();		
		$this->load->model('User');
		$this->load->model('Upload');
		$this->load->model('Classified');

		//Check if user is moderator
		$uri = $this->uri->uri_string();
		if ((($uri != 'admin') and ($uri !='admin/newsession')) and $this->_verify_mod() == FALSE) redirect('','refresh');
	}

	function _verify_mod() {
		
		if ($this->session->userdata('is_moderator') == 1)	return TRUE;
			else return FALSE;
	}

	function index() {
		

		if ($this->_verify_mod()) {
			redirect('admin/dashboard','refresh');
		}
			else
		{
			$data['content'] = 'admin/login';
			$this->load->view('admin/template',$data);
		}
	}

	function newsession() {
		
		if ($this->User->authenticate_mod($this->input->post('user'),$this->input->post('pass')))
		{
			$newmoderator = array('is_moderator' => 1);
			$this->session->set_userdata($newmoderator);
			redirect('admin/dashboard','refresh');
		}
		else redirect('','refresh');

	}

	function logout() {
		$this->session->unset_userdata('is_moderator');
		redirect('','refresh');
	}

	function dashboard() {
		# All stats here 

		$data['all_users'] = $this->User->get_all_users();
		$data['inactive_uploads'] = $this->Upload->get_inactive();

		$this->load->model('Flag');
		$data['flags'] = $this->Flag->get_all();
		
		$data['stats'] = array(
			'total_users' => count($data['all_users']),
			'total_uploads' => $this->Upload->get_total_uploads(),
			'total_classifieds' => $this->Classified->get_total_classifieds(),
			'queries' => $this->db->get('queries')->result()
			);
		$data['content'] = 'admin/dashboard';
		$this->load->view('admin/template',$data);
	}
	
	function insert() {
		$this->load->model('Subject');
		$data['subjects'] = $this->Subject->get_titles();
		$data['content'] = 'admin/upload';
		$this->load->view('admin/template',$data);
	}
	
	function upload(){
		$this->load->model('Subject');
		$this->load->model('User');
		
		if($this->form_validation->run('adminUpload')){
			$data['content'] = 'admin/uploaded';
				
			//$this->User->log_user_ip(1,$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],3);
			//$data['upload_id']= $this->Upload->add($fileNames,$fileExtensions,$fileSizes,$numOfFiles,true);
							
			$this->load->view('admin/template', $data);
		}else{
			//validation error
			$data['subjects'] = $this->Subject->get_titles();
			$data['content'] = 'admin/upload';
			$this->load->view('admin/template', $data);
		}
	}

	function view($id) {
		$data['upload'] = $this->Upload->get_by_id($id);
		
		$data['content'] = 'admin/view';
		$this->load->view('admin/template',$data);
	}	

	function approve() {
		# Approve pending uploads

		$approved = $_POST['uploads'];
		foreach ($approved as $uploadid) {
			$this->Upload->approve($uploadid);
		}
		redirect(site_url('admin'),'refresh');
	}

}