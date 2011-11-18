<?php class Sessions extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('User');
		if ($this->session->userdata('logged_in')) {			
		$data->points = $this->User->total_points($this->session->userdata('user_id'));
		$this->load->vars($data);
		}
	}

	function create() {
		
		if($this->form_validation->run('login')) {
			if ($this->User->validate_login())
			{	
				$id = $this->User->get_id_by_email($this->input->post('email'));
				$verified = $this->User->find_by_id($id)->verified;
				if($verified == 1){
				
					$this->User->log_user_ip($id,$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],1);
					
					$newlogin = array(
		                   'email'  => $this->input->post('email'),
		                   'user_id' => $id,              
		                   'logged_in' => TRUE,
		                   'username' => $this->User->get_username_by_id($id),
		                   'points' => $this->User->get_points_by_id($id)
		               );
		
					$this->session->set_userdata($newlogin);					
					redirect($this->session->flashdata('last_url'),'refresh');
				}else{
					$data['content'] = 'users/login';
					$data['incorrectLogin'] = false;
					$data['notVerified'] = true;
					
				 	$data['pageTitle'] = 'Login / Create an Account on Studygig';
					$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
					$this->load->view('subTemplate2', $data);
			}
			}
			else
			{
				$data['content'] = 'users/login';
				$data['incorrectLogin'] = true;
				$data['notVerified'] = false;
				
				$data['pageTitle'] = 'Login / Create an Account on Studygig';
				$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
				$this->load->view('subTemplate2', $data);
				
			}
		}else
		{
			$data['content'] = 'users/login';
			$data['incorrectLogin'] = false;
			$data['notVerified'] = false;
			
			$data['pageTitle'] = 'Login / Create an Account on Studygig';
			$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
			$this->load->view('subTemplate2',$data);
		}
	
	}
	
	function destroy() {	
		$this->session->sess_destroy();
		
		redirect(site_url(),'refresh');
	}
	
	function fb_login_old() {
  
    # We require the library
    require("application/third_party/facebooksdk/src/facebook.php");
    
    # Creating the facebook object
    $facebook = new Facebook(array(
        'appId'  => '170587262970610',
        'secret' => 'fec7d93520564ba77807f059a823639a',
        'cookie' => true
    ));
    
    # Let's see if we have an active session
    $session = $facebook->getSession();
    
    if(!empty($session)) {
        # Active session, let's try getting the user id (getUser()) and user info (api->('/me'))
        try{
            $uid = $facebook->getUser();
            $user = $facebook->api('/me');
        } catch (Exception $e){}
    
        if(!empty($user)){
            # User info ok? Let's print it (Here we will be adding the login and registering routines)
            
            if ($this->User->find_user_facebook($user['id'],$user['name'],$user['email'])){
            	$fblogin = $this->User->get_user_facebook($user['id'],$user['name'],$user['email']);
            	$id = $this->User->get_id_by_email($user['email']);
            
            $newfblogin = array(
            	'email'  => $user['email'],
	            'user_id' => $id,                  
	            'logged_in' => TRUE,
	            'username' => $this->User->get_username_by_id($id),
              'points' => $this->User->get_points_by_id($id)
            );
            
            $this->session->set_userdata($newfblogin);
            	redirect(site_url('users/dashboard'),'refresh');
            }else{
            	$fblogin = $this->User->add_user_facebook($user['id'],$user['name'],$user['email']);
            	
            	$id = $this->User->get_id_by_email($user['email']);
            
            $newfblogin = array(
            	'email'  => $user['email'],
	            'user_id' => $id,                  
	            'logged_in' => TRUE,
	            'username' => $this->User->get_username_by_id($id),
              'points' => $this->User->get_points_by_id($id)
            );
            
            $this->session->set_userdata($newfblogin);
            	
            	$data['content'] = 'users/success';
            	$data['signedUpThruStudygig'] = false;
            	$data['pageTitle'] = 'Success, your account was created on Studygig';
				$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
				$this->load->view('subTemplate2',$data);
        }
            
                        		
            
            // $logoutUrl = $facebook->getLogoutUrl();            
            //redirect(site_url('users/dashboard'),'refresh');        
            
        } else {
            # For testing purposes, if there was an error, let's kill the script
            die("There was an error.");
        }
    } else {
        # There's no active session, let's generate one. WORKS!
        $login_url = $facebook->getLoginUrl(array('req_perms' => 'email,publish_stream','cancel_url' => 'http://studygig.com/index.php/users/login'));
        header("Location: ".$login_url);
    }

  
  }
  
     function fb_login() {
     
     $app_id = 170587262970610;
     $app_secret = "fec7d93520564ba77807f059a823639a";
     $my_url = current_url();//"http://www.studygig.com/index.php/sessions/fb_login";
  	
     $code = $this->input->get('code');
  	 
     if(empty($code)) {
       
       $this->session->set_userdata('state', md5(uniqid(rand(), TRUE)));  //CSRF protection
       
       $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
         . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
         . $this->session->userdata('state')."&scope=email,publish_stream";
  		 
  		 
       echo("<script> top.location.href='" . $dialog_url . "'</script>");
     }    
     
     if($_REQUEST['state'] == $this->session->userdata('state')) {
     
       $token_url = "https://graph.facebook.com/oauth/access_token?"
         . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
         . "&client_secret=" . $app_secret ."&code=". $code;
       $response = file_get_contents($token_url);
       
       
       $params = null;
       parse_str($response, $params);
  
       $graph_url = "https://graph.facebook.com/me?access_token=" 
         . $params["access_token"];
  

       $user = json_decode(file_get_contents($graph_url));
				
			 if ($this->User->find_user_facebook($user->id,$user->name,$user->email))
			 	{
          $fblogin = $this->User->get_user_facebook($user->id,$user->name,$user->email);
          $id = $this->User->get_id_by_email($user->email);	
       
       
		     $newfblogin = array(
		          	'email'  => $user->email,
			        'user_id' => $fblogin->id,                  
			        'logged_in' => TRUE,
			        'username' => $this->User->get_username_by_id($id),
				'points' => $this->User->get_points_by_id($id),
				'token' => $params["access_token"]
		        );
		          
		     $this->session->set_userdata($newfblogin);     
		     
		     redirect(site_url('users/dashboard'),'refresh');
		    }  
		    	else
		    {
		    			
		    			$fblogin = $this->User->add_user_facebook($user->id,$user->name,$user->email);
            	
            	$id = $this->User->get_id_by_email($user->email);
            
            $newfblogin = array(
            	'email'  => $user->email,
	            'user_id' => $id,                  
	            'logged_in' => TRUE,
	            'username' => $this->User->get_username_by_id($id),
              'points' => $this->User->get_points_by_id($id),
              'token' => $params["access_token"]
            );
            
            	$this->session->set_userdata($newfblogin);
            	
            	$this->curl->simple_post('https://graph.facebook.com/me/feed', array('access_token'=>$params["access_token"],'link' =>'http://studygig.com' ,'message' => 'Past tests, lecture notes and study guides - Find study material on Studygig'));
            	
            	$data['content'] = 'users/success';
            	$data['signedUpThruStudygig'] = false;
            	$data['pageTitle'] = 'Success, your account was created on Studygig';
				$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
							$this->load->view('subTemplate2',$data);
		    			
		    }
		    	 
     }
     else {
       echo("The state does not match. You may be a victim of CSRF.");
     }
    }
	
}
