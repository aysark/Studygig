
<div class="loginCol">	
	<span id="loginTitle">Login to your Studygig Account</span>
	<?php 
	if (validation_errors() != ""){
		echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:95%;">'.validation_errors().'</div>'; 
		} 
	
	if ($incorrectLogin){
			echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:95%;">Login details are incorrect.</div>';	
	}else if($notVerified){
			echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:95%;">You have not validated your email, you must validate your email before you can login.  <a href="../users/resendVerificationEmailPage">Click here to resend the validation email.</a></div>';
	}
?>

<div id="loginForm">
	<div id="loginWithFacebook">
	<h2>Login using Facebook</h2>
	<a href="<?php echo site_url('sessions/fb_login');?>"><div id="loginWithFacebookButton"></div></a>
	<p>
		<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js
#appId=170587262970610&amp;xfbml=1"></script><fb:facepile></fb:facepile>
</p>
<br/>
<h2>Need an account? <a href="../users/signup">Create an Account</a> - its Free (and takes 5 seconds)</h2>
	</div>
	<div id="verticalSep">
    &nbsp;
	</div>
	
<?php 
$attributes = array('name' => 'loginform', 'id' => 'loginWithOutFb'); 
echo form_open('sessions/create',$attributes);?>
	<h2>Or login using Studygig</h2>
<div id="emailLoginField">
Email:<input type="textfield" class="formTextField2" name="email" maxlength="30" value="<?php echo set_value('email'); ?>" required />
</div>
<div id="passwordLoginField">
Password: <input type="password" class="formTextField2" name="password" maxlength="32"  value="<?php echo set_value('password'); ?>" required />
<a href="<?php echo site_url('users/forgotpass');?>">Forgot your password?</a>
</div>
<div id="loginButtonAlign">
<input type="submit" id="loginButton" value="Login" />
</div>
<?php echo form_close();?>
<div class="clear"></div>
</div>
</div>

<script type="text/javascript" language="JavaScript">
document.forms['loginform'].elements['email'].focus();
</script>