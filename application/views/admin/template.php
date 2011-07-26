<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Studygig Admin Panel</title>
	<?php
	
	$link = array(
          'href' => 'css/style.css',
          'rel' => 'stylesheet',
          'type' => 'text/css',
          'media' => 'screen'
	);
	
	echo link_tag($link);
	$link = array(
          'href' => 'css/styleAdmin.css',
          'rel' => 'stylesheet',
          'type' => 'text/css',
          'media' => 'screen'
	);

	echo link_tag($link);
	$link = array(
          'href' => 'css/jquerycss.css',
          'rel' => 'stylesheet',
          'type' => 'text/css',
          'media' => 'screen'
	);

	echo link_tag($link);
	
	$link = array(
          'href' => 'css/styleAdminUpload.css',
          'rel' => 'stylesheet',
          'type' => 'text/css',
          'media' => 'screen'
	);
	echo link_tag($link);
	
	$link = array(
          'href' => 'css/chosen.css',
          'rel' => 'stylesheet',
          'type' => 'text/css',
          'media' => 'screen'
	);

	echo link_tag($link);
	
	?>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>

<script type="text/javascript" language="JavaScript">
 $(function() {
		$( "#tabs" ).tabs();
	});

</script>

</head>
	<body>
	<div id="wrapper">
		 
    <!-- end header div -->		
	<?php $this->load->view($content); ?>
	
	
	
	<div id="footer">
  	<div id="seperator">
  	</div>
   	
   
    
    <div class="clear">
    </div>
    
    <div id="footerText">
    <ul class="horiList">
     <li><a href="http://development.studygig.com">development.studygig.com</a></li>
     <li><a href="https://studygig.basecamphq.com">Studygig Basecamp</a></li>
     <?php if($this->session->userdata('is_moderator') == 1):?>
     <li><a href="<?php echo site_url('admin/logout'); ?>">Logout</a></li>
     <?php endif;?>
    </ul>
    <br/>
    Be sure to like all of our stuff on: <a href="http://www.facebook.com/studygig" title="Like Studygig on Facebook">Facebook</a> & <a href="http://twitter.com/studygig" title="Follow Studygig on Twitter">Twitter</a>
    <br/>
    Copyright © 2011 Studygig.   
  	
  </div><!-- end footer div -->
	
</div><!-- end wrapper div -->

	</body>
</html>
