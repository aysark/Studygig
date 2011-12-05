<?php class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('User');
		$this->user = $this->User->find_by_id($this->session->userdata('user_id'));
		$this->loggedin = $this->session->userdata('logged_in');
		
		date_default_timezone_set('America/Toronto');
		
		if ($this->session->userdata('logged_in')) {
			
			$data->points = $this->User->total_points($this->session->userdata('user_id'));
			$this->load->vars($data);
		}
	
	}

	function signup() {	
		if($this->session->userdata('logged_in')) redirect('users/dashboard','refresh');
		$data['content'] = 'users/signup';
		
		$data['pageTitle'] = 'Create an Account on Studygig';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
		$this->load->view('subTemplate2', $data);	
	}
	
	function verify($hash) {
	# Verify email address
	$data = $this->User->verify($hash);
		if ($data[0])
			{
				$user = $data[1];
				//log user in
				$this->User->log_user_ip($user->id,$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],1);
					
				$newlogin = array(
		                   'email'  => $user->email,
		                   'user_id' => $user->id,              
		                   'logged_in' => TRUE,
		                   'username' => $user->username,
		                   'points' => $user->points
		               );
		
				$this->session->set_userdata($newlogin);					
				$data['content'] = 'users/dashboard';
				
				$data['pageTitle'] = 'Past tests, lecture notes and study guides - Find study material on Studygig';
				$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
				$this->load->view('subTemplate2',$data);
				
				
				// send welcome email
				$email = $this->User->get_email_by_hash($hash);
				require_once 'Mailgun.php';
				
				mailgun_init('key-147iqkqjpa8njqj7s9');
				
				$body = '<meta content="text/html; charset=utf-8" http-equiv=Content-Type><title>Welcome to Studygig</title><body><p style="font-size: 12px; color:#8a8a8a; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; text-align:center">Is this email not displaying correctly?&nbsp;<a href="http://email.studygig.com/welcome/">View it on web</a></p><table cellpadding=0 cellspacing=0 border=0 align=center width="100%" style="padding: 0px 0 35px; background-image:url(\'http://email.studygig.com/welcome/images/bg_tile.png\'); background-repeat:repeat; background-position:center top" bgcolor="#f7f7f7"><tr><td height=20></td><tr><td height=10></td><td align=center><table cellpadding=0 cellspacing=0 border=0 align=center width=599 style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tr><td width=200 style="margin: 0; padding: 10px 0 0" align=center valign=top><a href="http://studygig.com"><img src="http://email.studygig.com/welcome/images/studygig-logo.png" alt="Studygig Logo" width=174 height=61 style=float:left border=0></a><p style="color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px; float:right"><a href="http://studygig.com/index.php/users/login" style="color: #006eda; text-decoration: none">Login</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/help" style="color: #006eda; text-decoration: none">Help</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/" style="color: #006eda; text-decoration: none">Search</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/contact" style="color: #006eda; text-decoration: none">Contact</a></p></td><tr><td style="margin: 0; padding: 15px 0 0" align=center valign=top><a href="http://studygig.com"><img src="http://email.studygig.com/welcome/images/welcome-banner.png" alt="Welcome to Studygig!" width=581 height=295 border=0></a></td><tr><td style="font-size: 1px; height: 15px; line-height: 1px" height=15>&nbsp;</td></table><table cellpadding=0 cellspacing=0 border=0 align=center width=599 style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tr><td width=599 valign=top align=left style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><table cellpadding=0 cellspacing=0 border=0 style="color: #717171; font: normal 11px Tahoma,Arial,Helvetica,Garuda,sans-serif; margin: 0; padding: 0" width=599><tr><tr><td style="padding: 0" align=center valign=top><a href="http://studygig.com"><img src="http://email.studygig.com/welcome/images/search.gif" alt="Find Study Material" width=599 height=79 border=0></a></td><tr><td style="padding: 10px 0 0" align=center valign=top><a href="http://studygig.com/index.php/uploads/insert"><img src="http://email.studygig.com/welcome/images/post.gif" alt="Post Study Material" width=599 height=79 border=0></a></td><tr><td style="padding: 10px 0 0" align=center valign=top><a href="http://studygig.com/index.php/site/help"><img src="http://email.studygig.com/welcome/images/learn.gif" alt="Post Study Material" width=599 height=79 border=0></a></td></table></td></table><table cellpadding=0 cellspacing=0 border=0 align=center width=599 style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; line-height: 10px" class=footer><tr><td align=center style="padding: 15px 0 10px; font-size: 12px; color:#8a8a8a; margin: 0; line-height: 1.2;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif" valign=top><p style="font-size: 12px; color:#8a8a8a; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif">Follow the adventures of Studygig:&nbsp;<a href="http://twitter.com/studygig">@studygig</a>,&nbsp;<a href="http://www.facebook.com/studygig">facebook.com/studygig</a>,&nbsp;<a href="http://studygig.posterous.com/">blog.studygig.com</a></p></td><tr></table></td><td height=20></td></table>';
				
				$rawMime = 
				    "X-Priority: 1 (Highest)\n".
				    "X-Mailgun-Tag: Welcome Email\n".
				    "Content-Type: text/html;charset=UTF-8\n".    
				    "From: reply@studygig.com\n".
				    "To: ".$email."\n".
				    "Subject: Welcome to Studygig!\n".
				    "\n".
			$body;
			MailgunMessage::send_raw("reply@studygig.com", $email, $rawMime); 
				
			}
		else{
			$data['incorrectLogin'] = false;
			$data['notVerified'] = true;
			$data['content'] = 'users/verified';
			$data['pageTitle'] = 'Your email was not verified.';
			$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
			$this->load->view('subTemplate2',$data);
		}
	}

	function createuser() {				
		
		
			
		if($this->form_validation->run('signup')) {
		
			#Make random hash
			
			$verifyhash = $this->session->userdata('session_id');
		
			#Send email
			
			require_once 'Mailgun.php';
				
			mailgun_init('key-147iqkqjpa8njqj7s9');
			$username = $this->input->post('username');
			$body ='<meta content="text/html; charset=utf-8" http-equiv="Content-Type"><title>Welcome to Studygig</title><table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="padding: 0px 0 35px; background-image:url(\'http://email.studygig.com/welcome/images/bg_tile.png\'); background-repeat:repeat; background-position:center top" bgcolor="#f7f7f7"><tbody><tr><td height="20"></td></tr><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tbody><tr><td width="20"></td><td width="200" style="margin: 0; padding: 10px 0 0" align="center" valign="top"><a href="http://studygig.com"><img src="http://email.studygig.com/welcome/images/studygig-logo.png" alt="Studygig Logo" width="174" height="61" style="float:left" border="0"></a><p style="color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px; float:right"><a href="http://studygig.com/index.php/users/login" style="color: #006eda; text-decoration: none">Login</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/help" style="color: #006eda; text-decoration: none">Help</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/" style="color: #006eda; text-decoration: none">Search</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/contact" style="color: #006eda; text-decoration: none">Contact</a></p></td><td width="20"></td></tr><tr><td width="20"></td><td style="margin: 0; padding: 15px 0 0" align="left" valign="top"><span style="font-size:18px">Hi, '.  $username.'.</span><br><br><p style="font-size: 14px; color:#000000; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; text-align:left">Please confirm your Studygig account by clicking this link (if it doesn\'t work please copy and paste in url):<br><a href="http://studygig.com/index.php/users/verify/'.$verifyhash.'" style="color: #006eda; text-decoration: none">http://studygig.com/index.php/users/verify/'.$verifyhash.'</a><br><br>Once you confirm, you will have full access to Studygig and all future notifications will be sent to this email address.<br><br><i style="color: #898989">The Studygig Team</i><br><br></p></td><td width="20"></td></tr></tbody></table><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tbody><tr><td width="599" valign="top" align="left" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"></td></tr></tbody></table><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; line-height: 10px" class="footer"><tbody><tr><td align="center" style="padding: 15px 0 10px; font-size: 12px; color:#8a8a8a; margin: 0; line-height: 1.2;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif" valign="top"><p style="font-size: 12px; color:#8a8a8a; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif">Follow the adventures of Studygig:&nbsp;<a href="http://twitter.com/studygig">@studygig</a>,&nbsp;<a href="http://www.facebook.com/studygig">facebook.com/studygig</a>,&nbsp;<a href="http://studygig.posterous.com/">blog.studygig.com</a></p></td></tr><tr></tr></tbody></table></td></tr></tbody></table>';	
			$email = trim($this->input->post('email'));	                          
			$rawMime = 
				    "X-Priority: 1 (Highest)\n".
				    "X-Mailgun-Tag: Verification Email\n".
				    "Content-Type: text/html;charset=UTF-8\n".    
				    "From: reply@studygig.com\n".
				    "To: ".$email."\n".
				    "Subject: Please confirm your Studygig account, ".$username."!\n".
				    "\n".
			$body;
			MailgunMessage::send_raw("reply@studygig.com", $email, $rawMime); 
			
					$newUserId = $this->User->get_total_users()+1;
					$this->User->create($verifyhash);
					$this->User->log_user_ip($newUserId,$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],0);
					$data['content'] = 'users/success';
					$data['signedUpThruStudygig'] = true;
					
					$data['pageTitle'] = 'Success, your account was created on Studygig';
					$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
					
					$this->load->view('subTemplate2',$data);
		}
			else
		{
			$data['content'] = 'users/signup';
			
			$data['pageTitle'] = 'Create an Account on Studygig';
			$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
			
			$this->load->view('subTemplate2',$data);
		}
	}
	
	function resendVerificationEmailPage(){
		$data['content'] = 'users/resendemail';
		$data['verifiedSent'] = false;
		
		$data['pageTitle'] = 'Past tests, lecture notes and study guides - Find study material on Studygig';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';		
		$this->load->view('subTemplate2', $data);	
	}
	
	function resendVerificationEmail(){
		if($this->form_validation->run('emailreset')){
			$user = $this->User->find_by_id($this->User->get_id_by_email($this->input->post('email')));
			if ($user){
				require_once 'Mailgun.php';
				
				mailgun_init('key-147iqkqjpa8njqj7s9');
				
				$email = trim($user->email);	
				$body='<meta content="text/html; charset=utf-8" http-equiv="Content-Type"><title>Welcome to Studygig</title><table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="padding: 0px 0 35px; background-image:url(\'http://email.studygig.com/welcome/images/bg_tile.png\'); background-repeat:repeat; background-position:center top" bgcolor="#f7f7f7"><tbody><tr><td height="20"></td></tr><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tbody><tr><td width="20"></td><td width="200" style="margin: 0; padding: 10px 0 0" align="center" valign="top"><a href="http://studygig.com"><img src="http://email.studygig.com/welcome/images/studygig-logo.png" alt="Studygig Logo" width="174" height="61" style="float:left" border="0"></a><p style="color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px; float:right"><a href="http://studygig.com/index.php/users/login" style="color: #006eda; text-decoration: none">Login</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/help" style="color: #006eda; text-decoration: none">Help</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/" style="color: #006eda; text-decoration: none">Search</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/contact" style="color: #006eda; text-decoration: none">Contact</a></p></td><td width="20"></td></tr><tr><td width="20"></td><td style="margin: 0; padding: 15px 0 0" align="left" valign="top"><p style="font-size: 14px; color:#000000; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; text-align:left">Please confirm your Studygig account by clicking this link (if it doesn\'t work please copy and paste in url):<br><a href="http://studygig.com/index.php/users/verify/'.$user->verifyhash.'" style="color: #006eda; text-decoration: none">http://studygig.com/index.php/users/verify/'.$user->verifyhash.'</a><br><br>Once you confirm, you will have full access to Studygig and all future notifications will be sent to this email address.<br><br><i style="color: #898989">The Studygig Team</i><br><br></p></td><td width="20"></td></tr></tbody></table><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tbody><tr><td width="599" valign="top" align="left" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"></td></tr></tbody></table><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; line-height: 10px" class="footer"><tbody><tr><td align="center" style="padding: 15px 0 10px; font-size: 12px; color:#8a8a8a; margin: 0; line-height: 1.2;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif" valign="top"><p style="font-size: 12px; color:#8a8a8a; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif">Follow the adventures of Studygig:&nbsp;<a href="http://twitter.com/studygig">@studygig</a>,&nbsp;<a href="http://www.facebook.com/studygig">facebook.com/studygig</a>,&nbsp;<a href="http://studygig.posterous.com/">blog.studygig.com</a></p></td></tr><tr></tr></tbody></table></td></tr></tbody></table>';                          
			$rawMime = 
				    "X-Priority: 1 (Highest)\n".
				    "X-Mailgun-Tag: Resend Verification Email\n".
				    "Content-Type: text/html;charset=UTF-8\n".    
				    "From: reply@studygig.com\n".
				    "To: ".$email."\n".
				    "Subject: Please confirm your email\n".
				    "\n".
			$body;
			MailgunMessage::send_raw("reply@studygig.com", $email, $rawMime); 
			
				/*$this->load->library('email');
				$config['mailtype'] = 'html';
					
				$this->email->initialize($config);
				$this->email->from('reply@studygig.com', 'Studygig');
				$this->email->to($user->email); 
		
				$this->email->subject('Studygig account email validation');		
				$this->email->message('<meta content="text/html; charset=utf-8" http-equiv="Content-Type"><title>Welcome to Studygig</title><table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="padding: 0px 0 35px; background-image:url(\'http://email.studygig.com/welcome/images/bg_tile.png\'); background-repeat:repeat; background-position:center top" bgcolor="#f7f7f7"><tbody><tr><td height="20"></td></tr><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tbody><tr><td width="20"></td><td width="200" style="margin: 0; padding: 10px 0 0" align="center" valign="top"><a href="http://studygig.com"><img src="http://email.studygig.com/welcome/images/studygig-logo.png" alt="Studygig Logo" width="174" height="61" style="float:left" border="0"></a><p style="color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px; float:right"><a href="http://studygig.com/index.php/users/login" style="color: #006eda; text-decoration: none">Login</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/help" style="color: #006eda; text-decoration: none">Help</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/" style="color: #006eda; text-decoration: none">Search</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/contact" style="color: #006eda; text-decoration: none">Contact</a></p></td><td width="20"></td></tr><tr><td width="20"></td><td style="margin: 0; padding: 15px 0 0" align="left" valign="top"><p style="font-size: 14px; color:#000000; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; text-align:left">Please confirm your Studygig account by clicking this link:<br><a href="http://studygig.com/index.php/users/verify/'.$user->verifyhash.'" style="color: #006eda; text-decoration: none">http://studygig.com/index.php/users/verify/</a><br><br>Once you confirm, you will have full access to Studygig and all future notifications will be sent to this email address.<br><br><i style="color: #898989">The Studygig Team</i><br><br></p></td><td width="20"></td></tr></tbody></table><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tbody><tr><td width="599" valign="top" align="left" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"></td></tr></tbody></table><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; line-height: 10px" class="footer"><tbody><tr><td align="center" style="padding: 15px 0 10px; font-size: 12px; color:#8a8a8a; margin: 0; line-height: 1.2;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif" valign="top"><p style="font-size: 12px; color:#8a8a8a; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif">Follow the adventures of Studygig:&nbsp;<a href="http://twitter.com/studygig">@studygig</a>,&nbsp;<a href="http://www.facebook.com/studygig">facebook.com/studygig</a>,&nbsp;<a href="http://studygig.posterous.com/">blog.studygig.com</a></p></td></tr><tr></tr></tbody></table></td></tr></tbody></table>');	
		
				$this->email->send();*/
			}
			$data['content'] = 'users/resendemail';
			$data['verifiedSent'] = true;
			
			$data['pageTitle'] = 'Past tests, lecture notes and study guides - Find study material on Studygig';
			$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';		
			$this->load->view('subTemplate2', $data);	
		}else{
		
		$data['content'] = 'users/resendemail';
			$data['verifiedSent'] = false;
			
			$data['pageTitle'] = 'Past tests, lecture notes and study guides - Find study material on Studygig';
			$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';		
			$this->load->view('subTemplate2', $data);	
	}
	}

	function login() {
		$data['content'] = 'users/login';
		$data['incorrectLogin'] = false;
		$data['notVerified'] = false;
	    
	    $data['pageTitle'] = 'Login / Create an Account on Studygig';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
	    
		$this->load->view('subTemplate2', $data);	
	}
	
	function underconstruction() {
		$data['content'] = 'users/underconstruction';
	    
	    $data['pageTitle'] = 'This feature is still under construction';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
	    
		$this->load->view('subTemplate2', $data);	
	}
	
	function forgotpass(){
		$data['content'] = 'users/forgotpassword';
		$data['resetpass'] = false;
		
		$data['pageTitle'] = 'Past tests, lecture notes and study guides - Find study material on Studygig';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';		
		$this->load->view('subTemplate2', $data);	
	}
	
	function resetpass(){
		if($this->form_validation->run('passreset')){
			$user_id = $this->User->get_id_by_email($this->input->post('email'));
			if ($user_id){
				//generate random password (length )		
				$n = rand(10e16, 10e20);
				$password = base_convert($n, 10, 36);
				
				require_once 'Mailgun.php';
				
				mailgun_init('key-147iqkqjpa8njqj7s9');
				$body = "You have requested to reset your password, your new password is: ".$password ." Please\r\r login and change this password for security purposes: http://www.studygig.com\r";
				$email =$this->input->post('email');
				$rawMime = 
				    "X-Priority: 1 (Highest)\n".
				    "X-Mailgun-Tag: Password Reset\n".
				    "Content-Type: text/html;charset=UTF-8\n".    
				    "From: reply@studygig.com\n".
				    "To: ".$email."\n".
				    "Subject: Studygig account email validation\n".
				    "\n".
				$body;
				MailgunMessage::send_raw("reply@studygig.com", $email, $rawMime); 
				
				// send email
				/*$this->load->library('email');
				$config['mailtype'] = 'html';
					
				$this->email->initialize($config);
				
				$this->email->from('info@studygig.com', 'Studygig');
				$this->email->to($this->input->post('email'));  			
				$this->email->subject('Studygig account password reset');
				$this->email->message("You have requested to reset your password, your new password is: ".$password ." Please\r\r login and change this password for security purposes: http://www.studygig.com\r");	
				$this->email->send();*/
				
				//send password to database
				$this->User->new_password($user_id, $password);			
			}
			$data['content'] = 'users/forgotpassword';
			$data['resetpass'] = true;
			
			$data['pageTitle'] = 'Past tests, lecture notes and study guides - Find study material on Studygig';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
			$this->load->view('subTemplate2', $data);	
		}else{
			
			$data['content'] = 'users/forgotpassword';
			$data['resetpass'] = false;
			
			$data['pageTitle'] = 'Past tests, lecture notes and study guides - Find study material on Studygig';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
			$this->load->view('subTemplate2', $data);	
		}
		
		
	}
	
  function email_unique($email) {
    $this->form_validation->set_message('email_unique', 'The email address is already taken!  Perhaps try <a href="http://www.studygig.com/index.php/users/login">signing in</a> or have you <a href="http://www.studygig.com/index.php/users/forgotpass">forgot your password?</a>');
  	return $this->User->validates_email_uniqueness($email);
  }
  
  function ends_with_yorku($email) {
    $this->form_validation->set_message('ends_with_yorku', 'The email address must be a YorkU email.  If you do not have one, use facebook to login.');
    $length = -8;
    return (substr($email, $length) === "yorku.ca");
  }
	
  function email_unique_or_same($email) {
    $this->form_validation->set_message('email_unique_or_same', 'The email address is already taken!');
  	if (($this->User->validates_email_uniqueness($email)) || (strcasecmp($this->user->email,$email) == 0)) {
  		return true;
  	}else{
  		return false;
  	}
  }
  	
  function username_unique($username) {
    $this->form_validation->set_message('username_unique', 'This username is already taken! Perhaps try <a href="http://www.studygig.com/index.php/users/login">signing in</a> or have you <a href="http://www.studygig.com/index.php/users/forgotpass">forgot your password?</a>');
  	return $this->User->validates_username_uniqueness($username);  
  }
  
  function samepassword($first, $second) {
  	if ($first != $second)
  		$this->form_validation->set_message('samepassword', 'Passwords do not match!');
  	
  }	
  
	
	
   function validate_password($currentpassword) {
    $this->form_validation->set_message('validate_password', 'Your current password was incorrect.');
  	return $this->User->validates_password($currentpassword,$this->user);  
  }
  
  function dashboard() {
    $this->load->model('Favourite');
    $this->load->model('Upload');
    if ($this->loggedin) {
      $data['content'] = 'users/dashboard';
      $data['user'] = $this->user;    
      $userid = $this->user->id;
      
      $data['total_uploads'] = $this->User->total_uploads($userid);
      $data['total_downloads'] = $this->User->total_downloads($userid);
      
      $data['points'] = $this->User->total_points($userid);
      $data['recentdownloads'] = $this->User->recent_downloads($userid);
      $data['favourites'] = $this->Favourite->get($userid);
      
      foreach ($data['favourites'] as $f => $fav){
      	$data['favouritesUsers'][$f] = $this->Upload->get_uploader($fav->id)->username;
      	$data['favouritesCourses'][$f]  = $this->Upload->get_course_by_id($fav->id);
  	  }
  	  
  	  foreach ($data['recentdownloads'] as $d => $download){
      	$data['recentDownloadsUsers'][$d] = $this->Upload->get_uploader($download->id)->username;
      	$data['recentDownloadsCourses'][$d]  = $this->Upload->get_course_by_id($download->id);
  	  }

      $data['pageTitle'] = 'Past tests, lecture notes and study guides - Find study material on Studygig';
	  $data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
      $this->load->view('subTemplate2', $data);
    }
    else
    redirect('users/login');
  }
  
  function account() {    
  
    if ($this->loggedin) {	
      $data['content'] = 'users/account';
      $data['user'] = $this->user; 
      $data['editted'] = false;   
  	
  	  $data['pageTitle'] = 'Account Settings';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
      $this->load->view('subTemplate2', $data);  
    }
    else  
    redirect('users/login');
  }
  
  function profile(){
	  if ($this->loggedin) {	
	      $data['content'] = 'users/profile';
	      $data['user'] = $this->user; 
	  	
	  	  $data['pageTitle'] = 'Account Settings';
			$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
	      $this->load->view('subTemplate2', $data);  
	    }
	    else  
	    redirect('users/login');
  }
  
  function invite(){
  	if ($this->loggedin) {
	      $data['content'] = 'users/invite';
	  	  $data['user'] = $this->user;
	  	  $data['pageTitle'] = 'Invite Your Friends & Classmates';
		  $data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
	      $this->load->view('subTemplate2', $data);  
	}else
    	redirect('users/login');
  }
  
  function sendInvites(){
  if ($this->session->userdata('logged_in')) 
		{			
			if($this->form_validation->run('sendInvites')){	
				$sender = $this->User->find_by_id($this->session->userdata('user_id'));		
				$inputClean = substr($this->input->post('emails'),0,strlen($this->input->post('emails'))-1);
			  	$emails = explode(",", $inputClean);
			  	
			  	//add to record
				$this->User->addInvites($sender->id,count($emails),$inputClean);
				
				//send out emails
			  	for ($i=0; $i < count($emails); $i++){
								
				$email = $emails[$i];
				
				$body='<meta content="text/html; charset=utf-8" http-equiv=Content-Type><title>Welcome to Studygig</title><body><table cellpadding=0 cellspacing=0 border=0 align=center width="100%" style="padding: 0px 0 35px; background-image:url(\'http://email.studygig.com/welcome/images/bg_tile.png\'); background-repeat:repeat; background-position:center top" bgcolor="#f7f7f7"><tr><td height=20></td><tr><td align=center><table cellpadding=0 cellspacing=0 border=0 align=center width=599 style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tr><td width=20></td><td width=200 style="margin: 0; padding: 10px 0 0" align=center valign=top><a href="http://studygig.com"><img src="http://email.studygig.com/welcome/images/studygig-logo.png" alt="Studygig Logo" width=174 height=61 style=float:left border=0></a><p style="color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px; float:right"><a href="http://studygig.com/index.php/users/login" style="color: #006eda; text-decoration: none">Login</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/help" style="color: #006eda; text-decoration: none">Help</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/" style="color: #006eda; text-decoration: none">Search</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/contact" style="color: #006eda; text-decoration: none">Contact</a></p></td><td width=20></td><tr><td height=20></td><tr><td width=20></td><td style="padding:10px; border-style:dotted; border-width:1px; border-color: #CCC" align=left valign=top><p style=font-size:18px>'.nl2br(trim($this->input->post('message'))).'</p><p style=font-size:12px>Direct message sent by '.$sender->username.' ('.$sender->email.') to you ('.$email.').</p></td><td width=20></td><tr><td width=20></td><td style="margin: 0; padding: 15px 0 0" align=left valign=top><span style=font-size:18px>Send a message back to '.$sender->username.' by replying to this email.</span></td><td width=20></td></table><table cellpadding=0 cellspacing=0 border=0 align=center width=599 style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tr><td width=599 valign=top align=left style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"></td></table><table cellpadding=0 cellspacing=0 border=0 align=center width=599 style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; line-height: 10px" class=footer><tr><td align=center style="padding: 15px 0 10px; font-size: 12px; color:#8a8a8a; margin: 0; line-height: 1.2;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif" valign=top><p style="font-size: 12px; color:#8a8a8a; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif">This message is a service email related to your use of Studygig.<br>Follow the adventures of Studygig:&nbsp;<a href="http://twitter.com/studygig">@studygig</a>,&nbsp;<a href="http://www.facebook.com/studygig">facebook.com/studygig</a>,&nbsp;<a href="http://studygig.posterous.com/">blog.studygig.com</a></p></td><tr></table></td></table>';
				$rawMime = 
				    "X-Priority: 1 (Highest)\n".
				    "X-Mailgun-Tag: Studygig Invite Email\n".
				    "X-Campaign-Id: Studygig Invite Email\n".
				    "Content-Type: text/html;charset=UTF-8\n".    
				    "From:".$sender->email."\n".
				    "To: ".$email."\n".
				    "Subject:".$sender->username." has invited you to Studygig!\n".
				    "\n".
			$body;
		//	MailgunMessage::send_raw($sender->email, $email, $rawMime); 
			}
			
			echo "Invite was sent successfully to: ".$inputClean;
				
				}else{
					echo "Sorry, there was an error with one or more of the emails you typed; ".$this->input->post('emails');
				
			}				
		}
			else
		{
			echo '<a href="'.base_url().'index.php/users/signup">Register</a> or <a href="'.base_url().'index.php/users/login">Login</a> to send an invite.';
		}	
	}
  
  function editAccount() {	      
		if ($this->loggedin) {
			if($this->form_validation->run('editprofile')){	
				$this->User->update_profile($this->user->id,$this->input->post('email'),$this->input->post('confirmnewpassword'));
				$data['content'] = 'users/account';
				$data['user'] = $this->user; 
				$data['editted'] = true;
				
				$data['pageTitle'] = 'Account Settings';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
				$this->load->view('subTemplate2', $data);	
			}else{
				$data['content'] = 'users/account';
				$data['user'] = $this->user; 
				$data['editted'] = false;
				
				$data['pageTitle'] = 'Account Settings';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
				$this->load->view('subTemplate2', $data);	
			}
		}else
    	redirect('users/login');
	}
  
  function yourUploads() {    
  $this->load->model('Upload');
    if ($this->loggedin) {	
      $data['content'] = 'users/your-uploads';
      $data['user'] = $this->user; 
      $userid = $this->user->id;  
      $data['uploads'] = $this->User->get_all_uploads($this->user->id);
      foreach ($data['uploads'] as $u => $upload){
      	$data['uploadsUsers'][$u] = $this->Upload->get_uploader($upload->id)->username;
      	$data['uploadsCourses'][$u]  = $this->Upload->get_course_by_id($upload->id);
  	  }
  	
  	  $data['pageTitle'] = 'Your Uploads';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
      $this->load->view('subTemplate2', $data);  
    }
    else  
    redirect('users/login');
  }
  
  function yourListings() {    
   $this->load->model('Classified');
    if ($this->loggedin) {	
      $data['content'] = 'users/your-listings';
      $data['user'] = $this->user; 
      $userid = $this->user->id;  
      $data['classifieds'] = $this->User->get_all_classifieds($this->user->id);
      foreach ($data['classifieds'] as $l => $listing){
      	$data['classifiedsUsers'][$l] = $this->Classified->get_uploader($listing->id)->username;
      	$data['classifiedsCourses'][$l]  = $this->Classified->get_course_by_id($listing->id);
  	  }
  	  $data['pageTitle'] = 'Your Listings';
	  $data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
      $this->load->view('subTemplate2', $data);  
    }
    else  
    redirect('users/login');
  }
  
  function rewards(){
	  if ($this->loggedin) {	
	      $data['content'] = 'users/rewards';
	      $data['user'] = $this->user; 
	  	
	  	  $data['pageTitle'] = 'Rewards';
			$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
	      $this->load->view('subTemplate2', $data);  
	    }
	    else  
	    redirect('users/login');
  }
  
  function redeemReward(){
  	if ($this->session->userdata('logged_in')) 
		{	
			if ($this->User->validate_points($this->session->userdata('user_id'),$this->input->post('reward_id'))) 
				{
					$this->User->log_user_ip($this->session->userdata('user_id'),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],4);
					$this->User->addRewardRequest();
					echo "Your reward has been requested.  We will contact you via your email very soon.";
				}			
					else
				{
					echo "You do not have enough points yet!  Go post some more study material!";
				}
		}
			else
		{
			echo '<a href="'.base_url().'index.php/users/signup">Register</a> or <a href="'.base_url().'index.php/users/login">Login</a> to rate.';
		}
  }
  
  
}	
