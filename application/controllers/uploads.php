<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploads extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Upload');
		$this->load->model('User');
		date_default_timezone_set('America/Toronto');

		if ($this->session->userdata('logged_in')) {
			$data->points = $this->User->total_points($this->session->userdata('user_id'));
			$this->load->vars($data);
		}
	}


	//Upload form
	function insert() {
		if (!$this->session->userdata('logged_in')) redirect(site_url('users/login'),'refresh');

		$this->load->model('Subject');
		$data['subjects'] = $this->Subject->get_titles();

		$data['content'] = 'uploads/insert';
		$data['pageTitle'] = 'Share your Study Material on Studygig';
		$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';
		$this->load->view('subTemplate2',$data);

	}

	function getcourse() {
		$id = $this->input->post('subject_id');
		$this->load->model('Course');

		$results = $this->Course->get_courses_by_subject_id($id);
		echo json_encode($results);
	}

	function check_upload_url($url) {
	    $urlregex = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";

		if(preg_match($urlregex, $url))
		{
			$ext = $this->get_url_ext($url);
			if($ext){
				return true;
			}else{
				return false;

		}
		}else {
			return false;
		}
  }

  function get_url_ext($url){
  		$length = strlen($url);
		$pdf = strripos($url,".pdf");
		//echo $length.' '.$pdf;
		if ($pdf){
	    		if (($length - $pdf) == 4){
	    			return ".pdf";
				}else{
					return false;
				}
		    }
		$docx = strripos($url,".docx",10);
		    if ( $docx){
		    	if (($length - $docx) == 5){
	    			return ".docx";
				}else{
					return false;
				}
		    }
		$doc = strripos($url,".doc",10);
		    if ($doc){
		    	if (($length - $doc) == 4){
	    			return ".doc";
				}else{
					return false;
				}
		    }
		$ppt = strripos($url,".ppt",10);
		    if ($ppt){
		    	if (($length - $ppt) == 4){
	    			return ".ppt";
				}else{
					return false;
				}
		    }
		$jpeg = strripos($url,".jpeg",10);
		    if ($jpeg){
		    	if (($length - $jpeg) == 5){
	    			return ".jpeg";
				}else{
					return false;
				}
		    }
		$jpg = strripos($url,".jpg",10);
		    if ($jpg){
		    	if (($length - $jpg) == 4){
	    			return ".jpg";
				}else{
					return false;
				}
		    }
		$png = strripos($url,".png",10);
		    if ($png){
		    	if (($length - $png) == 4){
	    			return ".png";
				}else{
					return false;
				}
		    }
		$gif = strripos($url,".gif",10);
		    if ($gif){
		    	if (($length - $gif) == 4){
	    			return ".gif";
				}else{
					return false;
				}
		    }else{
		    	return false;
	  	  	}
  }


	//Upload function
	function upload() {
		$this->load->model('Subject');
		$this->load->model('User');
		$this->load->library('curl');

		if($this->form_validation->run('upload')){
			if (strchr($this->input->post('uploadType'),"l")){
				$url =  mysql_real_escape_string(trim($this->input->post('uploadLink')));
				$url = str_ireplace("www.","",$url);
				if($this->check_upload_url($url) ){
					if ( $this->Upload->check_if_duplicate_url($url)){
						$data['upload_data'] = "";
						$data['material'] = $this->input->post('material');
						$data['content'] = 'uploads/uploaded';
						$data['link'] = $url;
						$this->User->log_user_ip($this->input->post('user_id'),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],3);
						$numOfFiles = 1;
						$data['numOfFiles']=1;
						$ext = $this->get_url_ext($url);

						$ch = curl_init();
					    curl_setopt($ch, CURLOPT_HEADER, 0);
					    curl_setopt($ch, CURLOPT_VERBOSE, 0);
					    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
					    curl_setopt($ch, CURLOPT_URL, "https://crocodoc.com/api/v2/document/upload" );
					    curl_setopt($ch, CURLOPT_POST, true);

					    $post = array(
					        "url"=> $url,
					        "token" => "yYaBAI95eJxVkPb0TwvhoqMi",
					        "private" => "true",
					        "title" => $this->input->post('title')
					    );
					    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

					    #Get response from crocdoc
					    $json_response = curl_exec($ch);
					    $response = json_decode($json_response);

					    #Check if upload is successful
					    if (isset($response->uuid)) $uuid = $response->uuid;
					    else {

					    	$uuid = "ERROR";

					    	$data['error'] = "There was an error uploading your document";
							$data['content'] = 'uploads/insert';

							$data['pageTitle'] = 'Post your Study Material on Studygig';
							$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';

							$this->load->view('subTemplate2', $data);

					    }

					    log_message('debug','CROCDOC: '. $json_response. " ". $uuid);

						if ($this->input->post('anon') == 1){
								$data['upload_id']=$this->Upload->add($url,$ext,-1,$numOfFiles,true,$uuid);
						}else{
								$data['upload_id']=$this->Upload->add($url,$ext,-1,$numOfFiles,false,$uuid);
						}

						# Facebook wall post
							if ($this->input->post('postfb') == 1) {

							$this->curl->simple_post('https://graph.facebook.com/me/feed', array('access_token'=>$this->session->userdata('token'),'link' =>'http://studygig.com' ,'message' => 'I just posted new study material on Studygig, check it out!'));

							}

						$data['pageTitle'] = 'Success - Your Study Material was posted on Studygig';
						$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';

						$this->load->view('subTemplate2', $data);


					}else{

					$data['subjects'] = $this->Subject->get_titles();
					$data['error'] = "Sorry, that URL has been already submitted.  <b>Uploading duplicate links results in an account suspension.</b>";
					$data['content'] = 'uploads/insert';

					$data['pageTitle'] = 'Post your Study Material on Studygig';
					$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';

					$this->load->view('subTemplate2', $data);
				}

				}else{
					$data['subjects'] = $this->Subject->get_titles();
					$data['error'] = "The upload URL must be a valid URL (including 'http://') and a direct link to the upload.  It must end with .PDF, .PPT, .DOC, .DOCX, .JPEG/.JPG, .PNG or .GIF";
					$data['content'] = 'uploads/insert';

					$data['pageTitle'] = 'Post your Study Material on Studygig';
					$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';

					$this->load->view('subTemplate2', $data);
				}

			}else{
				$config['upload_path'] = './uploads/materials/';
				$config['allowed_types'] = "docx|pdf|doc|ppt|pptx|gif|jpg|jpeg|png";
				$config['max_size']	= '50000';
				$config['max_width'] = '0';
				$config['max_height'] = '0';
				$config['max_filename']  = '30';

				$this->load->library('upload', $config);
		        $this->load->library('Multi_upload');

		        $files = $this->multi_upload->go_upload();
		        if ( ! $files )
		        {
						$data['subjects'] = $this->Subject->get_titles();
						$data['error'] = $this->upload->display_errors();
						$data['content'] = 'uploads/insert';

						$data['pageTitle'] = 'Post your Study Material on Studygig';
						$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';

						$this->load->view('subTemplate2', $data);
		        }
		        else
		        {

							$data['upload_data'] = $files;
							$data['content'] = 'uploads/uploaded';
							$numOfFiles =0;
							$fileNames = "";
							$fileExtensions = "";
							$fileSizes ="";

							foreach($files as $file) {
								$numOfFiles++;
								$fileNames .= $file['name']." ";
								$fileExtensions .= $file['ext'].",";
								$fileSizes .= $file['size'].",";

								$input_file = $file['file']."[0]";

								//change extension to .jpg in name
								$output_file = str_replace($file['ext'],".jpg","/var/www/vhosts/studygig.com/uploads/".$file['name']);

								$command = "convert $input_file -resize 85% -crop 540x465+0+0 canvas:none -fill \"#0076e6\" -font AvantGarde-Demi -pointsize 28 -draw \"text 60,270 'Studygig.com Preview'\" -channel RGBA $output_file ";

								exec($command);

								#Crocdoc upload

								// $response = $this->curl->simple_post(
								// 	'https://crocodoc.com/api/v1/document/upload',
								// 	array('file'  =>"@".$file['file'],
								// 		  'token' => 'yYaBAI95eJxVkPb0Twvh',
								// 		  'title' => $file['name']));

								$ch = curl_init();
							    curl_setopt($ch, CURLOPT_HEADER, 0);
							    curl_setopt($ch, CURLOPT_VERBOSE, 0);
							    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
							    curl_setopt($ch, CURLOPT_URL, "https://crocodoc.com/api/v2/document/upload" );
							    curl_setopt($ch, CURLOPT_POST, true);

							    $post = array(
							        "file"=>"@". $file['file'],
							        "token" => "yYaBAI95eJxVkPb0TwvhoqMi",
							        "private" => "true",
							        "title" => $file['name']
							    );
							    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

							    #Get response from crocdoc
							    $json_response = curl_exec($ch);
							    $response = json_decode($json_response);

							    #Check if upload is successful
							    if (isset($response->uuid)) $uuid = $response->uuid;
							    else {

							    	$uuid = "ERROR";

							    	$data['error'] = "There was an error uploading your document";
									$data['content'] = 'uploads/insert';

									$data['pageTitle'] = 'Post your Study Material on Studygig';
									$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';

									$this->load->view('subTemplate2', $data);

							    }

							    log_message('debug','CROCDOC: '. $json_response. " ". $uuid);

							}
							$this->User->log_user_ip($this->input->post('user_id'),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'],3);
							$data['numOfFiles']=$numOfFiles;

							if ($this->input->post('anon') == 1){
								$data['upload_id']= $this->Upload->add($fileNames,$fileExtensions,$fileSizes,$numOfFiles,true,$uuid);
							}else{
								$data['upload_id']= $this->Upload->add($fileNames,$fileExtensions,$fileSizes,$numOfFiles,false,$uuid);
							}

							$data['material'] = $this->input->post('material');

							# Facebook wall post
							if ($this->input->post('postfb') == 1) {

							$this->curl->simple_post('https://graph.facebook.com/me/feed', array('access_token'=>$this->session->userdata('token'),'link' =>'http://studygig.com' ,'message' => 'I just posted new study material on Studygig, check it out!'));

							}

							$data['pageTitle'] = 'Success - Your Study Material was posted on Studygig';
							$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';
							$this->load->view('subTemplate2', $data);
		        }
        	}
		}else{
			$data['subjects'] = $this->Subject->get_titles();
			//$data['error'] = $this->upload->display_errors();
			$data['content'] = 'uploads/insert';

			$data['pageTitle'] = 'Post your Study Material on Studygig';
			$data['pageDescription'] = 'Find study material, from course books to lecture notes. Join thousands already finding study material and acing their courses. Listing your study material is free!';

			$this->load->view('subTemplate2', $data);
		}
	}


	//Search form
	function index()
	{
		$this->load->helper('date');
		$data['content'] = 'uploads/search';
		$data['latestUploads'] = $this->Upload->latest();
		$data['latestUploads1'] =  array_slice($data['latestUploads'],0, 4);
		$data['latestUploads2'] =  array_slice($data['latestUploads'],4, 4);
		$data['latestUploads3'] =  array_slice($data['latestUploads'],8, 4);
		//print_r($data['latestUploads3']);

		foreach ($data['latestUploads'] as $u => $upload){
	      	$data['latestUploadsUsers'][$u] = $this->Upload->get_uploader($upload->id)->username;
	      	$data['latestUploadsCourses'][$u]  = $this->Upload->get_course_by_id($upload->id);
  	  }

		$data['pageTitle'] = 'Past tests, lecture notes and study guides - Find study material on Studygig';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';

		$this->load->view('template',$data);
	}

	function compare_dates($date1)
    {
    	$date2 = time();

	    $blocks = array(
	        array('name'=>'year','amount'    =>    60*60*24*365    ),
	        array('name'=>'month','amount'    =>    60*60*24*31    ),
	        array('name'=>'week','amount'    =>    60*60*24*7    ),
	        array('name'=>'day','amount'    =>    60*60*24    ),
	        array('name'=>'hour','amount'    =>    60*60        ),
	        array('name'=>'min','amount'    =>    60        )
	        );

	    $diff = abs($date1-$date2);

	    $levels = 2;
	    $current_level = 1;
	    $result = array();
	    foreach($blocks as $block)
	        {
	        if ($current_level > $levels) {break;}
	        if ($diff/$block['amount'] >= 1)
	            {
	            $amount = floor($diff/$block['amount']);
	            if ($amount>1) {$plural='s';} else {$plural='';}
	            $result[] = $amount.' '.$block['name'].$plural;
	            $diff -= $amount*$block['amount'];
	            $current_level++;
	            }
	        }
	    return implode(' ',$result).' ago';
    }

	//Search results
	function search_backup($last_search = "")
	{
		if ($this->input->post('query')) $this->session->set_flashdata('last_search',urldecode($this->input->post('query')));

		$data['query'] = mysql_real_escape_string(trim(str_replace(","," ",$this->input->post('query'))));
		if ($last_search){
			$data['query'] = $last_search;
			$this->session->set_flashdata('last_search',$data['query']);
		}

		$data['uploads'] = $this->Upload->search($data['query'],$_SERVER['REMOTE_ADDR'], $this->input->post('sortResultsBy'),$this->input->post('materialTypeFilter'));

		$data['content'] = 'uploads/results';
		$results =0;
		//$data['totalrows'] = sizeof($data['uploads']);
		$data['totalrows'] = $this->Upload->searchcount($data['query']);
		if (sizeof($data['uploads']) !=0 )
		{
			foreach($data['uploads'] as $k => $upload) {
				$results++;
				$uploadid = $upload->upload_id;
		  		$get_ratings = $this->Upload->get_rating($uploadid);

		  		$ratings[$k]['id'] = $uploadid;
		  		$ratings[$k]['positive'] = $get_ratings['positive'];
		  		$ratings[$k]['negative'] = $get_ratings['negative'];
				$string = $this->Upload->get_subject_by_id($uploadid);
				//$subjects[$k]  = substr($string,0,stripos($string," "));
				$courses[$k]  = $this->Upload->get_course_by_id($uploadid);
				$users[$k] = $this->Upload->get_uploader($uploadid)->username;
				$materials[$k] = $this->Upload->get_material_by_id($uploadid);
			}

			$data['ratings'] = $ratings;
			//$data['subjects'] = $subjects;
			$data['courses'] = $courses;
			$data['users'] = $users;
			$data['materials'] = $materials;
			$data['totalResults'] = $results;
		}
		//echo $this->pagination->create_links();

		$this->load->model('Classified');
		$data['classifieds'] = $this->Classified->search($data['query']);

		$data['pageTitle'] = $data['query'].' - Studygig Search';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';

		$this->load->view('subTemplate', $data);
	}

	function loadmore_backup() {

		$startfrom = $this->input->post('loaded');
		$data['query'] = mysql_real_escape_string(trim(str_replace(","," ",$this->input->post('ajaxquery'))));
		$data['uploads'] = $this->Upload->search($data['query'],$_SERVER['REMOTE_ADDR'],$startfrom);
		$uploads = $data['uploads'];

		$results =0;
		$data['totalrows'] = sizeof($data['uploads']);
		if (sizeof($data['uploads']) !=0 )
		{
			foreach($data['uploads'] as $k => $upload) {
				$results++;

				$uploadid = $upload->upload_id;
		  		$get_ratings = $this->Upload->get_rating($uploadid);


		  		$ratings[$k]['id'] = $uploadid;
		  		$ratings[$k]['positive'] = $get_ratings['positive'];
		  		$ratings[$k]['negative'] = $get_ratings['negative'];
				$string = $this->Upload->get_subject_by_id($uploadid);
				//$subjects[$k]  = substr($string,0,stripos($string," "));
				$courses[$k]  = $this->Upload->get_course_by_id($uploadid);
				$users[$k] = $this->Upload->get_uploader($uploadid)->username;
				$materials[$k] = $this->Upload->get_material_by_id($uploadid);
			}

			$data['ratings'] = $ratings;
			//$data['subjects'] = $subjects;
			$data['courses'] = $courses;
			$data['users'] = $users;
			$data['materials'] = $materials;
			$data['totalResults'] = $results;

		}

		$send = array('uploads'=>$uploads, 'ratings' => $ratings, 'courses' => $courses, 'materials' => $materials, 'users' => $users);

		echo json_encode($send);
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

		$this->load->model('Classified');

		if ($this->session->flashdata('last_search')) $this->session->keep_flashdata('last_search');
		else
		$this->session->set_flashdata('last_search',urldecode($query));

		$data['query'] = urldecode($query);

		$data['results'] = $this->Upload->search( $query,$offset,$this->input->post('sortResultsBy'),$this->input->post('materialTypeFilter'));
		$data['is_upload'] = TRUE;


		foreach($data['results'] as $k => $upload) {

			$uploadid = $upload->upload_id;
			$get_ratings = $this->Upload->get_rating($uploadid);

			$ratings[$k]['id'] = $uploadid;
			$ratings[$k]['positive'] = $get_ratings['positive'];
			$ratings[$k]['negative'] = $get_ratings['negative'];
			$string = $this->Upload->get_subject_by_id($uploadid);
			//$subjects[$k]  = substr($string,0,stripos($string," "));
			$courses[$k]  = $this->Upload->get_course_by_id($uploadid);
			$users[$k] = $this->Upload->get_uploader($uploadid)->username;
			$materials[$k] = $this->Upload->get_material_by_id($uploadid);
		}

		if ($data['results']){
			$data['ratings'] = $ratings;
			//$data['subjects'] = $subjects;
			$data['courses'] = $courses;
			$data['users'] = $users;
			$data['materials'] = $materials;
			//totalResults = $urows;
		}
		$this->load->library('pagination');

		$config['base_url'] = site_url('uploads/search/'.$query);
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

		$config['total_rows'] = $this->Upload->searchcount($query);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$data['crows'] = $this->Classified->searchcount($query);
		$data['urows'] = $this->Upload->searchcount($query);

		$data['content'] = 'uploads/results';
		$data['pageTitle'] = urldecode($query).' - Find study material on Studygig';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';

		$this->load->view('subTemplate',$data);
	}

	function searchfor() {
		$replace = array(';',',');
		$query = mysql_real_escape_string(trim(str_replace($replace," ",$this->input->post('query'))));
		$this->load->model('Classified');


			//log person's ip and query to db
 	$log = array(
			'query' => $query,
			'ip' => $_SERVER['REMOTE_ADDR'],
			);

	$this->db->insert('queries',$log);

			$urows = $this->Upload->searchcount($query);
			$crows = $this->Classified->searchcount($query);

			if ($urows == 0 && $crows == 0){
				redirect(site_url('uploads/search/'.$query),'redirect');
			} else  if  ($urows >= $crows){
				redirect(site_url('uploads/search/'.$query),'redirect');
			}else{
				redirect(site_url('classifieds/search/'.$query),'redirect');
			}
	}

	function getsearchfor($search) {
		$replace = array(';',',');
		$query = mysql_real_escape_string(trim(str_replace($replace," ",$search)));
		$this->load->model('Classified');


			//log person's ip and query to db
 	$log = array(
			'query' => $query,
			'ip' => $_SERVER['REMOTE_ADDR'],
			);

	$this->db->insert('queries',$log);

			$urows = $this->Upload->searchcount($query);
			$crows = $this->Classified->searchcount($query);

			if ($urows == 0 && $crows == 0){
				redirect(site_url('uploads/search/'.$query),'redirect');
			} else  if  ($urows >= $crows){
				redirect(site_url('uploads/search/'.$query),'redirect');
			}else{
				redirect(site_url('classifieds/search/'.$query),'redirect');
			}
	}

	//View a course
	function view($id)
	{
		$this->load->model('Favourite');
		$this->Upload->increment_upload_views($id);

		$data['upload'] = $this->Upload->get_by_id($id);
		$data['content'] = 'uploads/view';
		$data['file_name'] = $data['upload']->filepath;
		$data['file_path'] = 'uploads/materials/'. $data['file_name'];
		$data['file_path_for_images'] = 'uploads/'. $data['file_name'];
		$data['ratings'] = $this->Upload->get_rating($id);
		$data['uploader'] = $this->Upload->get_uploader($id);
		$data['course']  = $this->Upload->get_course_by_id($id);
		$data['favourited'] =  $this->Favourite->is_favourited_by($this->session->userdata('user_id'),$id);
		$data['related'] = false;
		$data['materialType'] = $this->Upload->get_material_by_id($id);
		$data['fileType'] = $data['upload']->filetype;

		//check if upload has related uploads
		if ($data['upload']->related == 1){
			$data['related'] = true;
			$data['moreByUser'] = $this->Upload->get_related($id);
		}

		$data['similarUploads'] = $this->Upload->get_similar($id);
		$data['byUserUploads'] = $this->Upload->get_byUser($id);

		$data['pageTitle'] = substr($data['course'],0,8).' '.htmlspecialchars($data['upload']->title);
		$data['pageDescription'] = $data['course'].'.  '.$data['upload']->description;

		$this->session->keep_flashdata('last_search');

		$this->load->view('subTemplate', $data);
	}

	function download() {

		if ($this->session->userdata('logged_in')) {

		    $this->load->helper('download');
		    $this->load->model('Transaction');
		    $this->load->model('User');

		    # Get the ids
		    $uploadid = $this->input->post('upload_id');
		    $uploader = $this->Upload->get_uploader($uploadid);
		    $uploaderid = $uploader->id;
		    $downloader_id   = $this->session->userdata('user_id');
		    $downloader_name = $this->User->get_username_by_id($downloader_id);

		    #Check if he already has the file
		    $already_has = $this->User->already_has($this->session->userdata('user_id'),$uploadid);

		    # Check if user is a subscriber
		    $this->load->model('Member');
		    $subscriber = $this->Member->is_member($this->session->userdata('user_id'));

		    $data['upload'] = $this->Upload->get_by_id($uploadid);

		    //check if upload is members only
		    if($data['upload']->members == 1){
		    	//check if uploader is a member
		    	if ($subscriber){
		    		# Get the file
			        $data['file'] = $this->_prepare_download($this->input->post('file_path'),
			        										 $this->input->post('file_name'));

			         # Check if transaction is complete
			        if ($this->Transaction->add($this->session->userdata('user_id'),$uploadid,$uploaderid,$already_has,$subscriber)) {
			            $this->load->model('Favourite');

			            $data['upload'] = $this->Upload->get_by_id($uploadid);
			            $data['file_name'] = $data['upload']->filepath;
			            $data['fileType'] = $data['upload']->filetype;

			            //check if image or not
			             if ((strcasecmp($data['fileType'],".jpg") == 0) || (strcasecmp($data['fileType'],".jpeg") == 0) || (strcasecmp($data['fileType'],".gif") == 0) || (strcasecmp($data['fileType'],".png")== 0))
			           	{
			                $data['file_path_for_images'] = 'uploads/'. $data['file_name'];
						}else{
					   	 	 $data['file_path'] = 'uploads/materials/'. $data['file_name'];
					    }

			            $data['ratings'] = $this->Upload->get_rating($uploadid);
			            $data['uploader'] =$uploader;
			            $data['course']  = $this->Upload->get_course_by_id($uploadid);
			            $data['favourited'] =  $this->Favourite->is_favourited_by($this->session->userdata('user_id'),$uploadid);
			            $data['related'] = false;
			            $data['materialType'] = $this->Upload->get_material_by_id($uploadid);


			            //check if upload has related uploads
			            if ($data['upload']->related == 1) {
			                $data['related'] = true;
			                $data['moreByUser'] = $this->Upload->get_related($uploadid);
			            }

			            $data['similarUploads'] = $this->Upload->get_similar($uploadid);
			            $data['byUserUploads'] = $this->Upload->get_byUser($uploadid);

			            // Check for Crocodoc version
			            if ($data['upload']->uuid != NULL) {

				            $ch = curl_init();
						    curl_setopt($ch, CURLOPT_HEADER, 0);
						    curl_setopt($ch, CURLOPT_VERBOSE, 0);
						    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
						    curl_setopt($ch, CURLOPT_URL, "https://crocodoc.com/api/v2/session/create" );
						    curl_setopt($ch, CURLOPT_POST, true);

						    $post = array(
						        "uuid"=> $data['upload']->uuid,
						        "token" => "yYaBAI95eJxVkPb0TwvhoqMi",
						        "downloadable" => "false",
							"editable" => "true",
						        "user" => $downloader_id. ",". $downloader_name
						    );

						    log_message('error','CROCDOC PARAMS: '. json_encode($post));

						    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

						    #Get response from crocdoc
						    $json_response = curl_exec($ch);
						    $response = json_decode($json_response);

						    $data['sessionid'] = $response->session;
						    log_message('error','CROCDOC SESSION ID: '. $response->session);
						}

			            $data['content'] = 'uploads/docview';
			        } else {
			            $data['content'] = 'uploads/error';
			            # Not created yet!
			        }

			        $data['pageTitle'] = htmlspecialchars($data['upload']->title);
			        $data['pageDescription'] = $data['course'].'.  '.$data['upload']->description;

			        $this->load->view('subTemplate', $data);
		    	}else{
		    		//user need to be a member
		    		$data['content'] = 'users/memberdownload';
			        $data['pageTitle'] = "Become a Member to Download This Document";
			        $data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
			        $this->load->view('subTemplate', $data);
	    		}
		    }else{
			    if ($this->User->can_download($this->session->userdata('user_id')) or $subscriber) {
			        # Get the file
			        $data['file'] = $this->_prepare_download($this->input->post('file_path'),
			        										 $this->input->post('file_name'));


			        # Check if transaction is complete
			        if ($this->Transaction->add($this->session->userdata('user_id'),$uploadid,$uploaderid,$already_has,$subscriber)) {
			            $this->load->model('Favourite');

			            $data['upload'] = $this->Upload->get_by_id($uploadid);
			            $data['file_name'] = $data['upload']->filepath;
			            $data['fileType'] = $data['upload']->filetype;

			            //check if image or not
			             if ((strcasecmp($data['fileType'],".jpg") == 0) || (strcasecmp($data['fileType'],".jpeg") == 0) || (strcasecmp($data['fileType'],".gif") == 0) || (strcasecmp($data['fileType'],".png")== 0))
			           	{
			                $data['file_path_for_images'] = 'uploads/'. $data['file_name'];
						}else{
					   	 	 $data['file_path'] = 'uploads/materials/'. $data['file_name'];
					    }

			            $data['ratings'] = $this->Upload->get_rating($uploadid);
			            $data['uploader'] =$uploader;
			            $data['course']  = $this->Upload->get_course_by_id($uploadid);
			            $data['favourited'] =  $this->Favourite->is_favourited_by($this->session->userdata('user_id'),$uploadid);
			            $data['related'] = false;
			            $data['materialType'] = $this->Upload->get_material_by_id($uploadid);


			            //check if upload has related uploads
			            if ($data['upload']->related == 1) {
			                $data['related'] = true;
			                $data['moreByUser'] = $this->Upload->get_related($uploadid);
			            }

			            $data['similarUploads'] = $this->Upload->get_similar($uploadid);
			            $data['byUserUploads'] = $this->Upload->get_byUser($uploadid);

			            // Check for Crocodoc version
			            if ($data['upload']->uuid != NULL) {

				            $ch = curl_init();
						    curl_setopt($ch, CURLOPT_HEADER, 0);
						    curl_setopt($ch, CURLOPT_VERBOSE, 0);
						    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
						    curl_setopt($ch, CURLOPT_URL, "https://crocodoc.com/api/v2/session/create" );
						    curl_setopt($ch, CURLOPT_POST, true);

						    $post = array(
							"uuid"=> $data['upload']->uuid,
                                                        "token" => "yYaBAI95eJxVkPb0TwvhoqMi",
                                                        "downloadable" => "false",
                                                        "editable" => "true",
                                                        "user" => $downloader_id. ",". $downloader_name
						    );

						    log_message('error','CROCDOC PARAMS: '. json_encode($post));

						    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

						    #Get response from crocdoc
						    $json_response = curl_exec($ch);
						    $response = json_decode($json_response);

						    $data['sessionid'] = $response->session;
						    log_message('error','CROCDOC SESSION ID: '. $response->session);
						}

			            $data['content'] = 'uploads/docview';
			        } else {
			            $data['content'] = 'uploads/error';
			            # Not created yet!
			        }

			        $data['pageTitle'] = htmlspecialchars($data['upload']->title);
			        $data['pageDescription'] = $data['course'].'.  '.$data['upload']->description;

			        $this->load->view('subTemplate', $data);
			    } else {
			        // check if the user is trying to dl their own upload


			        $data['content'] = 'users/notenough';
			        $data['pageTitle'] = "Oh dear, you don't have enough points!";
			        $data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';

			        $this->load->view('subTemplate', $data);
			    }
	    	}
		} else {
		    $data['content'] = 'users/signup';

		$data['pageTitle'] = 'Create an Account on Studygig';
		$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';
		$this->load->view('subTemplate2', $data);
		}

	}

	function _prepare_download($path, $name) {
		$data['path'] = $path;
		$data['name'] = $name;

		return $data;
	}

	function favourite($courseid) {

		$this->load->model('Favourite');
		$this->Favourite->add($this->session->userdata('user_id'),$courseid);

		redirect('uploads/view/'. $courseid,'refresh');
	}

	function unfavourite($courseid) {

		$this->load->model('Favourite');
		$this->Favourite->remove($this->session->userdata('user_id'),$courseid);

		redirect('uploads/view/'. $courseid,'refresh');
	}

	function emailSignup(){
	$email = $this->input->post('email');
  		if (!empty($email))
		{
					if(filter_var($email, FILTER_VALIDATE_EMAIL))
					{
						$this->Upload->addEmailSignUp();
						echo "The email has been signed up.";
					}else{
						echo "The email is not valid.";
					}
		}
			else
		{
				echo "Please type in an email.";
		}
  }


  function requestStudyMaterial(){
  	if ($this->session->userdata('logged_in'))
		{
					$this->Upload->addStudyMaterialRequest();
					echo "You have requested study material for this search.  Other students will see this and share their study material - be sure to check back soon.";
		}
			else
		{
			echo '<a href="../users/signup">Register</a> or <a href="../users/login">Login</a> to request study material.';
		}
  }

  function convert_line_breaks($string, $line_break=PHP_EOL) {
    $patterns = array(
                        "/(<br>|<br \/>|<br\/>)\s*/i",
                        "/(\r\n|\r|\n)/"
    );
    $replacements = array(
                            PHP_EOL,
                            $line_break
    );
    $string = preg_replace($patterns, $replacements, $string);
    return $string;
  }

  function edit($id) {

  	if( $this->Upload->get_uploader($id)->id == $this->session->userdata('user_id'))
  		{
		 	$this->load->model('Subject');
		  	$data['upload'] = $this->Upload->get_by_id($id);
		  	$data['subjects'] = $this->Subject->get_titles();
		  	$data['upload_id'] = $id;

		  	$data['content'] = 'uploads/edit';
		  	$data['pageTitle'] = 'Edit study material';
			$data['pageDescription'] = 'Need a past test to help you study? Or a note for a missed class?  Studygig is a search engine for university students to find study material such as past tests and lecture notes.';

			$this->load->view('subTemplate2', $data);
		}
		else
		{
			echo "You can't edit other people's stuff";
		}
  }

  function update() {

  	$this->Upload->update($this->input->post('upload_id'));
  	redirect(site_url('users/dashboard'),'refresh');
  }

  function delete($id) {
  	if( $this->Upload->get_uploader($id)->id == $this->session->userdata('user_id'))
  	 {
  	 	$this->Upload->delete($id);
  	 	redirect(site_url('users/dashboard'),'refresh');
  	 }
  	 else
  	 {
	 	echo "You can't delete other people's stuff!";
	 }
  }
}
