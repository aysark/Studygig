<!-- Google Code for Signup Page Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1036987137;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "3lzaCM2l6AIQgda87gM";
var google_conversion_value = 0;
if (1) {
  google_conversion_value = 1;
}
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1036987137/?value=1&amp;label=3lzaCM2l6AIQgda87gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- END Google Code for Signup Page Conversion Page -->
<div id="loginTitle" style="text-align: center;">Create a <b>Free</b> Account</div>
<div class="signup-upload"></div>
<div class="signup-rewards"></div>
<div class="signupCol">	
	<h3>The easiest way to study.</h3>
	<?php
	if (validation_errors() != ""){
	 echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:95%;">'.validation_errors().'</div>';}?>
	 
 <div id="loginForm">
	<div id="loginWithFacebook">
	<a href="<?php echo site_url('sessions/fb_login');?>" class="facebookLink"><div id="loginWithFacebookButton"></div></a>
	<p> <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js
#appId=170587262970610&amp;xfbml=1"></script><fb:facepile></fb:facepile></p>
<script type="text/javascript">
    mpmetrics.track_links(".facebookLink", "Signed up through Facebook");
</script>
<br/>
<h2>Already a Studygig member? <a href="login">Login Now.</a></h2>
	 </div>
	 
	 <div id="verticalSep">
    &nbsp;
	</div>
	 <?php 
$attributes = array('name' => 'signupform' ,'id' => 'loginWithOutFb'); 
echo form_open('users/createuser',$attributes);?>
	<p>Or sign up using this form:</p>
Email:<br/><input type="textfield" class="formTextField2" name="email" maxlength="30" value="<?php echo set_value('email'); ?>" required />
Username: <br/><input type="textfield"class="formTextField2" maxlength="30" name="username" value="<?php echo set_value('username'); ?>" required />

<div id="password">
	Password: <br/><input type="password" class="formTextField2" maxlength="32"  name="password" value="<?php echo set_value('password'); ?>" required />
</div>
<p><input type="submit" id="loginButton" value="Create Account" /></p>

<?php echo form_close();?>
	 <div class="clear"></div>
</div>

</div>
<div class="signupCol2">	
	<h2><a href="../site/tenreasons">9 reasons why students use Studygig.</a></h2>
</div>




<script type="text/javascript" language="JavaScript">
mpmetrics.track("Viewing Sign Up Page", {"From": "<?php echo $_SERVER['HTTP_REFERER']; ?>"}); 

var on_button_click = function() {
    mpmetrics.track("Signed up through Studygig"); 
};
$("#loginButton").click(on_button_click);

document.forms['signupform'].elements['email'].focus();
$(document).ready(function(){
    $('#password').showPassword();
});

jQuery.fn.showPassword = function (conf) {
    var config = $.extend({
        str:        'Show password', 
        className:    'password-toggler'
    }, conf);

    return this.each(function () {
        jQuery('input[type=password]', this).each(function () {
            var field        = jQuery(this);
            var fakeField    = jQuery('<input type="text" class="' + config.className + ' formTextField2" value="' + field.val() + '" />').insertAfter(field).hide(); // only IE really needs this
            var check        = jQuery('<label class="' + config.className + '"><input type="checkbox" /> ' + config.str + '</label>');
            var parentLabel    = field.parents('label');

            if (parentLabel.length) {
                check.insertAfter(parentLabel);
            }
            else {
                check.insertAfter(fakeField); // field
            }

            check.find('input').click(function() {
                if (jQuery(this).is(':checked')) {
                //    field.attr('type', 'text'); // strange, this threw errors
                //    field[0].type = 'text'; // and this doesn't work in IE
                    field.hide();
                    fakeField.val(field.val()).show();
                }
                else {
                //    field.attr('type', 'password');
                //    field[0].type = 'password';
                    field.show();
                    fakeField.hide();
                }
            });

            fakeField.change(function() {
                field.val(fakeField.val());
            });
        });
    });
};
</script>
