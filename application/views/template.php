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
$str = str_replace('\n',' ',$pageDescription);
$str = str_replace('\r',' ',$str);
echo $str; 
?>" /> 

<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="PUBLIC">

<meta property="og:title" content="<?php echo $pageTitle; ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://studygig.com" />
<meta property="og:image" content="http://www.studygig.com/images/logo.png" />
<meta property="og:description" content="<?php $str = str_replace('\n',' ',$pageDescription);
$str = str_replace('\r',' ',$str);
echo $str;  ?>" />
<meta property="og:site_name" content="Studygig" />
<meta property="fb:admins" content="509468451" />
<meta property="fb:app_id" content="170587262970610" /> 

<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />   
<meta name="google-site-verification" content="wWfOHZs42xIyUlxca007WHi7_8QfdBsoxwX5dqgqZt4" /> 

	 <link href="css/style.css" media="screen" rel="stylesheet" type="text/css" /> 
	  <link href="css/jquerycss.css" media="screen" rel="stylesheet" type="text/css" /> 
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.blockUI.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<script type="text/javascript" src="js/jquery.MetaData.js"></script>
	<script type="text/javascript" src="js/jquery.MultiFile.min.js"></script>	
	<script type="text/javascript" src="js/jquery.tipsy.mini.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
	 <link rel="alternate" type="application/rss+xml" title="Classifieds Feed" href="http://studygig.com/index.php/classifiedFeed/" /> 
		<!-- include Cycle plugin -->
<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>

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
	$('.slideshow').cycle({
		fx: 'scrollDown', 
		sync:   1, 
    	speed:   1500, 
    	timeout: 4000,
    	random: 1,
    	 nowrap:  0
	});
	
	$( "#mainSearchField" ).catcomplete({
				source: "get_course_list.php",
				minLength: 1,
				delay: 0
				
			});
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
			
// google analytics START
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22030731-1']);
  _gaq.push(['_trackPageview']);

    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(ga, ss);
  // google analytics END
			
//uservoice START
 /* var uvOptions = {};

    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/1bMi7usxc9DYeOCJAACjSw.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
*/
  //uservoice END
});
  
  
  var _gms = {
    move_sel: 'div,a,input[type=submit]',
    load_t: +new Date,
    unload: true,
    profile: '2a65dc'
  };

</script>

</head>
	<body>
		<!-- ClickTale Top part -->
<script type="text/javascript">
var WRInitTime=(new Date()).getTime();
</script>
<!-- ClickTale end of Top part -->

			
<?php if( extension_loaded('newrelic') ) { echo newrelic_get_browser_timing_header(); } ?>
    <div id="navbar">
    	<div id="innerNavBar">
    		<a id="navLogo" href="/">
    			<img src="images/nav/logo.png" width="122" height="28" alt="Studygig">
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
				<li class="navbar-list-item"><a href="index.php/site/howitworks">How It Works</a></li>
				<li class="navbar-list-item"><a href="<?php echo site_url('users/signup');?>">Create An Account</a></li>
				<li class="navbar-list-item"><a href="<?php echo site_url('users/login');?>">Log In</a></li>
			<?php endif; ?>
         </ul>
         <a id="upload-notes" href="<?php echo site_url('uploads/insert');?>">Upload Notes</a>
         
         <ul class="navbar-list right">
         	<li class="navbar-list-item"><a href="<?php echo site_url('site/help');?>">Help</a></li>
         	
	</ul>
    </div><!-- end inner navbar-->
    </div><!-- end navbar div -->
    <div id="wrapper">
    <script type='text/javascript'> var mp_protocol = (('https:' == document.location.protocol) ? 'https://' : 'http://'); document.write(unescape('%3Cscript src="' + mp_protocol + 'api.mixpanel.com/site_media/js/api/mixpanel.js" type="text/javascript"%3E%3C/script%3E')); </script> <script type='text/javascript'> try {  var mpmetrics = new MixpanelLib('2150b708434b3dc7d28b6e2bb92fd003'); } catch(err) { null_fn = function () {}; var mpmetrics = {  track: null_fn,  track_funnel: null_fn,  register: null_fn,  register_once: null_fn, register_funnel: null_fn }; } 

mpmetrics.track("Viewing Home Page", {"From": "<?php echo $_SERVER['HTTP_REFERER']; ?>"}); 
</script>
  <?php $this->load->view($content); ?>
  <div id="footer">
  	<div id="seperator">
  	</div>
    <div id="footerSEO">
    	<div class="col11">
                <h2>Popular Subjects</h2> 
<ul class="seo" >
<li><a href="index.php/uploads/search/Administrative Studies" title="Administrative Studies">ADMS - Administrative Studies</a></li>
<li><a href="index.php/uploads/search/Computer Science & Engineering" title="Computer Science & Engineering">CSE - Computer Science & Engineering</a></li>
<li><a href="index.php/uploads/search/Dance" title="Dance">DANC - Dance</a></li>
<li><a href="index.php/uploads/search/Economics" title="Economics">ECON - Economics</a></li>
<li><a href="index.php/uploads/search/English" title="English">EN - English</a></li>
<li><a href="index.php/uploads/search/Environmental Studies" title="Environmental Studies">ENVS - Environmental Studies</a></li>
<li><a href="index.php/uploads/search/Geography" title="Geography">GEOG - Geography</a></li>
<li><a href="index.php/uploads/search/History" title="History">HIST - History</a></li>
<li><a href="index.php/uploads/search/Humanities" title="Humanities">HUMA - Humanities</a></li>
</ul>

<ul class="seo" >
	<li><a href="index.php/uploads/search/Mathematics and Statistics" title="Mathematics and Statistics">MATH - Mathematics and Statistics</a></li>
<li><a href="index.php/uploads/search/Philosophy" title="Philosophy">PHIL - Philosophy</a></li>
<li><a href="index.php/uploads/search/Political" title="Political Science">POLS - Political Science</a></li>
<li><a href="index.php/uploads/search/Psychology" title="Psychology">PSYC - Psychology</a></li>
<li><a href="index.php/uploads/search/Sociology" title="Sociology">SOCI - Sociology</a></li>
<li><a href="index.php/uploads/search/Social Science" title="Social Science">SOSC - Social Science</a></li>
<li><a href="index.php/uploads/search/Visual Arts" title="Visual Arts">VISA - Visual Arts</a></li>
<li><a href="index.php/uploads/search/Womens Studies" title="Womens Studies">WMST - Womens Studies</a></li>
</ul>
            </div>
            <div class="col22">
                <h2>Popular Courses</h2>
<ul class="seo" >
<li><a href="index.php/uploads/search/ADMS1000" title="ADMS1000">ADMS1000</a></li>
<li><a href="index.php/uploads/search/CSE1020" title="CSE1020">CSE1020</a></li>
<li><a href="index.php/uploads/search/DANC1205" title="DANC1205">DANC1205</a></li>
<li><a href="index.php/uploads/search/ECON1000" title="ECON1000">ECON1000</a></li>
<li><a href="index.php/uploads/search/EN1001" title="EN1001">EN1001</a></li>
<li><a href="index.php/uploads/search/ENVS1000" title="ENVS1000">ENVS1000</a></li>
<li><a href="index.php/uploads/search/ENVS1200" title="ENVS1200">ENVS1200</a></li>
<li><a href="index.php/uploads/search/GEOG1000" title="GEOG1000">GEOG1000</a></li>
</ul>

<ul class="seo" >
<li><a href="index.php/uploads/search/HIST1010" title="HIST1010">HIST1010</a></li>
<li><a href="index.php/uploads/search/HUMA1110" title="HUMA1110">HUMA1110</a></li>
<li><a href="index.php/uploads/search/HUMA1125" title="HUMA1125">HUMA1125</a></li>
<li><a href="index.php/uploads/search/MATH1013" title="MATH1013">MATH1013</a></li>
<li><a href="index.php/uploads/search/MATH1014" title="MATH1014">MATH1014</a></li>
<li><a href="index.php/uploads/search/PHIL1000" title="PHIL1000">PHIL1000</a></li>
<li><a href="index.php/uploads/search/PHIL1100" title="PHIL1100">PHIL1100</a></li>
<li><a href="index.php/uploads/search/PSYC1010" title="PSYC1010">PSYC1010</a></li>
</ul>

<ul class="seo" >
<li><a href="index.php/uploads/search/PSYC2020" title="PSYC2020">PSYC2020</a></li>
<li><a href="index.php/uploads/search/SOCI1010" title="SOCI1010">SOCI1010</a></li>
<li><a href="index.php/uploads/search/SOCI2030" title="SOCI2030">SOCI2030</a></li>
<li><a href="index.php/uploads/search/SOSC1000" title="SOSC1000">SOSC1000</a></li>
<li><a href="index.php/uploads/search/SOSC1009" title="SOSC1009">SOSC1009</a></li>
<li><a href="index.php/uploads/search/VISA1000" title="VISA1000">VISA1000</a></li>
<li><a href="index.php/uploads/search/WMST1500" title="WMST1500">WMST1500</a></li>
<li><a href="index.php/uploads/search/WMST1510" title="WMST1510">WMST1510</a></li>
</ul>

            </div>
            <div class="col33">
                <h2>Study Material</h2>
<ul class="seo">
<li><a href="index.php/uploads/search/Books" title="Books">Books</a></li>
<li><a href="index.php/uploads/search/past tests" title="Past tests, quizes, exams, midterms, finals">Past Tests</a></li>
<li><a href="index.php/uploads/search/Assignment Solutions" title="Assignment Solutions">Solutions</a></li>
<li><a href="index.php/uploads/search/Lecture Notes" title="Lecture Notes and student notes">Lecture Notes</a></li>
<li><a href="index.php/uploads/search/Lab Report" title="Lab Reports &amp; Material">Lab Reports &amp; Material</a></li>
<li><a href="index.php/uploads/search/Study guide" title="Study guides">Study Guides</a></li>
<li><a href="index.php/uploads/search/Reference Material" title="Reference Materials, equation sheets, cheat sheets">Reference Materials</a></li>
</ul>
            </div>
    </div>
    
    <div class="clear">
    </div>
    
    <div id="footerText">
    <ul class="horiList">
     <li><a href="index.php/site/aboutus">About Us</a></li>
     <li><a href="index.php/site/tenreasons">9 Reasons</a></li>
     <li><a href="index.php/site/help">FAQs/Help</a></li>
     <li><a href="http://studygig.posterous.com">Blog</a></li>
     <li><a href="index.php/site/academicintegrity">Academic Integrity</a></li>
     <li><a href="index.php/site/copyright">Copyright Notice</a></li>
     <li><a href="index.php/site/termsofuse">Terms of Use</a></li>
     <li><a href="index.php/site/privacy">Privacy Policy</a></li>
     <li><a href="index.php/site/contact">Contact Us</a></li>
    </ul>
    <br/>
    Join us on: <a href="http://www.facebook.com/studygig" title="Like Studygig on Facebook">Facebook</a> & <a href="http://twitter.com/studygig" title="Follow Studygig on Twitter">Twitter</a><a href="http://mixpanel.com/f/partner" style="float:right;"><img src="http://mixpanel.com/site_media/images/partner/badge_light.png" alt="Web Analytics" /></a>
    <br/>
    Copyright © 2011 Studygig.
    <br/>
     Made in Canada <img src="images/made-in-canada.png" width="15" height="10" alt="Made in Canada" />     
 </div>
  	
  </div><!-- end footer div -->
    <?php if( extension_loaded('newrelic') ) { echo newrelic_get_browser_timing_footer(); } ?>
</div><!-- end wrapper div -->
<!-- ClickTale Bottom part -->
<div id="ClickTaleDiv" style="display: none;"></div>
<script type="text/javascript">
	$(function() {
		$( "#tabs" ).tabs();
		$('.dashHelp').tipsy({gravity: 'w'});
		$('.dashHelpS').tipsy({gravity: 'n'});
	});

if(document.location.protocol!='https:')
  document.write(unescape("%3Cscript%20src='http://s.clicktale.net/WRc5.js'%20type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
if(typeof ClickTale=='function') ClickTale(247,1,"www08");
</script>
<!-- ClickTale end of Bottom part -->
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
