<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('Paypal_Lib');
		$this->load->model('Member');
		$this->load->model('User');
		$this->user = $this->User->find_by_id($this->session->userdata('user_id'));
		$this->loggedin = $this->session->userdata('logged_in');
		
		if ($this->session->userdata('logged_in')) {
			
			$data->points = $this->User->total_points($this->session->userdata('user_id'));
			$this->load->vars($data);
		}
	}
	
	function index()
	{
		if($this->session->userdata('logged_in')) {

			if ($this->Member->is_member($this->session->userdata('user_id')))
			$this->success();
				else
			$this->form();
		}
			else
		redirect(site_url('users/signup'),'refresh');
	}
	
	function form()
	{
		
		$this->paypal_lib->add_field('business', 'alexm_1312120710_biz@gmail.com');
	    $this->paypal_lib->add_field('return', site_url('members/success'));
	    $this->paypal_lib->add_field('cancel_return', site_url('members/cancel'));
	    $this->paypal_lib->add_field('notify_url', site_url('members/ipn')); // <-- IPN url
	    $this->paypal_lib->add_field('custom', $this->session->userdata('user_id')); // <-- User id

	    $this->paypal_lib->add_field('item_name', 'Studygig 1 month subscription');
	    $this->paypal_lib->add_field('item_number', '1');
	    $this->paypal_lib->add_field('amount', '7');

		// if you want an image button use this:
		//$this->paypal_lib->image('button_03.gif');

		$this->paypal_lib->button('Subscribe');
		
	    $data['paypal_form'] = $this->paypal_lib->paypal_form();

		$data['content'] = 'members/form';
		$data['pageTitle'] = 'Share your Study Material on Studygig';
		$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';

		$this->load->view('subTemplate', $data);
        
	}

	function auto_form()
	{
		$this->paypal_lib->add_field('business', 'alexm_1312120710_biz@gmail.com');
	    $this->paypal_lib->add_field('return', site_url('members/success'));
	    $this->paypal_lib->add_field('cancel_return', site_url('members/cancel'));
	    $this->paypal_lib->add_field('notify_url', site_url('members/ipn')); // <-- IPN url
	    $this->paypal_lib->add_field('custom', '1234567890'); // <-- Verify return

	    $this->paypal_lib->add_field('item_name', 'Paypal Test Transaction');
	    $this->paypal_lib->add_field('item_number', '1');
	    $this->paypal_lib->add_field('amount', '7');

	    $this->paypal_lib->paypal_auto_form();
	}

	function cancel()
	{	
		$data['content'] = 'members/cancel';
		$data['pageTitle'] = 'Share your Study Material on Studygig';
		$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';

		$this->load->view('subTemplate', $data);
	}
	
	function success()
	{
		$data['pp_info'] = $_POST;

		$data['content'] = 'members/success';
		$data['pageTitle'] = 'Share your Study Material on Studygig';
		$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';

		$this->load->view('subTemplate', $data);
	}
	
	function ipn()
	{
		if ($this->paypal_lib->validate_ipn()) 
		{
			$id = $this->paypal_lib->ipn_data['custom'];
			$this->Member->add($id);
		}
	}
}