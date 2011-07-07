<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" lang="en">  
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pageTitle; ?></title>
<meta name="title" content="<?php echo $pageTitle; ?>" /> 
<meta name="author" content="Studygig"/> 
<meta name="description" content="<?php
$str = str_replace('\n',' ',htmlspecialchars($pageDescription));
$str = str_replace('\r',' ',$str);
echo substr($str,0,150);   ?>" /> 

<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="PUBLIC">
 		
<meta property="fb:app_id" content="170587262970610" /> 
<meta property="og:site_name" content="<?php echo $pageTitle; ?>" /> 
<meta property="og:title" content="<?php echo $pageTitle; ?>" /> 
<meta property="og:url" content="<?php echo current_url(); ?>" /> 
<meta property="og:type" content="website" /> 
<meta property="og:image" content="http://www.studygig.com/images/logo.png" /> 
<meta property="og:description" content="<?php
$str = str_replace('\n',' ',htmlspecialchars($pageDescription));
$str = str_replace('\r',' ',$str);
echo substr($str,0,150);   ?>" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />   
<meta name="google-site-verification" content="wWfOHZs42xIyUlxca007WHi7_8QfdBsoxwX5dqgqZt4" /> 
	<?php
	
	$link = array(
          'href' => 'css/style.css',
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
	
	?>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.blockUI.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.form.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.MetaData.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.MultiFile.min.js"></script>	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>

<script type="text/javascript" language="JavaScript">
  //user voice
    var uvOptions = {};
  
$.widget( "custom.catcomplete", $.ui.autocomplete, {
		_renderMenu: function( ul, items ) {
			var self = this,
				currentCategory = "";
			$.each( items, function( index, item ) {
				if ( item.category != currentCategory ) {
					ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
					currentCategory = item.category;
				}
				self._renderItem( ul, item );
			});
		}
	});
	
	//kissmetrics
	var _kmq = _kmq || [];
  function _kms(u){
    setTimeout(function(){
      var s = document.createElement('script'); var f = document.getElementsByTagName('script')[0]; s.type = 'text/javascript'; s.async = true;
      s.src = u; f.parentNode.insertBefore(s, f);
    }, 1);
  }
  _kms('//i.kissmetrics.com/i.js');_kms('//doug1izaerwt3.cloudfront.net/d8977a0cd5dace9f913e5f13bb972a0a61b72853.1.js');
	
$(function() {
		$( "#mainSearchField" ).catcomplete({
				source: "<?php echo base_url();?>get_course_list.php",
				minLength: 1,
				delay: 0
			});
			
		var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/1bMi7usxc9DYeOCJAACjSw.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
})();

//google analytics
  var uvOptions = {};
  (function() {
    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/1bMi7usxc9DYeOCJAACjSw.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
  })();
  
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22030731-1']);
  _gaq.push(['_setDomainName', '.studygig.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  

</script>

</head>
	<body>

			<div id="alphaBarContent">
			Hi there!  We are in <a href="<?php echo site_url('site/aboutus');?>">Public Alpha</a>, please be patient with us as we fix bugs, complete pages and add  features.  But we'd love to hear your opinion and feedback!
			</div>
	<div id="wrapper">
		 <div id="top">
    	
        	<?php if($this->session->userdata('logged_in')): ?>
        		<div id="navigationLoggedIn">
            	<div id="hiUser">Hi, <?php echo $this->session->userdata('username'); ?>!</div>
                <?php echo anchor('users/dashboard','Dashboard ('.$points.')'); ?> |  
                <?php echo anchor('users/profile','Account Settings'); ?> |  
                <a href="<?php echo site_url('sessions/destroy');?>">Logout</a> |  
				<a href="<?php echo site_url('site/howitworks'); ?>" title="Find out how Studygig works">How it works</a>  
                <div id="postStudyMaterialDialog" title="How would you like to post?">
	<a href="<?php echo site_url('uploads/insert');?>" style="outline:none;	-moz-outline:none;"><div id="shareStudyMaterialButton"></div></a> <a href="<?php echo site_url('classifieds/insert');?>" style="outline:none;-moz-outline:none;"><div id="sellStudyMaterialButton"></div></a>

	</div>
	<div id="postStudyMaterialButton">Post Study Material</div>
			<?php else: ?>	
				<div id="navigation">
                <a href="<?php echo site_url('users/login');?>" title="Sign in to your Studygig account">Login</a> |  
                <a href="<?php echo site_url('users/signup');?>" title="Create an account to use Studygig">Create an Account</a> |  
                <a href="<?php echo site_url('site/howitworks'); ?>" title="Find out how Studygig works">How it works</a>
                
                <div id="postStudyMaterialDialog" title="How would you like to post?">
	<a href="<?php echo site_url('uploads/insert');?>" style="outline:none;	-moz-outline:none;"><div id="shareStudyMaterialButton"></div></a> <a href="<?php echo site_url('classifieds/insert');?>" style="outline:none;-moz-outline:none;"><div id="sellStudyMaterialButton"></div></a>

	</div>
	<div id="postStudyMaterialButton">Post Study Material</div>
			
			<?php endif; ?>
         </div>
    </div><!-- end top div -->
		
	    <div id="header2">
    <a href="<?php echo site_url();?>" title="Welcome to Studygig"><img src="<?php echo base_url(); ?>images/studygig-logo.png" width="228" height="60" alt="Studygig Logo" /></a>
    
    <div id="main2Search">
        	<?php $attributes = array('class' => 'search', 'method' => 'post', 'name' => 'searchform', 'onsubmit' => 'return validateForm()' ); 
	echo form_open('uploads/searchfor',$attributes); 
	if (!isset($query)){
	?>
	<input name="query" type="text" id="mainSearchField" value="" /><input name="submit" type="submit" value="" id="mainSearchButton" class="button" />
	<?php
}else{
?>
<input name="query" type="text" id="mainSearchField" value="<?php echo $query; ?>" /><input name="submit" type="submit" value="" id="mainSearchButton" class="button" />
<?php } ?>		
      <?php echo form_close(); ?>
        </div>
  	</div>
    <!-- end header div -->		
	<?php $this->load->view($content); ?>
	
	<div id="footer">
  	<div id="seperator">
  	</div>
   	
    <div id="footerSEO">
    	<div class="col11">
                <h2>Popular Subjects</h2> 
<ul class="seo" >
<li><a href="Administrative Studies" title="Administrative Studies">ADMS - Administrative Studies</a></li>
<li><a href="Computer Science & Engineering" title="Computer Science & Engineering">CSE - Computer Science & Engineering</a></li>
<li><a href="Dance" title="Dance">DANC - Dance</a></li>
<li><a href="Economics" title="Economics">ECON - Economics</a></li>
<li><a href="English" title="English">EN - English</a></li>
<li><a href="Environmental Studies" title="Environmental Studies">ENVS - Environmental Studies</a></li>
<li><a href="Geography" title="Geography">GEOG - Geography</a></li>
<li><a href="History" title="History">HIST - History</a></li>
<li><a href="Humanities" title="Humanities">HUMA - Humanities</a></li>
</ul>

<ul class="seo" >
	<li><a href="Mathematics and Statistics" title="Mathematics and Statistics">MATH - Mathematics and Statistics</a></li>
<li><a href="Philosophy" title="Philosophy">PHIL - Philosophy</a></li>
<li><a href="Political" title="Political Science">POLS - Political Science</a></li>
<li><a href="Psychology" title="Psychology">PSYC - Psychology</a></li>
<li><a href="Sociology" title="Sociology">SOCI - Sociology</a></li>
<li><a href="Social Science" title="Social Science">SOSC - Social Science</a></li>
<li><a href="Visual Arts" title="Visual Arts">VISA - Visual Arts</a></li>
<li><a href="Womens Studies" title="Womens Studies">WMST - Womens Studies</a></li>
</ul>
            </div>
            <div class="col22">
                <h2>Popular Courses</h2>
<ul class="seo" >
<li><a href="ADMS1000" title="ADMS1000">ADMS1000</a></li>
<li><a href="CSE1020" title="CSE1020">CSE1020</a></li>
<li><a href="DANC1205" title="DANC1205">DANC1205</a></li>
<li><a href="ECON1000" title="ECON1000">ECON1000</a></li>
<li><a href="EN1001" title="EN1001">EN1001</a></li>
<li><a href="ENVS1000" title="ENVS1000">ENVS1000</a></li>
<li><a href="ENVS1200" title="ENVS1200">ENVS1200</a></li>
<li><a href="GEOG1000" title="GEOG1000">GEOG1000</a></li>
</ul>

<ul class="seo" >
<li><a href="HIST1010" title="HIST1010">HIST1010</a></li>
<li><a href="HUMA1110" title="HUMA1110">HUMA1110</a></li>
<li><a href="HUMA1125" title="HUMA1125">HUMA1125</a></li>
<li><a href="MATH1013" title="MATH1013">MATH1013</a></li>
<li><a href="MATH1014" title="MATH1014">MATH1014</a></li>
<li><a href="PHIL1000" title="PHIL1000">PHIL1000</a></li>
<li><a href="PHIL1100" title="PHIL1100">PHIL1100</a></li>
<li><a href="PSYC1010" title="PSYC1010">PSYC1010</a></li>
</ul>

<ul class="seo" >
<li><a href="PSYC2020" title="PSYC2020">PSYC2020</a></li>
<li><a href="SOCI1010" title="SOCI1010">SOCI1010</a></li>
<li><a href="SOCI2030" title="SOCI2030">SOCI2030</a></li>
<li><a href="SOSC1000" title="SOSC1000">SOSC1000</a></li>
<li><a href="SOSC1009" title="SOSC1009">SOSC1009</a></li>
<li><a href="VISA1000" title="VISA1000">VISA1000</a></li>
<li><a href="WMST1500" title="WMST1500">WMST1500</a></li>
<li><a href="WMST1510" title="WMST1510">WMST1510</a></li>
</ul>

            </div>
            <div class="col33">
                <h2>Study Material</h2>
<ul class="seo">
<li><a href="Books" title="Books">Books</a></li>
<li><a href="past tests" title="Past tests, quizes, exams, midterms, finals">Past Tests</a></li>
<li><a href="Assignment Solutions" title="Assignment Solutions">Solutions</a></li>
<li><a href="Lecture Notes" title="Lecture Notes and student notes">Lecture Notes</a></li>
<li><a href="Lab Report" title="Lab Reports &amp; Material">Lab Reports &amp; Material</a></li>
<li><a href="Study guide" title="Study guides">Study Guides</a></li>
<li><a href="Reference Material" title="Reference Materials, equation sheets, cheat sheets">Reference Materials</a></li>
</ul>
            </div>
    </div>
    
    <div class="clear">
    </div>
    
    <div id="footerText">
    <ul class="horiList">
     <li><a href="<?php echo site_url('site/aboutus');?>">About Us</a></li>
     <li><a href="<?php echo site_url('site/help');?>">FAQs/Help</a></li>
     <li><a href="<?php echo site_url('site/blog');?>">Blog</a></li>
     <li><a href="<?php echo site_url('site/academicintegrity');?>">Academic Integrity</a></li>
     <li><a href="<?php echo site_url('site/termsofuse');?>">Terms of Use</a></li>
     <li><a href="<?php echo site_url('site/privacy');?>">Privacy Policy</a></li>
     <li><a href="<?php echo site_url('site/contact');?>">Contact Us</a></li>
    </ul>
    <br/>
    Join us on: <a href="http://www.facebook.com/studygig" title="Like Studygig on Facebook">Facebook</a> & <a href="http://twitter.com/studygig" title="Follow Studygig on Twitter">Twitter</a>
    <br/>
    Copyright © 2011 Studygig.
    <br/>
    Made in Canada <img src="<?php echo base_url(); ?>images/made-in-canada.png" width="15" height="10" alt="Made in Canada" /></div>
    
  	
  </div><!-- end footer div -->
	
</div><!-- end wrapper div -->
<script type="text/javascript" language="JavaScript">

$(function() {
	$( "#postStudyMaterialDialog" ).dialog({
		autoOpen: false,
			height: 340,
			width: 485,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
		close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
	});
	$( "#postStudyMaterialButton" )	.click(function() {
				$( "#postStudyMaterialDialog" ).dialog( "open" );
			});
			
});
function validateForm()
{
	var x= jQuery.trim(document.forms['searchform'].elements['query'].value);
	if (x==null || x=="" || (x.length < 5) || x=="Course name (e.g. ACTG4160 notes)" || x=="No course or subject found.")
	 {
	  	document.forms['searchform'].elements['query'].focus();
	  	return false;
	 }
}

</script>


	</body>
</html>
