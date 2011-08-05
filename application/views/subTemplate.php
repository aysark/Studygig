<?php 	 if (uri_string() == 'users/login')
			$this->session->keep_flashdata('last_url');
		else
		 	$this->session->set_flashdata('last_url',current_url()); ?>
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
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />   
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
	
	$link = array(
          'href' => 'css/chosen.css',
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
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tipsy.mini.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>

<script type="text/javascript" language="JavaScript">
  
$.widget( "custom.catcomplete", $.ui.autocomplete, {
		_renderMenu: function( ul, items ) {
			var x = document.forms['searchform'].elements['query'].value;
			var self = this, currentCategory = "";
			
			$.each( items, function( index, item ) {

				if ( item.category != currentCategory ) {
					ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
					currentCategory = item.category;
				}
			
				document.forms['searchform'].elements['query'].value = x+(items[0].label).substring(x.length).toLowerCase();	
				$('#mainSearchField').selectRange(x.length,items[0].label.length);
				
				self._renderItem( ul, item );
				
			});
		}
	});
$.fn.selectRange = function(start, end) {
    return this.each(function() {
        if (this.setSelectionRange) {
            this.focus();
            this.setSelectionRange(start, end);
        } else if (this.createTextRange) {
            var range = this.createTextRange();
            range.collapse(true);
            range.moveEnd('character', end);
            range.moveStart('character', start);
            range.select();
        }
    });
};
	
$(function() {
		$( "#mainSearchField" ).catcomplete({
				source: "<?php echo base_url();?>get_course_list.php",
				minLength: 1,
				delay: 0
			});

// google analytics START
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22030731-1']);
  _gaq.push(['_trackPageview']);

    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(ga, ss);
  // google analytics END			

//uservoice START
  var uvOptions = {};

    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/1bMi7usxc9DYeOCJAACjSw.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);

  //uservoice END
  
})();
  
	$(".chzn-select").chosen();

</script>

</head>
	<body>

			<div id="alphaBarContent">
			Hi there!  We are in <a href="<?php echo site_url('site/aboutus');?>">Public Alpha</a>, please be patient with us as we fix bugs, complete pages and add  features.  But we'd love to hear your opinion and feedback!
			</div>
	<div id="wrapper">
		<?php if( extension_loaded('newrelic') ) { echo newrelic_get_browser_timing_header(); } ?>
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
    
        <script type='text/javascript'> var mp_protocol = (('https:' == document.location.protocol) ? 'https://' : 'http://'); document.write(unescape('%3Cscript src="' + mp_protocol + 'api.mixpanel.com/site_media/js/api/mixpanel.js" type="text/javascript"%3E%3C/script%3E')); </script> <script type='text/javascript'> try {  var mpmetrics = new MixpanelLib('2150b708434b3dc7d28b6e2bb92fd003'); } catch(err) { null_fn = function () {}; var mpmetrics = {  track: null_fn,  track_funnel: null_fn,  register: null_fn,  register_once: null_fn, register_funnel: null_fn }; } 

</script>
    
	<?php $this->load->view($content); ?>
	
	<div id="footer">
  	<div id="seperator">
  	</div>
   	
   
    
    <div class="clear">
    </div>
    
    <div id="footerText">
    <ul class="horiList">
     <li><a href="<?php echo site_url('site/aboutus');?>">About Us</a></li>
     <li><a href="<?php echo site_url('site/tenreasons');?>">9 Reasons</a></li>
     <li><a href="http://studygig.assistly.com/">FAQs/Help</a></li>
     <li><a href="http://studygig.posterous.com">Blog</a></li>
     <li><a href="<?php echo site_url('site/academicintegrity');?>">Academic Integrity</a></li>
     <li><a href="<?php echo site_url('site/copyright');?>">Copyright Notice</a></li>
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
	<?php if( extension_loaded('newrelic') ) { echo newrelic_get_browser_timing_footer(); } ?>
</div><!-- end wrapper div -->
<script type="text/javascript" language="JavaScript">
<?php if(isset($query)): ?>		
mpmetrics.track("Search", {"Query": "<?php echo $query; ?>"}); 
<?php endif; ?>

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
	
	if (x==null || x=="" || x.length < 5)
	 {
	  	document.forms['searchform'].elements['query'].focus();
	  	return false;
	 }else{
	 	return true;
	 }
}


</script>
	</body>
		<script type="text/javascript" language="JavaScript">
	<?php if($this->session->userdata('logged_in')): ?>		
	 		mpmetrics.name_tag("<?php echo $this->session->userdata('username'); ?>");
	 	<?php else: ?>
	 					mpmetrics.name_tag("<?php echo $_SERVER['REMOTE_ADDR']; ?>");
	 	<?php endif; ?>
	</script>
</html>
