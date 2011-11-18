<div id="content2">
	
	<ul id="user_navbar">
		<li >
			<a href="dashboard">Dashboard</a>
		</li>
		<li>
			<a href="yourUploads">Your Uploads</a>
		</li>
		<li >
			<a href="yourListings">Your Listings</a>
		</li>
		<li class="active">
			<a href="profile">Profile</a>
		</li>
		<li >
			<a href="account">Account</a>
		</li>
		<li>
			<a href="rewards">Rewards</a>
		</li>
	</ul>
	

<!-- MAIN CONTENT START
 ************************
 -->
 
 
<div id="favourites" class="roundedCornerContent">

<?php 

if ($editted==1){
	echo '<p class="ui-state-highlight ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;">Success! Your profile was updated.</p>';
	}else if (validation_errors() != ""){
		echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:90%;">'.validation_errors().'</div>'; } 
		
		?>

	<div id="editProfileForm">
	<?php echo form_open('users/editProfile');?>
	Full Name: 
	<input type="textfield" id="username" name="name" value="<?php echo set_value('name'); ?>" />
	Profile Pic: 
	<input type="textfield" class="formTextField" name="profilePic" maxlength="30" value="<?php echo set_value('email', $user->email); ?>" />
	
	Current password: <input type="password" class="formTextField" maxlength="32" name="currentpassword" value="<?php echo set_value('currentpassword'); ?>" />
	
	New password: <input type="password"class="formTextField" name="newpassword" maxlength="32" value="<?php echo set_value('newpassword'); ?>" />
	
	Confirm new password: <input type="password" class="formTextField" maxlength="32" name="confirmnewpassword" value="<?php echo set_value('confirmnewpassword'); ?>" />
	
	<input type="submit" id="insertUploadButton"  name="submit" value="Save account settings" /> 
	<?php echo form_close();?>
	</div>

</div><!-- end favourite div -->
 
 
</div><!-- end content div -->



