
	<ul id="user_navbar">
		<li class="active">
			<a href="dashboard">Dashboard</a>
		</li>
		<li>
			<a href="yourUploads">Your Uploads</a>
		</li>
		<li>
			<a href="yourListings">Your Listings</a>
		</li>
		<li>
			<a href="profile">Profile</a>
		</li>
		<li>
			<a href="account">Account</a>
		</li>
		<li>
			<a href="rewards">Rewards</a>
		</li>
	</ul>
	
<div class="twoCol1RightBased">
	<h1><?php echo $user->username;?></h1>
	<span class="edit_button floatRight"><a href="profile">Edit Profile</a></span>
	<div class="clear"></div>
	<div id="dashboardShare" class="roundedCornerContent silver">
		  Invite your friends <br/>Earn $20 point credit!
		  <br/>
		  <a href="invite" id="insertUploadButton" style="font-size:18px; margin-top:10px;">Invite Now</a>
	</div>
	<div id="dashboardSnapshot" class="roundedCornerContent">
		<h2>Snapshot</h2>
		<br/>
		<ul>
			<li class="clear">
				<div class="stat_name">Points <a href="#" class="dashHelp" title="Use points to download study material (it costs 50 points to download) or trade in your points to redeem real life rewards.  To earn points- simply upload study material!"><img src="../../images/help-icon.gif" width="16" height="15" alt="Help Icon" /></a></div>
				<div class="stat_value"><?php echo $points;?></div>
				<div class="clear"></div>
			</li>
			
			<li class="clear">
				<div class="stat_name">Uploads</div>
				<div class="stat_value"><?php echo $total_uploads;?></div>
				<div class="clear"></div>
			</li>
			
			<li class="clear">
				<div class="stat_name">Downloads</div>
				<div class="stat_value"><?php echo $total_downloads;?></div>
				<div class="clear"></div>
			</li>
			
			<li class="clear">
				<div class="stat_name">Trophies <a href="#" class="dashHelp" title="This feature is still under construction."><img src="../../images/help-icon.gif" width="16" height="15" alt="Help Icon" /></a></div>
				<div class="stat_value">0</div>
				<div class="clear"></div>
			</li>
			<li class="clear">
				<div class="stat_name">Membership</div>
				<div class="stat_value"><?php 
					if ($ismember) {
					 echo "Member";
				 }
					 else{
					 echo "Free";
				 	}
					 ?></div>
				<div class="clear"></div>
				<div class="stat_action">
					<?php 
					if ($ismember) {
					 echo "<a href=\"../members/status\">View membership status »</a>";
				 }
					 else{
					 echo "<a href=\"../members/form\">Become a Member »</a>";
				 	}
					 ?>
				
				</div>
			</li>
			
		<ul>
	</div>

</div>


<!-- MAIN CONTENT START
 ************************
 -->
 
 
<div class="twoCol2RightBased">

	<div class="roundedCornerContent" id="dashboardGetStarted">
<h2>Get Started in 3 Steps</h2>
<ul class="dashboardList">
<li><a href="../uploads/insert"><img src="../../images/post-study-material-icon.png" class="textmiddle"> Upload Notes</a></li>
<li><a href="../classifieds/insert"><img src="../../images/list-study-material-icon.png" class="textmiddle"> List Your Books</a></li>
<li><img src="../../images/download-earn-icon.png" class="textmiddle"><a href="rewards"> Earn Rewards</a></li>
</ul>
</div>

<div id="favourites" class="roundedCornerContent">
<h2>Favourites</h2>
<ul>
	<?php 
			if(empty($favourites)){
				echo '<p>Start favouriting study material and you\'ll see them here!</p>';
			} ?>
			<?php $i=0; ?>
	<?php foreach($favourites as  $upload): ?>
		<li>
			
			<a href="<?php echo site_url('uploads/view/'. $upload->id);?>"><h2><?php echo $upload->title; ?></h2></a>
			 <h5> <img src="../../images/material<?php echo $upload->material; ?>.png" width="75" height="25" alt="Material Type" class="material-type-icon" /> <img src="../../images/file<?php echo $upload->filetype; ?>.png" width="20" height="20" class="file-type-icon" />
             Uploaded by <?php echo $favouritesUsers[$i]. " on " . date('F j, Y \a\t g:i A', strtotime($upload->created_at));?> in <a href="<?php echo site_url('uploads/getsearchfor/').'/'.substr ($favouritesCourses[$i],0,8);?>"><span class="courseCourseStyle"><?php echo $favouritesCourses[$i];?></span></a></h5>
			
		</li>
		<?php $i++;?>
	<?php endforeach; ?>
</ul>
</div>

<div id="favourites" class="roundedCornerContent">
<h2>Recent Downloads</h2>
<?php 
			if(empty($recentdownloads)){
				echo '<p>You haven\'t downloaded yet! Use points to download useful study material you find.  It costs 20 points to download.  You can easily earn points by <a href="../uploads/insert">posting study material.</a></p>';
			} ?>
		<ul>
			<?php $i=0; ?>
	<?php foreach($recentdownloads as  $upload): ?>
	<li>
	<h2><a href="<?php echo site_url('uploads/view/'. $upload->id);?>"><?php echo $upload->title; ?></a></h2>
	 <h5> <img src="../../images/material<?php echo $upload->material; ?>.png" width="75" height="25" alt="Material Type" class="material-type-icon" /> <img src="../../images/file<?php echo $upload->filetype; ?>.png" width="20" height="20" class="file-type-icon" />
     Uploaded by <?php echo $recentDownloadsUsers[$i]. " on " . date('F j, Y \a\t g:i A', strtotime($upload->created_at));?> in <a href="<?php echo site_url('uploads/getsearchfor/').'/'.substr ($recentDownloadsCourses[$i],0,8);?>"><span class="courseCourseStyle"><?php echo $recentDownloadsCourses[$i];?></span></a></h5>
			
		</li>
		<?php $i++;?>
	<?php endforeach; ?>
	</ul>
	<div class="clear" style="text-align:right">
		<?php 
					if (!$ismember) {
					 echo "<a href=\"../members/form\">Become a Member to see all your downloads »</a>";
				 }
					 ?>
	</div>
</div>
<?php if($user->oauth_provider): ?>
	<div id="dashboardFacebook">
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:activity site="http://studygig.com" width="640" height="200" header="true" font="tahoma" border_color="" recommendations="true"></fb:activity>
</div>
<?php endif; ?>
	
</div>



