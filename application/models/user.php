<?php class User extends CI_Model {

	function validate_login() {
	
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('password', md5($this->input->post('password')));
		//$this->db->where('verified', 1);
		
		$query = $this->db->get('users');
		
		if ($query->num_rows() == 1)
			return true;
		else
			return false;
	}

	function authenticate_mod($user,$pass) {
		$this->db->where('user',$user);
		$this->db->where('pass',md5($pass));

		$query = $this->db->get('moderators');

		if ($query->num_rows() == 1)
			return TRUE;
			else
			return FALSE;
	}
	
	function create($the_hash) {
	
		$newuser = array(
		'email' => mysql_real_escape_string(trim($this->input->post('email'))),
		'username' =>  mysql_real_escape_string(trim($this->input->post('username'))),
		'password' => md5(mysql_real_escape_string($this->input->post('password'))),
		'verifyhash' => $the_hash,
		'oauth_provider' => NULL,
		'points' => 10
		);
	
		$this->db->insert('users', $newuser);
		
			
	}
	
	function update() {
		
		$updateduser = array(
		'email' => mysql_real_escape_string(trim($this->input->post('email'))),
		'password' =>mysql_real_escape_string(md5($this->input->post('password')))		
		);
		
		
		$this->db->where('id', $user_id)->update('users', $updateduser);
	}
	
	
	function new_password($user_id, $password){ 
		$this->db->where('id', $user_id)->update('users', array('password' => md5($password))); 
	}
	
	function update_profile($userid, $email, $password){
		
		$this->db->where('id', $userid)->update('users', array('email' => trim($email),'password' => md5(trim($password)))); 
		
	}
	
	function verify($hash) {
	  $this->db->where('verifyhash',$hash);
	  $query = $this->db->get('users');
	  
	  if ($query->num_rows() == 1)
	  	{	  			  		
	  		$verifieduser = array('verified' => 1);
	  		
	  		$this->db->where('verifyhash',$hash);
	  		$this->db->update('users', $verifieduser); 
	  		
	  		$data[0] = TRUE;
	  		$data[1] = $this->get_user_by_hash($hash);
	  		
	  		return $data;
	  	}
	  else
	  	return FALSE;	
	} 
	
	function get_email_by_hash($hash) {
		$this->db->select('email')->from('users')->where('verifyhash', $hash);	 
	  	$results= $this->db->get()->result();
	  			
		$user = $results[0];
	  	return $user->email;
	} 
	
	function get_user_by_hash($hash) {
		$this->db->where('verifyhash', $hash);	 
	  	$query= $this->db->get('users');
	  	
	  	return $query->row();
	} 
	
	function get_id_by_email($email) {
	  	$this->db->select('id')->from('users')->where('email', $email);	 
	  	$results= $this->db->get()->result();
		
		if ($results){
	  		$user = $results[0];
	  		return $user->id;
	  	}else{
	  		return false;
  		}
	}
	
	function get_username_by_id($id) {
	  	$this->db->select('username')->from('users')->where('id', $id);	 
	  	$results= $this->db->get()->result();
	  	//$results = $this->db->get_where('users',array('email'=>$email))->result();
		
			$user = $results[0];
	  	return $user->username;
	}
	
	function get_points_by_id($id) {
	  	$this->db->select('points')->from('users')->where('id', $id);	 
	  	$results= $this->db->get()->result();
	  	//$results = $this->db->get_where('users',array('email'=>$email))->result();
		
			$user = $results[0];
	  	return $user->points;
	}
	
	function find_by_id($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		if ($query){
	  		return $query->row();
	  	}else{
	  		return false;
  		}
  	}
  	
	function validates_email_uniqueness($email) {
	
  	$this->db->where('email',$email);
  	$query = $this->db->get('users');
  	
  	if ($query->num_rows() == 1)
  		return FALSE;
  	else
  		return TRUE;
  	
	}
	
	function validates_username_uniqueness($username) {
	
  	$this->db->where('username',$username);
  	$query = $this->db->get('users');
  	
  	if ($query->num_rows() == 1)
  		return FALSE;
  	else
  		return TRUE;
	}
	
	//validates the current password
	function validates_password($password,$user) {
	$this->db->where('email', $user->email);
  	$this->db->where('password',md5($password));
  	$query = $this->db->get('users');
  	
  	if ($query->num_rows() == 1)
  		return true;
  	else
  		return false;
  	
	}
	
	function find_user_facebook($userid,$username,$useremail){
	$this->db->where('oauth_provider','facebook');
	$this->db->where('oauth_uid',$userid);
	   
	$this->db->or_where('email', $useremail); 
	   
	$query = $this->db->get('users');
	if ($query->num_rows() == 1)
	{	
		return true;
	}
	return false;
}
	function get_user_facebook($userid,$username,$useremail){
	$this->db->where('oauth_provider','facebook');
	$this->db->where('oauth_uid',$userid);
	   
	$this->db->or_where('email', $useremail); 
	   
	$query = $this->db->get('users');
	$user = $query->row();
	$this->log_user_ip($user->id,$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],2);
	return $query->row();  	
	
}
  	
	function add_user_facebook($userid,$username,$useremail) {
	  
		$newfbuser = array(
				  'oauth_provider' => 'facebook',
				  'oauth_uid' => $userid,
				  'email' => $useremail,
				  'username' => $username,
				  'verified' => 1,
				  'points' => 10
			);
  
		$this->db->insert('users',$newfbuser);	      
		$this->db->where('id',mysql_insert_id());
		$query = $this->db->get('users');
  		$this->log_user_ip(mysql_insert_id(),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],0);

		return $query->row();   
	}
	
	function can_download($id) {
		
		#Checks if the user has enough points to download a course.
		
		$this->db->where('id',$id);
		$this->db->where('points >=',20);
		$query = $this->db->get('users');
		
		if ($query->num_rows() == 0)
			return FALSE;
		else
			return TRUE;
	}
	
	function validate_points($id, $reward_id) {
		
		#Checks if the user has enough points to download a course.
		
		if ($reward_id == 1) {
			 //$10 Best Buy Gift Card
			$pointcost = 500;
		}else if ($reward_id == 2) {
			//$10 Amnesty International Donation
			$pointcost = 500;
		}else if ($reward_id == 3) {
			 //$15 iTunes Gift Card 
			$pointcost = 800;
		}else if ($reward_id == 4) {
			 //$25 Best Buy Gift Card 
			$pointcost = 1300;
		}else{
			//$50 Amazon Card
			$pointcost = 2500;
		}
		
		$this->db->where('id',$id);
		$this->db->where('points >=',$pointcost);
		$query = $this->db->get('users');
		
		if ($query->num_rows() == 0)
			return FALSE;
		else
			return TRUE;
	}
	
	function addRewardRequest(){
		$reward_id =$this->input->post('reward_id');
		if ($reward_id == 1) {
			$type = 1; //$10 Best Buy Gift Card
			$pointcost = 500;
		}else if ($reward_id == 2) {
			$type = 2; //$10 Amnesty International Donation
			$pointcost = 500;
		}else if ($reward_id == 3) {
			$type = 3; //$15 iTunes Gift Card 
			$pointcost = 800;
		}else if ($reward_id == 4) {
			$type = 4; //$25 Best Buy Gift Card 
			$pointcost = 1300;
		}else{
			$type = 5;	//$50 Amazon Card
			$pointcost = 2500;
		}
		
		$newrequest = array(	
			'user_id'=> $this->session->userdata('user_id'),
			'type' => $type
		);
	
		$this->db->insert('reward_requests',$newrequest);
		
		$this->db->where('id',$this->session->userdata('user_id'));
		$this->db->set('points', "points - $pointcost", FALSE);
		$this->db->update('users'); 
	
}
	
	function already_has($userid,$uploadid) {
	
		$this->db->where('user_id',$userid);
		$this->db->where('upload_id',$uploadid);
		
		$query = $this->db->get('transactions');
		
		if ($query->num_rows() >= 1)
			return TRUE;
		else
			return FALSE;
	}
	
	function recentActivity($userid) {
  	$this->db->order_by("date", "desc"); 
  	$this->db->where('user_id',$userid);
  	$query = $this->db->get('ips',3);
  	return $query->result();
 	} 
	
	function total_uploads($id) {
		$this->db->where('user_id',$id);
		$this->db->from('uploads');
		return $this->db->count_all_results();			
	}
	
	function total_downloads($id) {
		
		$this->db->where('user_id',$id);
		$this->db->from ('transactions');
		
		return $this->db->count_all_results();
	}
	
	function total_points($id) {
	
		$this->db->select('points')->from('users')->where('id', $id);	 
	  $results= $this->db->get()->result();
		
		$user = $results[0];
	  return $user->points;
	}
	
	function recent_uploads($id) {

		$this->db->where('user_id',$id);
		$this->db->limit(3);
		$this->db->order_by("created_at", "desc"); 
		$query = $this->db->get('uploads');		
		
		return $query->result();
	}
	
	function recent_downloads($id) {
	
		$this->db->select('*');
		$this->db->from('transactions');
		$this->db->where('transactions.user_id',$id);
		
		$this->db->join('uploads', 'uploads.id = transactions.upload_id','inner');
		
		$this->db->limit(3);
		$this->db->order_by("transactions.created_at", "desc"); 
		
		$query = $this->db->get();		
		
		return $query->result();	
	}

	function get_all_uploads($id) {
		$this->db->where('user_id',$id);
		return $this->db->get('uploads')->result();
	}

	function get_all_classifieds($id) {
		$this->db->where('user_id',$id);
		return $this->db->get('classifieds')->result();
	}
	
	function get_total_users(){
		return $this->db->count_all_results('users');
	}
	
	
	function get_all_users() {
		$query = $this->db->get('users');
		return $query->result();
	}
	
	function log_user_ip($id,$ip,$useragent,$action){

  		$log = array(
			'ip' => $ip,
			'user_id' => $id,
			'useragent' => $useragent,
			'action' => $action 
			);

			$this->db->insert('ips',$log);
  	}
  	
  	function log_admin_ip($username,$ip,$useragent,$action){

  		$log = array(
			'ip' => $ip,
			'username' => $username,
			'useragent' => $useragent,
			'action' => $action 
			);

			$this->db->insert('admin_ips',$log);
  	}

  	function is_moderator($id) {
  		#Checks if user has moderator privileges

  		$this->db->where('user_id',$id);
  		$query = $this->db->get('moderators');

  		if ($query->num_rows() == 1) return TRUE;
  			else
  		return FALSE;
  	}
  	
  	function addInvites($id, $numOfEmails, $emails){
  	
		$newInvite = array(	
		'user_id' => $id,
		'num_invitees' => $numOfEmails,
		'emails'=> mysql_real_escape_string(trim($emails))
		);
	
		$this->db->insert('invites',$newInvite);
  }
  	
}
