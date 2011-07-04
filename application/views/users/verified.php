<div id="content2">
	
<div class="loginCol">	
	
	<span id="loginTitle">Account Validated</span>
		<?php 
	if (validation_errors() != ""){
		echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:95%;">'.validation_errors().'</div>'; 
		} 
	
	if ($incorrectLogin){
			echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:95%;">Login details are incorrect.  Or if you have not validated your email, you must validate your email before you can login.  <a href="../resendVerificationEmailPage">Click here to resend the validation email.</a>
			
			</div>';	
	}else if($notVerified){
			echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:95%;">You have not validated your email, you must validate your email before you can login.  <a href="../resendVerificationEmailPage">Click here to resend the validation email.</a></div>';
	}
?>

<p>You can login now!</p>

<?php 
$attributes = array('name' => 'loginform'); 
echo form_open('sessions/create',$attributes);?>
<div id="emailLoginField2">
Email:<input type="textfield" class="formTextField2" name="email" maxlength="30" value="<?php echo set_value('email'); ?>" />
</div>
<div id="passwordLoginField2">
Password: <input type="password" class="formTextField2" name="password" maxlength="32"  value="<?php echo set_value('password'); ?>" />
<a href="<?php echo site_url('users/forgotpass');?>">Forgot your password?</a>
</div>
<div id="loginButtonAlign">
<input type="submit" id="loginButton" value="Login" />
</div>
<?php echo form_close();?>
</div>
	

</div>

<script type="text/javascript" language="JavaScript">
document.forms['loginform'].elements['email'].focus();
</script>