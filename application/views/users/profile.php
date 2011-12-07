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
 
 
<div id="profile" class="roundedCornerContent">

	<div id="editProfileForm">
	<?php echo form_open('users/editprofile');?>
		Full name:<input type="textfield" class="formTextField" id="fullname" name="fullname" value="<?php echo set_value('fullname', $user->fullname); ?>" />
		University major:<input type="textfield" class="formTextField" name="major" value="<?php echo set_value('major', $user->major); ?>" />
		Year of study:<select id="year" name="year">
						<option value="1st year">1st year</option>
						<option value="2nd year">2nd year</option>
						<option value="3rd year">3rd year</option>
						<option value="4th year">4th year</option>
						<option value="5th+ year">5th+ year</option>
						<option value="Other">Other</option>
					  </select>
		
		<br />
		<input type="submit" id="insertUploadButton"  name="submit" value="Save profile settings" /> 
	<?php echo form_close();?>
	</div>

</div><!-- end favourite div -->
 
 
</div><!-- end content div -->



