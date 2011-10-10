<?php

class Site extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		if ($this->session->userdata('logged_in')) {
			
			$this->load->model('User');		
			$data->points = $this->User->total_points($this->session->userdata('user_id'));
			$this->load->vars($data);
		}

		$this->output->cache(5);
	
	}
	
	function howitworks() {
		$data['content'] = 'site/howitworks';
		
		$data['pageTitle'] = 'How Studygig Works';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
		$this->load->view('subTemplate', $data);	
	}
	
	function aboutus() {
		$data['content'] = 'site/aboutus';
		
		$data['pageTitle'] = 'About Studygig';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
		$this->load->view('subTemplate', $data);	
	}
	
	function mailinglist() {
		$data['content'] = 'site/joinmailinglist';
		
		$data['pageTitle'] = 'Join the Studygig Mailing List';
		$data['pageDescription'] = 'Stay up-to-date with us about new site features, giveaways, and when we launch at new universities!';
		$this->load->view('subTemplate', $data);	
	}
	
	function tenreasons() {
		$data['content'] = 'site/10reasons';
		
		$data['pageTitle'] = '9 reasons why students use Studygig';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
		$this->load->view('subTemplate', $data);	
	}
	
	function help() {
		$data['content'] = 'site/help';
		
		$data['pageTitle'] = 'FAQs and Help on Studygig';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
		$this->load->view('subTemplate', $data);	
	}
	
	function blog() {
		$data['content'] = 'site/blog';
		
		$data['pageTitle'] = 'Studygig Blog';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
		$this->load->view('subTemplate', $data);	
	}
	
	function academicintegrity() {
		$data['content'] = 'site/academicintegrity';
		
		$data['pageTitle'] = 'Academic Integrity';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
		$this->load->view('subTemplate', $data);	
	}
	
	function copyright() {
		$data['content'] = 'site/copyright';
		
		$data['pageTitle'] = 'Copyright Notice';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
		$this->load->view('subTemplate', $data);	
	}
	
	function termsofuse() {
		$data['content'] = 'site/termsofuse';
		
		$data['pageTitle'] = 'Terms of Use';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
		$this->load->view('subTemplate', $data);	
	}
	
	function privacy() {
		$data['content'] = 'site/privacy';
		
		$data['pageTitle'] = 'Privacy Policy';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
		$this->load->view('subTemplate', $data);	
	}
	
	function contact() {
	if($this->form_validation->run('contact')){	
	
			$cat = $this->input->post('category');
			
			if ($cat == 0){
				$cat = "Select a Category";
			}else if ($cat == 1){
				$cat = "Feedback & Suggestions";
			}else if ($cat == 2){
				$cat = "Help";
			}else if ($cat == 3){
				$cat = "Technical Support";
			}else{
				$cat = "Other (please specify)";
			}
			$email =trim($this->input->post('email'));
			$body ="Message: \r\n".strip_tags(trim($this->input->post('message')))." \r\n\r\n".$_SERVER['REMOTE_ADDR']."\r\n  " .$_SERVER['HTTP_USER_AGENT'];
			$rawMime = 
				    "X-Priority: 1 (Highest)\n".
				    "X-Mailgun-Tag: Contact Studygig Email\n".
				    "Content-Type: text/html;charset=UTF-8\n".    
				    "From:".$email."\n".
				    "To: info@studygig.com\n".
				    "Subject: Studygig Contact - ".$cat."\n".
				    "\n".
			$body;
			MailgunMessage::send_raw($email, "info@studygig.com", $rawMime); 
			
			/*
			$this->load->library('email');

			$this->email->from($this->input->post('email'),$this->input->post('name'));
			$this->email->to('info@studygig.com', 'Studygig'); 
			$this->email->subject('Studygig - '.$cat);
			$this->email->message('Message: \r\n'.strip_tags(trim($this->input->post('message'))).' \r\n\r\n'.$_SERVER['REMOTE_ADDR'].'\r\n  ' .$_SERVER['HTTP_USER_AGENT']);	
			*/

					$data['editted'] = true;
				
					$data['content'] = 'site/contact';
			
					$data['pageTitle'] = 'Contact Us';
					$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
					$this->load->view('subTemplate', $data);	

				
			}else{
				$data['editted'] = false;
				
				$data['content'] = 'site/contact';
		
		$data['pageTitle'] = 'Contact Us';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
		$this->load->view('subTemplate', $data);	

			}
	
	
	
	}
}
