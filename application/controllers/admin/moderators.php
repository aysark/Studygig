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
		
		if ($this->session->userdata('is_moderator') == 1){
			return TRUE;
		}else
		 return FALSE;
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
			$newmoderator = array('is_moderator' => 1, 'username' => $this->input->post('user'));
			$this->session->set_userdata($newmoderator);
			$this->User->log_admin_ip($this->session->userdata('username'),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],0);
			redirect('admin/dashboard','refresh');
		}
		else redirect('','refresh');

	}

	function logout() {
		$this->session->unset_userdata('is_moderator');
		$this->User->log_admin_ip($this->session->userdata('username'),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],4);
		redirect('','refresh');
		
	}

	function dashboard() {
		# All stats here 
		$data['all_users'] = $this->User->get_all_users();
		$data['inactive_uploads'] = $this->Upload->get_inactive();
		$data['inactive_classifieds'] = $this->Classified->get_inactive();

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
				
			$this->User->log_admin_ip($this->session->userdata('username'),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],3);
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
	
	function viewclassified($id) {
		$data['classified'] = $this->Classified->get_by_id($id);
		
		$data['content'] = 'admin/viewclassified';
		$this->load->view('admin/template',$data);
	}
	
	function viewuser($id) {
		$data['user'] = $this->User->find_by_id($id);
		$data['content'] = 'admin/viewuser';
		$this->load->view('admin/template',$data);
	}	

	function decide() {
		if($this->input->post('classifieds') == 0)
		{
			if ($this->input->post('approve')) {
				# Approve pending uploads
				$this->User->log_admin_ip($this->session->userdata('username'),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],1);
				$approved = $this->input->post('uploads');
				foreach ($approved as $uploadid) {
					$this->Upload->approve($uploadid);
				}
				redirect(site_url('admin'),'refresh');
			}
			else
			{
				# Reject pending uploads
				$this->User->log_admin_ip($this->session->userdata('username'),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],11);
				$rejected = $this->input->post('uploads');
				foreach ($rejected as $uploadid) {
					$uploaderid = $this->Upload->get_uploader($uploadid)->id;
					$points = 0;
					if (substr($this->Upload->get_by_id($uploadid)->filepath,0,6) == 'http://') {
						switch ($this->Upload->get_material_by_id($uploadid)) {
						    case 0:
						       	$points = 15 ;
						        break;
						    case 1:
						        $points = 5 ;
						        break;
						    case 2:
						        $points = 5 ;
						        break;
						    case 3:
						        $points = 3 ;
						        break;
						    case 4:
						        $points = 3 ;
						        break;
						    case 5:
						        $points = 3 ;
						        break;
						    case 6:
						        $points = 1 ;
						        break;                 
						}
					}
					else
					{
						switch ($this->Upload->get_material_by_id($uploadid)) {
						    case 0:
						       	$points = 20;
						        break;
						    case 1:
						        $points = 15;
						        break;
						    case 2:
						        $points = 10;
						        break;
						    case 3:
						        $points = 5;
						        break;
						    case 4:
						        $points = 5;
						        break;
						    case 5:
						        $points = 5;
						        break;
						    case 6:
						        $points = 1 ;
						        break;                
						}
					}	
					
					#Send email warning user
			$user = $this->Upload->get_uploader($uploadid);
			$upload = $this->Upload->get_by_id($uploadid);
			$this->load->library('email');
			$config['mailtype'] = 'html';
			
			$this->email->initialize($config);
			$this->email->from('reply@studygig.com', 'Studygig');
			$this->email->to($user->email); 
			$this->email->set_alt_message('Your upload by the title of '.$upload->title .' was recently rejected by our moderators.  This is likely because of one or more of the following reasons; Spam, Infringes Rights, Bad Content, Other.  The points given to you for this upload have been revoked.  If you believe this was a mistake please do contact us and we will happily redeem the revoked points to your account.  Thank you!');

			$this->email->subject('Your upload was rejected.');
			$this->email->message('<meta content="text/html; charset=utf-8" http-equiv="Content-Type"><title>Welcome to Studygig</title><table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="padding: 0px 0 35px; background-image:url(\'http://email.studygig.com/welcome/images/bg_tile.png\'); background-repeat:repeat; background-position:center top" bgcolor="#f7f7f7"><tbody><tr><td height="20"></td></tr><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tbody><tr><td width="20"></td><td width="200" style="margin: 0; padding: 10px 0 0" align="center" valign="top"><a href="http://studygig.com"><img src="http://email.studygig.com/welcome/images/studygig-logo.png" alt="Studygig Logo" width="174" height="61" style="float:left" border="0"></a><p style="color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px; float:right"><a href="http://studygig.com/index.php/users/login" style="color: #006eda; text-decoration: none">Login</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/help" style="color: #006eda; text-decoration: none">Help</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/" style="color: #006eda; text-decoration: none">Search</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/contact" style="color: #006eda; text-decoration: none">Contact</a></p></td><td width="20"></td></tr><tr><td width="20"></td><td style="margin: 0; padding: 15px 0 0" align="left" valign="top"><span style="font-size:18px">One of your uploads was rejected.</span><br><br><p style="font-size: 14px; color:#000000; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; text-align:left"> Your upload by the title of '.$upload->title.' was recently rejected by one of our moderators.  This is likely because of one or more of the following reasons; Spam, Infringes Rights, Bad Content, Other.  The points given to you for this upload have been revoked.  If you believe this was a mistake please do contact us and we will happily redeem the revoked points to your account. <br><br><i style="color: #898989">The Studygig Team</i><br><br></p></td><td width="20"></td></tr></tbody></table><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tbody><tr><td width="599" valign="top" align="left" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"></td></tr></tbody></table><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; line-height: 10px" class="footer"><tbody><tr><td align="center" style="padding: 15px 0 10px; font-size: 12px; color:#8a8a8a; margin: 0; line-height: 1.2;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif" valign="top"><p style="font-size: 12px; color:#8a8a8a; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif">Follow the adventures of Studygig:&nbsp;<a href="http://twitter.com/studygig">@studygig</a>,&nbsp;<a href="http://www.facebook.com/studygig">facebook.com/studygig</a>,&nbsp;<a href="http://studygig.posterous.com/">blog.studygig.com</a></p></td></tr><tr></tr></tbody></table></td></tr></tbody></table>');	
					$this->email->send();
					$this->Upload->reject($uploadid,$uploaderid,$points);
				}
				redirect(site_url('admin'),'refresh');
			}
		}
		else
		{

			if ($this->input->post('approve')) {
				$this->User->log_admin_ip($this->session->userdata('username'),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],2);
				$approved = $this->input->post('classifieds');
				foreach ($approved as $classifiedid) {
					$this->Classified->approve($classifiedid);
				}
				redirect(site_url('admin'),'refresh');
			}
			else
			{
				$this->User->log_admin_ip($this->session->userdata('username'),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],22);
				$rejected = $this->input->post('classifieds');
				foreach ($rejected as $classifiedid) {
					$this->Classified->reject($classifiedid);
					
					
							#Send email warning user
			$user = $this->Classified->get_uploader($classifiedid);
			$classified = $this->Classified->get_by_id($classifiedid);
			$this->load->library('email');
			$config['mailtype'] = 'html';
			
			$this->email->initialize($config);
			$this->email->from('reply@studygig.com', 'Studygig');
			$this->email->to($user->email); 
			$this->email->set_alt_message('Your classified post by the title of '.$classified->title .' was recently rejected by one of our moderators.  This is likely because of one or more of the following reasons; Spam, Infringes Rights, Bad Content, Other.  If you believe this was a mistake please do contact us and we will happily approve it.  Thank you!');

			$this->email->subject('Your upload was rejected.');
			$this->email->message('<meta content="text/html; charset=utf-8" http-equiv="Content-Type"><title>Welcome to Studygig</title><table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="padding: 0px 0 35px; background-image:url(\'http://email.studygig.com/welcome/images/bg_tile.png\'); background-repeat:repeat; background-position:center top" bgcolor="#f7f7f7"><tbody><tr><td height="20"></td></tr><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tbody><tr><td width="20"></td><td width="200" style="margin: 0; padding: 10px 0 0" align="center" valign="top"><a href="http://studygig.com"><img src="http://email.studygig.com/welcome/images/studygig-logo.png" alt="Studygig Logo" width="174" height="61" style="float:left" border="0"></a><p style="color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px; float:right"><a href="http://studygig.com/index.php/users/login" style="color: #006eda; text-decoration: none">Login</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/help" style="color: #006eda; text-decoration: none">Help</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/" style="color: #006eda; text-decoration: none">Search</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/contact" style="color: #006eda; text-decoration: none">Contact</a></p></td><td width="20"></td></tr><tr><td width="20"></td><td style="margin: 0; padding: 15px 0 0" align="left" valign="top"><span style="font-size:18px">One of your uploads was rejected.</span><br><br><p style="font-size: 14px; color:#000000; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; text-align:left"> Your upload by the title of '.$classified->title.' was recently rejected by one of our moderators.  This is likely because of one or more of the following reasons; Spam, Infringes Rights, Bad Content, Other.  If you believe this was a mistake please do contact us and we will happily approve it. <br><br><i style="color: #898989">The Studygig Team</i><br><br></p></td><td width="20"></td></tr></tbody></table><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tbody><tr><td width="599" valign="top" align="left" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"></td></tr></tbody></table><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; line-height: 10px" class="footer"><tbody><tr><td align="center" style="padding: 15px 0 10px; font-size: 12px; color:#8a8a8a; margin: 0; line-height: 1.2;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif" valign="top"><p style="font-size: 12px; color:#8a8a8a; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif">Follow the adventures of Studygig:&nbsp;<a href="http://twitter.com/studygig">@studygig</a>,&nbsp;<a href="http://www.facebook.com/studygig">facebook.com/studygig</a>,&nbsp;<a href="http://studygig.posterous.com/">blog.studygig.com</a></p></td></tr><tr></tr></tbody></table></td></tr></tbody></table>');	
					$this->email->send();
					
				}
				redirect(site_url('admin'),'refresh');

			}			
		}	
	}

}