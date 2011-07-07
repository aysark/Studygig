<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classifieds extends CI_Controller {

	function __construct(){
	
	parent::__construct();
		
	$this->load->model('Upload');
	$this->load->model('User');
	$this->load->model('Classified');
		
	date_default_timezone_set('America/Toronto');
		
	if ($this->session->userdata('logged_in')) {	
		$data->points = $this->User->total_points($this->session->userdata('user_id'));
		$this->load->vars($data);
	}	
		
	}
	
	function index(){
		
	$data['classifieds'] = $this->Classified->get_all();
	
	$data['content'] = 'classifieds/list';
	$data['pageTitle'] = 'Past tests, lecture notes and study guides - Find study material on Studygig';
	$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';	
	$this->load->view('subTemplate',$data);
	}
	
	function search($query) {
		
	if ($this->uri->segment(4) === FALSE)
		{
		    $offset = 0;
		}
	else
		{
		    $offset = $this->uri->segment(4);
		}
		
		$data['query'] = urldecode($query);

	if ($this->session->flashdata('last_search')) $this->session->keep_flashdata('last_search');
		else
	$this->session->set_flashdata('last_search',urldecode($query));	
	
	$data['results'] = $this->Classified->search($data['query'],$offset,$this->input->post('sortResultsBy'),$this->input->post('materialTypeFilter'));
	$data['is_upload'] = FALSE;
	
	foreach($data['results'] as $k => $classif) {		
			$classifid = $classif->classified_id;
			$courses[$k]  = $this->Classified->get_course_by_id($classifid);
			$users[$k] = $this->Classified->get_uploader($classifid)->username;
			$materials[$k] = $this->Classified->get_material_by_id($classifid);
		}
	
	if ($data['results']){			
		$data['courses'] = $courses;
		$data['users'] = $users;
		$data['materials'] = $materials;
	}
			
	$data['urows'] = $this->Upload->searchcount( $query);
	$data['crows'] = $this->Classified->searchcount( $query);
	
	$this->load->library('pagination');

	$config['base_url'] = site_url('classifieds/search/'.$query);
	$config['per_page'] = '10';
	$config['uri_segment'] = 4;
	$config['num_links'] = 5;
	$config['full_tag_open'] = '<div class="pagination">';
	$config['full_tag_close'] = '</div>';
	$config['num_tag_open'] = '<div class="paginationNumLink">';
	$config['num_tag_close'] = '</div>';
	$config['next_tag_open'] = '<div class="paginationNumLink">';
	$config['next_tag_close'] = '</div>';
	$config['prev_tag_open'] = '<div class="paginationNumLink">';
	$config['prev_tag_close'] = '</div>';
	$config['cur_tag_open'] = '<div class="paginationCurLink">';
	$config['cur_tag_close'] = '</div>';
		
	$config['total_rows'] = $this->Classified->searchcount( $query);
	$this->pagination->initialize($config);
	$data['pagination'] = $this->pagination->create_links();
	
	$data['pageTitle'] = urldecode($query).' - Find study material on Studygig';
	$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';
	
	$data['content'] = 'uploads/results';
	$this->load->view('subTemplate',$data);
	
	}
	
	function insert(){
	
	if (!$this->session->userdata('logged_in')) redirect(site_url('users/login'),'refresh');
				
	$this->load->model('Subject');
	$data['subjects'] = $this->Subject->get_titles();
	
	$data['content'] = 'classifieds/insert';
	$data['pageTitle'] = 'List your Books & Study Material on Studygig';
	$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';
	$this->load->view('subTemplate',$data);
	}
	
	function add(){
	$this->load->model('Subject');
		if($this->form_validation->run('list')){
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$subject_id = $this->input->post('subject_id');
			$course_id = $this->input->post('course_id');
			$material = $this->input->post('material');
			$price = $this->input->post('price');
			
			# Facebook wall post              
			if ($this->input->post('postfb') == 1) {
				$this->curl->simple_post('https://graph.facebook.com/me/feed', 
				array('access_token'=>$this->session->userdata('token'),
				      'link' =>'http://studygig.com',
				      'message' => 'Past tests, lecture notes and study guides - Find study material on Studygig'));
			}
			
			
			$lastid = $this->Classified->add($title,$description,$subject_id,$course_id,$material,$price);
			$data['classified_id'] = $lastid;
			
			$this->User->log_user_ip($this->input->post('user_id'),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],5);
			$data['title']=$title;
			$data['content'] = 'classifieds/listed';
			$data['pageTitle'] = 'Success - Your study material was listed on Studygig';
			$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';
			$this->load->view('subTemplate', $data);
		}else{
			$data['subjects'] = $this->Subject->get_titles();
			$data['content'] = 'classifieds/insert';
			
			$data['pageTitle'] = 'List your Books & Study Material on Studygig';
			$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';
			
			$this->load->view('subTemplate', $data);
		}
	}
	
	function view($id) {
		$this->Classified->increment_listing_views($id);
		
		$data['listing'] = $this->Classified->get_by_id($id);
		$data['content'] = 'classifieds/view';
		$data['uploader'] = $this->Classified->get_uploader($id);
		$data['course']  = $this->Classified->get_course_by_id($id);
		$data['materialType'] = $this->Classified->get_material_by_id($id);
		
		$data['similarUploads'] = $this->Classified->get_similar($id);
		$data['byUserUploads'] = $this->Classified->get_byUser($id);

		$data['pageTitle'] = substr($data['course'],0,8).' '.$data['listing']->title;
		$data['pageDescription'] = $data['course'].'.  '.$data['listing']->description;
								
		$this->load->view('subTemplate', $data);
	}
	
	function remove_old() {
	# Run via cron everyday. 
		if (!$this->input->is_cli_request()) 
			echo "Only command line access!";
		else 		
		  	$this->Classified->clean();
	}
	
	function contactSeller(){
		if ($this->session->userdata('logged_in')) 
		{	
				$this->Classified->addSellerMessage();
				
				$sender = $this->User->find_by_id($this->session->userdata('user_id'));
				$reciever = $this->Classified->get_uploader($this->input->post('listing_id'));
				
				$this->load->library('email');
				$config['mailtype'] = 'html';

				$this->email->initialize($config);

				$this->email->from($sender->email, $sender->username);
				$this->email->to($reciever->email); 

				$this->email->subject('Direct message from '.$sender->username.' - Studygig');
				$this->email->set_alt_message(nl2br(trim($this->input->post('message'))).' - MESSAGE SENT VIA STUDYGIG.COM');
				$this->email->message('<meta content="text/html; charset=utf-8" http-equiv=Content-Type><title>Welcome to Studygig</title><body><table cellpadding=0 cellspacing=0 border=0 align=center width="100%" style="padding: 0px 0 35px; background-image:url(\'http://email.studygig.com/welcome/images/bg_tile.png\'); background-repeat:repeat; background-position:center top" bgcolor="#f7f7f7"><tr><td height=20></td><tr><td align=center><table cellpadding=0 cellspacing=0 border=0 align=center width=599 style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tr><td width=20></td><td width=200 style="margin: 0; padding: 10px 0 0" align=center valign=top><a href="http://studygig.com"><img src="http://email.studygig.com/welcome/images/studygig-logo.png" alt="Studygig Logo" width=174 height=61 style=float:left border=0></a><p style="color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px; float:right"><a href="http://studygig.com/index.php/users/login" style="color: #006eda; text-decoration: none">Login</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/help" style="color: #006eda; text-decoration: none">Help</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/" style="color: #006eda; text-decoration: none">Search</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://studygig.com/index.php/site/contact" style="color: #006eda; text-decoration: none">Contact</a></p></td><td width=20></td><tr><td height=20></td><tr><td width=20></td><td style="padding:10px; border-style:dotted; border-width:1px; border-color: #CCC" align=left valign=top><p style=font-size:18px>'.nl2br(trim($this->input->post('message'))).'</p><p style=font-size:12px>Direct message sent by '.$sender->username.' ('.$sender->email.') to you ('.$reciever->email.').</p></td><td width=20></td><tr><td width=20></td><td style="margin: 0; padding: 15px 0 0" align=left valign=top><span style=font-size:18px>Send a message back to '.$sender->username.' by replying to this email.</span></td><td width=20></td></table><table cellpadding=0 cellspacing=0 border=0 align=center width=599 style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"><tr><td width=599 valign=top align=left style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif"></td></table><table cellpadding=0 cellspacing=0 border=0 align=center width=599 style="font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif; line-height: 10px" class=footer><tr><td align=center style="padding: 15px 0 10px; font-size: 12px; color:#8a8a8a; margin: 0; line-height: 1.2;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif" valign=top><p style="font-size: 12px; color:#8a8a8a; margin: 0; padding: 0;font-family: Tahoma,Arial,Helvetica,Garuda,sans-serif">This message is a service email related to your use of Studygig.<br>Follow the adventures of Studygig:&nbsp;<a href="http://twitter.com/studygig">@studygig</a>,&nbsp;<a href="http://www.facebook.com/studygig">facebook.com/studygig</a>,&nbsp;<a href="http://studygig.posterous.com/">blog.studygig.com</a></p></td><tr></table></td></table>');	
					
				if ($this->email->send()){
					echo "Message was sent successfully.";
				}else{
					echo "There was an error sending your message.";
				}
		}
			else
		{
			echo '<a href="'.base_url().'index.php/users/signup">Register</a> or <a href="'.base_url().'index.php/users/login">Login</a> to send message.';
		}	
}
	
}
