<div id="content2">
	
<div class="loginCol">	
	
	<span id="loginTitle">Reset Your Password</span>
<?php 

if ($resetpass){
	echo '<div class="ui-state-highlight ui-corner-all" >Password has been reset, please check your account email.</div>';
	}else if (validation_errors() != ""){
		echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:95%;">'.validation_errors().'</div>';
		 }?>
 <div id="loginForm">
<?php echo form_open('users/resetpass');?>

<p>Enter your e-mail address to have the password associated with that account reset.</p>
Email: <input type="textfield" class="formTextField2" name="email" maxlength="30"  value="<?php echo set_value('email'); ?>" />

<input type="submit" id="loginButton" value="Reset my password" />

<?php echo form_close();?>

</div>
</div>
	

</div>
