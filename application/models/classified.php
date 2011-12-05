<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classified extends CI_Model {


		function clean() {
			# change active to 0 where created_at more than 60 days ago
			$query = "UPDATE classifieds
				  SET active = '0'
				  WHERE DATE_SUB(CURDATE(), INTERVAL 1 DAY) >= created_at";
			$this->db->query($query);
		}

		function add($title,$description,$subject_id,$course_id,$material,$price) {
		
			$newclassified = array(
						'title' => $title,
						'description' => $description,
						'subject_id' => $subject_id,
						'course_id' => $course_id,
						'user_id' => $this->session->userdata('user_id'),
						'material' => $material,
						'price' => $price
			);
			
			$this->db->insert('classifieds',$newclassified);
			$lastid= mysql_insert_id();
			return $lastid;
		}
		
		function get_all() {
			$this->db->where('active','1');
			$query = $this->db->get('classifieds');
			return $query->result();		
		}
		
		function get_recent($limit) {
			$this->db->where('active','1');
			$this->db->order_by("created_at", "desc"); 
			$query = $this->db->get('classifieds',$limit);
			return $query->result();		
		}

		function get_seller_by_id($id) {
			$this->db->where('id',$id);
			$query = $this->db->get('classifieds');

			return $query->row();
		}
		
		function search($search,$offset = 0,$sortResults=0, $materialTypeFilter=null) {
			# apply a material type filter if there was one applied
	 		if (!empty($materialTypeFilter)){
	 			$subquery ="( ";
	 			$length =count($materialTypeFilter);
	 			$i=0;
		 		foreach($materialTypeFilter as $mt) {
			 		if ($mt == 8){
						$subquery .=" CL.material = 7 ";
				 	}else if ($mt == 9){
						$subquery .=" CL.material = 1 ";
				 	}else if ($mt == 10){
						$subquery .=" CL.material = 5 ";
				 	}else if ($mt == 11){
						$subquery .=" CL.material = 8 ";
				 	}else{
						$subquery .=" CL.material = 6 ";
				 	}
				 	
				 	if ($i == $length-1){
				 		$subquery .= " ) AND ";
				 	}else{
				 		$subquery .= " OR ";
				 	}
				 	$i++;
			 }
	 
  		
  		$query = "SELECT *, CL.id AS classified_id, CL.title AS classified_title  
				  FROM classifieds AS CL
				  LEFT JOIN courses AS C ON CL.course_id = C.Id
				  LEFT JOIN subjects_shortform AS S ON CL.subject_id = S.Id
				  WHERE $subquery MATCH(CL.title, CL.description) AGAINST('$search' IN NATURAL LANGUAGE MODE)
				  OR $subquery MATCH(C.course_title) AGAINST('$search' IN NATURAL LANGUAGE MODE)
				  OR $subquery MATCH(S.subject_shortform_title) AGAINST('$search' IN NATURAL LANGUAGE MODE)";
 	}else{
 		$query = "SELECT *, CL.id AS classified_id, CL.title AS classified_title  
				  FROM classifieds AS CL
				  LEFT JOIN courses AS C ON CL.course_id = C.Id
				  LEFT JOIN subjects_shortform AS S ON CL.subject_id = S.Id
				  WHERE MATCH(CL.title, CL.description) AGAINST('$search' IN NATURAL LANGUAGE MODE)
				  OR MATCH(C.course_title) AGAINST('$search' IN NATURAL LANGUAGE MODE)
				  OR MATCH(S.subject_shortform_title) AGAINST('$search' IN NATURAL LANGUAGE MODE)";
 	}
			
	if ($sortResults == 0){
 		$query .= " ORDER BY created_at DESC"; 	  //newest
 	}else if ($sortResults == 1){
 		$query .= " ORDER BY views DESC"; 	  //most views
 	}else if ($sortResults == 2){ //lowest price
 		$query .= " ORDER BY price DESC"; 
 	}else if ($sortResults == 3){ //highest price
 		$query .= " ORDER BY price ASC"; 
 	}
 	
 	$query .= " LIMIT $offset, 10";
		                  
		  	$query_final = $this->db->query($query);  	
		  	return $query_final->result();
			
		}
		
	function searchAll($offset = 0,$sortResults=0, $materialTypeFilter=null) {

 		$query = "SELECT *, CL.id AS classified_id, CL.title AS classified_title  
				  FROM classifieds AS CL
				  LEFT JOIN courses AS C ON CL.course_id = C.Id
				  LEFT JOIN subjects_shortform AS S ON CL.subject_id = S.Id
				 ";
 		$query .= " ORDER BY created_at DESC"; 	  //newest
 	
 	$query .= " LIMIT $offset, 10";
		                  
		  	$query_final = $this->db->query($query);  	
		  	return $query_final->result();
			
		}

		function searchcount($search) {
			
			$query = "SELECT *, CL.id AS classified_id, CL.title AS classified_title  
				  FROM classifieds AS CL
				  LEFT JOIN courses AS C ON CL.course_id = C.Id
				  LEFT JOIN subjects_shortform AS S ON CL.subject_id = S.Id
				  WHERE MATCH(CL.title, CL.description) AGAINST('$search' IN NATURAL LANGUAGE MODE)
				  OR MATCH(C.course_title) AGAINST('$search' IN NATURAL LANGUAGE MODE)
				  OR MATCH(S.subject_shortform_title) AGAINST('$search' IN NATURAL LANGUAGE MODE)";
		                  
		  	 $q = $this->db->query($query);
			 $numresults =$q->num_rows();			  
			 return $numresults;			
		}
		
		
		function get_by_id($id) {
				
				$this->db->where('id', $id);
				$query = $this->db->get('classifieds');				
				return $query->row();			  
		}
		
		function get_uploader($id) {
				$classified = $this->get_by_id($id);	
				$this->db->where('id', $classified->user_id );
				$query = $this->db->get('users');
				return $query->row();
		}
		
		function get_course_by_id($id) {
				
				$this->db->where('id', $id);
				$query  = $this->db->get('classifieds');
				$row = $query->row();
		
				$course_id = $row->course_id;
				
				$this->db->where('id', $course_id);
				$query2 = $this->db->get('courses');
				$course = $query2->row();
				
				return $course->course_title;
		}
	      
		function get_material_by_id($id) {
				
				$classified = $this->get_by_id($id);
				return $classified->material;
		}
		
		function get_similar($id){
  	$upload = $this->get_by_id($id);
  	
  	$this->db->where('course_id',$upload->course_id);
  	$this->db->where('material',$upload->material);
  	$this->db->where_not_in('id',$id);
 
  	$query = $this->db->get('classifieds',5);
  	
  	return $query->result();
  }
  
  function get_byUser($id){
  	$upload = $this->get_by_id($id);
  	
  	$this->db->where('user_id',$upload->user_id);
  	$this->db->where_not_in('id',$id);
  	$this->db->where_not_in('created_at',$upload->created_at);
 
  	$query = $this->db->get('classifieds',5);
  	return $query->result();
  }
		
	function increment_listing_views($id){
  			$this->db->where('id',$id);
  			$this->db->set('views', 'views+1', FALSE);
			$this->db->update('classifieds'); 
 	 }
 	 
 	 function addSellerMessage() {
 	 
		$new = array(	
			'message' => mysql_real_escape_string(trim($this->input->post('message'))),
			'listing_id'=> $this->input->post('listing_id'),
			'user_id'=> $this->session->userdata('user_id')	
		);
	
		$this->db->insert('classifieds_messages',$new);
	}
	
	function get_total_classifieds() {
		$query = $this->db->get('classifieds');
		return count($query->result());
	}

	function get_inactive() {
    	$this->db->where('active','0');
    	return $this->db->get('classifieds')->result();
  	}
 		
	function approve($id) {
    	$this->db->where('id',$id);
    	$this->db->set('active','1');
    	$this->db->update('classifieds');
  	}

  	function reject($id) {
  		$this->db->where('id',$id);
  		$this->db->delete('classifieds');
  	}

  	function update($id) {
		$this->db->where('id',$id);
		$newclassified = array(
						'title' => $this->input->post('title'),
						'description' => $this->input->post('description'),
						'subject_id' => $this->input->post('subject_id'),
						'course_id' => $this->input->post('course_id'),
						'user_id' => $this->session->userdata('user_id'),
						'material' => $this->input->post('material'),
						'price' => $this->input->post('price')
			);
		$this->db->set($newclassified);
		$this->db->update('classifieds');	  		
  	}

  	function delete($id) {
  		$this->db->where('id',$id);
  		$inactive_classified = array('active' => '0');
  		$this->db->update('classifieds',$inactive_classified);
  	}
}		
