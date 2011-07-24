<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class classifiedFeed extends CI_Controller  {

      function __construct()
      {
        parent::__construct();

        $this->load->helper('xml');
		$this->load->helper('text');
        $this->load->model('classified');
      }
      
     function index()
	{
		$data['feed_name'] = 'Studygig.com'; // your website
		$data['encoding'] = 'utf-8'; // the encoding
        $data['feed_url'] = 'http://studygig.com/index.php/classifiedFeed/'; // the url to your feed
        $data['page_description'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!'; 
        $data['page_language'] = 'en-en'; // the language
        $data['creator_email'] = 'info@studygig.com'; // your email
        $data['posts'] = $this->classified->get_recent(10);
        header("Content-Type: application/rss+xml"); // important!
        
        $this->load->view('classifiedrss', $data);  
	}

}
