<div id="content2">
	
<div class="loginCol">	
	
	<span id="loginTitle">Resend Validation Email</span>
<?php 		 
		 if (validation_errors() != ""){
		echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:95%;">'.validation_errors().'</div>'; 
		} 
	 if($verifiedSent){
		echo '<div class="ui-state-highlight ui-corner-all" >The validation email has been resent - check your inbox or junk mail for it!</div>';
	}
		 
		 ?>
 <div id="loginForm">
<?php echo form_open('users/resendVerificationEmail');?>

<p>Enter your e-mail address to have us resend the validation email.</p>
Email: <input type="textfield" class="formTextField2" name="email" maxlength="30"  value="<?php echo set_value('email'); ?>" required />

<input type="submit" id="loginButton" value="Resend Validation" />

<?php echo form_close();?>

</div>
</div>
	

</div>
