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
<link href="/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script> 

<script type="text/javascript" language="JavaScript">
 $(function() {
		$("#logoutbtn").button();
	});

</script>

</head>
	<body>
	<div id="wrapper">
		
	<?php if($this->session->userdata('is_moderator') == 1):?>
     	<a href="<?php echo site_url('admin/logout'); ?>" id="logoutbtn">Logout</a>
     <?php endif;?>
    <!-- end header div -->		
	<?php $this->load->view($content); ?>
	
	
	
	<div id="footer">
  	<div id="seperator">
  	</div>
   	
   
    
    <div class="clear">
    </div>
    
    <div id="footerText">
	<?php if($this->session->userdata('is_moderator') == 1):?>
    <ul class="horiList">
     <li><a href="http://development.studygig.com">dev.studygig</a></li>
     <li><a href="https://studygig.basecamphq.com">Basecamp</a></li>
     <li><a href="https://pp.pingdom.com/index.php/member/default">Pingdom</a></li>
     <li><a href="https://rpm.newrelic.com">Newrelic</a></li>
     <li><a href="https://64.207.156.202:4643/vz/cp">Parallels Container</a></li>
     <li><a href="http://bitly.com/u/studygig">Bit.ly</a></li>
     <li><a href="http://feedburner.google.com/fb/a/myfeeds">Classifieds Feedburner</a></li>
     <li><a href="http://app.dlvr.it/deliveries">Dlvr.it</a></li>
     <li><a href="http://mixpanel.com/report/22823/stream/#users">Mixpanel</a></li>
     <li><a href="https://mailgun.net/cp">Mailgun</a></li>
     <li><a href="http://www.meatspy.com/patterns">Meatspy</a></li>
      <li><a href="http://www.meatspy.com/patterns">Meatspy</a></li>
    </ul>
      <?php endif;?>
    <br/>
    Be sure to like all of our stuff on: <a href="http://www.facebook.com/studygig" title="Like Studygig on Facebook">Facebook</a> & <a href="http://twitter.com/studygig" title="Follow Studygig on Twitter">Twitter</a>
    <br/>
    Copyright © 2011 Studygig.   
  	
  </div><!-- end footer div -->
	
</div><!-- end wrapper div -->

	</body>
</html>
