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
	
	$link = array(
          'href' => 'css/sticky.min.css',
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
	<script type="text/javascript" src="<?php echo base_url();?>js/sticky.min.js"></script>

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
/*  var uvOptions = {};

    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/1bMi7usxc9DYeOCJAACjSw.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
*/
  //uservoice END
  
})();
  
	$(".chzn-select").chosen();

</script>

</head>
	<body>


	
		<?php if( extension_loaded('newrelic') ) { echo newrelic_get_browser_timing_header(); } ?>
		 <div id="navbar">
    	<div id="innerNavBar">
    		<a id="navLogo" href="/">
    			<img src="<?php echo base_url(); ?>images/nav/logo.png" width="122" height="28" alt="Studygig">
    			</a>
    			<ul class="navbar-list left">
        	<?php if($this->session->userdata('logged_in')): ?>
        		
        		<li class="navbar-list-item dropdown">
        			<a href="<?php echo site_url('users/dashboard');?>">
        				<span class="navbar-icon">&nbsp;&nbsp;&nbsp;</span>
        				Hi, <?php echo $this->session->userdata('username'); ?>!
        				<span class="navbar-arrow">&nbsp;&nbsp;&nbsp;</span>
        			</a>
        			<ul id="navbar-list-item-menu">
        				<li>
        					<img class="dropdown-arrow" alt="" src="<?php echo base_url(); ?>images/nav/arrowIconUpside.gif"/> 
        					<a href="<?php echo site_url('users/dashboard');?>">Dashboard</a></li> 
			            <li><a href="<?php echo site_url('users/account');?>">Account</a></li> 
			            <li><a href="<?php echo site_url('users/rewards');?>">Rewards</a></li> 
			            <li><a href="<?php echo site_url('sessions/destroy');?>">Log Out</a></li>
        			</ul>
			        
        		</li>
        		<li class="navbar-list-item points">
        			<a href="#" class="dashHelpS" title="Points"><span class="navbar-points">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        			<?php echo $points; ?></a>
        			</a>
        			</li>
			<?php else: ?>	
				<li class="navbar-list-item"><a href="<?php echo site_url('site/howitworks');?>">How It Works</a></li>
				<li class="navbar-list-item"><a href="<?php echo site_url('users/signup');?>">Create An Account</a></li>
				<li class="navbar-list-item"><a href="<?php echo site_url('users/login');?>">Log In</a></li>
			<?php endif; ?>
         </ul>
         <a id="upload-notes" href="<?php echo site_url('uploads/insert');?>">Upload Notes</a>
         
         <ul class="navbar-list right">
         	<li class="navbar-list-item"><a href="<?php echo site_url('members/form');?>">Become a Member</a></li>
         	<li class="navbar-list-item"><a href="<?php echo site_url('site/help');?>">Help</a></li>
         	
         <!-- <div id="postStudyMaterialDialog" title="How would you like to post?">
	<a href="<?php echo site_url('uploads/insert');?>" style="outline:none;	-moz-outline:none;"><div id="shareStudyMaterialButton"></div></a> <a href="<?php echo site_url('classifieds/insert');?>" style="outline:none;-moz-outline:none;"><div id="sellStudyMaterialButton"></div></a> 
	<div id="postStudyMaterialButton">Post Study Material</div> -->
	</ul>
    </div><!-- end inner navbar-->
    </div><!-- end navbar div -->
		<div id="wrapper">
	    <div id="header2">
	    	<div id="universityDialog" title="Pick a University/College">
	<h1>Want Your University/College on Studygig?</h1>
	<p>Studygig is currently offered for York University students.
		<br /><br />
		Leave your email and university/college name so we can let you know when we get to yours! </p>
	<!-- Begin MailChimp Signup Form -->
<link href="http://cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
<div id="mc_embed_signup">
<form action="http://studygig.us2.list-manage1.com/subscribe/post?u=474d67c0f98fc0b92284a9bc0&amp;id=8935058561" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
<div class="mc-field-group">
	<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
</label>
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
<div class="mc-field-group">
	<label for="mce-UNI">University/College Name  <span class="asterisk">*</span>
</label>
	<input type="text" value="" name="UNI" class="required" id="mce-UNI">
</div>
	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>	<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
</form>
</div>

<!--End mc_embed_signup-->
	</div>
   <div id="universityDropdown">York University<span class="whiteArrow"></span></div>
   
  
	
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
     <li><a href="<?php echo site_url('site/help');?>">FAQs/Help</a></li>
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
	$( "#universityDialog" ).dialog({
		autoOpen: false,
			height: 450,
			width: 600,
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
	$( "#universityDropdown" )	.click(function() {
				$( "#universityDialog" ).dialog( "open" );
			});
			
	$(function() {
		$('.dashHelp').tipsy({gravity: 'w'});
		$('.dashHelpS').tipsy({gravity: 'n'});
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
<!-- begin olark code --><script type='text/javascript'>/*{literal}<![CDATA[*/window.olark||(function(i){var e=window,h=document,a=e.location.protocol=="https:"?"https:":"http:",g=i.name,b="load";(function(){e[g]=function(){(c.s=c.s||[]).push(arguments)};var c=e[g]._={},f=i.methods.length; while(f--){(function(j){e[g][j]=function(){e[g]("call",j,arguments)}})(i.methods[f])} c.l=i.loader;c.i=arguments.callee;c.f=setTimeout(function(){if(c.f){(new Image).src=a+"//"+c.l.replace(".js",".png")+"&"+escape(e.location.href)}c.f=null},20000);c.p={0:+new Date};c.P=function(j){c.p[j]=new Date-c.p[0]};function d(){c.P(b);e[g](b)}e.addEventListener?e.addEventListener(b,d,false):e.attachEvent("on"+b,d); (function(){function l(j){j="head";return["<",j,"></",j,"><",z,' onl'+'oad="var d=',B,";d.getElementsByTagName('head')[0].",y,"(d.",A,"('script')).",u,"='",a,"//",c.l,"'",'"',"></",z,">"].join("")}var z="body",s=h[z];if(!s){return setTimeout(arguments.callee,100)}c.P(1);var y="appendChild",A="createElement",u="src",r=h[A]("div"),G=r[y](h[A](g)),D=h[A]("iframe"),B="document",C="domain",q;r.style.display="none";s.insertBefore(r,s.firstChild).id=g;D.frameBorder="0";D.id=g+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){D.src="javascript:false"} D.allowTransparency="true";G[y](D);try{D.contentWindow[B].open()}catch(F){i[C]=h[C];q="javascript:var d="+B+".open();d.domain='"+h.domain+"';";D[u]=q+"void(0);"}try{var H=D.contentWindow[B];H.write(l());H.close()}catch(E){D[u]=q+'d.write("'+l().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}c.P(2)})()})()})({loader:(function(a){return "static.olark.com/jsclient/loader0.js?ts="+(a?a[1]:(+new Date))})(document.cookie.match(/olarkld=([0-9]+)/)),name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('3318-113-10-6602');/*]]>{/literal}*/</script>
<!-- end olark code -->
	</body>
		<script type="text/javascript" language="JavaScript">
	<?php if($this->session->userdata('logged_in')): ?>		
	 		mpmetrics.name_tag("<?php echo $this->session->userdata('username'); ?>");
	 	<?php else: ?>
	 					mpmetrics.name_tag("<?php echo $_SERVER['REMOTE_ADDR']; ?>");
	 	<?php endif; ?>
	</script>
</html>
