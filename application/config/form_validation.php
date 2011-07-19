<?php

$config = array(
			'login' =>  array(  array(
                     'field'   => 'email',
                     'label'   => 'email',
                     'rules'   => 'required|valid_email'
                  ),
                  	array(
                     'field'   => 'password',
                     'label'   => 'password',
                     'rules'   => 'required|min_length[5]'
                  )),
             'signup' =>  array(  array(
                     'field'   => 'email',
                     'label'   => 'email',
                     'rules'   => 'required|valid_email|callback_email_unique|callback_ends_with_yorku'
                  ),
                  	array(
                     'field'   => 'username',
                     'label'   => 'username',
                     'rules'   => 'required|alpha_numeric|min_length[5]|callback_username_unique'
                  ),
               			array(
                     'field'   => 'password',
                     'label'   => 'password',
                     'rules'   => 'required|min_length[5]'
              	    )),
           'passreset' =>  array(  array(
                     'field'   => 'email',
                     'label'   => 'email',
                     'rules'   => 'required|valid_email'
                  )),
        	'emailreset' =>  array(  array(
                     'field'   => 'email',
                     'label'   => 'email',
                     'rules'   => 'required|valid_email'
                  )),
          'upload' =>  array(  array(
                     'field'   => 'title',
                     'label'   => 'title',
                     'rules'   => 'required|min_length[3]|max_length[60]'
                  ),
                  	 array(
                     'field'   => 'subject_id',
                     'label'   => 'subject',
                     'rules'   => 'required'
                  ),
                  	array(
                     'field'   => 'course_id',
                     'label'   => 'course',
                     'rules'   => 'required'
                  ),
                  	array(
                     'field'   => 'material',
                     'label'   => 'material',
                     'rules'   => 'required'
                  ),
                  	array(
                     'field'   => 'description',
                     'label'   => 'description',
                     'rules'   => 'required|min_length[10]'
                  ),
                  array(
                     'field'   => 'uploadType',
                     'label'   => 'upload type',
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'uploadLink',
                     'label'   => 'upload link',
                     'rules'   => 'min_length[10]'
                  )	 ),
	'adminUpload' =>  array(  array(
                     'field'   => 'title',
                     'label'   => 'title',
                     'rules'   => 'required|min_length[3]|max_length[60]'
                  ),
                  	 array(
                     'field'   => 'subject_id',
                     'label'   => 'subject',
                     'rules'   => 'required'
                  ),
                  	array(
                     'field'   => 'course_id',
                     'label'   => 'course',
                     'rules'   => 'required'
                  ),
                  	array(
                     'field'   => 'material',
                     'label'   => 'material',
                     'rules'   => 'required'
                  ),
                  	array(
                     'field'   => 'description',
                     'label'   => 'description',
                     'rules'   => 'required|min_length[10]'
                  ) ),
	'list' =>  array(  array(
                     'field'   => 'title',
                     'label'   => 'title',
                     'rules'   => 'required|min_length[3]|max_length[60]'
                  ),
                  	 array(
                     'field'   => 'subject_id',
                     'label'   => 'subject',
                     'rules'   => 'required'
                  ),
                  	array(
                     'field'   => 'course_id',
                     'label'   => 'course',
                     'rules'   => 'required'
                  ),
                  	array(
                     'field'   => 'material',
                     'label'   => 'material',
                     'rules'   => 'required'
                  ),
                 	array(
                     'field'   => 'price',
                     'label'   => 'price',
                     'rules'   => 'required|is_natural'
                  ),
                  	array(
                     'field'   => 'description',
                     'label'   => 'description',
                     'rules'   => 'required|min_length[10]'
                  ) ),
            'editprofile' =>  array(  
                  array(
                     'field'   => 'email',
                     'label'   => 'email',
                     'rules'   => 'valid_email|callback_email_unique_or_same'
                  ),
            	array(
                     'field'   => 'currentpassword',
                     'label'   => 'current password',
                     'rules'   => 'required|callback_validate_password'
              	    ),
              	    
              	    array(
                     'field'   => 'newpassword',
                     'label'   => 'new password',
                     'rules'   => 'required|matches[confirmnewpassword]'
              	    ),
              	    array(
                     'field'   => 'confirmnewpassword',
                     'label'   => 'confirm new password',
                     'rules'   => 'required|min_length[5]'
              	    )),
             'contact' =>  array(  
                  array(
                     'field'   => 'email',
                     'label'   => 'email',
                     'rules'   => 'required|valid_email'
                  ),
            	array(
                     'field'   => 'message',
                     'label'   => 'message',
                     'rules'   => 'required'
              	    ),
              	    
              	    array(
                     'field'   => 'name',
                     'label'   => 'name',
                     'rules'   => 'required'
              	    ),
              	    array(
                     'field'   => 'category',
                     'label'   => 'category',
                     'rules'   => 'required'
              	    )) 
            );
