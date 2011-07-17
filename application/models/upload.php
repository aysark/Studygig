<?php

class Upload extends CI_Model {

  function __construct()
    {
        parent::__construct();
    }
    
  function latest() {
  	$this->db->order_by("created_at", "desc"); 
  	$query = $this->db->get('uploads',10);
  	return $query->result();
  } 
  
  function get_by_id($id) {
  	$this->db->where('id', $id);
  	$query = $this->db->get('uploads');
  	
  	return $query->row();
  
  }
  
  function get_subject_by_id($id) {
    $this->db->where('id', $id);
    $query  = $this->db->get('uploads');
    $row = $query->row();
    
    $subject_id = $row->subject_id;
    
    $this->db->where('id', $subject_id);
    $query2 = $this->db->get('subjects');
    $subject = $query2->row();
    
    return $subject->title;
  }
  
  function get_course_by_id($id) {
    $this->db->where('id', $id);
    $query  = $this->db->get('uploads');
    $row = $query->row();
    
    $course_id = $row->course_id;
    
    $this->db->where('id', $course_id);
    $query2 = $this->db->get('courses');
    $course = $query2->row();
    
    return $course->course_title;
  }
  
  function get_material_by_id($id) {
    $upload = $this->get_by_id($id);
    return $upload->material;
  }
  
  function get_uploader($id) {
  	$upload = $this->get_by_id($id);
  	
  	$this->db->where('id', $upload->user_id );
  	$query = $this->db->get('users');
  	return $query->row();
  }
  
  function get_rating($id) {
  	$this->db->where('upload_id',$id);
  	$this->db->where('type',1);
  	$this->db->from('ratings');
  	$positive = $this->db->count_all_results();
  	
  	$this->db->where('upload_id',$id);
  	$this->db->from('ratings');
  	$negative = $this->db->count_all_results() - $positive;
  	
  	$ratings = array(
  	'positive' => $positive,
  	'negative' => $negative
  	);
  	
  	return $ratings;
  }
  
  function get_related($id){
  	$upload = $this->get_by_id($id);
  	
  	$this->db->where('created_at',$upload->created_at);
  	$this->db->where('related',1);
  	$this->db->where('user_id',$upload->user_id);
  	$this->db->where_not_in('id',$upload->id);
  	$query = $this->db->get('uploads');
  	
  	return $query->result();
  }
  
  function get_similar($id){
  	$upload = $this->get_by_id($id);
  	
  	$this->db->where('course_id',$upload->course_id);
  	$this->db->where('material',$upload->material);
  	$this->db->where_not_in('id',$id);
  	$this->db->where_not_in('related',1);
 
  	
  	$query = $this->db->get('uploads',5);
  	
  	return $query->result();
  }
  
  function get_byUser($id){
  	$upload = $this->get_by_id($id);
  	
  	$this->db->where('user_id',$upload->user_id);
  	$this->db->where_not_in('id',$id);
  	$this->db->where_not_in('created_at',$upload->created_at);
 
  	$query = $this->db->get('uploads',5);
  	return $query->result();
  }
 
  
  function add($paths,$types,$sizes,$numOfFiles,$anon ) {
  	if($anon){
  		$userid = 1;
  	}else{
  		$userid=$this->input->post('user_id');
  	}
  	
  	$this->load->model('Course');
  	$material = $this->input->post('material');
  	
  	if ($numOfFiles > 1){
  		$title =  mysql_real_escape_string(trim($this->input->post('title')));
  		$courseid = $this->input->post('course_id');
  		$subjectid = $this->input->post('subject_id');
  		$description =  mysql_real_escape_string(trim($this->input->post('description')));
  		
  		$pathArray = explode(" ", $paths);
		$typesArray = explode(",", $types);
		$sizesArray = explode(",", $sizes);

		for ($i=0; $i < $numOfFiles; $i++){
			$newcourse = array(
			'title' => trim($title)." (". ($i+1)."/$numOfFiles)",
			'course_id' => $courseid,
			'subject_id' => $subjectid,
			'filepath' => strtolower($pathArray[$i]),
			'description' => $description,
			'material' => $material,
			'user_id' => $userid,
			'filetype' => strtolower($typesArray[$i]),
			'filesize' => $sizesArray[$i],
			'related' => 1
			);
			
			$this->db->insert('uploads',$newcourse);
			$lastid= mysql_insert_id();
		}
  	}else{ 
  			$pathArray = explode(" ", $paths);
			$typesArray = explode(",", $types);
			$sizesArray = explode(",", $sizes);
			$title =  mysql_real_escape_string(trim($this->input->post('title')));
			$description =  mysql_real_escape_string(trim($this->input->post('description')));
			$courseid = $this->input->post('course_id');
			$newcourse = array(
			'title' => $title,
			'course_id' => $courseid,
			'subject_id' => $this->input->post('subject_id'),
			'filepath' => strtolower($pathArray[0]),
			'description' => $description,
			'material' => $material,
			'user_id' => $userid,
			'filetype' => strtolower($typesArray[0]),
			'filesize' => $sizesArray[0],
			'related' => 0  			 
			);
		
			$this->db->insert('uploads',$newcourse);
			$lastid= mysql_insert_id();
  	}
  	
	
	#Add points for the uploader	
	
	$this->db->where('id',$this->input->post('user_id'));
	if ($sizes == -1){
		if ($material == 0){
			$this->db->set('points', 'points+15', FALSE);
		}else if ($material == 1){
			$this->db->set('points', 'points+5', FALSE);
		}else if ($material == 2){
			$this->db->set('points', 'points+5', FALSE);
		}else if ($material == 3){
			$this->db->set('points', 'points+3', FALSE);
		}else if ($material == 4){
			$this->db->set('points', 'points+3', FALSE);
		}else if ($material == 5){
			$this->db->set('points', 'points+3', FALSE);
		}else{
			$this->db->set('points', 'points+1', FALSE);
		}
	}else{
		if ($material == 0){
			$this->db->set('points', 'points+20', FALSE);
		}else if ($material == 1){
			$this->db->set('points', 'points+15', FALSE);
		}else if ($material == 2){
			$this->db->set('points', 'points+10', FALSE);
		}else if ($material == 3){
			$this->db->set('points', 'points+5', FALSE);
		}else if ($material == 4){
			$this->db->set('points', 'points+5', FALSE);
		}else if ($material == 5){
			$this->db->set('points', 'points+5', FALSE);
		}else{
			$this->db->set('points', 'points+1', FALSE);
		}
	}
	$this->db->update('users'); 
	return $lastid;
	
}

function searchcount($search){
  
    $query = "SELECT *, U.id AS upload_id, U.title AS upload_title  FROM uploads AS U LEFT JOIN courses AS C ON U.Course_id = C.Id LEFT JOIN subjects_shortform AS S ON U.Subject_id = S.Id WHERE MATCH(U.title, U.description, U.filepath) AGAINST('$search' IN NATURAL LANGUAGE MODE) OR MATCH(C.course_title) AGAINST('$search' IN NATURAL LANGUAGE MODE) OR MATCH(S.subject_shortform_title) AGAINST('$search' IN NATURAL LANGUAGE MODE)";

    $q = $this->db->query($query);
    $numresults =$q->num_rows();
    return $numresults;
  }
  
  function search($search,$offset = 0,$sortResults=0, $materialTypeFilter=null) {  	
				
	
 	# apply a material type filter if there was one applied
 	if (!empty($materialTypeFilter)){
 			$subquery ="( ";
 			$length =count($materialTypeFilter);
 			$i=0;
	 		foreach($materialTypeFilter as $mt) {
		 		if ($mt == 1){
					$subquery .=" U.material = 0 ";
			 	}else if ($mt == 2){
					$subquery .=" U.material = 1 ";
			 	}else if ($mt == 3){
					$subquery .=" U.material = 2 ";
			 	}else if ($mt == 4){
					$subquery .=" U.material = 3 ";
			 	}else if ($mt == 5){
					$subquery .=" U.material = 4 ";
			 	}else if ($mt == 6){
					$subquery .=" U.material = 5 ";
			 	}else{
					$subquery .=" U.material = 6 ";
			 	}
			 	
			 	if ($i == $length-1){
			 		$subquery .= " ) AND ";
			 	}else{
			 		$subquery .= " OR ";
			 	}
			 	$i++;
		 }
 
  		
  		$query = "SELECT *, U.id AS upload_id, U.title AS upload_title  FROM uploads AS U LEFT JOIN courses AS C ON U.Course_id = C.Id LEFT JOIN subjects_shortform AS S ON U.Subject_id = S.Id WHERE $subquery MATCH(U.title, U.description, U.filepath) AGAINST('$search' IN NATURAL LANGUAGE MODE) OR $subquery MATCH(C.course_title) AGAINST('$search' IN NATURAL LANGUAGE MODE) OR $subquery MATCH(S.subject_shortform_title) AGAINST('$search' IN NATURAL LANGUAGE MODE)";
 	}else{
 		$query = "SELECT *, U.id AS upload_id, U.title AS upload_title  FROM uploads AS U LEFT JOIN courses AS C ON U.Course_id = C.Id LEFT JOIN subjects_shortform AS S ON U.Subject_id = S.Id WHERE MATCH(U.title, U.description, U.filepath) AGAINST('$search' IN NATURAL LANGUAGE MODE) OR MATCH(C.course_title) AGAINST('$search' IN NATURAL LANGUAGE MODE) OR MATCH(S.subject_shortform_title) AGAINST('$search' IN NATURAL LANGUAGE MODE)";
 	}

 	
 	if ($sortResults == 0){
 		$query .= " ORDER BY
								((SELECT COUNT(type) FROM `uploads`
								LEFT JOIN `ratings`
								ON ratings.upload_id = uploads.id
								WHERE ratings.type = 1 AND uploads.id = U.id) - 
								(SELECT COUNT(type) FROM `uploads`
								LEFT JOIN `ratings`
								ON ratings.upload_id = uploads.id
	WHERE ratings.type = 0 AND uploads.id = U.id)) DESC, views DESC"; 	  
 	}else if ($sortResults == 1){
 		$query .= " ORDER BY views DESC"; 	  
 	}else if ($sortResults == 2){
 		$query .= " ORDER BY ((SELECT COUNT(type) FROM `uploads`
								LEFT JOIN `ratings`
								ON ratings.upload_id = uploads.id
								WHERE ratings.type = 1 AND uploads.id = U.id) - 
								(SELECT COUNT(type) FROM `uploads`
								LEFT JOIN `ratings`
								ON ratings.upload_id = uploads.id
	WHERE ratings.type = 0 AND uploads.id = U.id)) DESC"; 
 	}else if ($sortResults == 3){
 		$query .= " ORDER BY ((SELECT COUNT(type) FROM `uploads`
								LEFT JOIN `ratings`
								ON ratings.upload_id = uploads.id
								WHERE ratings.type = 1 AND uploads.id = U.id) - 
								(SELECT COUNT(type) FROM `uploads`
								LEFT JOIN `ratings`
								ON ratings.upload_id = uploads.id
	WHERE ratings.type = 0 AND uploads.id = U.id)) ASC"; 
 	}else if ($sortResults == 4){
 		$query .= " ORDER BY created_at DESC"; 	 
 	}
 	
 	$query .= " LIMIT $offset, 10";
								
  	
  	# Query is sorted by calculating the positive - negative ratings and ordering descending.
  	$query_final = $this->db->query($query);  	
  	return $query_final->result();
  	
  	  
  }  
  
  function addStudyMaterialRequest(){
  	if ($this->Upload->findStudyMaterialRequest($this->input->post('query'))) {
			// this search term has been previously requested, just add 1 to # of requests
			$this->db->where('query',$this->input->post('query'));
			$this->db->set('requests', 'requests+1', FALSE);
			$this->db->update('studymaterial_requests'); 
			
		}else{
			$newrating = array(	
			'query' => $this->input->post('query'),
			'requests' => 1,
			);
	
			$this->db->insert('studymaterial_requests',$newrating);
		}
  }
  
  function findStudyMaterialRequest($query){
  	$this->db->where('query',$query);
  	$query = $this->db->get('studymaterial_requests');
  	
  	if ($query->num_rows() >= 1)
  		return TRUE;
  	else
  		return FALSE;
  }
  
  function increment_upload_views($id){
  	$this->db->where('id',$id);
  	$this->db->set('views', 'views+1', FALSE);
	$this->db->update('uploads'); 
  	
  }
  
  function check_if_duplicate_url($url){
    $this->db->where('filepath',$url);
  	$query = $this->db->get('uploads');
  	
  	if ($query->num_rows() >= 1)
  		return FALSE;
  	else
  		return TRUE;
  	
  }

  function get_inactive() {
    $this->db->where('active',0);
    return $this->db->get('uploads')->result();
  }

  function approve($id) {
    $this->db->where('id',$id);
    $this->db->set('active',1);
    $this->db->update('uploads');
  } 
  
  function get_total_uploads() {
		$query = $this->db->get('uploads');
		return count($query->result());
	}

}
